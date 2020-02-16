<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
	protected $table 		= 'activity_log';
	protected $primaryKey 	= 'id';
	public $timestamps = true;
    protected $fillable = [
        
        'notification_message','user_id',
    ];
}
