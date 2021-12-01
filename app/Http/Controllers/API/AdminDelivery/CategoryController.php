<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Array_;

class CategoryController extends Controller
{
    public function getCategory(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->with('category')->first();
            $category = $restaurant->category;
            $listCategory = [];


            foreach ($category as $c) {
                if ($c->status == 1) {
                    array_push($listCategory, $c);
                }
            }
            return response()->json(['category' => $listCategory], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function addCategory(Request $request)
    {
        $name = $request->name;
        $description = $request->description;

        $image = $request->image;
        $urlImage = "/data/files/$image";

        $category = new Category([
            'name' => $name,
            'image' => $urlImage,
            'description' => $description,
        ]);

        $category->save();

        $id = auth()->user()->id;
        $restaurant = Restaurant::where('user_id', $id)->first();

        if (!empty($category->id)) {
            $category->restaurant()->attach($category->id, ['category_id' => $category->id, 'restaurant_id' => $restaurant->id]);
        }

        return response()->json(['success' => 'Tạo thành công', 'category' => $category], 200);
    }

    public function editCategory(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $category_id = $request->category_id;
            $category = Category::find($category_id);
            return response()->json(['category' => $category], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateCategory(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $category_id = $request->category_id;
            $category = Category::find($category_id);
            $category->name = $request->name;
            $category->description = $request->description;

            $image = $request->image;

            if ($image != null) {
                $urlImage = "/data/files/$image";
            } else {
                $urlImage = null;
            }
            $category->image = $urlImage;

            $category->update();
            return response()->json(['success' => 'Tạo thành công', 'materials' => $category], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function deleteCategory(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $category_id = $request->category_id;
            $category = Category::find($category_id);
            $category->status = 0;
            $category->update();

            return response()->json(['category' => $category], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
