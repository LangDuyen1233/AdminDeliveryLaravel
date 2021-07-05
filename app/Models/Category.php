<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'restaurant_id'
    ];

    public function foods()
    {
        return $this->hasMany(Food::class,'category_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }

    public function topping()
    {
        return $this->hasMany(Topping::class,'restaurant_id');
    }
}
