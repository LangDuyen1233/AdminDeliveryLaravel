<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartOrder;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function getRestaurant(Request $request)
    {
        $restaurant_id = $request->restaurant_id;
        error_log($restaurant_id);
        $restaurant = Restaurant::where('id', $restaurant_id)->with('foods')->with('foods.toppings')->with('foods.image')->with('user')->first();
        $restaurant->rating = number_format($restaurant->rating, 1);
        foreach ($restaurant->foods as $f) {
            $f->weight = number_format($f->weight, 1);
        }

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
        foreach ($food as $f) {
            $f->weight = number_format($f->weight, 1);
        }
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

        $card = Cart::where('restaurant_id', $restaurant_id)->where('user_id', $user_id)->first();
        if ($card == null) {
            $card = new Cart([
                'user_id' => $user_id,
                'sum_price' => $sum_price,
                'restaurant_id' => (int)$restaurant_id,
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

        $card_order = CartOrder::where('food_id', $food_id)->where('cart_id',$card->id)->first();
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

        $sum_card = CartOrder::where('cart_id', $card->id)->get();

        foreach ($sum_card as $c) {
            error_log($c->price);
            $sum_price += $c->price;
        }

        $card->sum_price = $sum_price;
        $card->update();

        return response()->json(['card' => $card], 201);

    }

    public function getCard(Request $request)
    {
        $user_id = auth()->user()->id;
        $restaurant_id = $request->restaurant_id;
        error_log('vào đây bè');
        error_log($request->restaurant_id);
        $card = Cart::with('cardOrder')->with('cardOrder.food')->with('cardOrder.food.toppings')->with('cardOrder.food.image')->where('restaurant_id', $restaurant_id)->where('user_id', $user_id)->first();
        error_log($card);

        if ($card != null) {
            foreach ($card->cardOrder as $co) {
                $co->food->weight = number_format($co->food->weight, 1);
            }
            return response()->json(['card' => $card], 200);
        } else {
            return response()->json(['error' => 'Card not found'], 401);
        }
    }

    public function getFoodCard(Request $request)
    {
        $card_id = $request->card_id;
        $card = Cart::with('cardOrder')->with('cardOrder.food')->with('cardOrder.food.image')->with('cardOrder.toppings')->where('id', $card_id)->first();
        foreach ($card->cardOrder as $co) {
            $co->food->weight = number_format($co->food->weight, 1);
        }
        return response()->json(['card' => $card], 200);
    }

    public function deleteCard(Request $request)
    {
        $cart_id = $request->cart_id;
        $cardOrder = CartOrder::where('cart_id', $cart_id)->get();
        foreach ($cardOrder as $co) {
            $co->delete();
        }
        $card = Cart::where('id', $cart_id)->first();
        if ($card->delete()) {
            return response()->json(['card' => $card], 200);
        } else {
            return response()->json(['error' => 'Card not delete'], 401);
        }
    }

    public function increaseQuantity(Request $request)
    {
        $cardOrderId = $request->cardOrderId;
        $cardOrder = CartOrder::where('id', $cardOrderId)->with('food')->with('food.toppings')->with('food.image')->first();
        $cardOrder->quantity = $cardOrder->quantity + 1;

        $price = $cardOrder->food->price * $cardOrder->quantity;
        $priceTopping = 0;
        foreach ($cardOrder->food->toppings as $topping) {
            $priceTopping = $priceTopping + $cardOrder->quantity * $topping->price;
        }
        $cardOrder->price = $price + $priceTopping;

        if ($cardOrder->update()) {
            $cardOrder->food->weight = number_format($cardOrder->food->weight, 1);
            $cardO = CartOrder::where('cart_id', $cardOrder->cart_id)->get();
            $sumPrice = 0;
            foreach ($cardO as $co) {
                $sumPrice = $sumPrice + $co->price;
            }
            $card = Cart::where('id', $cardOrder->cart_id)->first();
            $card->sum_price = $sumPrice;
            $card->update();
            return response()->json(['cardOrder' => $cardOrder], 200);
        } else {
            return response()->json(['error' => 'Card not found'], 401);
        }

    }

    public function decreaseQuantity(Request $request)
    {
        $cardOrderId = $request->cardOrderId;
        $cardOrder = CartOrder::where('id', $cardOrderId)->with('food')->with('food.toppings')->with('food.image')->first();
        $cardOrder->quantity = $cardOrder->quantity - 1;

        $price = $cardOrder->food->price * $cardOrder->quantity;

        $priceTopping = 0;
        foreach ($cardOrder->food->toppings as $topping) {
            $priceTopping = $priceTopping + $cardOrder->quantity * $topping->price;
        }
        $cardOrder->price = $price + $priceTopping;

        if ($cardOrder->update()) {
            $cardOrder->food->weight = number_format($cardOrder->food->weight, 1);
            $cardO = CartOrder::where('cart_id', $cardOrder->cart_id)->get();
            $sumPrice = 0;
            foreach ($cardO as $co) {
                $sumPrice = $sumPrice + $co->price;
            }
            $card = Cart::where('id', $cardOrder->cart_id)->first();
            $card->sum_price = $sumPrice;
            $card->update();
            return response()->json(['cardOrder' => $cardOrder], 200);
        } else {
            return response()->json(['error' => 'Card not found'], 401);
        }
    }

}
