<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'id',
        'name',
        'size',
        'price',
        'weight',
        'ingredients',
        'status',
        'note',
        'restaurant_id',
        'category_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

//    public function toppings()
//    {
//        return $this->hasMany(Topping::class,'food_id');
//    }
//
//    public function sizes()
//    {
//        return $this->hasMany(Size::class);
//    }

    public function image()
    {
        return $this->belongsToMany(Image::class, 'image_foods');
    }

    public function carts()
    {
        return $this->belongsTo(Cart::class, 'cart_order');
    }
}
