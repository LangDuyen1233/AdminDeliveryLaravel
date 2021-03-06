<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Discount;
use App\Models\Food;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\TypeDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiscountController extends Controller
{
    public function index()
    {
        $discount = Discount::with('typeDiscount')->with('restaurant')->where('status',1)->get();
        $user = Session::get('auth');
        return view('discount.index',
            [
                'discount' => $discount,
                'user' => $user,
            ]
        );
    }

    public function create()
    {
        $discount = Discount::all();
        $type_discount = TypeDiscount::all();
        $restaurant = Restaurant::all();
        $user = Session::get('auth');
        return View('discount.create',
            [
                'discount' => $discount,
                'type_discount' => $type_discount,
                'restaurant' => $restaurant,
                'user' => $user,
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
        $discount->save();

        return redirect('admin-discount')->withErrors(['mes' => "Th??m khuy???n m??i th??nh c??ng"]);
    }

    public function edit($id)
    {
        $type_discount = TypeDiscount::all();
        $restaurant = Restaurant::all();
        $discount = Discount::where('id', $id)->with('typeDiscount')->with('restaurant')->first();
        $user = Session::get('auth');
        return View('discount.edit',
            [
                'discount' => $discount,
                'type_discount' => $type_discount,
                'restaurant' => $restaurant,
                'user' => $user,
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
            $d->start_date = date("Y-m-d", strtotime($request->get('start_date')));
            $d->end_date = date("Y-m-d", strtotime($request->get('end_date')));
            $d->type_discount_id = $request->get('type_discount_id');
            $d->restaurant_id = $request->get('restaurant_id');
            $d->status = $request->get('status');
            $d->save();
            return redirect('admin-discount')->withErrors(['mes' => "C???p nh???t khuy???n m??i th??nh c??ng"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {

        $d = Discount::find($id);

        try {
            $d->status = 0;
            $d->update();
            return redirect()->back()->withErrors(['mes' => "X??a khuy???n m??i th??nh c??ng"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'name.required' => 'B???n c???n nh???p t??n khuy???n m??i',
            'code.required' => 'B???n c???n nh???p m?? khuy???n m??i',
            'percent.required' => 'B???n c???n nh???p gi???m gi??',
            'start_date.required' => 'B???n c???n nh???p ng??y b???t ?????u',
            'start_date.date' => 'Ng??y b???t ?????u ph???i l?? ng??y',
            'start_date.before_or_equal:end_date' => 'Ng??y b???t ?????u ph???i tr?????c ng??y k???t th??c',
            'end_date.required' => 'B???n c???n nh???p ng??y k???t th??c',
            'end_date.date' => 'Ng??y k???t th??c ph???i l?? ng??y',
            'end_date.after_or_equal:start_date' => 'Ng??y k???t th??c ph???i sau ng??y b???t ?????u',
            'type_discount_id.required' => 'B???n c???n ch???n lo???i khuy???n m??i',
            'restaurant_id.required' => 'B???n c???n ch???n qu??n ??n',
        ];
    }
}
