<?php


namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
//        dd($res);
        return view('category.index',
            [
                'category' => $category,
            ]
        );
    }

    public function create()
    {
        return View('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'image' => 'required|max:100',
        ], $this->messages());
        $name = $request->get('name');
        $image = $request->get('image');
        $description = $request->get('description');
        $category = new Category([
            'name' => $name,
            'image' => $image,
            'description' => $description,
        ]);
//        dd($category);
        $category->save();
        return redirect('admin-category')->withErrors(['mes' => "Thêm danh mục thành công"]);
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return View('category.edit',
            [
                'category' => $category,
            ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $request->validate([
            'name' => 'required|max:100',
            'image' => 'required|max:100',
        ], $this->messages());
        try {
            error_log($category);
            $category->name = $request->get('name');
            $category->image = $request->get('image');
            $category->description = $request->get('description');

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
            'image.required' => 'Bạn cần chọn ảnh đại diện',
            'phone.required' => 'Bạn cần phải nhập số điện thoại.',
            'phone.min' => 'Số điện thoại phải lớn hơn 10 số.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ];
    }
}
