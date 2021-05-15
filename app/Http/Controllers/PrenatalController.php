<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Pregnant;
use App\Mother;
use App\Partner;
use App\Father;
use App\Prenatal;

class PrenatalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('pages.user.prenatal');
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
    	$rule = [
    		'record-type' => 'required|in:no-data,with-data',
    		'pregnant' => 'required|exists:pregnants,id',
    		'type' => 'required|in:update,add',
    		'trimester' => 'required|in:1st,2nd,3rd',
    		'checkup' => ['required',function($attribute, $value, $fail) use($request) {
    			if ($request->input('type')=='update') {
    				if (!Prenatal::where('id', $value)->count()) {
    					$fail('invalid data');
    				}
    			}
    			else {
    				if (!in_array($value, ['1','2','3'])) {
    					$fail('The selected checkup is invalid.');
    				}
    			}
    		}],//'in:1,2,3,exists:prenatals,id',
    	];

    	$valid = Validator::make($request->all(), $rule);
    	if ($valid->fails()) {
    		return response()->json([
	    		'statusCode' => 419,
	    		'errors' => $valid->errors(),
	    		'message' => 'Invalid request.'
	    	]);
    	}
    	$columns = [];
    	if ($request->input('record-type')=='no-data') 
    	{
    		$data = [];
	    	if ($request->input('trimester')=='1st') {
		    	$data = json_encode($this->get_prenatal_data_1st_trimester($request, 'no-data'));
		    }
		    else if ($request->input('trimester')=='2nd') {
		    	$data = json_encode($this->get_prenatal_data_2nd_trimester($request, 'no-data'));
		    }
		    else if ($request->input('trimester')=='3rd') {
					$data = json_encode($this->get_prenatal_data_3rd_trimester($request, 'no-data'));
				}
    		$columns['return_date'] = null;
    		$columns['date_conduct'] = date('Y-m-d');
    		$columns['data'] = $data;
    		$columns['checkup_order'] = $request->input('checkup');
    		$columns['trimester'] = $request->input('trimester');
    		$columns['pregnant_id'] = $request->input('pregnant');
    		$columns['record_status'] = 'no-data';
    		$columns['type'] = $request->input('type');
    		$columns['checkup'] = $request->input('checkup');
    		return $this->store_data($columns);
    	}
    	else if ($request->input('record-type')=='with-data') 
    	{
	    	if ($request->input('trimester')=='1st') {
		    	$validated = $this->validData1stTrimester($request);
		    }
		    else if ($request->input('trimester')=='2nd') {
		    	$validated = $this->validData2ndTrimester($request);
		    }
		    else if ($request->input('trimester')=='3rd') {
					$validated = $this->validData3rdTrimester($request);
				}

	    	if ($validated['statusCode']==419) {
	    		return $validated;
	    	}

	    	$data = [];
	    	if ($request->input('trimester')=='1st') {
		    	$data = json_encode($this->get_prenatal_data_1st_trimester($request, 'with-data'));
		    }
		    else if ($request->input('trimester')=='2nd') {
		    	$data = json_encode($this->get_prenatal_data_2nd_trimester($request, 'with-data'));
		    }
		    else if ($request->input('trimester')=='3rd') {
					$data = json_encode($this->get_prenatal_data_3rd_trimester($request, 'with-data'));
				}

				$columns['return_date'] = $request->input('return-date');
    		$columns['date_conduct'] = date('Y-m-d');
    		$columns['data'] = $data;
    		$columns['checkup_order'] = $request->input('checkup');
    		$columns['trimester'] = $request->input('trimester');
    		$columns['pregnant_id'] = $request->input('pregnant');
    		$columns['record_status'] = 'with-data';
    		$columns['type'] = $request->input('type');
    		$columns['checkup'] = $request->input('checkup');
    		return $this->store_data($columns);
				
    	}
    	else 
    	{
    		return response()->json([
    			'statusCode' => 419,
    			'message' => 'Invalid request.'
    		]);
    	}
    }

    public function store_data($columns)
    {
    	// $prenatal = Prenatal::create([
    	// 	'return_date' => $columns['return_date'],
    	// 	'date_conduct' => $columns['date_conduct'],
    	// 	'data' => $columns['data'],
    	// 	'checkup_order' => $columns['checkup_order'],
    	// 	'trimester' => $columns['trimester'],
    	// 	'pregnant_id' => $columns['pregnant_id'],
    	// 	'record_status' => $columns['record_status'],
    	// ]);

    	$message = '';
    	if ($columns['type']=='update') {
    		$prenatal = Prenatal::find($columns['checkup']);
    		$prenatal->record_status = 'with-data';
    		$message = 'Success to update records.';
    	}
    	else {
    		$prenatal = new Prenatal;
    		$prenatal->date_conduct = $columns['date_conduct'];
				$prenatal->checkup_order = $columns['checkup_order'];
				$prenatal->trimester = $columns['trimester'];
				$prenatal->record_status = $columns['record_status'];
				$prenatal->pregnant_id = $columns['pregnant_id'];
    		$message = 'Success to add new records.';
    	}
    	
    	$prenatal->return_date = $columns['return_date'];
    	$prenatal->data = $columns['data'];
    	
    	$prenatal->save();

    	return response()->json([
    		'statusCode' => 200,
    		'data' => $prenatal,
    		'message' => $message,
    	]);
    }


    public function validData1stTrimester($request)
    {
    	$rule = [
	    	'acetic-acid' => 'nullable|string',
				'age_gestation' => 'required|numeric',
				'bp' => 'nullable|string',
				'cbc' => 'nullable|string',
				'date-given' => 'nullable|date',
				'date_fillup' => 'required|date',
				'dental-checkup' => 'nullable|string',
				'dsg-advises-foods' => 'nullable|string',
				'dsg-advises-sex-safe' => 'nullable|string',
				'dsg-avoid-alcohol' => 'nullable|string',
				'dsg-birth-plan' => 'nullable|string',
				'dsg-right-use-insecticide' => 'nullable|string',
				'health-service-provider' => 'nullable|string',
				'height' => 'required|numeric',
				'hemoglobin-count' => 'nullable|string',
				'hospital-referral' => 'nullable|string',
				'laboratory-test' => 'nullable|string',
				'make-birthplan' => 'nullable|string',
				'nutritional-status' => 'nullable|in:Normal,Under Weight,Over Weight',
				'return-date' => 'required|date',
				'sti-hepatitis-b' => 'in:true,false',
				'sti-hiv' => 'in:true,false',
				'sti-syphilis' => 'in:true,false',
				'stool-examination' => 'nullable|string',
				'tetanus-vaccine' => 'nullable|string',
				'treatments' => 'nullable|in:Syphilis,Antiretroviral (ARV),Bacteriuria,Anemia',
				'urinalysis' => '',
				'weight' => 'required|numeric',
			];

			$valid = Validator::make($request->all(), $rule);
    	if ($valid->fails()) {
    		return [
	    		'statusCode' => 419,
	    		'errors' => $valid->errors(),
	    		'message' => 'Invalid request.'
	    	];
    	}
    	else {
    		return [
	    		'statusCode' => 200,
	    		'message' => 'Valid request.'
	    	];
    	}
    }
    public function validData2ndTrimester($request)
    {
			$rule = [
				'date_fillup' => 'required|date',
				'weight' => 'required|numeric',
				'height' => 'required|numeric',
				'age_gestation' => 'required|numeric',
				'bp' => 'nullable|string',
				'nutritional-status' => 'nullable|in:Normal,Under Weight,Over Weight',
				'pregnant-situation' => 'nullable|string',
				'advice-given' => 'nullable|string',
				'changes-birthplan' => 'nullable|string',
				'dental-checkup' => 'nullable|string',
				'laboratory-test' => 'nullable|string',
				'urinalysis' => 'nullable|string',
				'cbc' => 'nullable|string',
				'etiologic-test-if-needed' => 'nullable|string',
				'pap-smear-if-needed' => 'nullable|string',
				'gestational-diabetes-if-needed' => 'nullable|string',
				'bacteriuria-if-needed' => 'nullable|string',
				'treatments' => 'nullable|in:Deworming,Antiretroviral (ARV),Bacteriuria,Anemia',
				'dsg-reminder-discussion' => 'nullable|in:true,false',
				'return-date' => 'required|date',
				'health-service-provider' => 'nullable|string',
				'hospital-referral' => 'nullable|string',
			];

			$valid = Validator::make($request->all(), $rule);
    	if ($valid->fails()) {
    		return [
	    		'statusCode' => 419,
	    		'errors' => $valid->errors(),
	    		'message' => 'Invalid request.'
	    	];
    	}
    	else {
    		return [
	    		'statusCode' => 200,
	    		'message' => 'Valid request.'
	    	];
    	}
    }
    public function validData3rdTrimester($request)
    {
    	$rule = [
				'date_fillup' => 'required|date',
				'weight' => 'required|numeric',
				'height' => 'required|numeric',
				'age_gestation' => 'required|numeric|max:70',
				'bp' => 'nullable|string',
				'nutritional-status' => 'nullable|in:Normal,Under Weight,Over Weight',
				'pregnant-situation' => 'nullable|string',
				'advice-given' => 'nullable|string',
				'changes-birthplan' => 'nullable|string',
				'dental-checkup' => 'nullable|string',
				'laboratory-test' => 'nullable|string',
				'urinalysis' => 'nullable|string',
				'cbc' => 'nullable|string',
				'bacteriuria-if-needed' => 'nullable|string',
				'blood-rh-if-needed' => 'nullable|string',
				'treatments' => 'nullable|in:Antiretroviral (ARV),Bacteriuria,Anemia',
				'dsg-reminder-discussion' => 'nullable|in:false,true',
				'dsg-reminder-postpartum' => 'nullable|in:false,true',
				'dsg-agwat-ng-anak' => 'nullable|in:false,true',
				'dsg-tetanus-follow-up' => 'nullable|in:false,true',
				'return-date' => 'required|date',
				'health-service-provider' => 'nullable|string',
				'hospital-referral' => 'nullable|string',
			];

			$valid = Validator::make($request->all(), $rule);
    	if ($valid->fails()) {
    		return [
	    		'statusCode' => 419,
	    		'errors' => $valid->errors(),
	    		'message' => 'Invalid request.'
	    	];
    	}
    	else {
    		return [
	    		'statusCode' => 200,
	    		'message' => 'Valid request.'
	    	];
    	}
    }

    public function get_prenatal_data_1st_trimester($r, $type)
    {
    	$d = [];
    	$d['date'] = $type=='with-data'?$r->input('date_fillup'):date('Y-m-d');
    	$d['weight'] = $type=='with-data'?$r->input('weight'):'';
    	$d['height'] = $type=='with-data'?$r->input('height'):'';
    	$d['age_of_gestation'] = $type=='with-data'?$r->input('age_gestation'):'';
    	$d['blood_pressure'] = $type=='with-data'?$r->input('bp'):'';
    	$d['nutritional_status'] = $type=='with-data'?$r->input('nutritional-status'):'';
    	$d['return_date'] = $type=='with-data'?$r->input('return-date'):'';
    	$d['health_service_provider'] = $type=='with-data'?$r->input('health-service-provider'):'';
    	$d['hospital_referral'] = $type=='with-data'?$r->input('hospital-referral'):'';
    	$d['dental_checkup'] = $type=='with-data'?$r->input('dental-checkup'):'';
    	$d['urinalysis'] = $type=='with-data'?$r->input('urinalysis'):'';
    	$d['treatments'] = $type=='with-data'?$r->input('treatments'):'';
    	$d['complete_blood_count'] = $type=='with-data'?$r->input('cbc'):'';
    	$d['laboratory_test_done'] = $type=='with-data'?$r->input('laboratory-test'):'';

    	$d['make_a_birth_plan'] = $type=='with-data'?$r->input('make-birthplan'):'';
    	$d['hemoglobin_count'] = $type=='with-data'?$r->input('hemoglobin-count'):'';
    	$d['stool_examination'] = $type=='with-data'?$r->input('stool-examination'):'';
    	$d['acetic_acid_wash'] = $type=='with-data'?$r->input('acetic-acid'):'';
    	$d['tetanus_containing_vaccine'] = $type=='with-data'?$r->input('tetanus-vaccine'):'';
    	$d['date_given'] = $type=='with-data'?$r->input('date-given'):'';
    	$d['stis_sundromic_aaproach'] = [
    		'syphilis' => $type=='with-data'?$r->input('sti-syphilis'):false,
    		'hiv' => $type=='with-data'?$r->input('sti-hiv'):false,
    		'hepatits_b' => $type=='with-data'?$r->input('sti-hepatitis-b'):false,
    	];
    	$d['discussion_services_given'] = [
    		'avoid_alcohol' => $type=='with-data'?$r->input('dsg-avoid-alcohol'):false,
    		'advises_foods' => $type=='with-data'?$r->input('dsg-advises-foods'):false,
    		'advises_sex_safe' => $type=='with-data'?$r->input('dsg-advises-sex-safe'):false,
    		'right_use_of_insecticide' => $type=='with-data'?$r->input('dsg-right-use-insecticide'):false,
    		'birth_plan' => $type=='with-data'?$r->input('dsg-birth-plan'):false,
    	];
    	
    	return $d;
    }
    public function get_prenatal_data_2nd_trimester($r, $type)
    {
    	$d = [];
    	$d['date'] = $type=='with-data'?$r->input('date_fillup'):date('Y-m-d');
    	$d['weight'] = $type=='with-data'?$r->input('weight'):'';
    	$d['height'] = $type=='with-data'?$r->input('height'):'';
    	$d['age_of_gestation'] = $type=='with-data'?$r->input('age_gestation'):'';
    	$d['blood_pressure'] = $type=='with-data'?$r->input('bp'):'';
    	$d['nutritional_status'] = $type=='with-data'?$r->input('nutritional-status'):'';
    	$d['return_date'] = $type=='with-data'?$r->input('return-date'):'';
    	$d['health_service_provider'] = $type=='with-data'?$r->input('health-service-provider'):'';
    	$d['hospital_referral'] = $type=='with-data'?$r->input('hospital-referral'):'';
    	$d['dental_checkup'] = $type=='with-data'?$r->input('dental-checkup'):'';
    	$d['urinalysis'] = $type=='with-data'?$r->input('urinalysis'):'';
    	$d['complete_blood_count'] = $type=='with-data'?$r->input('cbc'):'';
    	$d['laboratory_test_done'] = $type=='with-data'?$r->input('laboratory-test'):'';
    	$d['changes_birthplan'] = $type=='with-data'?$r->input('changes-birthplan'):'';
    	$d['pregnant_situation'] = $type=='with-data'?$r->input('pregnant-situation'):'';
    	$d['advice_given'] = $type=='with-data'?$r->input('advice-given'):'';
    	$d['etiologic_test_if_needed'] = $type=='with-data'?$r->input('etiologic-test-if-needed'):'';
    	$d['pap_smear_if_needed'] = $type=='with-data'?$r->input('pap-smear-if-needed'):'';
    	$d['gestational_diabetes_if_needed'] = $type=='with-data'?$r->input('gestational_diabetes_if_needed'):'';
    	$d['bacteriuria_if_needed'] = $type=='with-data'?$r->input('bacteriuria-if-needed'):'';
    	$d['treatments'] = $type=='with-data'?$r->input('treatments'):'';
    	$d['discussion_services_given'] = [
    		'reminder_previous_discussion' => $type=='with-data'?$r->input('dsg-reminder-discussion'):false
    	];
				
    	return $d;
    }
    public function get_prenatal_data_3rd_trimester($r, $type)
    {
    	$d = [];
    	$d['date'] = $type=='with-data'?$r->input('date_fillup'):date('Y-m-d');
    	$d['weight'] = $type=='with-data'?$r->input('weight'):'';
    	$d['height'] = $type=='with-data'?$r->input('height'):'';
    	$d['age_of_gestation'] = $type=='with-data'?$r->input('age_gestation'):'';
    	$d['blood_pressure'] = $type=='with-data'?$r->input('bp'):'';
    	$d['nutritional_status'] = $type=='with-data'?$r->input('nutritional-status'):'';
    	$d['return_date'] = $type=='with-data'?$r->input('return-date'):'';
    	$d['health_service_provider'] = $type=='with-data'?$r->input('health-service-provider'):'';
    	$d['hospital_referral'] = $type=='with-data'?$r->input('hospital-referral'):'';
    	$d['dental_checkup'] = $type=='with-data'?$r->input('dental-checkup'):'';
    	$d['urinalysis'] = $type=='with-data'?$r->input('urinalysis'):'';
    	$d['complete_blood_count'] = $type=='with-data'?$r->input('cbc'):'';
    	$d['laboratory_test_done'] = $type=='with-data'?$r->input('laboratory-test'):'';
    	$d['changes_birthplan'] = $type=='with-data'?$r->input('changes-birthplan'):'';
    	$d['pregnant_situation'] = $type=='with-data'?$r->input('pregnant-situation'):'';
    	$d['advice_given'] = $type=='with-data'?$r->input('advice-given'):'';
    	$d['blood_rh_if_needed'] = $type=='with-data'?$r->input('blood-rh-if-needed'):'';
    	$d['bacteriuria_if_needed'] = $type=='with-data'?$r->input('bacteriuria-if-needed'):'';
    	$d['treatments'] = $type=='with-data'?$r->input('treatments'):'';
    	$d['discussion_services_given'] = [
    		'reminder_previous_discussion' => $type=='with-data'?$r->input('dsg-reminder-discussion'):false,
    		'dsg_reminder_postpartum' => $type=='with-data'?$r->input('dsg-reminder-postpartum'):false,
    		'dsg_agwat_ng_anak' => $type=='with-data'?$r->input('dsg-agwat-ng-anak'):false,
    		'dsg_tetanus_follow_up' => $type=='with-data'?$r->input('dsg-tetanus-follow-up'):false,
    	];
    	
    	return $d;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
     	$prenatal = Prenatal::where('id', $id);
     	if ( !$prenatal->count() ) {
     		return response()->json([
     			'statusCode' => 404,
     			'message' => 'No records found.'
     		]);
     	}
     	else {
     		$prenatal = $prenatal->first();
     		$prenatal->data = json_decode($prenatal->data, true);
     		if ($request->input('request-type')=='review') {
     			return response()->json([
	     			'statusCode' => 200,
	     			'message' => 'Records found.',
	     			'html' => $this->withElement($prenatal)
	     		]);
     		}
     		else if ($request->input('request-type')=='for-edit') {
     			return response()->json([
	     			'statusCode' => 200,
	     			'message' => 'Records found.',
	     			'data' => $prenatal
	     		]);
     		}
     		else {
     			return response()->json([
	     			'statusCode' => 419,
	     			'message' => 'Invalid request',
	     		]);
     		}
     		
     	}
    }

    public function withElement($data) {
    	return view("forms.prenatal-review-{$data->trimester}")->withData($data)->render();
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

    public function recordDonePrenatal(Request $request) 
    {
    	$rule = [
    		'labor-date' => 'required|date',
    		'pregnant-no' => 'required|exists:pregnants,pregnant_no'
    	];
    	$valid = Validator::make($request->all(), $rule);
    	if ($valid->fails()) {
    		return response()->json([
    			'statusCode' => 419,
    			'message' => 'Found some errors from your data.',
    			'errors' => $valid->errors()
    		]);
    	}

    	$pregnant = Pregnant::where('pregnant_no', $request->input('pregnant-no'))->first();

    	if ( $pregnant->is_record_done ) {
	    	return response()->json([
	  			'statusCode' => 200,
	  			'message' => 'This records is finalized, changes will not applied.',
	  		]);
	    }

    	$pregnant->update([
    		'is_labored' => true,
    		'is_record_done' => true,
    		'labor_date' => $request->input('labor-date'),
    		'remarks' => $request->input('remarks')
    	]);
    	return response()->json([
  			'statusCode' => 200,
  			'message' => 'Pregnant records is now finalized/completed.',
  		]);
    }

    public function searchPregnant(Request $request) 
    {
    	if ($request->input('pregnant-no')===null) {
	    	$rule = [
					'search-first-name' => 'required|string',
					'search-last-name' => 'required|string',
				];

		  	$valid = Validator::make($request->all(), $rule);

		  	if ($valid->fails()) {
		  		return response()->json([
		  			'statusCode' => 419,
		  			'data' => [],
		  		]);
		  	}

	    	// $pregnant = Pregnant::where('is_record_done', false)->with(['mother'])
	    	$pregnant = Pregnant::with(['mother'])
	    	->whereHas('mother', function($query) use($request) {
	    		$query->where([
					['firstname', 'LIKE', '%'.$request->input('search-first-name').'%'],
					['lastname', 'LIKE', '%'.$request->input('search-last-name').'%']
				]);
	    	})->get();

	    	return response()->json([
	    		'statusCode' => 200,
	    		'data' => $pregnant->makeHidden(['id','mother_id'])->toArray()
	    	]);

	    }

	    else {
	    	
	    	$rule = [
					'pregnant-no' => 'required|string',
				];

		  	$valid = Validator::make($request->all(), $rule);

		  	if ($valid->fails()) {
		  		return response()->json([
		  			'statusCode' => 419,
		  			'message' => 'Invalid request.',
		  		]);
		  	}

	    	$pregnant = Pregnant::where('pregnant_no', $request->input('pregnant-no'))
	    	->with(['mother', 'prenatals']);

	    	if ( !$pregnant->count() ) {
	    		return response()->json([
		    		'statusCode' => 404,
		    		'message' => 'No data found.',
		    	]);
	    	}
	    	else {
		    	return response()->json([
		    		'statusCode' => 200,
		    		'data' => $pregnant->first()
		    	]);
		    }
	    }

    }
  }
