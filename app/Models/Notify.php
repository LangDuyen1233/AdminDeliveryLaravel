<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{

    protected $table = 'notifications';
    protected $fillable = [
        'id',
        'title',
        'notification_type_id',
        'user_id',
        'description'
    ];

    public function notifyType()
    {
        return $this->belongsTo(NotifyType::class, 'notification_type_id');
    }

    public function user(){
       return $this->belongsTo(User::class, 'user_id');
    }
}
