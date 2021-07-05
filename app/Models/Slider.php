<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = "sliders";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'url',
    ];
}
