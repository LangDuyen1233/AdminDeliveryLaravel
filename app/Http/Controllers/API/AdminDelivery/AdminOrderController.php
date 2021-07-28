<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function getNewCard(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {

            $order = Order::with('user')->with('statusOrder')
//                ->where('')
                ->get();

            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

}
