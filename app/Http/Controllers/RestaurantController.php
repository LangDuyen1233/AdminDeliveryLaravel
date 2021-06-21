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
            'phone' => 'required|numeric|min:11'
        ], $this->messages());
        $name = $request->get('name');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $rating =$request->get('resting');
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
        dd($restaurant);
//        $user->save();
//        return redirect('admin-user')->withErrors(['mes' => "Thêm người dùng thành công"]);
    }

    public function edit($id)
    {
        $users = User::where('id', $id)->first();
        return View('user.editUser',
            [
                'users' => $users,
            ]);
    }

    public function update(Request $request, $id)
    {
        if (!isset($id)) {
            return response('', 400);
        }
        $u = User::find($id);
        if (!isset($u)) {
            return response('', 404);
        }
        $request->validate([
            'username' => 'required|max:100',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ], $this->messages());
        try {
            error_log($u);
            $u->username = $request->get('username');
            $u->email = $request->get('email');
            $u->dob = $request->get('dob');
            $u->phone_number = $request->get('phone');
            $u->gender = $request->get('gender');
            $u->bio = $request->get('bio');
            $u->active = $request->get('status');
            $u->role_id = $request->get('role_id');

            $u->save();
            return redirect('admin-user')->withErrors(['mes' => "Cập nhật người dùng thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id){
        error_log('ưertyjuol');
        if ( ! isset( $id ) ) {
            return response( '', 400 );
        }
        $u = User::find( $id );
        if ( ! isset( $u ) ) {
            return response( '', 404 );
        }


        try {
            $u->delete();
            return redirect()->back()->withErrors(['mes' => "Xóa người dùng thành công"]);
        } catch ( \Exception $e ) {
            return response( '', 500 );
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
