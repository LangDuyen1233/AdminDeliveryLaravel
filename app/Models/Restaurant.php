<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $fillable = [
        'id',
        'name',
        'address',
        'lattitude',
        'longtitude',
        'phone',
        'rating',
        'description',
    ];

//một nhà hàng có nhiều món ăn
    public function foods()
    {
        return $this->hasMany('App\Food');
    }
}
