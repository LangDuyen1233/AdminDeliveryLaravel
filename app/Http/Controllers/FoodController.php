<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Food;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\Topping;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FoodController extends Controller
{
    public function index()
    {
        $food = Food::with('toppings')->get();
        $image = Image::all();
        return view('food.index',
            [
                'food' => $food,
                'image' => $image,
            ]
        );
    }

    public function create()
    {
        $category = Category::all();
        $restaurant = Restaurant::all();
        $topping = Topping::all();
        return View('food.create',
            [
                'category' => $category,
                'restaurant' => $restaurant,
                'topping' => $topping,
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|max:100',
            'image' => 'required|max:100',
            'ingredients' => 'required|max:100',
            'restaurant_id' => 'required|max:100',
            'category_id' => 'required|max:100',
        ], $this->messages());
        $name = $request->get('name');
        $size = $request->get('size');
        $price = $request->get('price');
        $weight = $request->get('weight');
        $ingredients = $request->get('ingredients');
        $image = $request->get('image');
        $category_id = $request->get('category_id');
        $restaurant_id = $request->get('restaurant_id');
        $topping_id = $request->get('topping_id');

        $food = new Food([
            'name' => $name,
            'size' => $size,
            'price' => $price,
            'weight' => $weight,
            'ingredients' => $ingredients,
            'category_id' => $category_id,
            'restaurant_id' => $restaurant_id,
            'status' => $request->get('status'),
        ]);
        $food->save();
//        dd($food);

        $images = new Image([
                'url' => $image,
            ]
        );
//        $image->url = $image;
        $food->image()->save($images);

//        dd(count($topping_id));

        if (!empty($topping_id)) {

            foreach ($topping_id as $tp) {
                error_log($tp);
                $food->toppings()->attach($food->id, ['food_id' => $food->id, 'topping_id' => $tp]);
            }
        }
        return redirect('admin-food')->withErrors(['mes' => "Thêm món ăn thành công"]);
    }

    public function edit($id)
    {
        $category = Category::all();
        $restaurant = Restaurant::all();
        $topping = Topping::all();
        $food = Food::where('id', $id)->with('image')->with('toppings')->with('category')->first();
        return View('food.edit',
            [
                'category' => $category,
                'restaurant' => $restaurant,
                'topping' => $topping,
                'food' => $food,
            ]);
    }

    public function update(Request $request, $id)
    {

        $f = Food::find($id);

        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|max:100',
            'image' => 'required|max:100',
            'ingredients' => 'required|max:100',
            'restaurant_id' => 'required|max:100',
            'category_id' => 'required|max:100',
        ], $this->messages());
        try {
            $f->name = $request->get('name');
            $f->size = $request->get('size');
            $f->price = $request->get('price');
            $f->weight = $request->get('weight');
            $f->ingredients = $request->get('ingredients');
            $f->category_id = $request->get('category_id');
            $f->restaurant_id = $request->get('restaurant_id');
            $f->status = $request->get('status');
            $f->save();

            $image = $request->get('image');
            $images = new Image([
                    'url' => $image,
                ]
            );
//            dd($f->image);

            $f->image()->update($images->toArray());

            $topping_id = $request->get('topping_id');
            $f->toppings()->sync($topping_id);

            return redirect('admin-food')->withErrors(['mes' => "Cập nhật món ăn thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {

        $f = Food::find($id);
        try {
            if ($f->status == 0) {
                $f->status = 1;
                $f->update();
            } else {
                $f->status = 0;
                $f->update();
            }
            return redirect()->back()->withErrors(['mes' => "Cập nhật món ăn thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập tên món ăn.',
            'price.required' => 'Bạn cần nhập giá món ăn.',
            'image.required' => 'Bạn cần phải chọn hình ảnh cho món ăn.',
            'password.min' => 'Mật khẩu phải nhiều hơn 8 ký tự.',
            'ingredients.required' => 'Bạn cần nhập thành phần của món ăn.',
            'restaurant_id.required' => 'Bạn cần phải chọn nhà hàng.',
            'category_id.required' => 'Bạn cần phải chọn danh mục.',
        ];
    }
}
