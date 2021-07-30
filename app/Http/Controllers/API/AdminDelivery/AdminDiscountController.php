<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminDiscountController extends Controller
{
    public function getDiscount(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();
            $discount = Discount::with('typeDiscount')->where('restaurant_id', $restaurant->id)
                        ->where('status', 1)->get();
            foreach ($discount as $d) {
                $d->percent = number_format($d->percent, 1);
            }
            return response()->json(['discount' => $discount], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function addDiscountVoucher(Request $request)
    {
        $id = auth()->user()->id;
        error_log($id);
        $restaurant = Restaurant::where('user_id', $id)->first();
        error_log($restaurant);

        error_log($request->bearerToken());

        $name = $request->name;
        $code = $request->code;
        $percent = $request->percent;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $restaurant_id = $restaurant->id;
        $type_discount_id = $request->type_discount_id;


        $discount = new Discount([
            'name' => $name,
            'code' => $code,
            'percent' => (double)$percent,
            'start_date' => date("Y-m-d", strtotime($start_date)),
            'end_date' => date("Y-m-d", strtotime($end_date)),
            'restaurant_id' => (int)$restaurant_id,
            'type_discount_id' => (int)$type_discount_id,
            'status' => 1
        ]);
        $discount->percent = number_format($discount->percent, 1);
        $discount->save();
        return response()->json(['success' => 'Tạo thành công', 'discount' => $discount], 200);
    }

    public function editDiscountVoucher(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $discount_id = $request->discountId;
            $discount = Discount::find($discount_id);
            $discount->percent = number_format($discount->percent, 1);
            return response()->json(['discount' => $discount], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateDiscountVoucher(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $restaurant = Restaurant::where('user_id', $id)->first();
            error_log($restaurant);
            $discount_id = $request->discountId;
            error_log($discount_id);

            $discount = Discount::find($discount_id);
            error_log($discount);

            error_log($request->code);

            $discount->name = $request->name;
            $discount->code = $request->code;
            $discount->percent = (double)$request->percent;
            $discount->start_date = date("Y-m-d", strtotime($request->start_date));
            $discount->end_date = date("Y-m-d", strtotime($request->end_date));
            $discount->restaurant_id = (int)$restaurant->id;
            $discount->type_discount_id = (int)$request->type_discount_id;

            $discount->update();

            $discount->percent = number_format($discount->percent, 1);

            return response()->json(['success' => 'Tạo thành công', 'discount' => $discount], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function deleteDiscountVoucher(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $discount_id = $request->discount_id;
            $discount = Discount::find($discount_id);

            $discount->status = 0;
            $discount->update();
            $discount->percent = number_format($discount->percent, 1);
            return response()->json(['discount' => $discount], 200);

        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
