<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Food;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class FoodController extends Controller
{
    public function index()
    {
        $food = Food::with('toppings')->where('status', 1)->get();
        $image = Image::all();
        $user = Session::get('auth');

        return view('food.index',
            [
                'food' => $food,
                'image' => $image,
                'user' => $user,
            ]
        );
    }

    public function create()
    {
        $category = Category::all();
        $restaurant = Restaurant::all();
        $topping = Topping::all();
        $user = Session::get('auth');
        return View('food.create',
            [
                'category' => $category,
                'restaurant' => $restaurant,
                'topping' => $topping,
                'user' => $user,
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
            'status' => 1,
        ]);
        $food->save();

        $images = new Image([
                'url' => $image,
            ]
        );
        $food->image()->save($images);

        if (!empty($topping_id)) {

            foreach ($topping_id as $tp) {
                error_log($tp);
                $food->toppings()->attach($food->id, ['food_id' => $food->id, 'topping_id' => $tp]);
            }
        }
        return redirect('admin-food')->withErrors(['mes' => "Th??m m??n ??n th??nh c??ng"]);
    }

    public function edit($id)
    {
        $category = Category::all();
        $restaurant = Restaurant::all();
        $topping = Topping::all();
        $food = Food::where('id', $id)->with('image')->with('toppings')->with('category')->first();
        $user = Session::get('auth');
        return View('food.edit',
            [
                'category' => $category,
                'restaurant' => $restaurant,
                'topping' => $topping,
                'food' => $food,
                'user' => $user,
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
            $f->save();

            $image = $request->get('image');
            $images = new Image([
                    'url' => $image,
                ]
            );

            $f->image()->update($images->toArray());

            $topping_id = $request->get('topping_id');
            $f->toppings()->sync($topping_id);

            return redirect('admin-food')->withErrors(['mes' => "C???p nh???t m??n ??n th??nh c??ng"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {

        $f = Food::find($id);
        try {
            $f->status = 0;
            $f->update();
            return redirect()->back()->withErrors(['mes' => "C???p nh???t m??n ??n th??nh c??ng"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'name.required' => 'B???n c???n nh???p t??n m??n ??n.',
            'price.required' => 'B???n c???n nh???p gi?? m??n ??n.',
            'image.required' => 'B???n c???n ph???i ch???n h??nh ???nh cho m??n ??n.',
            'password.min' => 'M???t kh???u ph???i nhi???u h??n 8 k?? t???.',
            'ingredients.required' => 'B???n c???n nh???p th??nh ph???n c???a m??n ??n.',
            'restaurant_id.required' => 'B???n c???n ph???i ch???n nh?? h??ng.',
            'category_id.required' => 'B???n c???n ph???i ch???n danh m???c.',
        ];
    }
}
