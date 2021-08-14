<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'food_reviews';
    protected $fillable = [
        'id',
        'review',
        'rate',
        'restaurant_id',
        'user_id',
        'status'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class, 'food_review_id');
    }
}
