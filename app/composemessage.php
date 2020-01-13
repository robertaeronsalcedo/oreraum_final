<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class composemessage extends Model
{      
    protected $table = 'composemessage';
     protected $fillable = [
        
         'message','user_id'
    ];
}
