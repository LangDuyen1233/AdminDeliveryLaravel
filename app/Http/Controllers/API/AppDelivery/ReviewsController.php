<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function addReview(Request $request)
    {
        $id = auth()->user()->id;
        error_log($id);
        $restaurantId = $request->restaurantId;
        error_log('ẻthyj $restaurantId');
        $review = $request->review;
        $rate = $request->rate;
//        $date = Carbon::now();

        error_log($review);
        error_log($rate);

        $reviews = new Review([
            'review' => $review,
            'rate' => (double)$rate,
            'restaurant_id' => (int)$restaurantId,
            'user_id' => $id,
            'status' => 1
        ]);
        $reviews->save();
        error_log($reviews->id);

        $image = $request->image;
        error_log($image);

        $urlImage = "/data/files/$image";
        $images = new Image([
                'url' => $urlImage,
//                'food_review_id' => $review->id,
            ]
        );
        error_log($images);
        $reviews->image()->save($images);
        return response()->json(['success' => 'Tạo thành công', 'review' => $review], 200);
    }

}
