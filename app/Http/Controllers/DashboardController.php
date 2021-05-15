<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Child;
use App\Partner;
use App\Prenatal;
use App\Pregnant;
use App\Mother;
use App\Immunize;
use App\Father;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if (Auth::user()->role=='admin') {
    		$admin = User::where([
    			// ['id', '!=', Auth::user()->id],
    			['role', 'admin']
    		])->count();
    		$user = User::where([
    			['role', 'user']
    		])->count();
    		$active = User::where([
    			['role', 'user'],
    			['is_active', true],
    		])->count();
    		$deactive = User::where([
    			['role', 'user'],
    			['is_active', false],
    		])->count();
    		return view('pages.admin.dashboard')->with([
    			'admin' => $admin, 
    			'user' => $user, 
    			'active' => $active, 
    			'deactive' => $deactive
    		]);
    	}
    	else if (Auth::user()->role=='user') {
    		return view('pages.user.dashboard');
    	}
    	else {
    		abort(404);
    	}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
    	$child = Child::count();
    	$mother = Mother::count();
    	$immunize = (Immunize::count()/1500)*100;
    	$prenatal = (Prenatal::whereHas('pregnant', function($query) {
    		$query->where('is_record_done', false);
    	})->count()/2500)*100;

    	$prenatalCountComplete = Pregnant::where('is_record_done', true)->count();
    	$prenatalCountNotComplete = Pregnant::where('is_record_done', false)->count();

    	$immunizeCountComplete = Child::where('is_record_done', true)->count();
    	$immunizeCountNotComplete = Child::where('is_record_done', false)->count();

    	$immunizeChart = Child::where('is_record_done', false)
    	->selectRaw('count(*) total, YEAR(created_at) year')
    	->groupBy(DB::raw('YEAR(created_at)'))->get();

    	$immunizeChartLabel = [];
    	$immunizeChartData = [];
    	foreach ($immunizeChart as $k => $data) {
    		$immunizeChartLabel[] = $data['year'];
    		$immunizeChartData[] = $data['total'];
    	}

    	$prenatalChart = Pregnant::where('is_record_done', false)
    	->selectRaw('count(*) total, YEAR(created_at) year')
    	->groupBy(DB::raw('YEAR(created_at)'))->get();

    	$prenatalChartLabel = [];
    	$prenatalChartData = [];
    	foreach ($prenatalChart as $k => $data) {
    		$prenatalChartLabel[] = $data['year'];
    		$prenatalChartData[] = $data['total'];
    	}

    	return response()->json([
    		'statusCode' => 200,
    		'child' => $child,
    		'mother' => $mother,
    		'immunize' => round($immunize, 2),
    		'prenatal' => round($prenatal, 2),
    		'prenatalDonut' => [$prenatalCountNotComplete, $prenatalCountComplete],
    		'immunizeDonut' => [$immunizeCountNotComplete, $immunizeCountComplete],
    		// 'immunizeChart' => $immunizeChart,
    		'immunizeChart' => [
    			'label' => $immunizeChartLabel,
    			'data' => $immunizeChartData
    		],
    		'prenatalChart' => [
    			'label' => $prenatalChartLabel,
    			'data' => $prenatalChartData
    		],
    	]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  }
