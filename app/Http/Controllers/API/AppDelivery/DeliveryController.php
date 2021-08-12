<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function getDelivery(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        error_log('dsaas');
        if ($token != null) {
            $order = Order::where('order_status_id', 6)->with('foodOrder')->with('user')
                ->with('foodOrder.food')->with('foodOrder.toppings')->with('foodOrder.food.restaurant')->get();
            if ($order != null) {
                foreach ($order as $o) {
                    foreach ($o->foodOrder as $fo) {
                        $fo->food->weight = number_format($fo->food->weight, 1);
                        $fo->food->restaurant->rating = number_format($fo->food->restaurant->rating, 1);
                    }
                }
            }
            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

}
