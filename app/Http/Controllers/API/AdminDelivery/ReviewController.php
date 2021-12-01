<?php


namespace App\Http\Controllers\API\AdminDelivery;


use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getReview(Request $request)
    {
        $token = $request->bearerToken();
        if ($token != null) {
            $review = Review::with('user')->with('restaurant')->with('image')->get();

            foreach ($review as $r) {
                $r->rate = number_format($r->rate, 1);
                $r->restaurant->rating = number_format($r->restaurant->rating, 1);
            }

            return response()->json(['review' => $review], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
