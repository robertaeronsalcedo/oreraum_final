<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class code_request extends Model
{
    
    protected $fillable = [
        
        'code','user_id','code_id'
   ];
}
