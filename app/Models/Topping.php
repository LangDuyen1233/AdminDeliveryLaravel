<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $table = "toppings";
    protected $fillable = [
        'id',
        'name',
        'price',
        'status'
    ];

    public function food()
    {
        return $this->belongsToMany(Food::class,'food_topping');
    }

    public function cardOrder()
    {
        return $this->belongsToMany(CartOrder::class,'card_order_topping','topping_id');
    }
    public function foodOrder()
    {
        return $this->belongsToMany(Food_Orders::class,'food_orders_topping','topping_id');
    }
}
