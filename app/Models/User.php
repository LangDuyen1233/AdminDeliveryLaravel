<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class  User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'phone',
        'password',
        'gender',
        'dob',
        'bio',
        'token',
        'remember_token',
        'active',
        'role_id',
        'key_time',
        'random_key',
        'expires_at',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'user_order');
    }

    public function address()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

     public function review()
         {
            return $this->hasMany(Review::class,'restaurant_id');
         }
}
