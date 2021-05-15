<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{
    protected $table = 'mothers';

    protected $fillable = [
    	'firstname',
		'middlename',
		'lastname',
		'birthdate',
		'address',
		'civil_status',
		'contact',
    ];

    public function pregnants() {
    	return $this->hasMany('App\Pregnant');
    }

    public function partner() {
    	return $this->hasMany('App\Partner');
    }
}
