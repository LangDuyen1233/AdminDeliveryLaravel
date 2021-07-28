<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    protected $table = 'materials';
    protected $fillable = [
        'id',
        'name',
        'quantity',
        'image',
        'restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
