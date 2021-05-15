<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Immunize extends Model
{
	protected $table = 'immunizations';

	protected $fillable = [
		'return_date',
		'date_conduct',
		'data',
		'record_at',
		'children_id',
		'record_status',
		'created_at',
		'updated_at',
	];

	public function child() {
    	return $this->belongsTo('App\Child', 'children_id');
    }
}
