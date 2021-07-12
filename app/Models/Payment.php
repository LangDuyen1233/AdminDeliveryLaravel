<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'id',
        'price',
        'description',
        'method',
        'status'
        ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'payment_id');
    }
}
