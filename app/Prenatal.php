<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prenatal extends Model
{

	protected $table = 'prenatals';

	protected $fillable = [
		'return_date',
		'date_conduct',
		'data',
		'checkup_order',
		'trimester',
		'pregnant_id',
		'record_status',
	];
    
    public function pregnant() {
    	return $this->belongsTo('App\Pregnant');
    }
}
