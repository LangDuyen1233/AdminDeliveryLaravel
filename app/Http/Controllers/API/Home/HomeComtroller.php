<?php


namespace App\Http\Controllers\API\Home;


use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeComtroller extends Controller
{
    public function getFood()
    {
        $foods = Food::All();
        if ($foods != null) {
            return response()->json(['foods' => $foods], 200);
        } else {
            return response()->json(['mes' => 'not exist'], 204);
        }
    }

    public function getRestaurant()
    {
        $restaurant = Restaurant::all();
        if ($restaurant != null) {
            return response()->json(['Restaurants' => $restaurant], 200);
        } else {
            return response()->json(['mes' => 'not exist'], 204);
        }
    }
}
