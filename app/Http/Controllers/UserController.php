<?php

namespace App\Http\Controllers;

use App\Models\ExamDb;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $response['users'] = User::all();
        return view('pages.users.index')->with($response);
    }

    public function new()
    {
        $centers = ExamDb::distinct()->orderBy('center_no', 'asc')->pluck('center_no');
        $roles = Role::all();
        return view('pages.users.new', compact('centers', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'center_no' => 'nullable|exists:exam_dbs,center_no',
            'role_id'   => 'required|exists:roles,id',
            'phone_no'  => 'required|string',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'center_no' => $request->center_no,
            'role_id'   => $request->role_id,
            'phone_no'  => $request->phone_no,
            'status'    => $request->status ?? 1,
        ]);

        // ✅ Assign role via Spatie
        $role = Role::find($request->role_id);
        if ($role) {
            $user->assignRole($role->name);

            // ✅ If super-admin, allow access to all centers (null center_no)
            if ($role->name === 'super-admin') {
                $user->update(['center_no' => null]);
            }
        }

        return redirect()->route('users.all')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $centers = ExamDb::distinct()->orderBy('center_no', 'asc')->pluck('center_no');
        $roles = Role::all();
        return view('pages.users.edit', compact('user', 'centers', 'roles'));
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => ['required', 'email', Rule::unique('users', 'email')->ignore($user_id)],
            'password'  => 'nullable|min:6|confirmed',
            'center_no' => 'nullable|exists:exam_dbs,center_no',
            'role_id'   => 'nullable|exists:roles,id',
            'phone_no'  => 'nullable|string|max:30',
            'status'    => 'nullable|in:0,1',
        ]);

        $user = User::findOrFail($user_id);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'center_no' => $request->center_no,
            'phone_no'  => $request->phone_no,
            'status'    => $request->status ?? $user->status,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // ✅ Sync roles
        if ($request->role_id) {
            $role = Role::find($request->role_id);
            if ($role) {
                $user->syncRoles([$role->name]);
                $user->role_id = $role->id;

                // ✅ Reset center for super admin
                if ($role->name === 'super-admin') {
                    $user->center_no = null;
                }

                $user->save();
            }
        }

        return redirect()->route('users.all')->with('success', 'User updated successfully!');
    }

    public function delete($user_id)
    {
        $user = User::findOrFail($user_id);

        if ($user->hasRole('super-admin')) {
            return redirect()->back()->with('alert-danger', 'You cannot delete a super admin!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
