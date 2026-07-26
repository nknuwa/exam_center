<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $role = Role::where('name', $row['role'])->first();

        $user = new User([
            'name'      => $row['name'],
            'email'     => $row['email'],
            'phone_no'  => $row['phone_no'],
            'center_no' => $row['center_no'],
            'status'    => $row['status'],
            'password'  => Hash::make(Str::random(20)),
        ]);

        $user->save();

        if ($role) {
            $user->role_id = $role->id;
            $user->save();

            $user->assignRole($role->name);

            if ($role->name === 'super-admin') {
                $user->update(['center_no' => null]);
            }
        }
    }
}
