<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartOrder;
use App\Models\Food_Orders;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $user_id = auth()->user()->id;
        $sumprice = $request->sumprice;
        $method = $request->method_payment;
        $now = Carbon::now()->format('Y-m-d');
        $address = $request->address;
        $price_delivery = $request->price_delivery;
        $note = $request->note;
        $discount_id = $request->discount_id;
        $card_id = $request->card_id;
        $status = $request->status;
        error_log($card_id);


        $payment = new Payment([
            'method' => $method,
            'status' => $status,
            'user_id' => $user_id,
        ]);
        $payment->save();

        error_log($payment->id);

        if ($discount_id == 0) {
            $discount_id = null;
        }

        $setStatus = Order::where('user_id', $user_id)->get();
//        error_log($setStatus);
        foreach ($setStatus as $ss) {
            error_log($ss);
            $ss->status = 0;
            $ss->update();
        }
//        $setStatus->update();

        $order = new Order([
            'price' => $sumprice,
            'price_delivery' => (int)$price_delivery,
            'address_delivery' => $address,
            'date' => $now,
            'user_id' => $user_id,
            'payment_id' => $payment->id,
            'discount_id' => $discount_id,
            'note' => $note,
            'status' => 1,
            'order_status_id' => 3,
        ]);
        $order->save();

        $order_id = $order->id;
        $card_order = CartOrder::where('cart_id', $card_id)->get();

        foreach ($card_order as $co) {
            $price = $co->price;
            $quantity = $co->quantity;
            $food_id = $co->food_id;
            $food_orders = new Food_Orders([
                'price' => $price,
                'quantity' => $quantity,
                'food_id' => $food_id,
                'order_id' => $order_id,
            ]);
            error_log($food_orders);
            $food_orders->save();
            foreach ($co->toppings as $t) {
                $food_orders->toppings()->sync($t->id);
            }

            $co->delete();
        }
        $card = Cart::where('id', $card_id)->first();
        $card->delete();

        $o = Order::with('food.restaurant.user')->where('id', $order->id)->first();
        foreach ($o->food as $f) {
            $f->restaurant->rating = number_format($f->restaurant->rating, 1);
            $f->weight = number_format($f->weight, 1);
        }

        return response()->json(['order' => $o], 200);
    }

    public function getOrder()
    {
        $user_id = auth()->user()->id;
        $order = Order::where('user_id', $user_id)->where('status', 1)->with('food')->with('food.toppings')
            ->with('statusOrder')->with('food.restaurant')->with('payment')->first();

        if ($order != null) {
            foreach ($order->food as $f) {
                $f->restaurant->rating = number_format($f->restaurant->rating, 1);
                $f->weight = number_format($f->weight, 1);
            }
        }
        return response()->json(['order' => $order], 200);
    }

    public function getHistory()
    {
        $user_id = auth()->user()->id;
        error_log($user_id);
        $order = Order::with('statusOrder')
            ->with('food')
            ->with('food.restaurant')
            ->with('foodOrder.toppings')
            ->whereIn('order_status_id', [4, 5])->where('user_id', $user_id)->get();

        if ($order != null) {
            foreach ($order as $o) {
                foreach ($o->food as $fo) {
                    error_log('vaof ddaay ddi');
//                    $fo->weight = number_format($fo->weight, 1);
                    $fo->restaurant->rating = number_format($fo->restaurant->rating, 1);
                    $fo->weight = number_format($fo->weight, 1);
                }
            }
        }
        return response()->json(['order' => $order], 200);
    }

    public function getdraftOrder()
    {
        $user_id = auth()->user()->id;
        $card = Cart::with('restaurant')->where('user_id', $user_id)->get();
        foreach ($card as $c) {
            $c->restaurant->rating = number_format($c->restaurant->rating, 1);
        }
        return response()->json(['card' => $card], 200);
    }

    public function deleteDraftOrder(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = $request->card_id;
            $card = Cart::where('id', $id)->with('cardOrder')->first();
            error_log($card);

            foreach ($card->cardOrder as $c) {
                $c->delete();
            }

            $card->delete();

            return response()->json(['card' => $card], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
