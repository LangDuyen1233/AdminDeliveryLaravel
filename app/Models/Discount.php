<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $fillable = [
        'id',
        'name',
        'percent',
        'status',
        'start_date',
        'end_date',
        'food_id',
        'order_id',
    ];
}
