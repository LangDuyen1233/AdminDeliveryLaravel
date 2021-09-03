<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{

    protected $table = 'order_statuses';
    protected $fillable = [
        'id',
        'status',
        'description',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_status_id');
    }
}
