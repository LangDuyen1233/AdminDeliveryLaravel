<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class AdminAddressController extends Controller
{
    public function updateAddressMap(Request $request)
    {
        $restaurant_id = $request->id;
        $address = $request->address;
        $lattitude = $request->lattitude;
        $longtitude = $request->longtitude;
        $restaurant = Restaurant::where('id', $restaurant_id)->first();
        if ($restaurant != null) {
            $restaurant->address = $address;
            $restaurant->lattitude =(String)$lattitude;
            $restaurant->longtitude =(String) $longtitude;
            $restaurant->update();

            $restaurant->rating=  number_format($restaurant->rating,1);

            return response()->json(['restaurants' => $restaurant], 200);
        }

        return response()->json(['error' => 'restaurant not found'], 401);
    }
}
