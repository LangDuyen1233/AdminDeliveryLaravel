<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CartOrder extends Model
{
    protected $table = 'cart_order';
    protected $fillable = [
        'id',
        'quantity',
        'price',
        'food_id',
        'cart_id',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function toppings(){
        return $this->belongsToMany(Topping::class,'card_order_topping','card_order_id');
    }

}
