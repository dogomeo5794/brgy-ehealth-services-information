<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\ResetPassword;

class AccountController extends Controller
{

  public function form() {
  	return view('register');
  }

  public function addAccount(Request $request) {
  	$rule = [
			'employee-id' => 'required|unique:users,employee_id|regex:/^[a-zA-Z0-9_]{5,30}$/u',
			'date-hired' => 'required|date',
			'full-name' => 'required|string',
			'address' => 'required',
			'birthday' => 'required|date',
			'contact' => 'required',
			'account-role' => 'required|in:admin,user',
			'email' => 'required|email|unique:users,email',
		];

  	$valid = Validator::make($request->all(), $rule);

  	if ($valid->fails()) {

  		return response()->json([
  			'statusCode' => 419,
  			'errors' => $valid->errors(),
  		]);
  	}

    $password = strtoupper(Str::random(16));

  	$user = new User;
  	$user->email = $request->input('email');
  	$user->username = $request->input('employee-id');
    $user->default_password = $password;
  	$user->password = Hash::make($password);
  	$user->employee_id = $request->input('employee-id');
  	$user->fullname = $request->input('full-name');
  	$user->birthdate = $request->input('birthday');
  	$user->address = $request->input('address');
  	$user->contact = $request->input('contact');
  	$user->hired_date = $request->input('date-hired');
  	$user->role = $request->input('account-role');
    $user->save();

    $user->returnPassword = $password;

    Log::channel('accounts')->info('New created account.', [
      'employeeID' => $user->employee_id,
      'name' => $user->fullname,
      'username' => $user->employee_id,
      'email' => $user->email,
      'password' => $password,
      'role' => $user->role,
    ]);

    return response()->json([
			'statusCode' => 200,
			'data' => $user
		]);

  }

  public function check_account(Request $request) {
  	$rule = [
  		'password' => 'required|string|min:8|confirmed',
  		'email' => 'required|email|max:30|min:5|unique:users',
  		'username' => 'required|max:30|min:5|unique:users|regex:/^[a-zA-Z0-9_]{5,30}$/u'
  	];

  	$message = [];

  	$valid = Validator::make($request->all(), $rule, $message);

  	if ( $valid->errors()->count() ) {
  		return response()->json([
  			'result' => false,
  			'errors' => $valid->errors(),
  		]);
  	}

  	return response()->json([
			'result' => true,
			'data' => $request->all(),
		]);
  }

	public function requestReset() {
		$resets = ResetPassword::where([
  		['new_password', '!=', NULL],
  		['is_expired', 0],
  		['is_resetted', 0],
  	])->with('user')->get();
  	return view('pages.admin.reset-passwords')->with([
  		'requested' => $resets
  	]);
	}

	public function resetPassword(Request $request, $token) {
    $reset = ResetPassword::where('reset_token', $token);
    $rule = [
      'type' => 'required|in:reset,ignore',
    ];

    $valid = Validator::make($request->all(), $rule);

    if( !$reset->count() OR $valid->fails() ) {
      return response()->json([
        'statusCode' => 419,
        'message' => 'Invalid request!'
      ]);
    }

    $reset = $reset->first();

    if ( $request->input('type') == 'reset' ) {
      $newPassUpdated = User::find($reset->user_id)->update([
        'password' => Hash::make($reset->new_password)
      ]);

      $reset->update([
        'is_expired' => false, 
        'new_password' => NULL,
        'is_resetted' => true,
      ]);
    }
    else {
      $reset->update([
        'is_expired' => true, 
        'new_password' => NULL, 
        'expired_date' => date('Y-m-d H:i:s')
      ]);
    }

    return response()->json([
      'statusCode' => 200,
      'message' => 'Success to '.$request->input('type').' password!'
    ]);

    
	}


