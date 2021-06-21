<?php

namespace App\Http\Controllers\Auth;
//
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function forgotPass() {
        return view( 'auth.forgotPass' );
    }

    public function doForgotPass( Request $request ) {
        $u = User::select( 'id', 'email' )
            ->where( 'email', '=', $request->email )
            ->where( 'active', '=', '1' )->first();
        if ( $u != null ) {
            $key  = openssl_random_pseudo_bytes( 200 );
            $time = now();
            $hash = md5( $key . $time );
//            Mail::to($request->input('email'))->send(new ForgetPass($request->input('email'), $hash, $request->input('name')));
            $u->random_key = $hash;
            $u->key_time   = Carbon::now()->addHour( 12 );
            $u->update();
            $u->notify( new ForgotPassword() );
            $mess = 'Chúng tôi đã gửi một mail đến email ' . $request->email . ' vui lòng vào mail nhấn vào link đính kèm để tiến hành đổi mật khẩu.';

            return redirect( 'notify' )->with( 'ok', $mess );

        } else {
            return redirect()->back()->withErrors( [ 'mes' => 'Email không tồn tại, hoặc chưa đăng ký.' ] );
        }
    }

    public function doConfirmPassword( $email, $key ) {

        $u = User::select( 'id', 'email', 'random_key', 'key_time', 'active' )
            ->where( 'email', '=', $email )
            ->where( 'active', '=', '1' )
            ->where( 'random_key', $key )
            ->first();

        if ( $u != null ) {
            $kt  = Carbon::parse( $u->key_time );
            $now = Carbon::now();
            if ( $now->lt( $kt ) == true ) {
                return \view( 'auth.reset-pass' )->with( [
                    'email' => $email,
                    'key'   => $key,
                ] );
            } else {
                return redirect( 'notify' )->withErrors( 'mes', 'Mail đã hết hạn sử dụng' );
            }
        } else {
            return redirect( 'notify' )->withErrors( [ 'mes' => 'Đường dẫn này chỉ được sử dụng được một lần' ] );
        }
    }

    public function resetPass( $email, $key, Request $request ) {
        $request->validate( [
            'pass'    => 'required|min:8',
            're-pass' => 'required|same:pass',
        ], $this->messages() );
        $u = User::select( 'id', 'email', 'random_key', 'key_time', 'active' )
            ->where( 'email', '=', $email )
            ->where( 'random_key', '=', $key )
            ->where( 'active', '=', '1' )->first();
        if ( $u != null ) {
            $u->password   = Hash::make( $request->pass );
            $u->random_key = null;
            $u->key_time   = null;
            $u->update();

            return redirect( 'login' )->with( 'ok', 'Mật khẩu đã được thay đổi' );
        } else {
            return redirect( 'login' )->withErrors( [ 'mes' => 'Liên kết đã hết hạn!' ] );
        }
    }

    private function messages() {
        return [
            'r_firstname.required' => 'Bạn cần nhập họ tên',
            'r_firstname.min'      => 'Họ tên cần lớn hơn 3 kí tự',
            'r_firstname.max'      => 'Họ tên cần bé hơn 50 kí tự',
            'r_lastname.required'  => 'Bạn cần nhập họ tên',
            'r_lastname.min'       => 'Họ tên cần lớn hơn 3 kí tự',
            'r_lastname.max'       => 'Họ tên cần bé hơn 50 kí tự',
            'r_email.required'     => 'Bạn cần phải nhập Email.',
            'r_email.email'        => 'Định dạng Email bị sai.',
            'r_email.unique'       => 'Email đã tồn tại',
            'r_pass.required'      => 'Bạn cần phải nhập Password.',
            'r_pass.min'           => 'Password phải nhiều hơn 8 ký tự.',
            'r_repass.same'        => 'RePassword không trùng với password',
            'r_pass.required'      => 'Bạn cần nhập Repassword',
        ];
    }
}
