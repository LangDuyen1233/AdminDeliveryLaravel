<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $table = "toppings";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'price',
        'category_id',
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
}
