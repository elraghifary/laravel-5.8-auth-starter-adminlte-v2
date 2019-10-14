<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        foreach ($user->getRoleNames() as $role) {
            $roles[] = $role;
        }

        $roles = implode(", ", $roles);

        return view('users.show', compact('user', 'roles'));
    }

    public function create()
    {
        $roles = Role::all()->pluck('name');

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = User::firstOrCreate([
            'email' => $request->email
        ], [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'status' => true
        ]);

        $user->assignRole($request->role);

        return redirect(route('user.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> has been saved.']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $password = !empty($request->password) ? bcrypt($request->password) : $user->password;

        $user->update([
            'name' => $request->name,
            'password' => $password,
            'status' => $request->status
        ]);

        return redirect(route('user.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> has been updated.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> was deleted.']);
    }

    public function roles(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all()->pluck('name');

        return view('users.roles', compact('user', 'roles'));
    }

    public function setRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->syncRoles($request->role);

        return redirect()->back()->with(['success' => 'User role has been set.']);
    }

    public function getData()
    {
        $users = User::all();

        $i = 0;
        
        $output = array(
            "data" => []
        );

        foreach ($users as $key => $user) {
            // get roles
            $arr_roles = [];

            foreach ($user->getRoleNames() as $role) {
                $arr_roles[] = $role;
            }

            $roles = implode(", ", $arr_roles);

            $link_show = route('user.show', $user->id);
            $link_role = route('user.roles', $user->id);
            $link_edit = route('user.edit', $user->id);
            $link_delete = route('user.destroy', $user->id);

            $output['data'][$i][] = $key + 1;
            $output['data'][$i][] = $user->name;
            $output['data'][$i][] = $user->email;
            $output['data'][$i][] = $user->status;
            $output['data'][$i][] = $roles;
            $output['data'][$i][] = '
                <form action="' . $link_delete . '" method="post" class="form-delete">
                    <a href="' . $link_role . '" class="btn btn-info btn-xs" data-popup="tooltip" title="Set User Role"><i class="fa fa-user-secret"></i></a>
                    <a href="' . $link_show . '" class="btn btn-default btn-xs" data-popup="tooltip" title="View User"><i class="fa fa-eye"></i></a>
                    <a href="' . $link_edit . '" class="btn btn-warning btn-xs" data-popup="tooltip" title="Edit User"><i class="fa fa-edit"></i></a>
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-xs" data-popup="tooltip" title="Delete User"><i class="fa fa-trash"></i></button>
                </form>';
            $i++;
        }

        echo json_encode($output);
    }
}
