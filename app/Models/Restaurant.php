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
        'image',
        'lattitude',
        'longtitude',
        'phone',
        'rating',
        'description',
        'active',
        'user_id'
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
        return $this->belongsToMany(Category::class, 'category_restaurant');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function card()
    {
        return $this->belongsTo(Cart::class, 'restaurant_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'restaurant_id');
    }
}
