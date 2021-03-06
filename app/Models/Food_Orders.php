<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Food_Orders extends Model
{
    protected $table = 'food_orders';
    protected $fillable = [
        'id',
        'price',
        'quantity',
        'food_id',
        'order_id',
    ];

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'food_orders_topping', 'food_orders_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

}
