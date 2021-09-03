<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Food;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function index()
    {
        $image = Image::all();
        $review = Review::with('user')->with('restaurant')->get();
        $user = Session::get('auth');
//        dd($review);
        return view('review.index',
            [
                'review' => $review,
                'image' => $image,
                'user' => $user,
            ]
        );
    }

    public function create()
    {
        $restaurant = Restaurant::all();
        $userList = User::all();
        $user = Session::get('auth');
        return View('review.create',
            [
                'restaurant' => $restaurant,
                'userList' => $userList,
                'user' => $user,
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'restaurant_id' => 'required',
            'rating' => 'required',
            'description' => 'required',
        ], $this->messages());
        $user_id = $request->get('user_id');
        $restaurant_id = $request->get('restaurant_id');
        $description = $request->get('description');
        $rating = $request->get('rating');
        $image = $request->get('image');
        $review = new Review([
            'review' => $description,
            'rate' => $rating,
            'restaurant_id' => $restaurant_id,
            'user_id' => $user_id,
            'status' => 1,
        ]);
        $review->save();
        return redirect('admin-review')->withErrors(['mes' => "Thêm đánh giá thành công"]);
    }

    public function edit($id)
    {
//        $user = User::all();
        $restaurant = Restaurant::all();
        $review = Review::where('id', $id)->with('image')->with('user')->with('restaurant')->first();
        $user = Session::get('auth');
//        dd(count($review->image));
        return View('review.edit',
            [
//                'user' => $user,
                'restaurant' => $restaurant,
                'review' => $review,
                'user' => $user,
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
            return redirect()->back()->withErrors(['mes' => "Xóa đánh giá thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'user_id.required' => 'Bạn cần phải chọn người dánh giá.',
            'restaurant_id.required' => 'Bạn cần phải chọn nhà hàng.',
            'rating.required' => 'Bạn cần phải nhập số sao đánh giá.',
            'description.required' => 'Bạn cần nhập nội dung đánh giá',
        ];
    }
}
