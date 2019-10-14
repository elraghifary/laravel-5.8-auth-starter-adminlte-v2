<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permissions.index');
    }

    public function store(Request $request)
    {
        $permission = Permission::firstOrCreate(['name' => $request->name]);

        return redirect()->back()->with(['success' => 'Permission: <strong>' . $permission->name . '</strong> has been saved.']);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        $permission->delete();

        return redirect()->back()->with(['success' => 'Permission: <strong>' . $permission->name . '</strong> was deleted.']);
    }

    public function getData()
    {
        $permissions = Permission::all();

        $i = 0;

        $output = array(
            "data" => []
        );

        foreach ($permissions as $key => $permission) {
            $link_delete = route('permission.destroy', $permission->id);

            $output['data'][$i][] = $key + 1;
            $output['data'][$i][] = $permission->name;
            $output['data'][$i][] = $permission->guard_name;
            $output['data'][$i][] = date('j M Y h:i', strtotime($permission->created_at));
            $output['data'][$i][] = '
                <form action="' . $link_delete . '" method="post" class="form-delete">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-xs" data-popup="tooltip" title="Delete Permission"><i class="fa fa-trash"></i></button>
                </form>';
            $i++;
        }

        echo json_encode($output);
    }
}
