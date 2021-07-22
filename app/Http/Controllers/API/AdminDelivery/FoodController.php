<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\Topping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpseclib3\Math\BinaryField\Integer;

class FoodController extends Controller
{
    public function getFood(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $category_id = $request->category_id;
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $food = Food::with('category')->with('restaurant')->with('image')->with('toppings')
                ->where('restaurant_id', $restaurant->id)->where('category_id', $category_id)->get();
            error_log($food);
            return response()->json(['food' => $food], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function addFood(Request $request)
    {
        $id = auth()->user()->id;
        error_log($id);
        $restaurant = Restaurant::where('user_id', $id)->first();
        error_log($restaurant);

        error_log($request->bearerToken());
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|unique:food,name',
//            'image' => 'required',
//            'price' => 'required',
//        ]);
        error_log($request->name);
        error_log($request->topping);
        error_log($request->size);
        error_log($request->price);
        error_log($request->weight);
        error_log($request->category_id);
        error_log($request->image);

//        if ($validator->fails()) {
//            return response()->json(['error' => $validator->errors()], 404);
//        }
        $name = $request->name;
        $size = $request->size;
        $price = $request->price;
        $weight = $request->weight;
        $ingredients = $request->ingredients;
        $category_id = $request->category_id;
        $restaurant_id = $restaurant->id;
        $topping = $request->topping;

//        error_log(explode(',',$topping));
//        error_log($topping);

        $food = new Food([
            'name' => $name,
            'size' => $size,
            'price' => (double)$price,
            'weight' => (double)$weight,
            'ingredients' => $ingredients,
            'status' => 1,
            'category_id' => (int)$category_id,
            'restaurant_id' => $restaurant_id
        ]);

        $food->save();

        error_log($topping);
        if ($topping != '') {
            $arrTopping = explode(',', $request->topping);
            foreach ($arrTopping as $tp) {
                if (!empty($tp)) {
                    $food->toppings()->attach($food->id, ['food_id' => $food->id, 'topping_id' => $tp]);
                }
            }
        }

        $image = $request->image;
        $images = new Image([
                'url' => $image,
            ]
        );
//        $images->url = $image;
        $food->image()->save($images);

        return response()->json(['success' => 'Tạo thành công', 'food' => $food], 200);
    }

    public function editFood(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $category_id = $request->category_id;
            $food_id = $request->food_id;
            $restaurant = Restaurant::where('user_id', $id)->first();
//
            $food = Food::with('category')->with('restaurant')->with('image')->with('toppings')
                            ->where('restaurant_id', $restaurant->id)
                            ->where('category_id', $category_id)
                            ->where('id', $food_id)->first();
            return response()->json(['food' => $food], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateFood(Request $request)
    {
        $id = auth()->user()->id;
        error_log($id);
        $restaurant = Restaurant::where('user_id', $id)->first();
        error_log($restaurant);

        error_log($request->bearerToken());
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|unique:food,name',
//            'image' => 'required',
//            'price' => 'required',
//        ]);
        error_log($request->name);
        error_log($request->topping);
        error_log($request->size);
        error_log($request->price);
        error_log($request->weight);
        error_log($request->category_id);
        error_log($request->image);

//        if ($validator->fails()) {
//            return response()->json(['error' => $validator->errors()], 404);
//        }
        $name = $request->name;
        $size = $request->size;
        $price = $request->price;
        $weight = $request->weight;
        $ingredients = $request->ingredients;
        $category_id = $request->category_id;
        $restaurant_id = $restaurant->id;
        $topping = $request->topping;

//        error_log(explode(',',$topping));
//        error_log($topping);

        $food = new Food([
            'name' => $name,
            'size' => $size,
            'price' => (double)$price,
            'weight' => (double)$weight,
            'ingredients' => $ingredients,
            'status' => 1,
            'category_id' => (int)$category_id,
            'restaurant_id' => $restaurant_id
        ]);

        $food->save();

        error_log($topping);
        if ($topping != '') {
            $arrTopping = explode(',', $request->topping);
            foreach ($arrTopping as $tp) {
                if (!empty($tp)) {
                    $food->toppings()->attach($food->id, ['food_id' => $food->id, 'topping_id' => $tp]);
                }
            }
        }

        $image = $request->image;
        $images = new Image([
                'url' => $image,
            ]
        );
//        $images->url = $image;
        $food->image()->save($images);

        return response()->json(['success' => 'Tạo thành công', 'food' => $food], 200);
    }

    public function getTopping(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $topping = Topping::whereHas("food", function ($f) use ($restaurant) {
                $f->where('restaurant_id', $restaurant->id);
            })->get();
            return response()->json(['topping' => $topping], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function addTopping(Request $request)
    {
        $id = auth()->user()->id;
        error_log($id);
        $restaurant = Restaurant::where('user_id', $id)->first();
        $name = $request->name;
        $price = $request->price;

//        error_log(explode(',',$topping));
        error_log($name);
        error_log($price);

        $topping = new Topping([
            'name' => $name,
            'price' => (double)$price,
            'status' => 1,
        ]);

        $topping->save();
        error_log($topping->id);

        $food = $request->food;
        error_log($food);
        if ($food != '') {
            $arrTopping = explode(',', $request->food);
            foreach ($arrTopping as $f) {
                if (!empty($f)) {
                    $topping->food()->attach($topping->id, ['food_id' => $f, 'topping_id' => $topping->id]);
                }
            }
        }

        return response()->json(['success' => 'Tạo thành công', 'topping' => $topping], 200);
    }
}
