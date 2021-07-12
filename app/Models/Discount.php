<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $fillable = [
        'id',
        'name',
        'code',
        'percent',
        'status',
        'start_date',
        'end_date',
        'type_discount_id',
        'restaurant_id',
    ];

    public function typeDiscount()
    {
        return $this->belongsTo(TypeDiscount::class, 'type_discount_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'discount_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
