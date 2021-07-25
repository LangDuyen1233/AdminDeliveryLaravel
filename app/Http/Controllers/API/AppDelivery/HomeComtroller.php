<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Double;

class HomeComtroller extends Controller
{
    public function getFood()
    {
        $foods = Food::with('image')->with('restaurant')->with('category')->get();
        if ($foods != null) {
            return response()->json(['foods' => $foods], 200);
        } else {
            return response()->json(['mes' => 'not exist'], 204);
        }
    }

    public function getRestaurant(Request $request)
    {
        $limit = $request->limit;
        error_log($limit);
        $restaurant = Restaurant::with('foods')->with('foods.image')->with('foods.toppings')->limit($limit)->get();

        foreach ($restaurant as $r) {
            $r->rating = number_format($r->rating, 1);
        }
        error_log($restaurant);
        if ($restaurant != null) {
            return response()->json(['restaurants' => $restaurant], 200);
        } else {
            return response()->json(['mes' => 'not exist'], 204);
        }
    }
}
