<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Child;
use App\Mother;
use App\Father;
use App\Partner;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->input('request-type')=='get-children') {
    		if ($request->input('_token') !== $request->session()->token()) {
    			return response()->json([
    				'statusCode' => 302,
    				'message' => 'Invalid token.',
    			]);
    		}

    		$children = Child::with(['parent.mother'])->paginate($this->limit);
    		$children->data = $children->map(function($item) {
    			$item['birthdate'] = date('M d, Y', strtotime($item['birthdate']));
    		});
    		return response()->json($children);
    	}
    	return view('pages.user.children');
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
				'baby-last-name' => 'required|string|max:100',
				'baby-first-name' => 'required|string|max:100',
				'baby-middle-name' => 'required|string|max:100',
				'baby-birthdate' => 'required|date',
				'baby-age' => ['required','string', function($attribute, $value, $fail) use($request) {
					$age = explode(' ', $value);
					$label = count($age) > 1 ? strtolower($age[1]):'';
					if (count($age) != 2) {
						$fail('baby-age invalid format.');
					}
					else if ( !in_array($label, ['days', 'day', 'month', 'months']) ) {
						$fail('baby-age invalid format. You should use day/s, or month/s');
					}
					else if ($age[0] != getAge($request->input('baby-birthdate'), $label)) {
						$fail('Computed age is '.getAge($request->input('baby-birthdate'), $label).' '.$label.'/s');
					}
				}],
				'baby-gender' => 'required|in:male,female',
				'baby-weight' => 'required|numeric',
				'baby-birthorder' => 'required|numeric|max:20',
				'baby-birthplace' => 'required|string',
				'baby-born-at' => 'required|string',
				'baby-remarks' => 'nullable|string',
			];

	  	$valid = Validator::make($request->all(), $rule);

	  	if ($valid->fails()) {
	  		return response()->json([
	  			'statusCode' => 419,
	  			'errors' => $valid->errors(),
	  		]);
	  	}


	  	$addNewParent = false;
	  	$mother = Mother::where([
	  		['firstname', $request->input('first-name')],
	  		['lastname', $request->input('last-name')],
	  		['middlename', 'LIKE', trim($request->input('middle-name'), '.').'%'],
	  		['birthdate', date('Y-m-d', strtotime($request->input('birthdate')))],
	  	])->first();


	  	if (!$mother) {
	  		$mother = Mother::create([
		  		'firstname' => $request->input('first-name'),
		  		'middlename' => $request->input('middle-name'),
		  		'lastname' => $request->input('last-name'),
		  		'birthdate' => date('Y-m-d', strtotime($request->input('birthdate'))),
		  		'address' => $request->input('address'),
		  		'civil_status' => $request->input('civil-status'),
		  		'contact' => $request->input('contact'),
		  	]);
		  	$addNewParent = true;
	  	}
	  	

	  	$father = Father::where([
	  		['firstname', $request->input('father-first-name')],
	  		['lastname', $request->input('father-last-name')],
	  		['middlename', 'LIKE', trim($request->input('father-middle-name'), '.').'%'],
	  		['birthdate', date('Y-m-d', strtotime($request->input('father-birthdate')))],
	  	])->first();

	  	if (!$father) {
	  		$father = Father::create([
		  		'firstname' => $request->input('father-first-name'),
		  		'middlename' => $request->input('father-middle-name'),
		  		'lastname' => $request->input('father-last-name'),
		  		'birthdate' => date('Y-m-d', strtotime($request->input('father-birthdate'))),
		  		'address' => $request->input('father-address'),
		  		'contact' => $request->input('father-contact'),
		  	]);
		  	$addNewParent = true;
	  	}

	  	if ($addNewParent) {
	  		$parent = Partner::create([
		  		'mother_id' => $mother->id,
					'father_id' => $father->id,
		  	]);
	  	}
	  	else {
	  		$parent = Partner::where([
	  			['mother_id', $mother->id],
	  			['father_id', $father->id],
	  		])->first();
	  	}


	  	$child = new Child;
	  	$child->birth_order = $request->input('baby-birthorder');
			$child->firstname = $request->input('baby-first-name');
			$child->middlename = $request->input('baby-middle-name');
			$child->lastname = $request->input('baby-last-name');
			$child->birthdate = $request->input('baby-birthdate');
			$child->born_weight = $request->input('baby-weight');
			$child->born_at = $request->input('baby-born-at');
			$child->born_place = $request->input('baby-birthplace');
			$child->gender = $request->input('baby-gender');
			$child->remarks = $request->input('baby-remarks');
			$child->parent_id = $parent->id;
			$child->save();
	  	
      return response()->json([
      	'statusCode' => 200,
      	'data' => $child,
      	'message' => 'Success to add new Child, now ready to make immunization records.'
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
    	if ($request->input('rtype')=='search') {
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
	    	$children = Child::where([
				['firstname', 'LIKE', '%'.$request->input('search-first-name').'%'],
				['lastname', 'LIKE', '%'.$request->input('search-last-name').'%']
			])
	    	->with(['parent.mother'])->get();

	    	return response()->json([
	    		'statusCode' => 200,
	    		'data' => $children
	    	]);

    	}
    	else if ($request->input('rtype')=='selected') {
    		$children = Child::find($id);
    		$children->parent = $children->parent;
    		$children->parent->mother = $children->parent->mother;
    		$children->immunizations = $children->immunizations;

	    	return response()->json([
	    		'statusCode' => $children?200:404,
	    		'data' => $children
	    	]);
    	}
    	else {
    		$child = Child::findOrFail($id);

	    	return view('pages.user.child-details')->with(['data'=>$child]);
    	}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$child = Child::find($id);
			$field = [
				'child_last_name' => '<div class="form-group"><input type="text" name="child_last_name" class="form-control x-field" style="position:absolute;top:0;" value="'.$child->lastname.'"><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
				'child_first_name' => '<div class="form-group"><input type="text" name="child_first_name" class="form-control x-field" style="position:absolute;top:0;" value="'.$child->firstname.'"><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
				'child_middle_name' => '<div class="form-group"><input type="text" name="child_middle_name" class="form-control x-field" style="position:absolute;top:0;" value="'.$child->middlename.'"><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
				'child_birthday' => '<div class="form-group"><input type="date" name="child_birthday" class="form-control x-field" style="position:absolute;top:0;" value="'.$child->birthdate.'"><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
				'child_age' => '<div class="form-group"><input name="child_age" class="form-control x-field" style="position:absolute;top:0;" value="'.getAge($child->birthdate, 'default').'"><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
				'child_birth_weight' => '<div class="form-group"><input type="number" name="child_birth_weight" class="form-control x-field" style="position:absolute;top:0;" value="'.$child->born_weight.'"><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
				'child_gender' => '<div class="form-group"><select name="child_gender" class="form-control x-field" style="position:absolute;top:0;"><option value="male" '.($child->gender=='male'?'selected':'').'>Male</option><option value="female" '.($child->gender=='female'?'selected':'').'>Female</option></select><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
				'child_birth_order' => '<div class="form-group"><input type="number" name="child_birth_order" class="form-control x-field" style="position:absolute;top:0;" value="'.$child->birth_order.'"><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
				'child_place_of_birth' => '<div class="form-group"><input type="text" name="child_place_of_birth" class="form-control x-field" style="position:absolute;top:0;" value="'.$child->born_place.'"><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
				'child_born_at' => '<div class="form-group"><input type="text" name="child_born_at" class="form-control x-field" style="position:absolute;top:0;" value="'.$child->born_at.'"><span style="padding-top: 12px;margin-bottom: -20px;" class="error invalid-feedback"></span></div>',
			];
      return response()->json($field);
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
    	if ($request->input('rtype')=='mark-record-done') {
    		$child = Child::find($id);
    		$child->remarks = $request->input('remarks');
    		$child->is_record_done = true;
    		$child->record_done_date = $request->input('complete_date');
    		$child->save();
    		return response()->json([
    			'statusCode' => 200,
    			'message' => 'Immunization record marked complete.',
    			'data' => $child
	       ]);
    	}
    	else if ($request->input('rtype')=='save-child-update') {
    		$rule = [
    			'child_last_name' => 'required|string',
					'child_first_name' => 'required|string',
					'child_middle_name' => 'required|string',
					'child_birthday' => 'required|date',
					'child_age' => 'required',
					'child_birth_weight' => 'required|numeric',
					'child_gender' => 'required|in:male,female',
					'child_birth_order' => 'required|numeric',
					'child_place_of_birth' => 'required|string',
					'child_born_at' => 'required|string',
    		];

    		$valid = Validator::make($request->all(), $rule);

    		if ($valid->fails()) {
    			return response()->json([
    				'statusCode' => 419,
    				'errors' => $valid->errors(),
    				'message' => 'Found some errors. Make sure input valid data.'
    			]);
    		}

    		$child = Child::find($id);
    		$child->birth_order = $request->input('child_birth_order');
				$child->firstname = $request->input('child_first_name');
				$child->middlename = $request->input('child_middle_name');
				$child->lastname = $request->input('child_last_name');
				$child->birthdate = $request->input('child_birthday');
				$child->born_weight = $request->input('child_birth_weight');
				$child->born_at = $request->input('child_born_at');
				$child->born_place = $request->input('child_place_of_birth');
				$child->gender = $request->input('child_gender');
				$child->save();

				$field = $request->all();
				$field['child_age'] = getAge($request->input('child_birthday'), 'default');
				$field['child_birthday'] = date('M d, Y', strtotime($request->input('child_birthday')));

				return response()->json([
  				'statusCode' => 200,
  				'data' => $field,
  				'message' => 'Success to update child information.'
  			]);

    	}
       
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
