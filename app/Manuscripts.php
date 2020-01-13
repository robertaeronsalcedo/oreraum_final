<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manuscripts extends Model
{
    protected $fillable = [
        
        'user_id', 'path','code','name'
    ];
}

