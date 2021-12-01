<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Mails\ConfirmDelivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DeliveryController extends Controller
{
    public function getDelivery(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $order = Order::where('order_status_id', 6)->with('foodOrder')->with('user')->with('userDelivery')
                ->with('foodOrder.food')->with('foodOrder.toppings')->with('foodOrder.food.restaurant')->with('foodOrder.food.restaurant.user')->get();
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
        if ($token != null) {
            $orderId = $request->orderId;
            $order = Order::where('id', $orderId)->first();

            $workflow = $order->workflow_get();
            if ($workflow->can($order, 'RECEIVED') == true) {
                $workflow->apply($order, 'RECEIVED');
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
        $userId = $request->userId;
        if ($token != null) {
            $order = Order::where('order_status_id', 3)->where('user_delivery_id', $userId)
                ->with('foodOrder')->with('user')->with('userDelivery')->with('payment')
                ->with('foodOrder.food')->with('foodOrder.toppings')->with('foodOrder.food.restaurant')->with('foodOrder.food.restaurant.user')
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
        $token = $request->bearerToken();
        if ($token != null) {
            $orderId = $request->orderId;
            $order = Order::where('id', $orderId)->with('payment')->first();

            $workflow = $order->workflow_get();
            if ($workflow->can($order, 'DELIVERED') == true) {
                $workflow->apply($order, 'DELIVERED');
                $order->payment->status = 'Đã thanh toán';
                $order->payment->update();
                $order->status = 0;
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
        $userId = $request->userId;
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

    public function registerDelivery()
    {
        $user_id = auth()->user()->id;
        $user = User::where('id', $user_id)->first();
        if ($user != null) {
            $code = random_int(100000, 999999);

            $user->code_confirm = $code;

            $user->update();
            Mail::to($user->email)->send(new ConfirmDelivery($code, $user->username));

            return response()->json([], 200);
        } else {
            return response()->json([], 401);
        }
    }

    public function confirmCode(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::where('id', $user_id)->first();
        if ($user != null) {
            $code = $request->code;
            if ($user->code_confirm == $code) {
                $user->role_id = 4;
                $user->code_confirm = null;

                $user->update();

                return response()->json([], 200);
            } else {
                return response()->json([], 204);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
