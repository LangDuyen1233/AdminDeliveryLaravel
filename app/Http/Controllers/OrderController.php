<?php


namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = User::all();
        $order = Order::with('statusOrder')->with('paymentStatus')->with('paymentMethod')->get();
//        dd($order);
        return view('order.index',
            [
                'user' => $user,
                'order' => $order,
            ]
        );
    }

    public function show($id)
    {

        $order = Order::with('cart.food.restaurant')->with('cart.food.toppings')->with('cart.food.sizes')->find($id);
//        dd($order->cart->food);
        return view('order.show',
            [
                'order' => $order,
            ]
        );
    }

    public function edit($id)
    {
        $statusOrder = OrderStatus::all();
        $paymentMethod = PaymentMethod::all();
        $paymentStatus = PaymentStatus::all();
        $order = Order::where('id', $id)->first();
        return View('order.edit',
            [
                'statusOrder' => $statusOrder,
                'paymentMethod' => $paymentMethod,
                'paymentStatus' => $paymentStatus,
                'order' => $order,
            ]);
    }

    public function update(Request $request, $id)
    {
//        if (!isset($id)) {
//            return response('', 400);
//        }
        $o = Order::find($id);
//        dd($f->image[0]->id);
//        $image = Image::find($f->image[0]->id);
//        if (!isset($f)) {
//            return response('', 404);
//        }
        $request->validate([
            'order_status_id' => 'required|max:100',
            'price_delivery' => 'required|max:100',
            'address_delivery' => 'required|max:100',
            'date' => 'required|max:100',
            'payment_status_id' => 'required|max:100',
            'payment_method_id' => 'required|max:100',
        ], $this->messages());
        try {
            $o->address_delivery = $request->get('address_delivery');
            $o->order_status_id = $request->get('order_status_id');
            $o->tax = $request->get('tax');
            $o->price_delivery = $request->get('price_delivery');
            $o->payment_status_id= $request->get('payment_status_id');
            $o->payment_method_id = $request->get('payment_method_id');
            $o->date = $request->get('date');
            $o->status = $request->get('status');
//            dd($o);
            $o->save();

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
            $o->user()->detach();
            $o->delete();
            return redirect()->back()->withErrors(['mes' => "Xóa thành công"]);
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
