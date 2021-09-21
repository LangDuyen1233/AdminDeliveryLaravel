<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function revenueWeek(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $id = auth()->user()->id;
            $revenueWeek = DB::table('orders')->selectRaw('orders.price, orders.updated_at,DAYOFWEEK(orders.updated_at) as day_of_week')
                ->join('food_orders', 'food_orders.order_id', '=', 'orders.id')
                ->join('foods', 'food_orders.food_id', '=', 'foods.id')
                ->join('restaurants', 'restaurants.id', '=', 'foods.restaurant_id')
                ->where(DB::raw('WEEK(orders.updated_at)'), '=', DB::raw('WEEK(NOW())'))
                ->where('restaurants.user_id', '=', $id)
                ->where('orders.order_status_id', '=', 4)
                ->groupBy('orders.updated_at', 'orders.price')
                ->get();
            error_log($revenueWeek);
            return response()->json(['revenueWeek' => $revenueWeek], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }


    }

    public function changePhoneRestaurant(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $restaurant = Restaurant::where('user_id',$id)->first();
            error_log($restaurant);
            $restaurant->phone = $request->phone;
            $restaurant->update();

            return response()->json(['success' => 'Sửa thành công'], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

}
