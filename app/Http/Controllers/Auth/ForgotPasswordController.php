<?php

namespace App\Http\Controllers\Auth;
//
use App\Http\Controllers\Controller;
use App\Mails\ForgotPass;
use App\Models\User;
use App\Notifications\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgotPass()
    {
        return view('auth.forgotPass');
    }

    public function doForgotPass(Request $request)
    {
        $u = User::where('email', '=', $request->email)
            ->where('active', '=', '1')->first();
        error_log($request->email);
//        dd($u);
        if ($u != null) {
            $key = Str::random(40);
            error_log($key);
            $u->random_key = $key;
            $u->key_time = Carbon::now()->addHour(24)->format('Y-m-d H:i:s');
            error_log($u->random_key);

            $u->update();
//            $u->notify( new ForgotPassword() );
            Mail::to($u->email)->send(new ForgotPass($u->email, $key, $u->username));
            $mess = 'Chúng tôi đã gửi một mail đến email ' . $request->email . ' vui lòng vào mail nhấn vào link đính kèm để tiến hành đổi mật khẩu.';

            return redirect('notify')->with('ok', $mess);

        } else {
            return redirect()->back()->withErrors(['mes' => 'Email không tồn tại, hoặc chưa đăng ký.']);
        }
    }

    public function doConfirmPassword($email, $key)
    {
        error_log('whyuwegyewhfbwehjgbweg');
        $u = User::select('email', 'random_key', 'key_time', 'active')
            ->where('email', '=', $email)
            ->where('active', '=', '1')
            ->where('random_key', $key)
            ->first();
        error_log($email);
//        dd($u);
        if ($u != null) {
            $kt = Carbon::parse($u->key_time);
            $now = Carbon::now();
            if ($now->lt($kt) == true) {
                return \view('auth.reset_pass')->with([
                    'email' => $email,
                    'key' => $key,
                ]);
            } else {
                return redirect('notify')->withErrors('mes', 'Mail đã hết hạn sử dụng');
            }
        } else {
            return redirect('notify')->withErrors(['mes' => 'Đường dẫn này chỉ được sử dụng được một lần']);
        }
    }

    public function resetPass($email, $key, Request $request)
    {
        error_log('và đây k');
        $request->validate([
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
        ], $this->messages());

        $u = User::where('email', '=', $email)
            ->where('random_key', '=', $key)
            ->where('active', '=', '1')->first();
        if ($u != null) {
            $u->password = Hash::make($request->password);
            $u->random_key = null;
            $u->key_time = null;
            $u->update();

            return redirect('/')->withErrors(['mes', 'Mật khẩu đã được thay đổi']);
        } else {
            return redirect('/')->withErrors(['mes' => 'Liên kết đã hết hạn!']);
        }
    }

    public function doConfirmPasswordApp($email, $key)
    {
        error_log('whyuwegyewhfbwehjgbweg');
        $u = User::select('email', 'random_key', 'key_time', 'active')
            ->where('email', '=', $email)
            ->where('active', '=', '1')
            ->where('random_key', $key)
            ->first();
        error_log($email);
//        dd($u);
        if ($u != null) {
            $kt = Carbon::parse($u->key_time);
            $now = Carbon::now();
            if ($now->lt($kt) == true) {
                return view('auth.reset_pass_app')->with([
                    'email' => $email,
                    'key' => $key,
                ]);
            } else {
                return redirect('notifyApp')->withErrors('mes', 'Mail đã hết hạn sử dụng');
            }
        } else {
            return redirect('notifyApp')->withErrors(['mes' => 'Đường dẫn này chỉ được sử dụng được một lần']);
        }
    }

    public function resetPassApp($email, $key, Request $request)
    {
        error_log('và đây k');
        $request->validate([
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
        ], $this->messages());

        $u = User::where('email', '=', $email)
            ->where('random_key', '=', $key)
            ->where('active', '=', '1')->first();
        if ($u != null) {
            $u->password = Hash::make($request->password);
            $u->random_key = null;
            $u->key_time = null;
            $u->update();

            return view('auth.forgotPassSuccess')->withErrors(['mes'=> 'Đổi mật khẩu thành công']);
        } else {
            return redirect('/')->withErrors(['mes' => 'Liên kết đã hết hạn!']);
        }
    }

    private function messages()
    {
        return [
            'password.required' => 'Bạn cần phải nhập Password.',
            'password.min' => 'Password phải nhiều hơn 8 ký tự.',
            're_password.same' => 'Confirm Password không trùng với password',
            're_password.required' => 'Bạn cần nhập Confirm Password',
        ];
    }
}
