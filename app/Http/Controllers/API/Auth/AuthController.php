<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Mails\ActiveAcount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'phone' => 'required|numeric|min: 11',
        ]);

        $user = User::where('email', '=', $request->email)->first();

        if ($user == null) {
            $key = Str::random(40);

            $email = $request->email;
            $username = $request->username;
            error_log($email);

            $user = User::create([
                'username' => $username,
                'email' => $email,
                'role_id' => 1,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'random_key' => $key,
                'key_time' => Carbon::now()->addHour(24)->format('Y-m-d H:i:s'),
                'active' => 0,
            ]);
            error_log($user);
            Mail::to($email)->send(new ActiveAcount($email, $key, $username));
            error_log('dsjadkaj');

            $user->save();

            return response()->json(['data' => $user], 201);
        } else {
            // đã tồn tại active 1 thông báo lỗi
            if ($user->active == 1) {
                return response()->json(['mes' => 'Người dùng đã tồn tại!'], 409);
            } else {
                // email tồn tại active =0 gửi lại email
                $key = Str::random(40);
                $user->random_key = $key;
                $user->key_time = Carbon::now()->addHour(24)->format('Y-m-d H:i:s');
                $user->update();
                Mail::to($user->email)->send(new ActiveAcount($user->email, $key, $user->username));

                return response()->json(['mes' => 'Bạn đăng ký thành công vui lòng check Email để kích hoạt tài khoản'], 201);
            }
        }
    }

    public function confirmEmail($email, $key)
    {
        $u = User::select('id', 'email', 'key_time', 'active')
            ->where('email', '=', $email)
            ->where('random_key', $key)
            ->where('active', '=', '0')
            ->first();
        error_log($u);
        if ($u == null) {
            return response()->json(['mes' => 'Xác nhận email không thành công! Email hoặc mã xác thực không đúng.'], 400);
        } else {
            $kt = Carbon::parse($u->key_time);
            $now = Carbon::now();
            if ($now->lt($kt) == true) {
                $u->active = 1;
                $u->key_time = null;
                $u->random_key = null;
                $u->update();

                return response()->json(['mes' => 'Xác nhận email thành công! Bạn có thể đăng nhập.'], 200);
            } else {
                return response()->json(['mes' => 'Liên kết đã hết hạn!'], 400);
            }
        }
    }

    public function login(Request $request)
    {
        $dataLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($dataLogin)) {
            $token = auth()->user()->token;
            $checkExpire = Carbon::parse(auth()->user()->expires_at);
            $now = Carbon::now();
            if ($token == null) {
                $token = auth()->user()->createToken('authToken')->accessToken;
                auth()->user()->expires_at = Carbon::now()->addMinute(5)->format('Y-m-d H:i:s');
                auth()->user()->token = $token;
                auth()->user()->update();
            } else if ($now->lt($checkExpire) == false) {
                auth()->user()->expires_at = null;
                auth()->user()->token = null;
                auth()->user()->update();
            }
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['mes' => 'Successfulley logout'], 200);
    }

}
