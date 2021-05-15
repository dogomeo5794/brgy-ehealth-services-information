<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
	use SoftDeletes;
	
    protected $table = 'children';

    public function parent() {
    	return $this->belongsTo('App\Partner');
    }

    public function immunizations() {
    	return $this->hasMany('App\Immunize', 'children_id');
    }
}
