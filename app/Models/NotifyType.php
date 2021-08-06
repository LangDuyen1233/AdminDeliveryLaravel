<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifyType extends Model
{
    protected $table = 'notification_types';
    protected $fillable = [
        'id',
        'type',
    ];

    public function notify()
    {
        return $this->hasMany(Notify::class, 'notification_type_id');
    }
}
