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
        $restaurant_id = $request->restaurant_id;
        $restaurant = Restaurant::where('id', $restaurant_id)->with('foods')->with('foods.toppings')->with('foods.discount')
            ->with('foods.image')->with('user')->first();
        $restaurant->rating = number_format($restaurant->rating, 1);
        foreach ($restaurant->foods as $f) {
            $f->weight = number_format($f->weight, 1);
            if ($f->discount != null) {
                $f->discount->percent = number_format($f->discount->percent, 1);
            }
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

        $topping_id = $request->toppingid;
        $restaurant_id = $request->restaurant_id;

        $card = Cart::where('restaurant_id', $restaurant_id)->where('user_id', $user_id)->first();
        if ($card == null) {
            $card = new Cart([
                'user_id' => $user_id,
                'sum_price' => $sum_price,
                'restaurant_id' => (int)$restaurant_id,
            ]);
            $card->save();
        } else {
            $card->sum_price = $sum_price;
            $card->update();
        }

        $quantity = $request->quantity;
        $price = $request->price;
        $food_id = $request->food_id;

        $card_order = CartOrder::where('food_id', $food_id)->where('cart_id', $card->id)->first();
        if ($card_order == null) {
            $card_order = new CartOrder([
                'quantity' => $quantity,
                'price' => $price,
                'food_id' => $food_id,
                'cart_id' => $card->id,
            ]);
            $card_order->save();
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
        $card = Cart::with('cardOrder')->with('cardOrder.food')
            ->with('cardOrder.toppings')->with('cardOrder.food.image')
            ->where('restaurant_id', $restaurant_id)->where('user_id', $user_id)->first();

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
        $card = Cart::with('cardOrder')
            ->with('cardOrder.food')
            ->with('restaurant')
            ->with('cardOrder.food.image')
            ->with('cardOrder.toppings')
            ->where('id', $card_id)->first();
        foreach ($card->cardOrder as $co) {
            $co->food->weight = number_format($co->food->weight, 1);
        }
        $card->restaurant->rating = number_format($card->restaurant->rating, 1);
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
        $cardOrder = CartOrder::where('id', $cardOrderId)->with('food')->with('toppings')
            ->with('food.image')->with('food.discount')->first();

        $cardOrder->quantity = $cardOrder->quantity + 1;
        if ($cardOrder->food->discount_id != null) {
            $price = ($cardOrder->food->price - round($cardOrder->food->price * ($cardOrder->food->discount->percent / 100))) * $cardOrder->quantity;
        } else {
            $price = $cardOrder->food->price * $cardOrder->quantity;
        }
        $priceTopping = 0;
        foreach ($cardOrder->toppings as $topping) {
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

            if ($cardOrder->food->discount != null) {
                $cardOrder->food->discount->percent = number_format($cardOrder->food->discount->percent, 1);
            }

            return response()->json(['cardOrder' => $cardOrder], 200);
        } else {
            return response()->json(['error' => 'Card not found'], 401);
        }

    }

    public function decreaseQuantity(Request $request)
    {
        $cardOrderId = $request->cardOrderId;
        $cardOrder = CartOrder::where('id', $cardOrderId)->with('food')->with('toppings')
            ->with('food.image')->with('food.discount')->first();
        $cardOrder->quantity = $cardOrder->quantity - 1;

        if ($cardOrder->food->discount_id != null) {
            $price = ($cardOrder->food->price - round($cardOrder->food->price * ($cardOrder->food->discount->percent / 100))) * $cardOrder->quantity;
        } else {
            $price = $cardOrder->food->price * $cardOrder->quantity;
        }

        $priceTopping = 0;
        foreach ($cardOrder->toppings as $topping) {
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

            if ($cardOrder->food->discount != null) {
                $cardOrder->food->discount->percent = number_format($cardOrder->food->discount->percent, 1);
            }

            return response()->json(['cardOrder' => $cardOrder], 200);
        } else {
            return response()->json(['error' => 'Card not found'], 401);
        }
    }

}
