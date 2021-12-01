<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::with('category')->with('user')->get();
        $user = Session::get('auth');
        return view('restaurant.index',
            [
                'restaurant' => $restaurant,
                'user' => $user,
            ]
        );
    }

    public function create()
    {
        $category = Category::where('status', 1)->get();
        $restaurant = Restaurant::with('user')->get();
        $user = Session::get('auth');

        foreach ($restaurant as $res) {
            error_log($res->user_id);
            $data[] = $res->user_id;
        }

        $userNotRestaurant = User::whereNotIn('id', $data)->where('active', 1)->where('role_id', 3)->get();

        return View('restaurant.create',
            [
                'category' => $category,
                'userRestaurant' => $userNotRestaurant,
                'user' => $user,
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:restaurants,name|max:100',
            'phone' => 'required|numeric|min:10|regex:/^0[0-9]/',
            'address' => 'required|max:100',
            'image' => 'required|max:100',
            'category_id' => 'required|max:100',
            'user_id' => 'required',
        ], $this->messages());

        $name = $request->get('name');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $image = $request->get('image');
        $rating = $request->get('rating');
        $description = $request->get('description');
        $category_id = $request->get('category_id');
        $user_id = $request->get('user_id');
        $restaurant = new Restaurant([
            'name' => $name,
            'address' => $address,
            'image' => $image,
            'phone' => $phone,
            'rating' => $rating,
            'description' => $description,
            'user_id' => $user_id,
            'active' => $request->get('active'),
            'lattitude' => 0.0,
            'longtitude' => 0.0,
        ]);
        $restaurant->save();
        foreach ($category_id as $c) {
            error_log($c);
            $restaurant->category()->attach($restaurant->id, ['restaurant_id' => $restaurant->id, 'category_id' => $c]);
        }

        return redirect('admin-restaurant')->withErrors(['mes' => "Thêm quán ăn thành công"]);
    }

    public function edit($id)
    {
        $category = Category::all();
        $restaurant = Restaurant::where('id', $id)->with('category')->with('user')->first();
        $res = Restaurant::all();
        $user = Session::get('auth');
        foreach ($res as $r) {
            error_log($r->user_id);
            if ($r->id != $id) {
                $data[] = $r->user_id;
            }
        }

        $userNotRestaurant = User::whereNotIn('id', $data)->where('active', 1)->where('role_id', 3)->get();
        return View('restaurant.edit',
            [
                'category' => $category,
                'restaurant' => $restaurant,
                'userRestaurant' => $userNotRestaurant,
                'user' => $user,
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
            'phone' => 'required|numeric|min:10|regex:/^0[0-9]/',
            'image' => 'required|max:100',
            'category_id' => 'required|max:100',
            'user_id' => 'required',
        ], $this->messages());
        try {
            $r->name = $request->get('name');
            $r->phone = $request->get('phone');
            $r->address = $request->get('address');
            $r->image = $request->get('image');
            $r->rating = $request->get('rating');
            $r->description = $request->get('description');
            $r->active = $request->get('active');
            $r->user_id = $request->get('user_id');
            error_log($request->get('user_id'));
            $category_id = $request->get('category_id');

            $r->save();
            $r->category()->sync($category_id);

            return redirect('admin-restaurant')->withErrors(['mes' => "Cập nhật quán ăn thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {

        $r = Restaurant::find($id);

        try {
            if ($r->active == 0) {
                $r->active = 1;
                $r->update();
            } else {
                $r->active = 0;
                $r->update();
            }
            return redirect()->back()->withErrors(['mes' => "Cập nhật quán ăn thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập họ tên',
            'name.unique' => 'Tên đã được sử dụng, bạn cần chọn tên khác',
            'address.required' => 'Bạn cần nhập địa chỉ',
            'phone.required' => 'Bạn cần phải nhập số điện thoại.',
            'phone.min' => 'Số điện thoại phải lớn hơn 10 số.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
            'image.required' => 'Bạn cần chọn hình ảnh',
            'category_id.required' => 'Bạn cần chọn danh mục',
            'user_id.required' => 'Bạn cần chọn chủ quán ăn',
        ];
    }
}
