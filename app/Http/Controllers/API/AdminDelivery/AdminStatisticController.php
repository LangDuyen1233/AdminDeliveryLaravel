<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminStatisticController extends Controller
{
    public function getSales(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();
            $now = Carbon::now();
            error_log($now);

            $order = Order::where('order_status_id', 4)->whereHas("food", function ($f) use ($restaurant) {
                $f->where('restaurant_id', $restaurant->id);
            })->whereDay('updated_at', '=', $now)->get();
            error_log($order);

            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);

        }
    }

    public function getCancel(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();
            $now = Carbon::now();
            error_log($now);

            $order = Order::where('order_status_id', 5)->whereHas("food", function ($f) use ($restaurant) {
                $f->where('restaurant_id', $restaurant->id);
            })->whereDay('updated_at', '=', $now)->get();
            error_log($order);

            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);

        }
    }

    public function getSum(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();
            $now = Carbon::now();
            error_log($now);

            $order = Order::whereIn('order_status_id', [1, 2, 3, 4, 5, 6])->whereHas("food", function ($f) use ($restaurant) {
                $f->where('restaurant_id', $restaurant->id);
            })->whereDay('updated_at', '=', $now)->get();
            error_log($order);

            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);

        }
    }

    //revenue
    public function getRevenue(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        $now = Carbon::now();
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $order = Order::where('order_status_id', 4)->whereHas("food", function ($f) use ($restaurant) {
                $f->where('restaurant_id', $restaurant->id);
            })->whereDate('updated_at', '>=', $now)->get();
            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);

        }
    }

    public function changeRevenue(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $range = $request->range;

            error_log($range);
            if ($range != '0') {
                $arr = explode(' ', $range);
                if (count($arr) != 1) {
                    $start = $arr[0];
                    $end = $arr[2];
                } else {
                    $start = $arr[0];
                    $end = $arr[0];
                }

            }
            error_log('sdfg');
            $order = Order::where('order_status_id', 4)->whereHas("food", function ($f) use ($restaurant) {
                $f->where('restaurant_id', $restaurant->id);
            })->whereDate('updated_at', '>=', $start)->whereDate('updated_at', '<=', $end)->get();
            error_log($order);

            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);

        }
    }

    //warehouse

    public function getWarehouse(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        $now = Carbon::now();
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();
            $materials = Materials::where('restaurant_id', $restaurant->id)->whereDate('updated_at', '>=', $now)->get();
            error_log($materials);
            return response()->json(['materials' => $materials], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function changeWarehouse(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $range = $request->range;

            error_log($range);
            if ($range != '0') {
                $arr = explode(' ', $range);
                if (count($arr) != 1) {
                    $start = $arr[0];
                    $end = $arr[2];
                } else {
                    $start = $arr[0];
                    $end = $arr[0];
                }
            }

            $materials = Materials::where('restaurant_id', $restaurant->id)
                        ->whereDate('updated_at', '>=', $start)->whereDate('updated_at', '<=', $end)->get();

            return response()->json(['materials' => $materials], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);

        }
    }
}
