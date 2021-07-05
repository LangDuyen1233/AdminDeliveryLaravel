<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TypeDiscount extends Model
{
    protected $table = 'type_discount';
    protected $fillable = [
        'id',
        'type'
    ];
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'type_discount_id');
    }
}
