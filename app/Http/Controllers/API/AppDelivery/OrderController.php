<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartOrder;
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
            'note' => $now,
            'status' => 1,
            'order_status_id' => 3,
        ]);
        $order->save();
        $card_order = CartOrder::where('cart_id', $card_id)->get();
        error_log($card_order);
//        $card_order->delete();
        foreach ($card_order as $co) {
            $co->delete();
        }
        $card = Cart::where('id', $card_id)->first();
        $card->delete();

        return response()->json(['order' => $order], 200);
    }
}
