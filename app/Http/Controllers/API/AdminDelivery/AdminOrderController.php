<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function getNewCard(Request $request)
    {
        $token = $request->bearerToken();
        $user_id = auth()->user()->id;

        $restaurant = Restaurant::where('user_id', $user_id)->first();

        if ($token != null) {

            $order = Order::with('user')->with('statusOrder')->with('foodOrder')
                ->with('foodOrder.food')->with('foodOrder.toppings')
                ->where('order_status_id', 1)->whereHas("food", function ($f) use ($restaurant) {
                $f->where('restaurant_id', $restaurant->id);
            })->get();
            foreach ($order as $o) {
                foreach ($o->foodOrder as $fo) {

                    $fo->food->weight = number_format($fo->food->weight, 1);
                }
            }
            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function cancelOrder(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $orderId = $request->orderId;
            $order = Order::find($orderId);

            $workflow = $order->workflow_get();
            if ($workflow->can($order, 'CANCEL') == true) {

                $workflow->apply($order, 'CANCEL');
                $order->reason = $request->reason;
                $order->status = 0;
                $order->save();
                return response()->json(['success' => 'Thay đổi thành công', 'order' => $order], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }
    }

    public function prepareOrder(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $orderId = $request->orderId;
            $order = Order::find($orderId);

            $workflow = $order->workflow_get();
            if ($workflow->can($order, 'PREPARES') == true) {

                $workflow->apply($order, 'PREPARES');
                $order->save();
                return response()->json(['success' => 'Thay đổi thành công', 'order' => $order], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }
    }

    public function getPrepareCard(Request $request)
    {
        $token = $request->bearerToken();
        $user_id = auth()->user()->id;

        $restaurant = Restaurant::where('user_id', $user_id)->first();
        if ($token != null) {
            $order = Order::with('user')->with('statusOrder')->with('foodOrder')
                ->with('foodOrder.food')->with('foodOrder.toppings')
                ->where('order_status_id', 2)->whereHas("food", function ($f) use ($restaurant) {
                    $f->where('restaurant_id', $restaurant->id);
                })->get();

            foreach ($order as $o) {
                foreach ($o->foodOrder as $fo) {
                    $fo->food->weight = number_format($fo->food->weight, 1);
                }
            }
            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function deliveryByRestaurant(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $orderId = $request->orderId;
            $order = Order::find($orderId);

            $workflow = $order->workflow_get();
            if ($workflow->can($order, 'DELIVERING') == true) {

                $workflow->apply($order, 'DELIVERING');
                $order->staff_id = (int)$request->staffId;
                $order->save();
                return response()->json(['success' => 'Thay đổi thành công', 'order' => $order], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }
    }

    public function deliveryByUser(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $orderId = $request->orderId;
            $order = Order::find($orderId);

            $workflow = $order->workflow_get();
            if ($workflow->can($order, 'WAITING') == true) {
                $workflow->apply($order, 'WAITING');
                $order->save();
                return response()->json(['success' => 'Thay đổi thành công', 'order' => $order], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }
    }

    public function getDeliveringCard(Request $request)
    {
        $token = $request->bearerToken();
        $user_id = auth()->user()->id;

        $restaurant = Restaurant::where('user_id', $user_id)->first();
        if ($token != null) {
            $order = Order::with('user')->with('statusOrder')->with('foodOrder')
                ->with('foodOrder.food')->with('foodOrder.toppings')->with('staff')
                ->where('order_status_id', 3)->whereHas("food", function ($f) use ($restaurant) {
                    $f->where('restaurant_id', $restaurant->id);
                })->get();
            foreach ($order as $o) {
                foreach ($o->foodOrder as $fo) {
                    $fo->food->weight = number_format($fo->food->weight, 1);
                }
            }
            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function delivered(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $orderId = $request->orderId;
            $order = Order::find($orderId);

            $workflow = $order->workflow_get();
            if ($workflow->can($order, 'DELIVERED') == true) {
                $workflow->apply($order, 'DELIVERED');
                $order->status=0;
                $order->save();
                return response()->json(['success' => 'Thay đổi thành công', 'order' => $order], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }
    }

    public function getDeliveredCard(Request $request)
    {
        $token = $request->bearerToken();
        $user_id = auth()->user()->id;

        $restaurant = Restaurant::where('user_id', $user_id)->first();
        if ($token != null) {
            $order = Order::with('user')->with('statusOrder')->with('foodOrder')
                ->with('foodOrder.food')->with('foodOrder.toppings')->with('staff')
                ->where('order_status_id', 4)->whereHas("food", function ($f) use ($restaurant) {
                    $f->where('restaurant_id', $restaurant->id);
                })->get();
            foreach ($order as $o) {
                foreach ($o->foodOrder as $fo) {
                    $fo->food->weight = number_format($fo->food->weight, 1);
                }
            }
            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function getHistoryCard(Request $request)
    {
        $token = $request->bearerToken();
        $user_id = auth()->user()->id;

        $restaurant = Restaurant::where('user_id', $user_id)->first();
        if ($token != null) {
            $order = Order::with('user')->with('statusOrder')->with('foodOrder')
                ->with('foodOrder.food')->with('foodOrder.food.restaurant')->with('foodOrder.toppings')->with('staff')
                ->whereIn('order_status_id', [4, 5])->whereHas("food", function ($f) use ($restaurant) {
                    $f->where('restaurant_id', $restaurant->id);
                })->get();
            foreach ($order as $o) {
                foreach ($o->foodOrder as $fo) {
                    $fo->food->weight = number_format($fo->food->weight, 1);
                    $fo->food->restaurant->rating = number_format( $fo->food->restaurant->rating, 1);
                }
            }
            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
