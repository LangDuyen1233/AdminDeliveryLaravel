<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::all();
//        dd($res);
        return view('restaurant.index',
            [
                'restaurant' => $restaurant,
            ]
        );
    }

    public function create()
    {
        return View('restaurant.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'phone' => 'required|numeric|min:11',
            'address' => 'required|max:100',
        ], $this->messages());
        $name = $request->get('name');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $rating = $request->get('rating');
        $longtitude = $request->get('longtitude');
        $lattitude = $request->get('lattitude');
        $description = $request->get('description');
        $restaurant = new Restaurant([
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'rating' => $rating,
            'longtitude' => $longtitude,
            'lattitude' => $lattitude,
            'description' => $description,
        ]);
//        dd($restaurant);
        $restaurant->save();
        return redirect('admin-restaurant')->withErrors(['mes' => "Thêm quán ăn thành công"]);
    }

    public function edit($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        return View('restaurant.edit',
            [
                'restaurant' => $restaurant,
            ]);
    }

    public function update(Request $request, $id)
    {
        if (!isset($id)) {
            return response('', 400);
        }
        $r = Restaurant::find($id);
        if (!isset($r)) {
            return response('', 404);
        }
        $request->validate([
            'name' => 'required|max:100',
            'address' => 'required|max:100',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ], $this->messages());
        try {
            error_log($r);
            $r->name = $request->get('name');
            $r->phone = $request->get('phone');
            $r->address = $request->get('address');
            $r->rating = $request->get('rating');
            $r->longtitude = $request->get('longtitude');
            $r->lattitude = $request->get('lattitude');
            $r->description = $request->get('description');

            $r->save();
            return redirect('admin-restaurant')->withErrors(['mes' => "Cập nhật quán ăn thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {

        $u = Restaurant::find($id);
        if (!isset($u)) {
            return response('', 404);
        }


        try {
            $u->delete();
            return redirect()->back()->withErrors(['mes' => "Xóa quán ăn thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập họ tên',
            'address.required' => 'Bạn cần nhập địa chỉ',
            'phone.required' => 'Bạn cần phải nhập số điện thoại.',
            'phone.min' => 'Số điện thoại phải lớn hơn 10 số.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ];
    }

}
