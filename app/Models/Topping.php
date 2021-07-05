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
        'category_id',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
