<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table 		= 'schedule';
	protected $primaryKey 	= 'id';
	public $timestamps = true;
    protected $fillable = [
        
        'month','date','timestart','timeend','fullname','venue','user_id',
    ];
}
