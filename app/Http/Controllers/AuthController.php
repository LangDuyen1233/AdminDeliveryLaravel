<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getProfile()
    {
        return view('auth.profile');
    }

    public function getRegister()
    {
        return view('auth.register');
    }
}
