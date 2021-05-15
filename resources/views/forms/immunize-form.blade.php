<form method="POST" action="immunization-url-here" id="immunization-form">
	@csrf
	@php
		$isUpdate = false;
		$obj = [];
		if (isset($data)) {
			$inputs = [];
			$isUpdate = true;
			$obj = json_decode($data->data, true);
			$inputs['act'] = in_array($obj['tags'],['bcg','hepab','pv','opv','ipv','pcv','mmr'])?$obj['tags']:'other';
			$inputs['title'] = $obj['vaccine_title'];
			$inputs['dose'] = $obj['vaccine_dose'];
		}
	@endphp

	<style type="text/css">
		.r1>input:first-child+input[type=hidden]+label, .r1>input:first-child+label {
	    border: 1px solid #D3CFC8;
	    border-radius: 0;
	    margin-left: -29px;
	    padding: 15px;
	    background: #fff;
	    cursor: pointer;
	  }
	  .r1 input {
	  	opacity: 0;
	  }
	  .r1 {
	  	margin-left: 25px !important;
	  	display: inline-block;
	  }
	  .r1>input:first-child:checked+input[type=hidden]+label, .r1>input:first-child:checked+label {
	    border: 1px solid #ff5757c2 !important;
	    box-shadow: rgb(60 64 67 / 10%) 0 1px 5px 0, rgb(60 64 67 / 20%) 0 1px 5px 1px;
		}
	</style>

	<div class="row">
		
		<div class="col-12">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Date</label>
						@if ($isUpdate)
						<span style="background-color: #e9ecef" class="form-control">{{ date('m/d/Y', strtotime($data->date_conduct)) }}</span>
						@else
						<input type="date" name="date_fillup" value="{{ date('Y-m-d') }}" class="form-control">
						@endif
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Vaccination Date</label>
						<input type="date" name="vaccine_date" class="form-control" value="{{ $isUpdate?$obj['vaccine_date']:date('Y-m-d') }}">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Return Date</label>
						<input type="date" name="return_date" class="form-control" value="{{ $isUpdate?$obj['return_date']:'' }}">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group">
						<label>Vaccine</label>
						@if ($inputs['act']=='other')
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" name="tags" value="{{ $isUpdate?$obj['tags']:'' }}" class="form-control" placeholder="tags/acro-name, w/o special character" title="tags/acro-name, w/o special character">
								</div>
							</div>
							<div class="col-sm-9">
								<div class="form-group">
									<input type="text" name="vaccine" value="{{ $isUpdate?$obj['vaccine_title']:'' }}" class="form-control" placeholder="Vaccine title here.">
								</div>
							</div>
						</div>
						@else
						<input type="hidden" name="vaccine" value="{{ $inputs['title'] }}">
						<input type="hidden" name="tags" value="{{ $inputs['act'] }}">
						<div class="form-control" style="height: auto;background-color: #e9ecef;">
							{{ $inputs['title'] }}
						</div>
						@endif
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Dose</label>
						@if ($inputs['act']=='other')
						<input type="text" name="dose" value="{{ $isUpdate?$obj['vaccine_dose']:'' }}" class="form-control" placeholder="e.g: '1st' or '2nd' or '3rd'">
						@else
						<input type="hidden" name="dose" value="{{ $inputs['dose'] }}">
						<div class="form-control" style="height: auto;background-color: #e9ecef;">
							{{ $inputs['dose'] }} Dose
						</div>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label>Baby's Age</label>
						<div class="form-control baby-age-group" style="height: auto;padding: 9px 0 0 0;border: none;">
							@if (in_array($inputs['act'], ['bcg','hepab']))
							<div class="r1">
								<input type="radio" name="baby-age" id="just-born" value="Just born" 
								{{ $isUpdate?($obj['baby_age']=='Just born'?'checked':''):'checked' }} >
								<label for="just-born">
									Just born
								</label>
							</div>
							@elseif (in_array($inputs['act'], ['pv','opv','pcv']))
							<div class="r1">
								<input type="radio" name="baby-age" id="1-1/2" value="1 1/2 Months" 
								{{ $isUpdate?($obj['baby_age']=='1 1/2 Months'?'checked':''):'checked' }} >
								<label for="1-1/2">
									1 1/2 Months
								</label>
							</div>
							<div class="r1">
								<input type="radio" name="baby-age" id="2-1/2" value="2 1/2 Months"
								{{ $isUpdate?($obj['baby_age']=='2 1/2 Months'?'checked':''):'' }} >
								<label for="2-1/2">
									2 1/2 Months
								</label>
							</div>
							<div class="r1">
								<input type="radio" name="baby-age" id="3-1/2" value="3 1/2 Months"
								{{ $isUpdate?($obj['baby_age']=='3 1/2 Months'?'checked':''):'' }} >
								<label for="3-1/2">
									3 1/2 Months
								</label>
							</div>
							@elseif ($inputs['act']=='ipv')
							<div class="r1">
								<input type="radio" name="baby-age" id="3-1/2" value="3 1/2 Months" 
								{{ $isUpdate?($obj['baby_age']=='3 1/2 Months'?'checked':''):'checked' }} >
								<label for="3-1/2">
									3 1/2 Months
								</label>
							</div>
							@elseif ($inputs['act']=='mmr')
							<div class="r1">
								<input type="radio" name="baby-age" id="9m" value="9 Months" 
								{{ $isUpdate?($obj['baby_age']=='9 Months'?'checked':''):'checked' }} >
								<label for="9m">
									9 Months
								</label>
							</div>
							<div class="r1">
								<input type="radio" name="baby-age" id="1y" value="1 Year"
								{{ $isUpdate?($obj['baby_age']=='1 Year'?'checked':''):'' }} >
								<label for="1y">
									1 Year
								</label>
							</div>
							@else
								<input type="text" name="baby-age" value="{{ $isUpdate?$obj['baby_age']:'' }}" class="form-control" placeholder="Input baby age">
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label>Remarks</label>
						<textarea id="remarks" name="remarks" class="form-control">
							{!! $isUpdate?$obj['remarks']:'' !!}
						</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>


<script type="text/javascript">
	$(function() {

		$('#remarks').summernote({
			height: 150
		});
		$('div.note-btn-group.btn-group.note-insert').remove();
		$('div.note-btn-group.btn-group.note-table').remove();
		$('div.note-btn-group.btn-group.note-view .btn-codeview').remove();

	})
</script>