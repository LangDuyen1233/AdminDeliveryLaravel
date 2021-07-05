<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Discount;
use App\Models\Food;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\TypeDiscount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
//        $type_discount = TypeDiscount::all();
        $discount = Discount::with('typeDiscount')->with('restaurant')->get();
//        dd($discount);
        return view('discount.index',
            [
//                'type_discount' => $type_discount,
                'discount' => $discount,
            ]
        );
    }

    public function create()
    {
        $discount = Discount::all();
        $type_discount = TypeDiscount::all();
        $restaurant = Restaurant::all();
        return View('discount.create',
            [
                'discount' => $discount,
                'type_discount' => $type_discount,
                'restaurant' => $restaurant,
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:100',
            'percent' => 'required|max:100',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type_discount_id' => 'required|max:100',
            'restaurant_id' => 'required|max:100',
        ], $this->messages());

        $name = $request->get('name');
        $code = $request->get('code');
        $percent = $request->get('percent');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $type_discount_id = $request->get('type_discount_id');
        $restaurant_id = $request->get('restaurant_id');

        $discount = new Discount([
            'name' => $name,
            'code' => $code,
            'percent' => $percent,
            'start_date' => date("Y-m-d", strtotime($start_date)),
            'end_date' => date("Y-m-d", strtotime($end_date)),
            'type_discount_id' => $type_discount_id,
            'restaurant_id' => $restaurant_id,
            'status' => $request->get('status'),
        ]);
//        dd($discount);
        $discount->save();

        return redirect('admin-discount')->withErrors(['mes' => "Thêm khuyến mãi thành công"]);
    }

    public function edit($id)
    {
        $type_discount = TypeDiscount::all();
        $restaurant = Restaurant::all();
        $discount = Discount::where('id', $id)->with('typeDiscount')->with('restaurant')->first();
        return View('discount.edit',
            [
                'discount' => $discount,
                'type_discount' => $type_discount,
                'restaurant' => $restaurant,
            ]);
    }

    public function update(Request $request, $id)
    {

        $d = Discount::find($id);
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:100',
            'percent' => 'required|max:100',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type_discount_id' => 'required|max:100',
            'restaurant_id' => 'required|max:100',
        ], $this->messages());
        try {
            error_log($d);
            $d->name = $request->get('name');
            $d->code = $request->get('code');
            $d->percent = $request->get('percent');
            $d->start_date = $request->get('start_date');
            $d->end_date = $request->get('end_date');
            $d->type_discount_id = $request->get('type_discount_id');
            $d->restaurant_id = $request->get('restaurant_id');
            $d->status = $request->get('status');
            $d->save();
//dd($d);
            return redirect('admin-discount')->withErrors(['mes' => "Cập nhật khuyến mãi thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {

        $d = Discount::find($id);

        try {
            $d->delete();
            return redirect()->back()->withErrors(['mes' => "Xóa khuyến mãi thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập tên khuyến mãi',
            'code.required' => 'Bạn cần nhập mã khuyến mãi',
            'percent.required' => 'Bạn cần nhập giảm giá',
            'start_date.required' => 'Bạn cần nhập ngày bắt đầu',
            'start_date.date' => 'Ngày bắt đầu phải là ngày',
            'start_date.before_or_equal:end_date' => 'Ngày bắt đầu phải trước ngày kết thúc',
            'end_date.required' => 'Bạn cần nhập ngày kết thúc',
            'end_date.date' => 'Ngày kết thúc phải là ngày',
            'end_date.after_or_equal:start_date' => 'Ngày kết thúc phải sau ngày bắt đầu',
            'type_discount_id.required' => 'Bạn cần chọn loại khuyến mãi',
            'restaurant_id.required' => 'Bạn cần chọn quán ăn',
        ];
    }
}
