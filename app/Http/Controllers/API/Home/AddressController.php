<?php


namespace App\Http\Controllers\API\Home;


use Illuminate\Http\Request;

class AddressController
{
    public function getAddress(Request $request)
    {
        $user_id = $request->id;
        error_log($user_id);
        $address = Address::where($user_id)->get();
        error_log($address);
        return response()->json(['address' => $address], 200);
    }
}
