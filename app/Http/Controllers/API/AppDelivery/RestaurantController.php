<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartOrder;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function getRestaurant(Request $request)
    {
//        ->with('foods.toppings')with('foods')->with('foods.image')

        $restaurant_id = $request->restaurant_id;
        error_log($restaurant_id);
        $restaurant = Restaurant::where('id', $restaurant_id)->first();
        $restaurant->rating = number_format($restaurant->rating, 1);
        if ($restaurant != null) {
            return response()->json(['restaurants' => $restaurant], 200);
        } else {
            return response()->json(['restaurants' => 'null'], 204);
        }
    }

    public function getFood(Request $request)
    {
        $restaurant_id = $request->restaurant_id;
        error_log($restaurant_id);
        $food = Food::with('image')->with('toppings')->where('restaurant_id', $restaurant_id)->get();
        if ($food != null) {
            return response()->json(['foods' => $food], 200);
        } else {
            return response()->json(['foods' => 'null'], 204);
        }
    }

    public function addCardOrder(Request $request)
    {
        $user_id = auth()->user()->id;
        $sum_price = 0;

        error_log($request->quantity);
        $topping_id = $request->toppingid;
        $restaurant_id = $request->restaurant_id;
        error_log($topping_id);
        error_log($restaurant_id);

        $card = Cart::where('restaurant_id', $restaurant_id)->first();
        if ($card == null) {
            $card = new Cart([
                'user_id' => $user_id,
                'sum_price' => $sum_price,
                'restaurant_id' => $restaurant_id,
            ]);
            error_log($card);
            $card->save();
        } else {
            $card->sum_price = $sum_price;
            $card->update();
        }


        $quantity = $request->quantity;
        $price = $request->price;
        $food_id = $request->food_id;
        error_log($card->id);
        $card_order = CartOrder::where('food_id', $food_id)->first();
        if ($card_order == null) {
            $card_order = new CartOrder([
                'quantity' => $quantity,
                'price' => $price,
                'food_id' => $food_id,
                'cart_id' => $card->id,
            ]);
            $card_order->save();
            error_log($card_order->id);
        } else {
            $card_order->quantity = $quantity;
            $card_order->price = $price;
            $card_order->update();
        }


        if ($topping_id != '') {
            $arrTopping = explode(',', $topping_id);
            $card_order->toppings()->sync($arrTopping);
        } else {
            $card_order->toppings()->sync($topping_id);
        }


        return response()->json(['card' => $card], 201);

    }

    public function getCard(Request $request)
    {
        $card_id = $request->card_id;
        error_log($request->card_id);
        $card = Cart::with('cardOrder')->where('id', $card_id)->first();
        if ($card != null) {
            return response()->json(['card' => $card], 200);
        } else {
            return response()->json(['error' => 'Card not found'], 401);
        }
    }
}
