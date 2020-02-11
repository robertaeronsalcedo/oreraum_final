<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class real_time_chat extends Model
{
    protected $fillable = [
        
        'id', 'receiver','sender','chat_id'
    ];
}
