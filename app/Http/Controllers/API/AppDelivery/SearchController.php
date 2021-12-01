<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchRestaurant(Request $request)
    {
        $restaurant_name = $request->name;
        $restaurant = Restaurant::with('foods')->with('foods.image')->where('name', 'like', "%{$restaurant_name}%")->get();
        foreach ($restaurant as $r) {
            $r->rating = number_format($r->rating, 1);
            foreach ($r->foods as $food) {
                $food->weight = number_format($food->weight, 1);
            }
        }
        if ($restaurant != null) {
            return response()->json(['restaurants' => $restaurant], 200);
        } else {
            return response()->json(['restaurants' => 'No restaurant'], 204);
        }

    }

    public function searchFood(Request $request)
    {
        $name = $request->name;
        $result = DB::table('restaurants')
            ->selectRaw('restaurants.id,restaurants.name,restaurants.address,restaurants.image,
                restaurants.lattitude, restaurants.longtitude, restaurants.rating, foods.name as foodname, foods.price,images.url')
            ->join('foods', 'restaurants.id', '=', 'foods.restaurant_id')
            ->join('image_foods', 'foods.id', '=', 'image_foods.food_id')
            ->join('images', 'image_foods.image_id', '=', 'images.id')
            ->where('restaurants.active', 1)
            ->where('foods.status', 1)
            ->where('foods.name', 'LIKE', "%$name%")
            ->orWhere('restaurants.name', 'LIKE', "%$name%")
            ->groupBy('restaurants.name')
            ->get();
        foreach ($result as $r) {
            $r->rating = number_format($r->rating, 1);
        }
        if ($result != null) {
            return response()->json(['result' => $result], 200);
        } else {
            return response()->json([], 204);
        }
    }
}
