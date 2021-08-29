<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\User;
use http\Header\Parser;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getUsers(Request $request)
    {

        $token = $request->bearerToken();
        error_log($token);
        error_log('dsaas');
        if ($token != null) {
            $user = $request->user();
            if ($user != null) {
                return response()->json(['users' => $user], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function changeName(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        error_log('dsaas');
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $user = User::find($id);
            error_log($user);
            error_log($request->username);
            $user->username = $request->username;
            $user->update();
            return response()->json(['success' => 'Tạo thành công', 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function changeDob(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        error_log('dsaas');
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $user = User::find($id);
            error_log($user);
            error_log($request->dob);
            $user->dob = $request->dob;
            $user->update();
            return response()->json(['success' => 'Tạo thành công', 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function changeGender(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        error_log('dsaas');
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $user = User::find($id);
            error_log($user);
            error_log($request->dob);
            $user->gender = $request->gender;
            $user->update();
            return response()->json(['success' => 'Tạo thành công', 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function changePhone(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        error_log('dsaas');
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $user = User::find($id);
            error_log($user);
            error_log($request->dob);
            $user->gender = $request->gender;
            $user->update();
            return response()->json(['success' => 'Tạo thành công', 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function changeAvatar(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        error_log('dsaas');
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $user = User::find($id);
            error_log($user);
//            error_log($request->dob);

            $avatar = $request->avatar;

            if ($avatar != null) {
                $urlImage = "/data/avatar/$avatar";
            } else {
                $urlImage = null;
            }

            $user->avatar = $urlImage;
            $user->update();
            return response()->json(['success' => 'Tạo thành công', 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateDelivery(Request $request)
    {
        $user_id = $request->id;
        error_log($user_id);

        $user = User::where('id', $user_id)->first();
        if ($user != null) {
            error_log('vào đầu');
            $user->role_id = 4;
            $user->update();
            return response()->json(['users' => $user], 200);
        }
        return response()->json(['error' => 'Người dùng không tồn tại', 401]);
    }
}
