<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\Topping;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function getFood(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $category_id = $request->category_id;
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $food = Food::with('category')->with('restaurant')->with('image')
                ->with('toppings')->with('discount')
                ->where('restaurant_id', $restaurant->id)->where('category_id', $category_id)
                ->where('status', 1)->get();

            foreach ($food as $f) {
                error_log($f->name);
                $f->weight = number_format($f->weight, 1);
                $f->restaurant->rating = number_format($f->restaurant->rating, 1);
                if ($f->discount != null) {
                    $f->discount->percent = number_format($f->discount->percent, 1);
                }
            }
            return response()->json(['food' => $food], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function addFood(Request $request)
    {
        $id = auth()->user()->id;
        $restaurant = Restaurant::where('user_id', $id)->first();

        $name = $request->name;
        $size = $request->size;
        $price = $request->price;
        $weight = $request->weight;
        $ingredients = $request->ingredients;
        $category_id = $request->category_id;
        $restaurant_id = $restaurant->id;
        $topping = $request->topping;

        $food = new Food([
            'name' => $name,
            'size' => $size,
            'price' => (int)$price,
            'weight' => (double)$weight,
            'ingredients' => $ingredients,
            'status' => 1,
            'category_id' => (int)$category_id,
            'restaurant_id' => $restaurant_id
        ]);

        $food->save();

        if ($topping != '') {
            $arrTopping = explode(',', $request->topping);
            foreach ($arrTopping as $tp) {
                if (!empty($tp)) {
                    $food->toppings()->attach($food->id, ['food_id' => $food->id, 'topping_id' => $tp]);
                }
            }
        }

        $image = $request->image;
        $urlImage = "/data/files/$image";
        $images = new Image([
                'url' => $urlImage,
            ]
        );
        $food->image()->save($images);

        $food->weight = number_format($food->weight, 1);

        return response()->json(['success' => 'Tạo thành công', 'food' => $food], 200);
    }

    public function editFood(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $id = auth()->user()->id;
            $category_id = $request->category_id;
            $food_id = $request->food_id;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $food = Food::with('category')->with('restaurant')->with('image')->with('toppings')
                ->where('restaurant_id', $restaurant->id)
                ->where('category_id', $category_id)
                ->where('id', $food_id)->first();

            $food->weight = number_format($food->weight, 1);

            $food->restaurant->rating = number_format($food->restaurant->rating, 1);

            return response()->json(['food' => $food], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateFood(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $id = auth()->user()->id;
            $category_id = $request->category_id;
            $food_id = $request->food_id;
            $topping = $request->topping;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $food = Food::find($food_id);

            try {
                $food->name = $request->name;
                $food->size = $request->size;
                $food->price = (int)$request->price;
                $food->weight = (double)$request->weight;
                $food->ingredients = $request->ingredients;
                $food->category_id = (int)$category_id;
                $food->restaurant_id = $restaurant->id;
                $food->status = 1;
                error_log($food);
                $food->update();


                if ($topping != '') {
                    $arrTopping = explode(',', $request->topping);
                    $food->toppings()->sync($arrTopping);
                }

                $image = $request->image;
                $urlImage = "/data/files/$image";
                $images = new Image([
                        'url' => $urlImage,
                    ]
                );
                $food->image()->update($images->toArray());

                $food->weight = number_format($food->weight, 1);

                return response()->json(['success' => 'Sửa thành công', 'food' => $food], 200);

            } catch (\Exception $e) {
                error_log($e->getMessage());
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function deleteFood(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $food_id = $request->food_id;

            $food = Food::find($food_id);

            $food->status = 0;
            $food->update();

            $food->weight = number_format($food->weight, 1);

            return response()->json(['food' => $food], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function getTopping(Request $request)
    {
        $token = $request->bearerToken();
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
        $name = $request->name;
        $price = $request->price;

        $topping = new Topping([
            'name' => $name,
            'price' => (int)$price,
            'status' => 1,
        ]);

        $topping->save();

        $food = $request->food;
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

    public function editTopping(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $id = auth()->user()->id;
            $topping_id = $request->topping_id;
            $restaurant = Restaurant::where('user_id', $id)->first();

            $topping = Topping::whereHas("food", function ($f) use ($restaurant) {
                $f->where('restaurant_id', $restaurant->id);
            })->with('food')->where('id', $topping_id)->first();

            foreach ($topping->food as $f) {
                $f->weight = number_format($f->weight, 1);
            }
            return response()->json(['topping' => $topping], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateTopping(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $topping_id = $request->topping;

            $topping = Topping::find($topping_id);

            try {
                $topping->name = $request->name;
                $topping->price = (int)$request->price;
                $topping->update();

                $food = $request->food;
                if ($food != '') {
                    $ar = explode(',', $request->food);
                    $topping->food()->sync($ar);
                }

                return response()->json(['topping' => $topping], 200);

            } catch (\Exception $e) {
                error_log($e->getMessage());
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function deleteTopping(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $topping_id = $request->topping_id;

            $topping = Topping::find($topping_id);

            $topping->food()->detach();
            $topping->delete();

            return response()->json(['topping' => $topping], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
