<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'id',
        'sum_price',
    ];

    public function food()
    {
        return $this->belongsToMany(Food::class, 'cart_order')->withPivot('price', 'quantity');;
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'cart_id');
    }
}
