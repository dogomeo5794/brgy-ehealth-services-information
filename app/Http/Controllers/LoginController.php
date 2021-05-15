<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\ResetPassword;

class LoginController extends Controller
{
  protected $redirectTo = '/home';

  public function __construct() {
  	$this->middleware('guest')->except('logout');
  }

  public function login_form (Request $request) {
  	return view('login');
  }

  public function login (Request $request) {
  	// return $request->all();
  	$username = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
  	// $credentials = $request->only('username', 'password');
  	$credentials = array(
  		$username => $request->input('username'),
  		'password' => $request->input('password')
  	);
  	if (Auth::attempt($credentials)) {
  		if ( !Auth::user()->is_active ) {
  			Auth::logout();
	    	$request->session()->invalidate();
	    	return redirect()->back()->withErrors(['error' => 'Your account is temporary block by admin, Please contact your admin for the reasons.'])->withInput();
    	}
    	else if (Auth::user()->role == 'admin') {
    		return redirect()->route('admin.dashboard');
    	}
    	else if (Auth::user()->role == 'user') {
//    		return redirect()->route('user.dashboard');
            return redirect()->route('patient.list');

    	}
    	else {
    		abort(404);
    	}
  	}
  	else {
  		return redirect()
  			->back()
  			->withErrors(['error' => 'Invalid Credentials'])
  			->withInput();
  	}
  }

  public function logout (Request $request) {
  	Auth::logout();
  	$request->session()->invalidate();
  	return redirect('/login'); 

  	// Auth::logout();
  	// return 'logout';
  	// return redirect('/login');
  }


  public function resetPasswordForm() {
  	return view('forgot-password');
  }

	public function resetPasswordPost(Request $request) {
		$param = filter_var($request->input('request'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
  	$user = User::where($param, $request->input('request'));

  	$rule = [
			'request' => [
				'required',
				function($attribute, $value, $fail) use($user) {
					if ( !$user->count() ) {
						$fail('Email or Username is not exist in our system.');
					}
				}
			],
			'new-password' => 'required|string|min:8',
		];

		$message = [
			'request.required' => 'Email or Username field is required!',
			'new-password.required' => 'Password field is required!',
			'new-password.string' => 'Password must string!',
			'new-password.min' => 'Password must limit 8 characters lenght!',
		];

		$valid = Validator::make($request->all(), $rule, $message);
  	if ($valid->fails()) {
  		return redirect()
			->back()
			->withErrors($valid->errors())
			->withInput();
  	}

  	$user = $user->first();

  	ResetPassword::where([
  		['user_id', $user->id],
  		['is_expired', 0],
  		['is_resetted', 0],
  	])->update([
  		'is_expired' => true, 
  		'new_password' => NULL, 
  		'expired_date' => date('Y-m-d H:i:s')
  	]);

  	if ( $user ) {
  		$token = hash('sha256', $user->username.time());

  		$reset = ResetPassword::create([
  			'reset_token' => $token,
  			'new_password' => $request->input('new-password'),
				'user_id' => $user->id,
  		]);

  		if ( $reset ) {
  			$request->session()->flash('success', 'Your request is now process by our system. Please wait until your administrator response to your request or you can manually reach your administrator in her/his office to notify that you are requested for reseting your password.');
  			return redirect()
  			->back();
  		}	

  		return redirect()
			->back()
			->withErrors(['error' => 'Failed to request reset password!'])
			->withInput();
  	}

  	return redirect()
			->back()
			->withErrors(['error' => 'Invalid Credentials'])
			->withInput();
	}

}
