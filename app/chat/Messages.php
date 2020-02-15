<?php

namespace App\chat;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
	protected $table 		= 'messages';
	protected $primaryKey 	= 'message_id';
    protected $fillable = [
				'message',
				'sender_id',
				'receiver_id',
				'seen_at',
	];

	public function receiverInfo() {
    	return $this->belongsTo(\App\User::class, 'receiver_id','id');
    }

	public function senderInfo() {
    	return $this->belongsTo(\App\User::class, 'sender_id','id');
    }
}
