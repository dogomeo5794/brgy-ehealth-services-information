<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Immunize;

class ImmunizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view("pages.user.immunization");
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
    		'child' => 'required|exists:children,id',
    		'type' => 'required|in:update,add-immunize',
    		// 'tags' => 'required|string',
    		'vaccine' => 'required|string',
    		'dose' => 'required|string',
    		'immunize' => [function($attribute, $value, $fail) use($request) {
    			if ($request->input('type')=='update') {
    				if (!Immunize::where('id', $value)->count()) {
    					$fail('Invalid data.');
    				}
    			}
    		}],
    		'tags' => ['required','string', 'regex:/^[a-zA-Z]+$/u', function($attribute, $value, $fail) use($request) {
    			if ($request->input('is_other')=='true') {
    				if (in_array($value, ['bcg','hepab','pv','opv','ipv','pcv','mmr','other'])) {
    					$fail('tags not available.');
    				}
    			}
    		}]
    	];

    	if ($request->input('record-type')=='with-data') {
    		if ($request->input('type')!='update') { $rule['date_fillup'] = 'required|date'; }
				$rule['vaccine_date'] = 'required|date';
				$rule['return_date'] = 'required|date';
				$rule['baby-age'] = 'required';
    	}

    	$valid = Validator::make($request->all(), $rule);
    	if ($valid->fails()) {
    		return response()->json([
	    		'statusCode' => 419,
	    		'errors' => $valid->errors(),
	    		'message' => 'Invalid request.',
	    		'request' => $request->all()
	    	]);
    	}

    	$columns = [];
    	if ($request->input('record-type')=='with-data') {

	    	$data = $this->get_immunization_data($request, 'with-data');

	    	$columns['return_date'] = $request->input('return_date');
    		$columns['date_conduct'] = $request->input('vaccine_date');
    		$columns['data'] = json_encode($data);
    		$columns['record_at'] = $request->input('dose');
    		$columns['children_id'] = $request->input('child');
    		$columns['record_status'] = 'with-data';
    		$columns['type'] = $request->input('type');

    		// return response()->json($columns);

	    }
	    else {
	    	$data = $this->get_immunization_data($request, 'no-data');

	    	$columns['return_date'] = null;
    		$columns['date_conduct'] = date('Y-m-d');
    		$columns['data'] = json_encode($data);
    		$columns['record_at'] = $request->input('dose');
    		$columns['children_id'] = $request->input('child');
    		$columns['record_status'] = 'no-data';
    		$columns['type'] = $request->input('type');

	    }

	    $message = '';
    	if ($columns['type']=='update') {
    		$immunize = Immunize::find($request->input('immunize'));
    		$immunize->record_status = 'with-data';
    		$message = 'Success to update records.';

    		// return response()->json($immunize);
    	}
    	else {
    		$immunize = new Immunize;
    		$immunize->date_conduct = $columns['date_conduct'];
				$immunize->record_status = $columns['record_status'];
				$immunize->children_id = $columns['children_id'];
    		$message = 'Success to add new records.';
    	}
    	
    	$immunize->return_date = $columns['return_date'];
    	$immunize->data = $columns['data'];
    	
    	$immunize->save();

    	return response()->json([
    		'statusCode' => 200,
    		'data' => $immunize,
    		'message' => $message,
    	]);

    }

    public function get_immunization_data($r, $type)
    {
    	$d = [];
    	if ($r->input('type')=='update') {
    		$immunize = Immunize::find($r->input('immunize'));
    		$data = json_decode($immunize->data, true);
    		$d['date'] = $data['date'];
    	}
    	else {
    		$d['date'] = $type=='with-data'?$r->input('date_fillup'):date('Y-m-d');
    	}
    	$d['vaccine_date'] = $type=='with-data'?$r->input('vaccine_date'):'';
    	$d['return_date'] = $type=='with-data'?$r->input('return_date'):'';
    	$d['tags'] = $r->input('tags');
    	$d['vaccine_title'] = $r->input('vaccine');
    	$d['vaccine_dose'] = $r->input('dose');
    	$d['baby_age'] = $type=='with-data'?$r->input('baby-age'):'';
    	$d['remarks'] = $type=='with-data'?$r->input('remarks'):'';
    	
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
    	if ($request->input('rtype')=='review') {
    		$immunize = Immunize::find($id);
    		return response()->json([
    			'statusCode' => $immunize?200:404,
    			'html' => view('forms.immunize-review')->with(['data'=>$immunize])->render(),
	      ]);
    	}
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
  		if ($request->input('rtype')=='generate-forms') {
  			// return response()->json($request->all());
   			return view('forms.immunize-form')->with(['inputs'=>$request->all()])->render();
   		}
   		else if ($request->input('rtype')=='for-edit') {
   			$immunize = Immunize::find($request->input('immunize'));
   			return response()->json([
     			'statusCode' => $immunize?200:404,
     			'message' => $immunize?'Records not found.':'Records found.',
     			'data' => $immunize,
     			'html' => view('forms.immunize-form')->with([
     				'data' => $immunize
     			])->render()
     		]);
   		}
   		else {
   			return response()->json([
     			'statusCode' => 419,
     			'message' => 'Invalid request',
     		]);
   		}
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
