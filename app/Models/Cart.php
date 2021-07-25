<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'id',
        'user_id',
        'sum_price',
        'restaurant_id',
    ];

    public function food()
    {
        return $this->belongsToMany(Food::class, 'cart_order')->withPivot('price', 'quantity');;
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'cart_id');
    }

    public function cardOrder(){
        return $this->hasMany(CartOrder::class,'cart_id');
    }

    public function Restaurant(){
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
