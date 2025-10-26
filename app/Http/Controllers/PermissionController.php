<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index() {
        $response['permissions'] = Permission::all();
        return view('pages.admin.permissions.index')->with($response);
    }

    public function store(Request $request){
        $request->validate(['name' => [
            'required',
            'string',
            'unique:permissions,name,'
        ]]);

        Permission::create([
            'name' => $request->name
        ]);

        $response['alert-success'] = 'Permissions created successfully';
                return view('pages.admin.permissions.index')->with($response);
    }
}
