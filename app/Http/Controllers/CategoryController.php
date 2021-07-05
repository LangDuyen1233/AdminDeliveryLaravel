<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::with('restaurant')->get();
//        dd($category[0]->restaurant->name);
        return view('category.index',
            [
                'category' => $category,
            ]
        );
    }

    public function create()
    {
        $restaurant = Restaurant::all();
        return View('category.create',
            [
                'restaurant' => $restaurant
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'image' => 'required|max:100',
            'restaurant_id' => 'required|max:100',
        ], $this->messages());
        $name = $request->get('name');
        $image = $request->get('image');
        $description = $request->get('description');
        $restaurant_id = $request->get('restaurant_id');
        $category = new Category([
            'name' => $name,
            'image' => $image,
            'description' => $description,
            'restaurant_id' => $restaurant_id,
        ]);
//        dd($category);
        $category->save();
        return redirect('admin-category')->withErrors(['mes' => "Thêm danh mục thành công"]);
    }

    public function edit($id)
    {
        $restaurant = Restaurant::all();
        $category = Category::where('id', $id)->with('restaurant')->first();
        return View('category.edit',
            [
                'category' => $category,
                'restaurant' => $restaurant
            ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $request->validate([
            'name' => 'required|max:100',
            'image' => 'required|max:100',
            'restaurant_id' => 'required|max:100',
        ], $this->messages());
        try {
            error_log($category);
            $category->name = $request->get('name');
            $category->image = $request->get('image');
            $category->description = $request->get('description');
            $category->restaurant_id = $request->get('restaurant_id');

            $category->save();
            return redirect('admin-category')->withErrors(['mes' => "Cập nhật danh mục thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response('', 500);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        try {
            $category->delete();
            return redirect()->back()->withErrors(['mes' => "Xóa danh mục thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập tên danh mục',
            'restaurant_id.required' => 'Bạn cần chọn quán ăn',
            'image.required' => 'Bạn cần chọn ảnh đại diện',
            'phone.required' => 'Bạn cần phải nhập số điện thoại.',
            'phone.min' => 'Số điện thoại phải lớn hơn 10 số.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ];
    }
}
