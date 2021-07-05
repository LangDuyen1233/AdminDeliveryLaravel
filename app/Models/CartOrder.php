<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CartOrder extends Model
{
    protected $table = 'cart_order';
    protected $fillable = [
        'id',
        'quality',
        'price',
        'food_id',
        'cart_id',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

//    public function food()
//    {
//        return $this->belongsTo(Food::class, 'food_id');
//    }
}
