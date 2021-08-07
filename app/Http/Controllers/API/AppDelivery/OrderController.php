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
        error_log($card_id);


        $payment = new Payment([
            'method' => $method,
            'status' => 'Chưa thanh toán',
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

        return response()->json(['order' => $order], 200);
    }

    public function getOrder()
    {
        $user_id = auth()->user()->id;
        error_log($user_id);
//        $ordetId = $request->order_id;
//        error_log($ordetId);
//        where('id', $ordetId)->
        $order = Order::where('user_id', $user_id)->where('status', 1)->with('food')->with('food.toppings')
            ->with('statusOrder')->with('food.restaurant')->with('payment')->first();
        error_log($order);

        if ($order != null) {
            foreach ($order->food as $f) {
                $f->restaurant->rating = number_format($f->restaurant->rating, 1);
            }
        }
        return response()->json(['order' => $order], 200);
    }
}
