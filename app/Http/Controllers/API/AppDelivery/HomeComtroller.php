<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeComtroller extends Controller
{
    public function getFood()
    {
        $foodOrder = DB::table('food_orders')->selectRaw('foods.name,foods.price,images.url,restaurants.id as restaurant_id,COUNT(food_orders.food_id) as total_food')
            ->join('foods', 'foods.id', '=', 'food_orders.food_id')
            ->join('image_foods', 'foods.id', '=', 'image_foods.food_id')
            ->join('images', 'images.id', '=', 'image_foods.image_id')
            ->join('restaurants', 'restaurants.id', '=', 'foods.restaurant_id')
            ->groupBy('food_orders.food_id', 'foods.name', 'foods.price', 'images.url', 'restaurants.id')
            ->orderBy('total_food', 'DESC')
            ->limit(20)
            ->get();
        if ($foodOrder != null) {
            return response()->json(['foods' => $foodOrder], 200);
        } else {
            return response()->json(['mes' => 'not exist'], 204);
        }
    }

    public function getRestaurant(Request $request)
    {
        $limit = $request->limit;
        $restaurant = Restaurant::with('foods')->with('foods.image')->with('foods.toppings')->limit($limit)->get();
        foreach ($restaurant as $r) {
            foreach ($r->foods as $f) {
                $f->weight = number_format($f->weight, 1);
            }
            $r->rating = number_format($r->rating, 1);
        }
        if ($restaurant != null) {
            return response()->json(['restaurants' => $restaurant], 200);
        } else {
            return response()->json(['mes' => 'not exist'], 204);
        }
    }
}
