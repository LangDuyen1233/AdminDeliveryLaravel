<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Topping;
use Illuminate\Http\Request;

class ToppingController extends Controller
{
    public function index()
    {
        $topping = Topping::with('category')->get();
//        dd($topping);
        return view('topping.index',
            [
                'topping' => $topping,
            ]
        );
    }

    public function create()
    {
        $category = Category::all();
        return View('topping.create',
            [
                'category' => $category
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|max:100',
            'category_id' => 'required|max:100',
        ], $this->messages());
        $name = $request->get('name');
        $price = $request->get('price');
        $category_id = $request->get('category_id');
        $topping = new Topping([
            'name' => $name,
            'price' => $price,
            'category_id' => $category_id,
            'status' => $request->get('status'),
        ]);
//        dd($category);
        $topping->save();
        return redirect('admin-topping')->withErrors(['mes' => "Thêm topping thành công"]);
    }

    public function edit($id)
    {
        $category = Category::all();
        $topping = Topping::where('id', $id)->with('category')->first();
        return View('topping.edit',
            [
                'category' => $category,
                'topping' => $topping
            ]);
    }

    public function update(Request $request, $id)
    {
        $topping = Topping::find($id);
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|max:100',
            'category_id' => 'required|max:100',
        ], $this->messages());
        try {
            $topping->name = $request->get('name');
            $topping->price = $request->get('price');
            $topping->category_id = $request->get('category_id');
            $topping->status= $request->get('status');

            $topping->save();
            return redirect('admin-topping')->withErrors(['mes' => "Cập nhật topping thành công"]);

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
            'price.required' => 'Bạn cần nhập giá',
            'category_id.required' => 'Bạn cần chọn danh mục',
        ];
    }
}
