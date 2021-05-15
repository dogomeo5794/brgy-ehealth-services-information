<form method="POST" action="first-trimester-url-here" id="trimester-form">
	@csrf
	@php
		$isUpdate = false;
		if (isset($data)) {
			$isUpdate = true;
		}
	@endphp
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Date</label>
						<input type="date" name="date_fillup" value="{{ date('Y-m-d') }}" class="form-control">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Weight</label>
						<input type="text" name="weight" class="form-control" value="{{ $isUpdate?$data->data->weight:'' }}">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Height</label>
						<input type="text" name="height" class="form-control" value="{{ $isUpdate?$data->data->height:'' }}">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Age of Gestation</label>
						<input type="number" name="age_gestation" class="form-control" value="{{ $isUpdate?$data->data->age_of_gestation:'' }}">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Blood Pressure</label>
						<input type="text" name="bp" class="form-control" value="{{ $isUpdate?$data->data->blood_pressure:'' }}">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Nutritional Status</label>
						<select name="nutritional-status" class="form-control">
							@php
								$select1 = false;
								$select2 = false;
								$select3 = false;
								$select4 = false;
								if ($isUpdate) {
									$select1 = $data->data->nutritional_status==''?true:false;
									$select2 = $data->data->nutritional_status=='Normal'?true:false;
									$select3 = $data->data->nutritional_status=='Under Weight'?true:false;
									$select4 = $data->data->nutritional_status=='Over Weight'?true:false;
								}
							@endphp
							<option {{ $select1?'selected':'' }} value="" selected=""></option>
							<option {{ $select2?'selected':'' }} value="Normal">Normal</option>
							<option {{ $select3?'selected':'' }} value="Under Weight">Under Weight</option>
							<option {{ $select4?'selected':'' }} value="Over Weight">Over Weight</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Pagsusuri ng kalagayan ng buntis:</label>
						<div name="pregnant-situation" class="form-control on-get-editor" style="height: auto;">
							{!! $isUpdate?($data->data->pregnant_situation==''?'...':$data->data->pregnant_situation):'...' !!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Mga Payong Binigay:</label>
						<div name="advice-given" class="form-control on-get-editor" style="height: auto;">
							{!! $isUpdate?($data->data->advice_given==''?'...':$data->data->advice_given):'...' !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Changes of Birth Plan:</label>
						<div name="changes-birthplan" class="form-control on-get-editor" style="height: auto;">
							{!! $isUpdate?($data->data->changes_birthplan==''?'...':$data->data->changes_birthplan):'...' !!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Dental Checkup</label>
						<div name="dental-checkup" class="form-control on-get-editor" style="height: auto;">
							{!! $isUpdate?($data->data->dental_checkup==''?'...':$data->data->dental_checkup):'...' !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label>Laboratory Test Done:</label>
						<div name="laboratory-test" class="form-control on-get-editor" style="height: auto;">
							{!! $isUpdate?($data->data->laboratory_test_done==''?'...':$data->data->laboratory_test_done):'...' !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Urinalysis:</label>
						<input type="text" name="urinalysis" class="form-control" value="{{ $isUpdate?$data->data->urinalysis:'' }}">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label><small>Complete Blood Count</small> (CBC):</label>
						<input type="text" name="cbc" class="form-control" value="{{ $isUpdate?$data->data->complete_blood_count:'' }}">
					</div>
				</div>
	
				<div class="col-sm-4">
					<div class="form-group">
						<label>Bacteriuria, kung kinakailangan</label>
						<input type="text" name="bacteriuria-if-needed" class="form-control">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Blood/RH group kung kinakailangan</label>
						<input type="text" name="blood-rh-if-needed" class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Treatments</label>
						@php
							$treat1 = false;
							$treat2 = false;
							$treat3 = false;
							$treat4 = false;
							if ($isUpdate) {
								$treat1 = $data->data->treatments==''?true:false;
								$treat2 = $data->data->treatments=='Antiretroviral (ARV)'?true:false;
								$treat3 = $data->data->treatments=='Bacteriuria'?true:false;
								$treat4 = $data->data->treatments=='Anemia'?true:false;
							}
						@endphp
						<select class="form-control" name="treatments">
							<option {{ $treat1?'selected':'' }} value="" selected=""></option>
							<option {{ $treat2?'selected':'' }} value="Antiretroviral (ARV)">Antiretroviral (ARV)</option>
							<option {{ $treat3?'selected':'' }} value="Bacteriuria">Bacteriuria</option>
							<option {{ $treat4?'selected':'' }} value="Anemia">Anemia</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label>
							Discussion/Services given: 
							<span class="check-all"><i class="far fa-square"></i> All</span>
						</label>
						@php
							$dsg1 = false;
							$dsg2 = false;
							$dsg3 = false;
							$dsg4 = false;
							if ($isUpdate) {
								$dsg1 = $data->data->discussion_services_given->reminder_previous_discussion=='true'?true:false;
								$dsg2 = $data->data->discussion_services_given->dsg_reminder_postpartum=='true'?true:false;
								$dsg3 = $data->data->discussion_services_given->dsg_agwat_ng_anak=='true'?true:false;
								$dsg4 = $data->data->discussion_services_given->dsg_tetanus_follow_up=='true'?true:false;
							}
						@endphp
						<div class="form-control" style="height: auto;">
							<div class="icheck-danger d-block">
								<input type="checkbox" name="dsg-reminder-discussion" id="dsg-1" {{ $dsg1=='true'?'checked':'' }} >
								<label for="dsg-1">
									Pagpaalala ng nakaraang tinalakay
								</label>
							</div>
							<div class="icheck-danger d-block">
								<input type="checkbox" name="dsg-reminder-postpartum" id="dsg-2" {{ $dsg2=='true'?'checked':'' }} >
								<label for="dsg-2">
									Pagpapayo sa postpartum at postnatal care
								</label>
							</div>
							<div class="icheck-danger d-block">
								<input type="checkbox" name="dsg-agwat-ng-anak" id="dsg-3" {{ $dsg3=='true'?'checked':'' }} >
								<label for="dsg-3">
									Pagpapayo sa pag-agwat ng anak
								</label>
							</div>
							<div class="icheck-danger d-block">
								<input type="checkbox" name="dsg-tetanus-follow-up" id="dsg-4" {{ $dsg4=='true'?'checked':'' }} >
								<label for="dsg-4">
									Pagfollow-up ng Tetanus-containing Vaccine
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label>Return Date:</label>
						<input type="date" name="return-date" class="form-control"  value="{{ $isUpdate?$data->data->return_date:'' }}">
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<label>Health Service Provider:</label>
						<input type="text" name="health-service-provider" class="form-control"  value="{{ $isUpdate?$data->data->health_service_provider:'' }}">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Hospital Referral:</label>
						<input type="text" name="hospital-referral" class="form-control"  value="{{ $isUpdate?$data->data->hospital_referral:'' }}">
					</div>
				</div>
			</div>

		</div>
	</div>
</form>


<script type="text/javascript">
	$(function() {

		$(document).on('click', '.on-get-editor', function() {
			$(this).getEditor({title: $(this).closest('.form-group').find('label:first').text()});
		});

		$(document).on('click' ,'.check-all', function() {
			if ($(this).find('i.far:first').hasClass('fa-square')) {
				$(this).find('i.far:first').removeClass('fa-square').addClass('fa-check-square')
				$(this).closest('.form-group').find('input[type="checkbox"]').prop('checked', true);
			}
			else {
				$(this).find('i.far:first').removeClass('fa-check-square').addClass('fa-square')
				$(this).closest('.form-group').find('input[type="checkbox"]').prop('checked', false);
			}
		})
	})
</script>