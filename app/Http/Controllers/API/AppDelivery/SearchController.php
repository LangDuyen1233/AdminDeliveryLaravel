<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchRestaurant(Request $request)
    {
        $restaurant_name = $request->name;
        $restaurant = Restaurant::where('name', 'like', "%{$restaurant_name}%")->get();
        foreach ($restaurant as $r) {
            $r->rating = number_format($r->rating, 1);
        }
        return response()->json(['restaurants' => $restaurant], 200);
    }

    public function searchFood(Request $request)
    {
        $food_name = $request->name;
        $food = Food::where('name', 'like', "%{$food_name}%")->with('restaurant')->get();
        foreach ($food as $f) {
            $f->weight = number_format($f->weight, 1);
            $f->restaurant->rating = number_format($f->restaurant->rating, 1);
        }
        return response()->json(['foods' => $food], 200);
    }
}
