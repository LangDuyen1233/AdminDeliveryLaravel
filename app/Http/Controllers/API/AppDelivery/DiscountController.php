<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function getDiscount(Request $request)
    {
        $restaurant_id = $request->restaurant_id;
        $now = Carbon::now()->format('Y-m-d');
        $discount = Discount::where('start_date','<=',$now)->where('end_date','>=',$now)->where('status',1)->where('restaurant_id',$restaurant_id)->get();
        return response()->json(['discounts' => $discount], 200);
    }
}
