<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manuscripts extends Model
{
	protected $table 		= 'manuscripts';
	protected $primaryKey 	= 'id';
    protected $fillable = [
        
        'user_id', 'path','code','name'
    ];

    public function getAuthor() {
        return $this->belongsTo(\App\User::class, 'user_id','id');
    }

    public function getCommittee() {
    	return $this->hasMany(\App\ManuscriptCommittee::class, 'manuscripts_id','id');
    }
}

