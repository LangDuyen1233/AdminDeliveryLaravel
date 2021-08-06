<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class Order extends Model
{
    use WorkflowTrait;
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'tax',
        'price',
        'price_delivery',
        'address_delivery',
        'date',
        'user_id',
        'order_status_id',
        'payment_id',
        'discount_id',
        'note',
        'status',
        'user_delivery_id',
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
        return $this->belongsTo(User::class, 'user_id');
    }

//    public function cart()
//    {
//        return $this->belongsTo(Cart::class, 'cart_id');
//    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }

    public function food()
    {
        return $this->belongsToMany(Food::class, 'food_orders')->withPivot(['price','quantity']);
    }
}
