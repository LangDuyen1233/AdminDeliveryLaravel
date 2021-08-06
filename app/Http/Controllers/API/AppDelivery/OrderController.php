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

        $order = new Order([
            'price' => $sumprice,
            'price_delivery' => $price_delivery,
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
            error_log($co);
            error_log($order_id);
            $price = $co->price;
            $quantity = $co->quantity;
            $food_id = $co->food_id;
            error_log($price);
            error_log($quantity);
            error_log($food_id);
            $food_orders = new Food_Orders([
                'price' => $price,
                'quantity' => $quantity,
                'food_id' => $food_id,
                'order_id' => $order_id,
            ]);
            error_log($food_orders);
            $food_orders->save();
            error_log($co->toppings);
            foreach ($co->toppings as $t) {
                error_log($t);
                error_log($t->id);
                $food_orders->toppings()->sync($t->id);
            }

            $co->delete();
        }
        $card = Cart::where('id', $card_id)->first();
        $card->delete();

        return response()->json(['order' => $order], 200);
    }
}
