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

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'food_topping');
    }

    public function image()
    {
        return $this->belongsToMany(Image::class, 'image_foods');
    }

    public function carts()
    {
        return $this->belongsTo(Cart::class, 'cart_order');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'food_orders');
    }

    public function cardOrder()
    {
        return $this->hasMany(CartOrder::class, 'food_id');
    }

    public function foodOrder()
    {
        return $this->hasMany(Food_Orders::class, 'food_id');
    }
}
