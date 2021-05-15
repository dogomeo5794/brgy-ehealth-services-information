<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Child;
use App\Partner;
use App\Mother;
use App\Immunization;
use App\Prenatal;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->input('preview')==true) {
    		if ($request->input('report')=='child') {
    			$p = $request->input('print');
    			$f = $request->input('date_from');
    			$t = $request->input('date_to');
    			$param = [];
    			if ($p=='under_monitoring') {
    				$data = Child::where('is_record_done', false)
    				->whereBetween('created_at', [$f, $t])->get();
    			}
    			else if ($p=='graduate') {
    				$data = Child::where('is_record_done', true)
    				->whereBetween('created_at', [$f, $t])->get();
    			}
    			else {
    				$data = Child::whereBetween('created_at', [$f, $t])->get();
    			}

    		}
    		if ($request->input('report')=='mother') {
    			$p = $request->input('print');
    			$f = $request->input('date_from');
    			$t = $request->input('date_to');
    			// $param = [];
    			// if ($p=='under_monitoring') {
    			// 	$data = Mother::where('is_record_done', false)
    			// 	->whereBetween('created_at', [$f, $t])->get();
    			// }
    			// else if ($p=='complete') {
    			// 	$data = Mother::where('is_record_done', true)
    			// 	->whereBetween('created_at', [$f, $t])->get();
    			// }
    			// else {
    				$data = Mother::whereBetween('created_at', [$f, $t])->get();
    			// }

    		}
    		if ($request->input('report')=='immunize') {
    			$p = '%'.$request->input('child').'%';
    			$data = Child::where('firstname', 'LIKE', $p)
    			->orWhere('lastname', 'LIKE', $p)
    			->orWhere('middlename', 'LIKE', $p)
    			->with(['immunizations'])->get();
    		}
    		if ($request->input('report')=='prenatal') {
    			$p = '%'.$request->input('mother').'%';
    			$data = Mother::where('firstname', 'LIKE', $p)
    			->orWhere('lastname', 'LIKE', $p)
    			->orWhere('middlename', 'LIKE', $p)
    			->with(['pregnants', 'pregnants.prenatals'])->get();
    		}
    		return view('pages.user.report-preview')
    		->with(['data'=>$data, 'type'=>$request->input('report')]);
    	}
    	return view('pages.user.reports');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