	public function accounts(Request $request) {
    if ($request->input('q')!==NULL) {
        $q = $request->input('q');
        $accounts = User::where('username', '!=', Auth::user()->username)
        ->where(function($query) use($q) {
          $query->where('username', 'LIKE', '%'.$q.'%')
          ->orWhere('fullname', 'LIKE', '%'.$q.'%')
          ->orWhere('employee_id', 'LIKE', '%'.$q.'%')
          ->orWhere('email', 'LIKE', '%'.$q.'%')
          ->orWhere('birthdate', date('Y-m-d', strtotime($q)))
          ->orWhere('address', 'LIKE', '%'.$q.'%')
          ->orWhere('contact', 'LIKE', '%'.$q.'%')
          ->orWhere('is_active', $q=='inactive'?false:true)
          ->orWhere('role', $q);
        })
        ->paginate($this->limit);
      }
      else {
        $accounts = User::where('username', '!=', Auth::user()->username)->paginate($this->limit);
      }
		
		return response()->json($accounts);
	}

  public function viewAccount(Request $request, $id) {
    $user = User::where('id', $id)->firstOrFail();
    return view('pages.admin.account-profile')->with(['user'=>$user,'type'=>'view']);
  }

  public function getOneAccount(Request $request, $id) {
    $user = User::where('id', $id);
    if ($user->count()) {
      return response()->json([
        'statusCode' => 200,
        'data' => $user->first()->setHidden(['id'])
      ]);
    }
    else {
      return response()->json([
        'statusCode' => 404,
        'message' => 'Data with username <u>'.$username.'</u> not found!'
      ]);
    }
  }

  public function updateAccount(Request $request, $id) {
    $user = User::where('id', $id);
    if ( !$user->count() ) {
      return response()->json([
        'statusCode' => 404,
        'message' => 'Invalid request.',
      ]);
    }

    $rule = [
      'hired-date' => 'required|date',
      'full-name' => 'required|string',
      'address' => 'required',
      'birthday' => 'required|date',
      'contact' => 'required',
      'account-role' => 'required|in:admin,user',
      'user-status' => 'required|in:active,block',
      'email' => ['required','email', function($attribute, $value, $fail) use($request, $user) {
        $user = User::where([
          ['email', $request->input('email')],
          ['email', '!=', $user->first()->email],
        ]);
        if ( $user->count() ) {
          $fail('Email is already use by other account.');
        }
      }],
      'employee-id' => ['required','regex:/^[a-zA-Z0-9_]{5,30}$/u',
      function($attribute, $value, $fail) use($request, $user) {
        $user = User::where([
          ['employee_id', $request->input('employee-id')],
          ['employee_id', '!=', $user->first()->employee_id],
        ]);
        if ( $user->count() ) {
          $fail('Employee ID is already use by other account.');
        }
      }],
    ];

    $valid = Validator::make($request->all(), $rule);

    if ($valid->fails()) {
      return response()->json([
        'statusCode' => 419,
        'errors' => $valid->errors(),
      ]);
    }

    $type = $user->first()->role;
    $isUpdated = $user->first()->update([
      'hired_date' => $request->input('hired-date'),
      'fullname' => $request->input('full-name'),
      'address' => $request->input('address'),
      'birthdate' => $request->input('birthday'),
      'contact' => $request->input('contact'),
      'role' => $request->input('account-role'),
      'is_active' => $request->input('user-status')=='active'?true:false,
      'email' => $request->input('email'),
      'employee_id' => $request->input('employee-id'),
      'username' => $request->input('employee-id'),
    ]);

    $user = $user->first();

    $user->is_active_status = $user->is_active;
    $user->is_active = $user->is_active?'Active':'Blocked';
    $user->hired_date = date('M d, Y', strtotime($user->hired_date));
    $user->fullname = ucwords($user->fullname);
    $user->address = ucwords($user->address);
    $user->role = ucwords($user->role);
    $user->birthdate = date('M d, Y', strtotime($user->birthdate));

    return response()->json([
      'statusCode' => 200,
      'message' => 'Success to update {$type} account information.',
      'data' => $user->setHidden(['id', 'password'])
    ]);
  }

