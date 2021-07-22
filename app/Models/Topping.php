<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $table = "toppings";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'price',
        'status'
    ];

    public function food()
    {
        return $this->belongsToMany(Food::class,'food_topping');
    }
}
