<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_method';
    protected $fillable = [
        'id',
        'price',
        'description',
        'method',
        ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'payment_method_id');
    }
}
