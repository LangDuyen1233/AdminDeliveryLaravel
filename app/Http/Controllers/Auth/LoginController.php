<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        error_log("voo dday ne " );
//        $request->validate([
//            'email' => 'required|email',
//            'pass' => 'required|min:8',
//        ], $this->messages());
        $users = User::select('id', 'email', 'password')
            ->where('email', '=', $request->get('email'))
            ->where('active', '=', '1')
            ->get();
        dd($users);
//        return view('auth.login');
//        session_start();
//
//        print("ahahahha" + $users);
//        if (count($users) == 1) {
//            $u = $users[0];
//            if ($u->email == $request->get('email') && Hash::check($request->get('pass'), $u->password)) {
//                $u = User::select('id', 'email', 'first_name')
//                    ->where('id', '=', $u->id)
//                    ->where('active', '=', '1')->first();
//                $role = $u->roles;
//                print($role);
//            } else {
//                return redirect()->back()
//                    ->withInput($request->only('email'))
//                    ->withErrors(['mes' => 'Bạn đã nhập sai Email hoặc Password']);
//            }
//        } else {
//            return redirect()->back()->withInput($request->only('email'))->withErrors(['mes' => 'Bạn đã nhập sai Email hoặc Password!']);
//        }
    }
//
//    private function messages()
//    {
//        return [
//            'email.required' => 'Bạn cần phải nhập Email.',
//            'email.email' => 'Email sai định dạng.',
//            'pass.required' => 'Bạn cần phải nhập Password.',
//            'pass.min' => 'Password phải nhiều hơn 8 ký tự.',
//        ];

//    }

}
