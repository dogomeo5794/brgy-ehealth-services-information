<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
    	if ($request->input('rtype')=='update-system-status') {
    		$rule = [
    			'system-remarks' => 'required',
					'system-status' => 'required'
    		];
    		$valid = Validator::make($request->all(), $rule);
    		if ($valid->fails()) {
    			return response()->json([
	    			'statusCode' => 419,
	    			'message' => 'Found some errors.',
	    			'errors' => $valid->errors(),
	    		]);
    		}
    		$setting = Setting::where('type', 'system-status')->first();
    		if ($setting) {
    			$setting->remarks = $request->input('system-remarks');
    			$setting->data = json_encode([
    				'system-status' => $request->input('system-status'),
    				'date-update' => date('Y-m-d H:m:i')
    			]);
    			$setting->save();
    		}
    		else {
    			$setting = new Setting;
    			$setting->type = 'system-status';
    			$setting->remarks = $request->input('system-remarks');
    			$setting->data = json_encode([
    				'system-status' => $request->input('system-status'),
    				'date-update' => date('Y-m-d H:m:i')
    			]);
    			$setting->save();
    		}
    		return response()->json([
    			'statusCode' => 200,
    			'message' => 'Success to update settings',
    			'data' => $setting
    		]);
    	}
    	else if ($request->input('rtype')=='update-population') {
    		$rule = [
    			'women' => 'required|numeric|regex: /[0-9]/',
					'children' => 'required|numeric|regex: /[0-9]/'
    		];
    		$valid = Validator::make($request->all(), $rule);
    		if ($valid->fails()) {
    			return response()->json([
	    			'statusCode' => 419,
	    			'message' => 'Found some errors.',
	    			'errors' => $valid->errors(),
	    		]);
    		}
    		$population = Setting::where('type', 'population')->first();
    		if ($population) {
    			$population->remarks = "";
    			$population->data = json_encode([
    				'women' => $request->input('women'),
    				'children' => $request->input('children')
    			]);
    			$population->save();
    		}
    		else {
    			$population = new Setting;
    			$population->type = 'population';
    			$population->remarks = "";
    			$population->data = json_encode([
    				'women' => $request->input('women'),
    				'children' => $request->input('children'),
    			]);
    			$population->save();
    		}
    		return response()->json([
    			'statusCode' => 200,
    			'message' => 'Success to update total population',
    			'data' => $population
    		]);
    	}
    	else if ($request->input('rtype')=='update-sms-format-prenatal') {
    		$rule = [
    			'sms_format' => 'required|max:200',
    		];
    		$valid = Validator::make($request->all(), $rule);
    		if ($valid->fails()) {
    			return response()->json([
	    			'statusCode' => 419,
	    			'message' => 'Found some errors.',
	    			'errors' => $valid->errors(),
	    		]);
    		}
    		$sms_format_prenatal = Setting::where('type', 'sms-format-prenatal')->first();
    		if ($sms_format_prenatal) {
    			$sms_format_prenatal->remarks = "";
    			$sms_format_prenatal->data = json_encode([
    				'sms_format' => $request->input('sms_format')
    			]);
    			$sms_format_prenatal->save();
    		}
    		else {
    			$sms_format_prenatal = new Setting;
    			$sms_format_prenatal->type = 'sms-format-prenatal';
    			$sms_format_prenatal->remarks = "";
    			$sms_format_prenatal->data = json_encode([
    				'sms_format' => $request->input('sms_format'),
    			]);
    			$sms_format_prenatal->save();
    		}
    		return response()->json([
    			'statusCode' => 200,
    			'message' => 'Success to update sms format for prenatal',
    			'data' => $sms_format_prenatal
    		]);
    	}
    	else if ($request->input('rtype')=='update-sms-format-immunize') {
    		$rule = [
    			'sms_format' => 'required|max:200',
    		];
    		$valid = Validator::make($request->all(), $rule);
    		if ($valid->fails()) {
    			return response()->json([
	    			'statusCode' => 419,
	    			'message' => 'Found some errors.',
	    			'errors' => $valid->errors(),
	    		]);
    		}
    		$sms_format_immunize = Setting::where('type', 'sms-format-immunize')->first();
    		if ($sms_format_immunize) {
    			$sms_format_immunize->remarks = "";
    			$sms_format_immunize->data = json_encode([
    				'sms_format' => $request->input('sms_format')
    			]);
    			$sms_format_immunize->save();
    		}
    		else {
    			$sms_format_immunize = new Setting;
    			$sms_format_immunize->type = 'sms-format-immunize';
    			$sms_format_immunize->remarks = "";
    			$sms_format_immunize->data = json_encode([
    				'sms_format' => $request->input('sms_format'),
    			]);
    			$sms_format_immunize->save();
    		}
    		return response()->json([
    			'statusCode' => 200,
    			'message' => 'Success to update sms format for immunize',
    			'data' => $sms_format_immunize
    		]);
    	}
    	else if ($request->input('rtype')=='get-system-status') {
    		$setting = Setting::where('type', 'system-status')->first();
    		$population = Setting::where('type', 'population')->first();
    		$sms_prenatal = Setting::where('type', 'sms-format-prenatal')->first();
    		$sms_immunize = Setting::where('type', 'sms-format-immunize')->first();
    		return response()->json([
    			'statusCode' => 200,
    			'data' => $setting,
    			'population' => $population,
    			'sms-format-prenatal' => $sms_prenatal,
    			'sms-format-immunize' => $sms_immunize,
    		]);
    	}

    	return response()->json([
  			'statusCode' => 404,
  			'message' => 'Request not found!'
  		]);
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
