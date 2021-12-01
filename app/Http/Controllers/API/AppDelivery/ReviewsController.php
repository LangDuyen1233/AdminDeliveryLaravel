<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function addReview(Request $request)
    {
        $id = auth()->user()->id;
        $restaurantId = $request->restaurantId;
        $review = $request->review;
        $rate = $request->rate;

        $reviews = new Review([
            'review' => $review,
            'rate' => (double)$rate,
            'restaurant_id' => (int)$restaurantId,
            'user_id' => $id,
            'status' => 1
        ]);
        $reviews->save();

        $image = $request->image;

        $urlImage = "/data/files/$image";
        $images = new Image([
                'url' => $urlImage,
            ]
        );
        $reviews->image()->save($images);
        return response()->json(['success' => 'Tạo thành công', 'review' => $review], 200);
    }

    public function reviewRestaurant(Request $request)
    {
        $restauran_id = $request->restaurantId;
        $review = Review::where('restaurant_id', $restauran_id)->with('image')->with('user')->get();
        if ($review != null) {
            foreach ($review as $r) {
                $r->rate = number_format($r->rate, 1);
            }
            return response()->json(['review' => $review], 200);
        } else {
            return response()->json(['error' => 'review not found'], 401);
        }
    }
}
