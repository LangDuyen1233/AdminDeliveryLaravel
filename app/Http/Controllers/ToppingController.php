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
        $topping = Topping::with('food')->get();
//        dd($topping);
        return view('topping.index',
            [
                'topping' => $topping,
            ]
        );
    }

    public function create()
    {
        return View('topping.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|max:100',
        ], $this->messages());
        $name = $request->get('name');
        $price = $request->get('price');
        $topping = new Topping([
            'name' => $name,
            'price' => $price,
            'status' => $request->get('status'),
        ]);
//        dd($category);
        $topping->save();
        return redirect('admin-topping')->withErrors(['mes' => "Thêm topping thành công"]);
    }

    public function edit($id)
    {
        $topping = Topping::where('id', $id)->first();
        return View('topping.edit',
            [
                'topping' => $topping
            ]);
    }

    public function update(Request $request, $id)
    {
        $topping = Topping::find($id);
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|max:100',
        ], $this->messages());
        try {
            $topping->name = $request->get('name');
            $topping->price = $request->get('price');
            $topping->status = $request->get('status');

            $topping->save();
            return redirect('admin-topping')->withErrors(['mes' => "Cập nhật topping thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response('', 500);
        }
    }

    public function destroy($id)
    {
        $tp = Topping::find($id);

        try {
            $tp->food()->detach();
            $tp->delete();
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
        ];
    }
}
