<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Mails\ActiveAcount;
use App\Mails\ForgotPass;
use App\Mails\ForgotPassApp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class   AuthController extends Controller
{
    public function registerSocial(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'avatar' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();

        if ($user == null) {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'avatar' => $request->avatar,
                'role_id' => 1,
                'active' => 1,
            ]);

            $user->save();

            return response()->json(['mes' => 'Register successful'], 200);
        } else {
            return response()->json(['mes' => 'Registered'], 204);
        }
    }

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
            Mail::to($email)->send(new ActiveAcount($email, $key, $username));

            $user->save();

            return response()->json(['data' => $user], 201);
        } else {
            // ???? t???n t???i active 1 th??ng b??o l???i
            if ($user->active == 1) {
                return response()->json(['mes' => 'Ng??????i du??ng ??a?? t????n ta??i!'], 409);
            } else {
                // email t???n t???i active =0 g???i l???i email
                $key = Str::random(40);
                $user->random_key = $key;
                $user->key_time = Carbon::now()->addHour(24)->format('Y-m-d H:i:s');
                $user->update();
                Mail::to($user->email)->send(new ActiveAcount($user->email, $key, $user->username));

                return response()->json(['mes' => 'B???n ????ng k?? th??nh c??ng vui l??ng check Email ????? k??ch ho???t t??i kho???n'], 201);
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
        if ($u == null) {
            return response()->json(['mes' => 'X??c nh???n email kh??ng th??nh c??ng! Email ho???c m?? x??c th???c kh??ng ????ng.'], 400);
        } else {
            $kt = Carbon::parse($u->key_time);
            $now = Carbon::now();
            if ($now->lt($kt) == true) {
                $u->active = 1;
                $u->key_time = null;
                $u->random_key = null;
                $u->update();

                return response()->json(['mes' => 'X??c nh???n email th??nh c??ng! B???n c?? th??? ????ng nh???p.'], 200);
            } else {
                return response()->json(['mes' => 'Li??n k???t ???? h???t h???n!'], 400);
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
                $token = auth()->user()->createToken('authToken')->accessToken;
                auth()->user()->expires_at = Carbon::now()->addMinute(5)->format('Y-m-d H:i:s');
                auth()->user()->token = $token;
                auth()->user()->update();
            }
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $user = User::where('id', '=', auth()->user()->id)->first();
            if ($user != null) {
                $request->user()->token()->revoke();
                $user->token = null;
                $user->expires_at = null;
                $user->update();
                return response()->json(['mes' => 'Successfulley logout'], 200);
            } else {
                return response()->json(['mes' => 'Logout failed'], 401);
            }
        } else {
            return response()->json(['mes' => 'Logout failed'], 401);
        }
    }

    public function loginOwner(Request $request)
    {
        $dataLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($dataLogin) && auth()->user()->role_id == 3 && auth()->user()->active == 1) {
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
            return response()->json(['token' => $token, 'users' => auth()->user()], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function loginAndRegisterPhone(Request $request)
    {
        $phone = $request->phone;
        $username = $request->username;
        $email = $request->email;
        $uid = $request->uid;
        $mssv = $request->mssv;

        $expires_at = Carbon::now()->addMinute(5)->format('Y-m-d H:i:s');
        $user = User::create([
            'username' => $username,
            'email' => $email,
            'role_id' => 1,
            'phone' => $request->phone,
            'active' => 1,
            'expires_at' => $expires_at,
            'uid' => $uid,
            'mssv' => $mssv,
        ]);
        $user->save();

        $token = $user->createToken('authToken')->accessToken;
        $user->token = $token;
        $user->update();

        return response()->json(['token' => $token, 'users' => $user], 201);
    }

    public function checkUser(Request $request)
    {
        $phone = $request->phone;

        $user = User::where('phone', $phone)->first();

        return response()->json(['users' => $user], 200);
    }

    public function loginPhone(Request $request)
    {
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        $token = $user->token;
        $checkExpire = Carbon::parse($user->expires_at);
        $now = Carbon::now();
        if ($token == null) {
            $token = $user->createToken('authToken')->accessToken;
            $user->expires_at = Carbon::now()->addMinute(5)->format('Y-m-d H:i:s');
            $user->token = $token;
            $user->update();
        } else if ($now->lt($checkExpire) == false) {
            $token = $user->createToken('authToken')->accessToken;
            $user->expires_at = Carbon::now()->addMinute(5)->format('Y-m-d H:i:s');
            $user->token = $token;
            $user->update();
        }
        return response()->json(['token' => $token, 'users' => $user], 200);
    }

    public function updateUid(Request $request)
    {
        $user_id = $request->user_id;
        $uid = $request->uid;
        $user = User::where('id', $user_id)->first();
        $user->uid = $uid;
        $user->update();

        return response()->json(['message' => 'success'], 200);
    }

    public function forgotPass(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->where('active', 1)->first();
        if ($user != null) {
            $key = Str::random(40);
            $user->random_key = $key;
            $user->key_time = Carbon::now()->addHour(24)->format('Y-m-d H:i:s');
            $user->update();

            Mail::to($user->email)->send(new ForgotPassApp($user->email, $key, $user->username));
            return response()->json(['mes' => 'Success'], 200);
        } else {
            return response()->json(['error' => 'Not Found'], 404);
        }
    }
}
