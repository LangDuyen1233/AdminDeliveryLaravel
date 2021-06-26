<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'id',
        'name',
        'price',
        'ingredients',
        'status',
        'note',
        'restaurant_id',
        'category_id',
    ];
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
