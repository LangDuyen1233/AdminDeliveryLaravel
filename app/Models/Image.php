<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class   Image extends Model
{
    protected $table = "images";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'url',
        'food_review_id'
    ];

    public function food()
    {
        return $this->belongsToMany(Food::class, 'image_foods');
    }

    public function foodReview()
    {
        return $this->belongsTo(Review::class, 'food_review_id');
    }
}
