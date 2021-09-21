<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function getRegister()
    {
        return view('auth.register');
    }

    public function index()
    {
        $user = Session::get('auth');
        return view('auth.changePass',
            [
                'user' => $user,
            ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'passwordOld' => 'required|min:8',
            'passwordNew' => 'required|min:8',
            're_passwordNew' => 'required|same:passwordNew',
        ], $this->messages());

        $passwordOld = $request->get('passwordOld');
        $passwordNew = $request->get('passwordNew');

        $user = User::find($request->id);
        if (Hash::check($passwordOld, $user->password)) {
            $user->password = Hash::make($passwordNew);
            $user->update();

            return redirect('changePass')->withErrors(['mes' => "Thay đổi mật khẩu thành công"]);
        } else
            return redirect('changePass')->withErrors(['mes' => "Thay đổi mật khẩu không thành công"]);
    }

    private function messages()
    {
        return [
            'passwordOld.required' => 'Bạn cần phải nhập mật khẩu cũ.',
            'passwordOld.min' => 'Mật khẩu phải nhiều hơn 8 ký tự.',
            'passwordNew.required' => 'Bạn cần phải nhập mật khẩu mới.',
            'passwordNew.min' => 'Mật khẩu phải nhiều hơn 8 ký tự.',
            're_passwordNew.same' => 'Xác nhận mật khẩu không trùng với mật khẩu mỚi',
            're_passwordNew.required' => 'Bạn cần nhập nhắc lại mật khẩu',
        ];
    }
}
