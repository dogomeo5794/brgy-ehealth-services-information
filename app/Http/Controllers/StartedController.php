<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class StartedController extends Controller
{
	public function started() {
		$user = User::where([
			['role', 'admin']
		]);
		$userCount = $user->count();
		$user = $user->first();
		// return response()->json($user->first());
		if ( $userCount==0 ) {
			return view('started')->with([
				'step' => 1,
			]);
		}
		else if ( $userCount==1 AND $user->fullname==null ) {
			return redirect()->route('app.started.next', ['username'=>$user->username]);
		}
		else {
			abort(404);
		}
	}

	public function startedNext($username) {
		$user = User::where([
			['username', $username],
			['fullname', NULL],
		])->firstOrFail();
	  return view('started')->with([
	  	'step' => 2,
	  	'username' => $user->username,
	  ]);
	}

	public function startedRegister(Request $request) {
		$user = User::where([
			['role', 'admin']
		]);

		if ($user->count() == 0) {

			$key = hash('md5', '102014'.date('Y-m-d'));
			$key_code = strtoupper(substr($key, 0, -17));

			$rule = [
				'generated-code' => [
					'required','min:15','max:15', function($attribute, $value, $fail) use($key_code) {
						if ($value !== $key_code) {
							$fail('Generated Code is invalid');
						}
					}
				],
				'password' => 'required|string|min:8',
				'password_confirmation' => 'required|string|same:password',
				'email' => 'required|email|max:30|min:5|unique:users',
				'username' => 'required|max:30|min:5|unique:users|regex:/^[a-zA-Z0-9_]{5,30}$/u',
			];

			$message = [
				'password_confirmation.same' => 'Password not match.',
				'generated-code.min' => 'Generated Code is invalid',
				'generated-code.max' => 'Generated Code is invalid',
			];

	  	$valid = Validator::make($request->all(), $rule, $message);

	  	if ($valid->fails()) {

	  		return redirect()
	  			->back()
	  			->withErrors($valid->errors())
	  			->withInput();
	  	}

			
			$user = User::create([
				'username' => $request->input('username'),
				'email' => $request->input('email'),
				'password' => Hash::make($request->input('password')),
				'role' => 'admin',
				'is_active' => true,
			]);

			return redirect()->route('app.started.next', ['username'=>$user->username]);
		}
		else {
			$userStep2 = User::where([
				['role', 'admin'],
				['fullname', NULL]
			]);

			if ( $userStep2->count() ) {
				$rule = [
					'employee-id' => 'required|unique:users,employee_id',
					'date-hired' => 'required|date',
					'full-name' => 'required|string',
					'address' => 'required',
					'birthday' => 'required|date',
					'contact' => 'required',
				];

		  	$valid = Validator::make($request->all(), $rule);

		  	if ($valid->fails()) {

		  		return redirect()
		  			->back()
		  			->withErrors($valid->errors())
		  			->withInput();
		  	}

		  	$user = User::where([
		  		['role', 'admin'],
		  		['fullname', NULL]
		  	])->firstOrFail();

		  	$user->update([
					'employee_id' => $request->input('employee-id'),
					'fullname' => $request->input('full-name'),
					'birthdate' => $request->input('birthday'),
					'address' => $request->input('address'),
					'contact' => $request->input('contact'),
					'hired_date' => $request->input('date-hired'),
		  	]);

		  	Auth::login($user);
	    	return redirect('/admin/dashboard');
			}
			else {
				abort(404);
			}

		}
	}


}
