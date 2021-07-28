<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getAddress(Request $request)
    {
        $user = $request->user();
        error_log($user);
        if ($user != null) {
            error_log($user->id);
            $address = Address::where('user_id', $user->id)->get();
            if ($address != null) {
                return response()->json(['address' => $address, 'users' => $user], 200);
            } else {
                return response()->json(['address' => $address], 204);
            }
        } else {
            response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function getAddressUser(Request $request)
    {
        $user_id = $request->user()->id;
        error_log($user_id);
        $user = User::with('address')->where('id', $user_id)->first();
        return response()->json(['users' => $user], 200);
    }
}
