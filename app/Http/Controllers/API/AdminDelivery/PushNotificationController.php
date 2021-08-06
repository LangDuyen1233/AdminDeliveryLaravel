<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Notify;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    public function getNotify(Request $request)
    {
        $token = $request->bearerToken();
        error_log($token);
        if ($token != null) {
            $id = auth()->user()->id;

            $notify = Notify::with('notifyType')->where('user_id', $id)->get();

            return response()->json(['notify' => $notify], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

}
