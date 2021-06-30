<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table ="sizes";
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
