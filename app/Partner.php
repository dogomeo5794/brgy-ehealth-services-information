<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'parents';

    protected $fillable = [
    	'mother_id',
		'father_id',
    ];

    public function mother() {
    	return $this->belongsTo('App\Mother');
    }

    public function father() {
    	return $this->belongsTo('App\Father');
    }
}
