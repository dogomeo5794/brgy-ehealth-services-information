<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Prenatal;
use App\Mother;

Route::get('/', function () {
    // return view('pages.home');
	return redirect()->route('login');
})->name('app.main');

Route::get('/sms/send', 'SMSController@send')->name('sms.send');


// Route::get('/check-session', function() {
// 	if (!Auth::check()) {
// 		return response()->json([
// 			'statusCose' => 419,
// 			'message' => 'Session expired.'
// 		]);
// 	}
// 	return response()->json([
// 		'statusCose' => 200,
// 		'message' => 'Session not expired.'
// 	]);

// })->name('check-session');

Route::get('/secret-code', function (Request $request) {
	// return substr(shell_exec('getmac'), 159, 20).' = '.substr(exec('getmac'), 0, 17);
	$rule = ['key' => 'required|string|min:6|max:6','code' => 'required|string'];

	$valid = Validator::make($request->all(), $rule);

	if ($valid->fails()) { abort(404); }

	$key = hash('sha256', $request->input('key'))=='e527f55424aa42619a9180a922b399033f431637d100e8560a1477460807acc2';
	$code = hash('sha256', $request->input('code'))=='6f4b0e02e7a2a8bc4f23312593f322a13cbb449864544e9ccd42901ef224381e';
	$final = hash('sha256', $request->input('key').$request->input('code'))=='a6cbbc839a6d36469db327d074d2bfd5817d02ad333fee47c6d7fd1d8556e9dc';

	if ($key and $code and $final) {
		$key_code = strtoupper(substr(hash('md5', '102014'.date('Y-m-d')), 0, -17));
		return 'secret_code: <u>'.$key_code.'</u>';
	}
	else { abort(404); }
})->name('app.main');

Route::get('/started', 'StartedController@started')->name('app.started');

Route::get('/started/{username}', 'StartedController@startedNext')->name('app.started.next');

Route::post('/started', 'StartedController@startedRegister')->name('register.started');

// Route::get('/register', 'AccountController@form')->name('form.register');
// Route::post('/register', 'AccountController@save')->name('save.register');

Route::get('/login', 'LoginController@login_form')->name('login');
Route::post('/login', 'LoginController@login')->name('app.login');

Route::post('/logout', 'LoginController@logout')->name('app.logout');

Route::get('/forgot-password', 'LoginController@resetPasswordForm')->name('forgot.password.form');
Route::post('/forgot-password', 'LoginController@resetPasswordPost')->name('forgot.password.post');



Route::group(['prefix'=>'/user', 'middleware'=>['ajaxAuth','auth','userAuth']], function() {
	Route::get('/', 'DashboardController@index');
	Route::get('/dashboard', 'DashboardController@index')->name('user.dashboard');	
    Route::get('/patient/list', 'PatientController@list')->name('patient.list');
    Route::post('/patient/list/fetch', 'PatientController@getList')->name('patient.getList');

	Route::post('/dashboard', 'DashboardController@data')->name('user.dashboard.data');
	Route::resource('/children', 'ChildController');
	Route::resource('/immunization', 'ImmunizeController');
	Route::resource('/pregnants', 'PregnantController');
	Route::post('/pregnants/search', 'PregnantController@searchPregnant')->name('pregnants.search');
	Route::post('/pregnants/list', 'PregnantController@pregnantList')->name('pregnants.list');
	Route::resource('/prenatal', 'PrenatalController');
	Route::post('/prenatal/search', 'PrenatalController@searchPregnant')->name('prenatal.search');
	Route::post('/prenatal/done', 'PrenatalController@recordDonePrenatal')->name('prenatal.done');


	Route::get('/profile', function() {
		$user = Auth::user();
    	return view('pages.admin.account-profile')->with(['user'=>$user, 'type'=>'profile']);
	})->name('user.profile');

	Route::get('/first-trimester/{checkup}', function(Request $request, $checkup) {
		if ( null!==$request->input('type') AND $request->input('type')=='update' ) {
			$prenatal = Prenatal::find($request->input('checkup'));
			$prenatal->data = json_decode($prenatal->data);
			return view('forms.first-trimester-checkup-form')->withData($prenatal);
		}
		else {
			return view('forms.first-trimester-checkup-form');
		}
	})->name('trimester.first');
	Route::get('/second-trimester/{checkup}', function(Request $request, $checkup) {
		if ( null!==$request->input('type') AND $request->input('type')=='update' ) {
			$prenatal = Prenatal::find($request->input('checkup'));
			$prenatal->data = json_decode($prenatal->data);
			return view('forms.second-trimester-checkup-form')->withData($prenatal);
		}
		else {
			return view('forms.second-trimester-checkup-form');
		}
	})->name('trimester.second');
	Route::get('/third-trimester/{checkup}', function(Request $request, $checkup) {
		if ( null!==$request->input('type') AND $request->input('type')=='update' ) {
			$prenatal = Prenatal::find($request->input('checkup'));
			$prenatal->data = json_decode($prenatal->data);
			return view('forms.third-trimester-checkup-form')->withData($prenatal);
		}
		else {
			return view('forms.third-trimester-checkup-form');
		}
	})->name('trimester.third');

	Route::get('/mother-info/{mother}', function(Request $request, $mother) {
		$mother = Mother::findOrFail($mother);
		$father = $mother->partner()->first()->father;
		return view('forms.mother-info')->with(['mother'=>$mother, 'father'=>$father]);
	})->name('mother.info');

	Route::get('/reports', 'ReportController@index')->name('reports.index');

});

Route::post('/account/profile', 'AccountController@updateProfileAccount')
	->middleware('auth')->name('profile.update');
Route::post('/accounts/{id}', 'AccountController@getOneAccount')
	->middleware('auth')->name('account.getone');
Route::post('/accounts/{id}/upload-profile', 'AccountController@uploadProfileAccount')
	->middleware('auth')->name('account.upload');

Route::group(['prefix'=>'/admin', 'middleware'=>['auth','adminAuth']], function() {
	Route::get('/', 'DashboardController@index');
	Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
	Route::get('/accounts', function() {
		return view('pages.admin.accounts');
	})->name('accounts');
	Route::post('/accounts', 'AccountController@accounts')->name('get.accounts');
	Route::get('/accounts/{id}', 'AccountController@viewAccount')->name('account.view');
	Route::post('/accounts/add', 'AccountController@addAccount')->name('account.add');
	Route::post('/accounts/{id}/update', 'AccountController@updateAccount')->name('account.update');
	Route::post('/accounts/{id}/activation', 'AccountController@activeAccount')->name('account.active');
	

	Route::get('/profile', function() {
		$user = Auth::user();
    	return view('pages.admin.account-profile')->with(['user'=>$user, 'type'=>'profile']);
	})->name('admin.profile');

	Route::get('/reports', function() {
		return 'admin reports';
	})->name('admin.reports');
	Route::get('/settings', function() {
		return view('pages.admin.settings');
	})->name('admin.settings');
	Route::post('/settings/get-status', 'SettingController@store')->name('admin.settings.store');

	Route::get('/password/reset', 'AccountController@requestReset')->name('password.request');
	Route::get('/password/reset/{token}', 'AccountController@resetPassword')->name('password.reset');

	Route::get('/accounts/history/logs', 'LogsController@AccountsLog')->name('account.logs');
	Route::get('/sms/logs', 'LogsController@SMSLogs')->name('sms.logs');

});

Route::get('/{any}', function () {
    return abort(404);
})->where('any', '.*');

// Auth::routes();
