<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Food;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $image = Image::all();
        $review = Review::with('user')->with('restaurant')->get();
//        dd($review);
        return view('review.index',
            [
                'review' => $review,
                'image' => $image,
            ]
        );
    }

    public function edit($id)
    {
//        $user = User::all();
        $restaurant = Restaurant::all();
        $review = Review::where('id', $id)->with('image')->with('user')->with('restaurant')->first();
//        dd(count($review->image));
        return View('review.edit',
            [
//                'user' => $user,
                'restaurant' => $restaurant,
                'review' => $review,
            ]);
    }

    public function update(Request $request, $id)
    {
        $r = Review::find($id);
//        dd($f->image[0]->id);
//        $image = Image::find($f->image[0]->id);
//        $request->validate([
//            'name' => 'required|max:100',
//            'price' => 'required|max:100',
//            'image' => 'required|max:100',
//            'ingredients' => 'required|max:100',
//            'restaurant_id' => 'required|max:100',
//            'category_id' => 'required|max:100',
//        ], $this->messages());
        try {
            $r->review = $request->get('review');
            $r->rate = $request->get('rate');
            $r->status = $request->get('status');
            $r->save();

            $image = $request->get('image');
//            dd($image);
            $r->image()->update(['url' => $image]);

//            dd($r);

            return redirect('admin-review')->withErrors(['mes' => "Cập nhật đánh giá thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {

        $r = Review::find($id);
//

        try {
            $r->image()->delete();
//            if ($r->has('image')) {
//                    $r->photos()->detach();
//            }
//            dd($r);
            $r->delete();
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
