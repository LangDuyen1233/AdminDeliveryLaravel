<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'payment_status';
    protected $fillable = [
        'id',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'payment_status_id');
    }
}
