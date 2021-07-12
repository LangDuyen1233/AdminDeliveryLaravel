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
}
