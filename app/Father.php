<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    protected $table = 'fathers';

    protected $fillable = [
    	'firstname',
		'middlename',
		'lastname',
		'birthdate',
		'address',
		'contact',
    ];

    public function partner() {
    	return $this->hasMany('App\Partner');
    }
}
