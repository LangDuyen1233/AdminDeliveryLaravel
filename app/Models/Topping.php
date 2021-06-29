<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $table ="toppings";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'price',
    ];
    public function foods()
    {
        return $this->belongsTo('App\Food');
    }
}
