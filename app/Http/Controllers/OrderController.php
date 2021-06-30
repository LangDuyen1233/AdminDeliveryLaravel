<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Food;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::with('statusOrder')->with('payment')->with('user')->get();
        return view('order.index',
            [
                'order' => $order,
            ]
        );
    }

    public function show($id){
        $order = Order::where('id', $id)->first();
        return view('order.show',
            [
                'order' => $order,
            ]
        );
    }

    public function edit($id)
    {
        $order = Order::where('id', $id)->first();
        return View('order.edit',
            [
                'order' => $order,
            ]);
    }

    public function update(Request $request, $id)
    {
        if (!isset($id)) {
            return response('', 400);
        }
        $f = Food::find($id);
//        dd($f->image[0]->id);
//        $image = Image::find($f->image[0]->id);
        if (!isset($f)) {
            return response('', 404);
        }
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|max:100',
            'image' => 'required|max:100',
            'ingredients' => 'required|max:100',
            'restaurant_id' => 'required|max:100',
            'category_id' => 'required|max:100',
        ], $this->messages());
        try {
            error_log($f);
            $f->name = $request->get('name');
            $f->price = $request->get('price');
            $f->weight = $request->get('weight');
            $f->ingredients = $request->get('ingredients');
            $f->note = $request->get('note');
            $f->category_id = $request->get('category_id');
            $f->restaurant_id = $request->get('restaurant_id');
            $f->status = $request->get('status');
            $f->save();
            $image = $request->get('image');
//            $image->url = $request->get('image');
//            $image->save();
//
            $images = new Image([
                    'url' => $image,
                ]
            );
//        $image->url = $image;
            $f->image()->update($images->toArray());

            return redirect('admin-food')->withErrors(['mes' => "Cập nhật món ăn thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {
        if (!isset($id)) {
            return response('', 400);
        }
        $f = Food::find($id);
        if (!isset($f)) {
            return response('', 404);
        }


        try {
            $f->image()->detach();
            $f->delete();
            return redirect()->back()->withErrors(['mes' => "Xóa món ăn thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'username.required' => 'Bạn cần nhập họ tên',
            'email.required' => 'Bạn cần phải nhập Email.',
            'email.email' => 'Định dạng Email bị sai.',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn cần phải nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải nhiều hơn 8 ký tự.',
            're_password.same' => 'Nhắc lại mật khẩu không trùng với mật khẩu',
            're_password.required' => 'Bạn cần nhập nhắc lại mật khẩu',
            'phone.required' => 'Bạn cần phải nhập số điện thoại.',
            'phone.min' => 'Số điện thoại phải lớn hơn 10 số.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ];
    }
}
