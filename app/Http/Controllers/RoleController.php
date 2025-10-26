<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view ('pages.admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => [
            'required',
            'string',
            'unique:roles,name,'
        ]]);
        Role::create([
            'name' => $request->name
        ]);

        $response['alert-success'] = 'Role Created Successfully';

        return redirect()->route('roles.all')->with($response);
    }

    public function addPermission($role_id)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($role_id);
        $rolePermissions = DB::table('role_has_permissions')
        ->where('role_has_permissions.role_id', $role_id)
        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();

        return view('pages.admin.roles.addPermission', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermission(Request $request, $role_id)
    {

        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($role_id);
        $role->syncPermissions($request->permission);
        $response['alert-success'] = 'Permissions added to role';
        return redirect()->route('roles.all')->with($response);
    }
}
