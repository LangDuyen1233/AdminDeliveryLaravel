<?php


namespace App\import;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UserImport implements ToModel, WithHeadingRow
{
    var $count = 0;

    public function model(array $row)
    {
        $u = User::where('email', $row['email'])->first();
        if ($u == null) {
            $user = new User([
                'username' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'password' => $row['password'] == "" ? Hash::make('12345678') : Hash::make($row['password']),
                'gender' => $row['gender'],
                'dob' => date("Y-m-d", strtotime($row['dob'])),
                'bio' => $row['bio'],
                'active' => 1,
                'role_id' => 1,
                'is_delete' => 1,
            ]);
            $user->save();
            $this->count++;
        }

    }
}
