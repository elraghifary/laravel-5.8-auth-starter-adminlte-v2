<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function store(Request $request)
    {
        $role = Role::firstOrCreate(['name' => $request->name]);

        return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> has been saved.']);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> was deleted.']);
    }

    public function permissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $permissions = null;
        $hasPermission = null;

        if (!empty($role)) {
            $getRole = Role::findByName($role->name);

            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();

            $permissions = Permission::all()->pluck('name');
        }

        return view('roles.permissions', compact('role', 'permissions', 'hasPermission'));
    }

    public function setPermission(Request $request, $role)
    {
        $role = Role::findByName($role);

        $role->syncPermissions($request->permission);

        return redirect()->back()->with(['success' => 'Role permission has been set.']);
    }

    public function getData()
    {
        $roles = Role::all();

        $i = 0;

        $output = array(
            "data" => []
        );

        foreach ($roles as $key => $role) {
            $link_permission = route('role.permissions', $role->id);
            $link_delete = route('role.destroy', $role->id);

            $output['data'][$i][] = $key + 1;
            $output['data'][$i][] = $role->name;
            $output['data'][$i][] = $role->guard_name;
            $output['data'][$i][] = date('j M Y h:i', strtotime($role->created_at));
            $output['data'][$i][] = '
                <form action="' . $link_delete . '" method="post" class="form-delete">
                    <a href="' . $link_permission . '" class="btn btn-info btn-xs" data-popup="tooltip" title="Permission Role"><i class="fa fa-file-text"></i></a>
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-xs" data-popup="tooltip" title="Delete Role"><i class="fa fa-trash"></i></button>
                </form>';
            $i++;
        }

        echo json_encode($output);
    }
}
