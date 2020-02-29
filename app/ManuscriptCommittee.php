<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManuscriptCommittee extends Model
{
	protected $table 		= 'manuscripts_committee';
	protected $primaryKey 	= 'manuscripts_committee_id';
    protected $fillable = [
        
        'annotation', 'id','manuscripts_id','evaluation'
    ];

    public function getUser() {
        return $this->belongsTo(\App\User::class, 'id','id');
    }

    public function getManuscripts() {
        return $this->belongsTo(\App\Manuscripts::class, 'manuscripts_id','id');
    }
    
}

