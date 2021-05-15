<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Pregnant;
use App\Mother;
use App\Partner;
use App\Father;

class PregnantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('pages.user.pregnant');
    }

    public function pregnantList(Request $request)
    {
    	if ($request->input('q')!==NULL) {
        $q = $request->input('q');
      //   $pregnant = Pregnant::with('mother')->whereHas('mother', function($query) use($q) {
	    	// 	$query->where('firstname', 'LIKE', '%'.$q.'%')
	    	// 	->orWhere('middlename', 'LIKE', '%'.$q.'%')
	    	// 	->orWhere('lastname', 'LIKE', '%'.$q.'%')
	    	// 	->orWhere('address', 'LIKE', '%'.$q.'%');
	    	// })->paginate($this->limit);
	    	if ( in_array(strtolower(trim($q)), ['has schedule', 'no schedule']) ) {
	    		$pregnant = Mother::with('pregnants')->whereHas('pregnants', function($query) use($q) {
	    			$q = strtolower(trim($q));
    				$q = $q=='has schedule'?false:true;
	    			$query->where('is_record_done', $q);
		    	})->paginate($this->limit);
	    	}
	    	else {
	    		$pregnant = Mother::where('firstname', 'LIKE', '%'.$q.'%')
		    		->orWhere('middlename', 'LIKE', '%'.$q.'%')
		    		->orWhere('lastname', 'LIKE', '%'.$q.'%')
		    		->orWhere('address', 'LIKE', '%'.$q.'%')
		    		->with('pregnants')->paginate($this->limit);
	    	}
      }
      else {
        $pregnant = Mother::with('pregnants')->paginate($this->limit);
        // $pregnant = Pregnant::with('mother')->paginate($this->limit);
      }

      foreach ($pregnant as $key => $value) {
      	$preggy = $value->pregnants->where('is_record_done', false)->first();
      	$pregnant[$key]->has_prenatal = $preggy===null?false:true;
      	$pregnant[$key]->mother_no = $value->id;
      }

      $data = $pregnant->makeHidden([
				'civil_status',
				'contact',
				'created_at',
				'deleted_at',
				'id',
				'pregnants',
				'updated_at',
			]);
			$pregnant->data = $data;

			return response()->json($pregnant);
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
				'first-name' => 'required|max:100',
				'last-name' => 'required|max:100',
				'last-period' => 'required|date',
				'middle-name' => 'required|max:100',
				'weight' => 'required',
				'address' => 'required|string',
				'birthdate' => 'required|date',
				'civil-status' => 'required|in:single,married,widowed,separated',
				'contact' => 'required|string',
				'father-address' => 'required|string',
				'father-birthdate' => 'required|date',
				'father-contact' => 'required|string',
				'father-first-name' => 'required|max:100',
				'father-last-name' => 'required|max:100',
				'father-middle-name' => 'required|max:100',
				'age' => ['required','numeric','max:100','min:10', function($attribute, $value, $fail) use($request) {
					if ($value != getAge($request->input('birthdate'))) {
						$fail('Miscompute age, computed age is '.getAge($request->input('birthdate')));
					}
				}],
				'father-age' => ['required','numeric','max:100','min:10', function($attribute, $value, $fail) use($request) {
					if ($value != getAge($request->input('father-birthdate'))) {
						$fail('Miscompute age, computed age is '.getAge($request->input('father-birthdate')));
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

	  	$newAdd = false;
	  	$checking = Mother::where([
	  		['firstname', $request->input('first-name')],
	  		['lastname', $request->input('last-name')],
	  		['middlename', 'LIKE', trim($request->input('middle-name'), '.').'%'],
	  		['birthdate', date('Y-m-d', strtotime($request->input('birthdate')))],
	  	]);


	  	if (!$checking->count()) {
	  		$mother = Mother::create([
		  		'firstname' => $request->input('first-name'),
		  		'middlename' => $request->input('middle-name'),
		  		'lastname' => $request->input('last-name'),
		  		'birthdate' => date('Y-m-d', strtotime($request->input('birthdate'))),
		  		'address' => $request->input('address'),
		  		'civil_status' => $request->input('civil-status'),
		  		'contact' => $request->input('contact'),
		  	]);
		  	$newAdd = true;
	  	}
	  	else if ( $checking->first()->pregnants()->where('is_record_done', false)->count() ) {
	  		return response()->json([
	  			'statusCode' => 302,
	  			'errors' => 'Pregnant records is already exist.',
	  		]);
	  	}
	  	else {
	  		$mother = $checking->first();
	  	}

	  	$checkingFather = Father::where([
	  		['firstname', $request->input('father-first-name')],
	  		['lastname', $request->input('father-last-name')],
	  		['middlename', 'LIKE', trim($request->input('father-middle-name'), '.').'%'],
	  		['birthdate', date('Y-m-d', strtotime($request->input('father-birthdate')))],
	  	]);

	  	if (!$checkingFather->count()) {
	  		$father = Father::create([
		  		'firstname' => $request->input('father-first-name'),
		  		'middlename' => $request->input('father-middle-name'),
		  		'lastname' => $request->input('father-last-name'),
		  		'birthdate' => date('Y-m-d', strtotime($request->input('father-birthdate'))),
		  		'address' => $request->input('father-address'),
		  		'contact' => $request->input('father-contact'),
		  	]);
		  	$newAdd = true;
	  	}
	  	else {
	  		$father = $checkingFather->first();
	  	}

	  	if ($newAdd) {
	  		$parent = Partner::create([
		  		'mother_id' => $mother->id,
					'father_id' => $father->id,
		  	]);
	  	}
	  	
	  	$pregnant = Pregnant::create([
	  		'pregnant_no' => Str::random(15),
	  		'weight' => $request->input('weight'),
	  		'last_period' => date('Y-m-d', strtotime($request->input('last-period'))),
	  		'expected_delivery' => expectedDelivery($request->input('last-period')),
	  		'mother_id' => $mother->id,
	  	]);

	  	
      return response()->json([
      	'statusCode' => 200,
      	'data' => $request->all()
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
    	$pregnant = Mother::findOrFail($id);
    	if ( $request->input('r')=='pregnant-records' AND $request->input('tid')==$request->session()->token() ) {
    		$pregnant_records = $pregnant->pregnants()
    		->where('pregnant_no', $request->input('rid'))->firstOrFail();

    		return view('pages.user.pregnant-prenatal-records')
    		->with(['data'=>$pregnant, 'pregnant'=>$pregnant_records]);
    	}
    	return view('pages.user.pregnant-info')->with(['data'=>$pregnant]);
     	// return response()->json($pregnant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      $rule = [
      	'edit-weight' => 'required|numeric',
				'edit-last-period' => 'required|date',
				'pregnant-no' => 'required|exists:pregnants,pregnant_no',
				'_token' => ['required', function($attribute, $value, $fail) use($request) {
					if ($value != $request->session()->token()) {
						$fail('Invalid token.');
					}
				}]
      ];

      $valid = Validator::make($request->all(), $rule);
      if ($valid->fails()) {
      	return response()->json([
      		'statusCode' => 419,
      		'errors' => $valid->errors(),
      		'message' => 'Failed to update pregnant details due to errors.',
      	]);
      }
      
      $pregnant = Pregnant::where('pregnant_no', $request->input('pregnant-no'))->first();
	  	$pregnant->weight = $request->input('edit-weight');
	  	$pregnant->last_period = date('Y-m-d', strtotime($request->input('edit-last-period')));
	  	$pregnant->expected_delivery = expectedDelivery($request->input('edit-last-period'));
	  	$pregnant->save();

	  	$pregnant->fperiod = date('M d, Y', strtotime($pregnant->last_period));
	  	$pregnant->fexpected_delivery = date('M d, Y', strtotime($pregnant->expected_delivery));

	  	return response()->json([
    		'statusCode' => 200,
    		'message' => 'Success to update pregnant details.',
    		'data' => $pregnant->setVisible([
    			'weight','last_period','expected_delivery', 'fperiod', 'fexpected_delivery'
    		])
    	]);

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
    	$rule = [
    		'mother-no' => 'required|exists:mothers,id',
    		'father-no' => 'required|exists:fathers,id',
				'first-name' => 'required|max:100',
				'last-name' => 'required|max:100',
				'middle-name' => 'required|max:100',
				'address' => 'required|string',
				'birthdate' => 'required|date',
				'civil-status' => 'required|in:single,married,widowed,separated',
				'contact' => 'required|string',
				'father-address' => 'required|string',
				'father-birthdate' => 'required|date',
				'father-contact' => 'required|string',
				'father-first-name' => 'required|max:100',
				'father-last-name' => 'required|max:100',
				'father-middle-name' => 'required|max:100',
				'age' => ['required','numeric','max:100','min:10', function($attribute, $value, $fail) use($request) {
					if ($value != getAge($request->input('birthdate'))) {
						$fail('Miscompute age, computed age is '.getAge($request->input('birthdate')));
					}
				}],
				'father-age' => ['required','numeric','max:100','min:10', function($attribute, $value, $fail) use($request) {
					if ($value != getAge($request->input('father-birthdate'))) {
						$fail('Miscompute age, computed age is '.getAge($request->input('father-birthdate')));
					}
				}],
			];

	  	$valid = Validator::make($request->all(), $rule);

	  	if ($valid->fails()) {
	  		return response()->json([
	  			'statusCode' => 419,
	  			'errors' => $valid->errors(),
	  			'message' => 'Failed to update mother information, Found some errors.',
	  		]);
	  	}

	  	$mother = Mother::where([
	  		['firstname', $request->input('first-name')],
	  		['lastname', $request->input('last-name')],
	  		['middlename', 'LIKE', trim($request->input('middle-name'), '.').'%'],
	  		['birthdate', date('Y-m-d', strtotime($request->input('birthdate')))],
	  		['id', '!=', $request->input('mother-no')],
	  	]);

	  	$father = Father::where([
	  		['firstname', $request->input('father-first-name')],
	  		['lastname', $request->input('father-last-name')],
	  		['middlename', 'LIKE', trim($request->input('father-middle-name'), '.').'%'],
	  		['birthdate', date('Y-m-d', strtotime($request->input('father-birthdate')))],
	  		['id', '!=', $request->input('father-no')],
	  	]);


	  	if ($mother->count() OR $father->count()) {
	  		$who = $mother->count()?'Mother':'Father/Partner';
	  		return response()->json([
	  			'statusCode' => 419,
	  			'message' => 'Failed to update information, '.$who.' has a conflict details.',
	  			'errors' => [],
	  			'meother' => $mother->first(),
	  			'father' => $father->first(),
	  		]);
	  	}

	  	$updateMother = Mother::find($request->input('mother-no'));
	  	$updateMother->firstname = $request->input('first-name');
	  	$updateMother->middlename = $request->input('middle-name');
	  	$updateMother->lastname = $request->input('last-name');
	  	$updateMother->birthdate = date('Y-m-d', strtotime($request->input('birthdate')));
	  	$updateMother->address = $request->input('address');
	  	$updateMother->civil_status = $request->input('civil-status');
	  	$updateMother->contact = $request->input('contact');
	  	$updateMother->save();

	  	$updateFather = Father::find($request->input('father-no'));
	  	$updateFather->firstname = $request->input('father-first-name');
	  	$updateFather->middlename = $request->input('father-middle-name');
	  	$updateFather->lastname = $request->input('father-last-name');
	  	$updateFather->birthdate = date('Y-m-d', strtotime($request->input('father-birthdate')));
	  	$updateFather->address = $request->input('father-address');
	  	$updateFather->contact = $request->input('father-contact');
	  	$updateFather->save();

	  	return response()->json([
  			'statusCode' => 200,
  			'message' => 'Success to update mother information.',
  		]);
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


    public function searchPregnant(Request $request) 
    {
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

    	$pregnant = Mother::where('firstname', 'LIKE', '%'.$request->input('search-first-name').'%')
    		->orWhere('lastname', 'LIKE', '%'.$request->input('search-last-name').'%')
    		->with(['partner', 'partner.father'])->get();

    	// $pregnant = Mother::where('firstname', 'LIKE', '%'.$request->input('search-first-name').'%')
    	// 	->orWhere('lastname', 'LIKE', '%'.$request->input('search-last-name').'%')
    	// 	->with(['pregnants' => function($query) {
    	// 		$query->where('is_record_done', false);
    	// 	}])->get();
    	// $pregnant = Partner::with(['mother' => function($query) use($request) {
    	// 	$query->where('firstname', 'LIKE', '%'.$request->input('search-first-name').'%')
    	// 	->orWhere('lastname', 'LIKE', '%'.$request->input('search-last-name').'%');
    	// }, 'father'])->get();

    	return response()->json([
    		'statusCode' => 200,
    		'data' => $pregnant
    	]);

    }
  }



