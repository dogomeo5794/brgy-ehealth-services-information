<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Pregnant extends Model
{
    protected $table = 'pregnants';

    protected $fillable = [
    	'pregnant_no',
		'weight',
		'last_period',
		'expected_delivery',
		'mother_id',
        'is_labored',
        'is_record_done',
        'labor_date',
        'remarks',
    ];

    public function mother() {
    	return $this->belongsTo('App\Mother');
    }

    public function prenatals() {
        return $this->hasMany('App\Prenatal');
    }
}
