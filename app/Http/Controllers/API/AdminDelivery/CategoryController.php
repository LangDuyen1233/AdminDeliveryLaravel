<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function getCategory(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $restaurant = Restaurant::where('user_id', $id)->first();
            $category = $restaurant->category;
            error_log($category);
            return response()->json(['category' => $category], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function addCategory(Request $request)
    {
        error_log($request->bearerToken());
        error_log($request->name);
        error_log($request->image);

        $name = $request->name;
        $description = $request->description;

        $image = $request->image;
        $urlImage = "/data/files/$image";

        $category = new Category([
            'name' => $name,
            'image' => $urlImage,
            'description' => $description,
        ]);
        // finally store our user



        $category->save();

        $id = auth()->user()->id;
        $restaurant = Restaurant::where('user_id', $id)->first();
        error_log($restaurant);

        if (!empty($category->id)) {
            $category->restaurant()->attach($category->id, ['category_id' => $category->id, 'restaurant_id' => $restaurant->id]);
        }

        return response()->json(['success' => 'Tạo thành công', 'category' => $category], 200);
    }
}
