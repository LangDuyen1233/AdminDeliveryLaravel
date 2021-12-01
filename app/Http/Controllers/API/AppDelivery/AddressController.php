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
        if ($user != null) {
            $address = Address::where('user_id', $user->id)->get();
            if ($address != null) {
                return response()->json(['address' => $address], 200);
            }
        } else {
            response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function getAddressUser(Request $request)
    {
        $user_id = $request->user()->id;
        $user = User::with('address')->where('id', $user_id)->first();

        return response()->json(['users' => $user], 200);
    }

    public function addAddress(Request $request)
    {
        $user_id = $request->user()->id;
        $detail = $request->detail;
        $addressDetail = $request->address;
        $longtitude = $request->longtitude;
        $lattitude = $request->lattitude;
        $status = $request->status;

        $address = Address::where('user_id', $user_id)->get();
        if ($address != null) {
            if ($status == 1) {
                foreach ($address as $a) {
                    $a->status = 0;
                    $a->update();
                }
            }
            $address = new Address([
                'user_id' => $user_id,
                'detail' => $detail,
                'address' => $addressDetail,
                'longtitude' => (string)$longtitude,
                'lattitude' => (string)$lattitude,
                'status' => (int)$status,
            ]);
            $address->save();
        } else {
            $address = new Address([
                'detail' => $detail,
                'user_id' => $user_id,
                'address' => $addressDetail,
                'longtitude' => (string)$longtitude,
                'lattitude' => (string)$lattitude,
                'status' => 1,
            ]);
            $address->save();
        }
        $address->longtitude = number_format($address->longtitude, 0);
        $address->lattitude = number_format($address->lattitude, 0);

        return response()->json(['address' => $address], 200);
    }

    public function updateAddress(Request $request)
    {
        $user_id = auth()->user()->id;
        $address_id = $request->id;
        $address = Address::where('user_id', $user_id)->get();
        foreach ($address as $a) {
            if ($request->status == 1) {
                $a->status = 0;
                $a->update();
                if ($a->id == $address_id) {
                    $a->detail = $request->detail;
                    $a->address = $request->address;
                    $a->longtitude = (string)$request->longtitude;
                    $a->lattitude = (string)$request->lattitude;
                    $a->status = (int)$request->status;
                    $a->update();
                }
            } else {
                $a->status = 0;
                $a->update();
                if ($a->id == $address_id) {
                    $a->detail = $request->detail;
                    $a->address = $request->address;
                    $a->longtitude = (string)$request->longtitude;
                    $a->lattitude = (string)$request->lattitude;
                    $a->status = (int)$request->status;
                    $a->update();
                }
                $address[0]->status = 1;
                $address[0]->update();
            }

        }
        return response()->json(['address' => $address], 200);
    }

    public function deleteAddress(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $address_id = $request->address_id;
            $address = Address::find($address_id);

            $address->delete();

            return response()->json(['address' => $address], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateLocation(Request $request)
    {
        $address_id = $request->address_id;
        $address = Address::where('id', $address_id)->first();
        $address->longtitude = (string)$request->longtitude;
        $address->lattitude = (string)$request->lattitude;
        $address->update();
        return response()->json(['address' => $address], 200);
    }

    public function getAddressFromId(Request $request)
    {
        $address_id = $request->address_id;
        $address = Address::where('id', $address_id)->first();
        return response()->json(['address' => $address], 200);
    }
}
