<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'tax',
        'price',
        'price_delivery',
        'date',
        'user_id',
        'cart_id',
        'order_status_id',
        'payment_id',
    ];

    public function statusOrder()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
