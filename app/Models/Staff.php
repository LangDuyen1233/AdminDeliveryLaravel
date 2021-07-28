<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $fillable = [
        'id',
        'name',
        'salary',
        'avatar',
        'start_date',
        'end_date',
        'gender',
        'dob',
        'address',
        'phone',
        'restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

}
