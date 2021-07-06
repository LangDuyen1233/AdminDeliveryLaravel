<?php


namespace App\import;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;


class UserImport implements ToModel
{
    public function model(array $row)
    {
        $u = User::where('code', $row[0])->first();

        if ($u == null || $row[11] == 1) {
            if ($u == null) {
                $u = new User();
            }
            $u->code = $row[0];
            $u->password = $row[1] == "" ? Hash::make('@Bc12345') : Hash::make($row[1]);
            $u->first_name = $row[2];
            $u->last_name = $row[3];
            $u->email = $row[4];
            $u->phone = $row[5];
            $u->class_name = $row[6];
            $u->job = $row[7];
            $u->dob = $row[8];
            $u->gender = $row[9];
            $u->active = 1;
            $u->save();
            if ($row[11] != 1) {
                $u->groups()->attach(4);
            }
            $this->count++;
        }
    }
}
