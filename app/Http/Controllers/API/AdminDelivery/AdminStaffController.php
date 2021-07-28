<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminStaffController extends Controller
{
    public function getStaff(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            $restaurant = Restaurant::where('user_id', $id)->first();
            $staff = Staff::where('restaurant_id', $restaurant->id)->get();

            return response()->json(['staff' => $staff], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

    }

    public function addStaff(Request $request)
    {
        $id = auth()->user()->id;
        error_log($id);
        $restaurant = Restaurant::where('user_id', $id)->first();
        error_log($restaurant);

        error_log($request->bearerToken());

        $name = $request->name;
        $salary = $request->salary;
        $avatar = $request->avatar;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $gender = $request->gender;
        $dob = $request->dob;
        $address = $request->address;
        $phone = $request->phone;
        $restaurant_id = $restaurant->id;

        if ($avatar != null) {
            $urlImage = "/data/avatar/$avatar";
        } else {
            $urlImage = null;
        }
//        $images = new Image([
//                'url' => $urlImage,
//            ]
//        );

        $staff = new Staff([
            'name' => $name,
            'salary' => (int)$salary,
            'avatar' => $urlImage,
            'start_date' => date("Y-m-d", strtotime($start_date)),
            'end_date' => date("Y-m-d", strtotime($end_date)),
            'gender' => $gender,
            'dob' => date("Y-m-d", strtotime($dob)),
            'address' => $address,
            'phone' => $phone,
            'restaurant_id' => $restaurant_id
        ]);

        $staff->save();
        return response()->json(['success' => 'Tạo thành công', 'staff' => $staff], 200);
    }

    public function editStaff(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $staff_id = $request->staffId;
            $staff = Staff::find($staff_id);
            error_log($staff);
            return response()->json(['staff' => $staff], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateStaff(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;
            error_log($id);
            $restaurant = Restaurant::where('user_id', $id)->first();
            error_log($restaurant);
            $staff_id = $request->staffId;
            error_log($staff_id);

            $staff = Staff::find($staff_id);

            $staff->name = $request->name;
            $staff->salary = (int)$request->salary;
            $staff->start_date = $request->start_date;
            $staff->end_date = $request->end_date;
            $staff->gender = $request->gender;
            $staff->dob = $request->dob;
            $staff->address = $request->address;
            $staff->phone = $request->phone;
            $staff->restaurant_id = $restaurant->id;

            $avatar = $request->avatar;

            if ($avatar != null) {
                $urlImage = "/data/avatar/$avatar";
            } else {
                $urlImage = null;
            }
            $staff->avatar = $urlImage;

            $staff->update();
            return response()->json(['success' => 'Tạo thành công', 'staff' => $staff], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function deleteStaff(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $staff_id = $request->staff_id;
            $staff = Staff::find($staff_id);

            $staff->delete();

            return response()->json(['staff' => $staff], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
