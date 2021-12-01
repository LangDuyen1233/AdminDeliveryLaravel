<?php


namespace App\Http\Controllers;


use App\Models\Food;
use App\Models\Food_Orders;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController
{
    public function index()
    {
        $user = Session::get('auth');
        $countUser = User::all()->count();
        $countRestaurant = Restaurant::all()->count();
        $countOrder = Order::all()->count();
        $food = Food::all(['id']);
        $sumPrice = Order::all()->sum('price');
        $sumPrice = number_format($sumPrice, 0, '', ',');
        $foodOrder = DB::table('food_orders')->selectRaw('foods.name,foods.price,images.url,COUNT(food_orders.food_id) as total_food')
            ->join('foods', 'foods.id', '=', 'food_orders.food_id')
            ->join('image_foods', 'foods.id', '=', 'image_foods.food_id')
            ->join('images', 'images.id', '=', 'image_foods.image_id')
            ->groupBy('food_orders.food_id', 'foods.name', 'foods.price', 'images.url')
            ->orderBy('total_food', 'DESC')
            ->limit(5)
            ->get();
        $monthlyRevenue = DB::table('orders')
            ->selectRaw('MONTH(updated_at) as month,SUM(orders.price) as total')
            ->where(DB::raw('YEAR(NOW())'), '=', DB::raw('YEAR(updated_at)'))
            ->groupBy(DB::raw('MONTH(updated_at)'))
            ->get();
        $restaurantSelling = DB::table('restaurants')
            ->selectRaw('restaurants.id,restaurants.image, restaurants.`name`,restaurants.rating, COUNT(DISTINCT(orders.id)) as countOrder')
            ->join('foods', 'restaurants.id','=','foods.restaurant_id')
            ->join('food_orders','foods.id', '=', 'food_orders.food_id')
            ->join('orders','food_orders.order_id','=','orders.id')
            ->groupBy('restaurants.id','restaurants.image','restaurants.name','restaurants.rating')
            ->orderBy('countOrder','DESC')
            ->limit(4)
            ->get();

        foreach ($monthlyRevenue as $mr) {
            $mr->total = number_format($mr->total, 0, '', ',');
        }

        return view('home.home',
            [
                'user' => $user,
                'food' => $food,
                'countUser' => $countUser,
                'countRestaurant' => $countRestaurant,
                'countOrder' => $countOrder,
                'sumPrice' => $sumPrice,
                'foodOrder' => $foodOrder,
                'monthlyRevenue' => $monthlyRevenue,
                'restaurantSelling'=>$restaurantSelling,

            ]
        );
    }
}
