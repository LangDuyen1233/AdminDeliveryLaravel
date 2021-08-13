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
            $order = Order::where('order_status_id', 6)->with('foodOrder')->with('user')->with('userDelivery')
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

    public function received(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            error_log($request->orderId);
            $orderId = $request->orderId;
            $order = Order::find($orderId);
            error_log($order);


            $workflow = $order->workflow_get();
            if ($workflow->can($order, 'RECEIVED') == true) {
                $workflow->apply($order, 'RECEIVED');
                error_log($request->userId);
                $order->user_delivery_id = $request->userId;
                $order->save();
                return response()->json(['success' => 'Thay đổi thành công', 'order' => $order], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }
    }

    public function isDelivery(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        error_log('is delivery');
        $userId = $request->userId;
        if ($token != null) {
            $order = Order::where('order_status_id', 3)->where('user_delivery_id', $userId)
                ->with('foodOrder')->with('user')->with('userDelivery')->with('payment')
                ->with('foodOrder.food')->with('foodOrder.toppings')->with('foodOrder.food.restaurant')
                ->first();
            if ($order != null) {
                foreach ($order->foodOrder as $fo) {
                    $fo->food->weight = number_format($fo->food->weight, 1);
                    $fo->food->restaurant->rating = number_format($fo->food->restaurant->rating, 1);
                }
            }
            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function changeDelivery(Request $request)
    {
        error_log('vào đây đi bạn');
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $orderId = $request->orderId;
            error_log($orderId);
            $order = Order::find($orderId);
            error_log($order);

            $workflow = $order->workflow_get();
            if ($workflow->can($order, 'DELIVERED') == true) {
                $workflow->apply($order, 'DELIVERED');
//                error_log($request->userId);
//                $order->user_delivery_id = $request->userId;
                $order->save();
                return response()->json(['success' => 'Thay đổi thành công', 'order' => $order], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }
    }

    public function historyDelivery(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        error_log('is historyDelivery');
        $userId = $request->userId;
        error_log($userId);
        if ($token != null) {
            $order = Order::where('order_status_id', 4)->where('user_delivery_id', $userId)
                ->with('foodOrder')->with('user')->with('userDelivery')->with('payment')
                ->with('foodOrder.food')->with('foodOrder.toppings')->with('foodOrder.food.restaurant')
                ->get();
            foreach ($order as $fo) {
                foreach ($fo->foodOrder as $f) {
                    $f->food->weight = number_format($f->food->weight, 1);
                    $f->food->restaurant->rating = number_format($f->food->restaurant->rating, 1);
                }
            }
            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
