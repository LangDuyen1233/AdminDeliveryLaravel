<?php


namespace App\Http\Controllers\API\AdminDelivery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;

class AdminRestaurantController extends Controller
{
    public function getRestaurant(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();
            $restaurant->rating= number_format( $restaurant->rating,1);
            return response()->json(['restaurants' => $restaurant], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function changeImageRestaurant(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $image = $request->image;

            if ($image != null) {
                $urlImage = "/data/avatar/$image";
            } else {
                $urlImage = null;
            }

            $restaurant->image = $urlImage;
            $restaurant->update();

            $restaurant->rating= number_format( $restaurant->rating,1);
            return response()->json(['success' => 'Tạo thành công', 'restaurants' => $restaurant], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