  public function updateProfileAccount(Request $request) {

    $rule = [
      'hired-date' => 'required|date',
      'full-name' => 'required|string',
      'address' => 'required',
      'birthday' => 'required|date',
      'contact' => 'required',
      'email' => ['required','email', function($attribute, $value, $fail) use($request) {
        $user = User::where([
          ['email', $request->input('email')],
          ['email', '!=', Auth::user()->email],
        ]);
        if ( $user->count() ) {
          $fail('Email is already use by other account.');
        }
      }],
      'employee-id' => ['required','regex:/^[a-zA-Z0-9_]{5,30}$/u',
      function($attribute, $value, $fail) use($request) {
        $user = User::where([
          ['employee_id', $request->input('employee-id')],
          ['employee_id', '!=', Auth::user()->employee_id],
        ]);
        if ( $user->count() ) {
          $fail('Employee ID is already use by other account.');
        }
      }],
    ];

    $valid = Validator::make($request->all(), $rule);

    if ($valid->fails()) {
      return response()->json([
        'statusCode' => 419,
        'errors' => $valid->errors(),
      ]);
    }

    $type = Auth::user()->role;
    $isUpdated = Auth::user()->update([
      'hired_date' => $request->input('hired-date'),
      'fullname' => $request->input('full-name'),
      'address' => $request->input('address'),
      'birthdate' => $request->input('birthday'),
      'contact' => $request->input('contact'),
      'email' => $request->input('email'),
      'employee_id' => $request->input('employee-id'),
      'username' => $request->input('employee-id'),
    ]);

    $user = Auth::user();

    $user->is_active_status = $user->is_active;
    $user->is_active = $user->is_active?'Active':'Blocked';
    $user->hired_date = date('M d, Y', strtotime($user->hired_date));
    $user->fullname = ucwords($user->fullname);
    $user->address = ucwords($user->address);
    $user->role = ucwords($user->role);
    $user->birthdate = date('M d, Y', strtotime($user->birthdate));

    return response()->json([
      'statusCode' => 200,
      'message' => 'Success to update your account information.',
      'data' => $user->setHidden(['id', 'password', 'remember_token'])
    ]);

  }

  public function activeAccount(Request $request, $id) {
    $user = User::find($id);
    if ( $user===NULL ) {
      return response()->json([
        'statusCode' => 404,
        'message' => 'Invalid request.',
      ]);
    }

    $user->update([
      'is_active' => $user->is_active?false:true
    ]);

    $user->account = $user->id;

    return response()->json([
      'statusCode' => 200,
      'data' => $user->setVisible(['is_active','account']),
    ]);
  }

  public function uploadProfileAccount(Request $request, $id) {
    $file_rule = [
      'image' => 'required',
    ];
    $valid = Validator::make($request->all(), $file_rule);

    if ( $valid->fails() ) {
      return response()->json([
        'statusCode' => 419,
        'message' => ' Invalid request!'
      ]);
    }

    $user = User::find($id);

    if ( $user===NULL ) {
      return response()->json([
        'statusCode' => 419,
        'message' => ' Invalid request!'
      ]);
    }

    $image = $request->input('image');
    list($img_info, $image) = explode(',', $image);

    list($type,$base) = explode(';', $img_info);
    list($img, $ext) = explode('/', $type);

    $image = base64_decode($image);
    $file_path = 'public/uploaded/profile/'.hash('md5',$user->id).'/'.hash('md5', $user->username.time()).'.'.$ext;

    Storage::put($file_path, $image);

    Storage::delete($user->profile);

    $user = $user->update([
      'profile' => $file_path
    ]);

    return response()->json([
      'statusCode' => 200,
      'message' => 'Profile picture uploaded.',
      'profile' => Storage::url($file_path)
    ]);
  }


}
