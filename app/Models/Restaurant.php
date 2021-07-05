<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $fillable = [
        'id',
        'name',
        'address',
        'lattitude',
        'longtitude',
        'phone',
        'rating',
        'description',
    ];

//một nhà hàng có nhiều món ăn
    public function foods()
    {
        return $this->hasMany(Food::class, 'restaurant_id');
    }

    public function discount()
    {
        return $this->hasMany(Discount::class, 'restaurant_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'restaurant_id');
    }
}
