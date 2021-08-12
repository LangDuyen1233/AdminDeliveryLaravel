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
            $order = Order::where('order_status_id', 6)->get();

            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

}
