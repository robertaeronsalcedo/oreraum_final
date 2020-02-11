<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity_Log extends Model
{
    protected $fillable = [
        
        'notification_message','user_id',
    ];
}
