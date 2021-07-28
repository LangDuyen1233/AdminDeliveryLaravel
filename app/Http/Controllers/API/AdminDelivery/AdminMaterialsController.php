<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\Restaurant;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminMaterialsController extends Controller
{
    public function getMaterials(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();
            $materials = Materials::where('restaurant_id', $restaurant->id)->get();

            return response()->json(['materials' => $materials], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

    }

    public function addMaterials(Request $request)
    {
        $id = auth()->user()->id;
        error_log($id);
        $restaurant = Restaurant::where('user_id', $id)->first();
        error_log($restaurant);

        error_log($request->bearerToken());

        $name = $request->name;
        $quantity = $request->quantity;
        $image = $request->image;
        $restaurant_id = $restaurant->id;

        if ($image != null) {
            $urlImage = "/data/files/$image";
        } else {
            $urlImage = null;
        }
//        $images = new Image([
//                'url' => $urlImage,
//            ]
//        );

        $materials = new Materials([
            'name' => $name,
            'quantity' => (int)$quantity,
            'image' => $urlImage,
            'restaurant_id' => $restaurant_id
        ]);

        $materials->save();
        return response()->json(['success' => 'Tạo thành công', 'materials' => $materials], 200);
    }

    public function editMaterials(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $materials_id = $request->materialsId;
            $materials = Materials::find($materials_id);
            error_log($materials);
            return response()->json(['materials' => $materials], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateMaterials(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $restaurant = Restaurant::where('user_id', $id)->first();
            error_log($restaurant);
            $materials_id = $request->materialsId;
            error_log($materials_id);

            $materials = Materials::find($materials_id);

            $materials->name = $request->name;
            $materials->quantity = (int)$request->quantity;
            $materials->restaurant_id = $restaurant->id;

            $image = $request->image;

            if ($image != null) {
                $urlImage = "/data/files/$image";
            } else {
                $urlImage = null;
            }
            $materials->image = $urlImage;

            $materials->update();
            return response()->json(['success' => 'Tạo thành công', 'materials' => $materials], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function deleteMaterials(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $materials_id = $request->materials_id;
            error_log($materials_id);
            $materials = Materials::find($materials_id);

            $materials->delete();

            return response()->json(['materials' => $materials], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
