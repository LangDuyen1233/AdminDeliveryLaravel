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
        session_start();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], $this->messages());
        $users = User::where('email', '=', $request->get('email'))
            ->where('role_id', '=', '2')
            ->where('active', '=', '1')
            ->first();
        error_log($users);
        if ($users != null) {
            $password = $request->get('password');
            if ($users->email == $request->get('email') && Hash::check($password, $users->password)) {
                $u = User::select('id', 'email', 'username','avatar')
                    ->where('id', '=', $users->id)
                    ->where('active', '=', '1')->first();
                Session::put('auth', $u);
                $_SESSION['auth']  = true;
                return redirect('/home');
            } else {
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['mes' => 'Bạn đã nhập sai Email hoặc Password']);
            }
        } else {
            return redirect()->back()->withInput($request->only('email'))->withErrors(['mes' => 'Bạn đã nhập sai Email hoặc Password!']);
        }
    }

    private function messages()
    {
        return [
            'email.required' => 'Bạn cần phải nhập Email.',
            'email.email' => 'Email sai định dạng.',
            'pass.required' => 'Bạn cần phải nhập Password.',
            'pass.min' => 'Password phải nhiều hơn 8 ký tự.',
        ];

    }

}
