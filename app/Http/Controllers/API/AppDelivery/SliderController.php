<?php


namespace App\Http\Controllers\API\AppDelivery;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SliderController extends Controller
{
    public function getSliders(Request $request)
    {
        $token = $request->bearerToken();
        if (Auth::check()) {
            $sliders = Slider::All();
            if ($sliders != null) {
                return response()->json(['sliders' => $sliders], 200);
            } else {
                return response()->json(['mes' => 'error sliders'], 401);
            }
        } else {
            return response()->json(['mes' => 'Unauthenticated'], 401);
        }
    }
}
