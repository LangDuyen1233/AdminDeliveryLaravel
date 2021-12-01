<?php


namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {

        $order = Order::with('statusOrder')->with('payment')->with('discount')->with('user')->where('is_delete', 1)->get();
        $user = Session::get('auth');
        return view('order.index',
            [
                'user' => $user,
                'order' => $order,
            ]
        );
    }

    public function show($id)
    {
        $order = Order::with('food.restaurant')->with('food.toppings')->with('user.address')->with('userDelivery')->find($id);
        $user = Session::get('auth');
        return view('order.show',
            [
                'order' => $order,
                'user' => $user,
            ]
        );
    }

    public function edit($id)
    {
        $statusOrder = OrderStatus::all();
        $order = Order::where('id', $id)->with('user')->with('payment')->first();
        $user = Session::get('auth');
        return View('order.edit',
            [
                'statusOrder' => $statusOrder,
                'order' => $order,
                'user' => $user,
            ]);
    }

    public function update(Request $request, $id)
    {

        $o = Order::with('payment')->find($id);

        $request->validate([
            'order_status_id' => 'required|max:100',
            'price_delivery' => 'required|max:100',
            'address_delivery' => 'required|max:100',
            'date' => 'required|max:100',
            'payment_status_id' => 'required|max:100',
            'payment_method_id' => 'required|max:100',
        ], $this->messages());
        error_log($request->get('payment_status_id'));
        try {
            $o->address_delivery = $request->get('address_delivery');
            $o->order_status_id = $request->get('order_status_id');
            $o->price_delivery = $request->get('price_delivery');
            $o->date = $request->get('date');
            $o->status = $request->get('status');
            $o->save();

            $o->payment->update(['status' => $request->get('payment_status_id')]);
            $o->payment->update(['method' => $request->get('payment_method_id')]);

            return redirect('admin-order')->withErrors(['mes' => "Cập nhật đơn hàng thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {
        $o = Order::find($id);

        try {
            $o->is_delete = 0;
            $o->update();
            return redirect()->back()->withErrors(['mes' => "Cập nhật đơn hàng thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'order_status_id.required' => 'Trạng thái đơn hàng là bắt buộc',
            'price_delivery.required' => 'Phí giao hàng là bắt buộc',
            'date.required' => 'Ngày giao hàng là bắt buộc',
            'payment_status_id.required' => 'Trạng thái thanh toán là bắt buộc',
            'payment_method_id.required' => 'Phương thức thanh toán là bắt buộc',
            'address_delivery.required' => 'Địa chỉ giao hàng là bắt buộc',
        ];
    }
}
