<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        print('vao');
        $this->validate($request, [
            'username' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'phone_number' => 'required|numeric|min:11',
        ]);

        $user = new User([
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => 1,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);
        $user->save();

        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['token' => $token, 'user' => $user], 200);
    }
}
