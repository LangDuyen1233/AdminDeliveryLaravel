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
        'address_delivery',
        'date',
        'user_id',
        'cart_id',
        'order_status_id',
        'payment_method_id',
        'payment_status_id',
        'discount_id',
        'status'
    ];

    public function statusOrder()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_order');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }
}
