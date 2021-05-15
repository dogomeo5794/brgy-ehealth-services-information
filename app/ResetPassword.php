<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    protected $table = 'reset_passwords';

   	protected $fillable = [
   		'reset_token',
		'new_password',
		'is_expired',
		'is_resetted',
		'expired_date',
		'user_id',
   	];

   	public function user() {
   		return $this->belongsTo('App\User');
   	}
}
