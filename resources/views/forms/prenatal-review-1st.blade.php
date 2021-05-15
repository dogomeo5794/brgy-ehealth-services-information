<style type="text/css">
	ul.list-unstyled li {
    padding-left: 20px;
	}
</style>
<table class="table table-bordered">
	<thead>
		@if ($data->checkup_order=='1')
		<th><strong>{{ $data->trimester }} Trimester</strong> - First Check-up</th>
		@elseif ($data->checkup_order=='2')
		<th><strong>{{ $data->trimester }} Trimester</strong> - Second Check-up</th>
		@else
		<th><strong>{{ $data->trimester }} Trimester</strong> - Third Check-up</th>
		@endif
	</thead>
	<tbody>
		<tr>
			<td>
				Date: <b>{{ date('M d, Y', strtotime($data->date_conduct)) }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Weight: <b>{{ $data->data['weight'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Height: <b>{{ $data->data['height'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Age of Gestation: <b>{{ $data->data['age_of_gestation'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Blood Pressure: <b>{{ $data->data['blood_pressure'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Nutritional Status:
				<ul class="list-unstyled">
					<li>
						<i class="far {{ $data->data['nutritional_status']=='Normal' ? 'fa-check-square' : 'fa-square' }}"></i> Normal
					</li>
					<li>
						<i class="far {{ $data->data['nutritional_status']=='Under Weight' ? 'fa-check-square' : 'fa-square' }}"></i> Underweight
					</li>
					<li>
						<i class="far {{ $data->data['nutritional_status']=='Over Weight' ? 'fa-check-square' : 'fa-square' }}"></i> Overweight
					</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td>
				Make a Birth Plan: {!! $data->data['make_a_birth_plan'] !!}
			</td>
		</tr>
		<tr>
			<td>
				Dental Checkup: {!! $data->data['dental_checkup'] !!}
			</td>
		</tr>
		<tr>
			<td>
				Laboratory Test Done: {!! $data->data['laboratory_test_done'] !!}
			</td>
		</tr>
		<tr>
			<td>
				Hemoglobin Count: <b>{{ $data->data['hemoglobin_count'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Urinalysis: <b>{{ $data->data['urinalysis'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Complete Blood Count (CBC): <b>{{ $data->data['complete_blood_count'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				STIs gamit ang syndromic approach:
				<ul class="list-unstyled">
					<li>
						{!! $data->data['stis_sundromic_aaproach']['syphilis']=='true'?'<i class="far fa-check-square"></i>':'-' !!} Syphilis</li>
					<li>
						{!! $data->data['stis_sundromic_aaproach']['hiv']=='true'?'<i class="far fa-check-square"></i>':'-' !!} HIV</li>
					<li>
						{!! $data->data['stis_sundromic_aaproach']['hepatits_b']=='true'?'<i class="far fa-check-square"></i>':'-' !!} Hepatits B (HbsAg)</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td>
				Stool Examination: <b>{{ $data->data['stool_examination'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Acetic Acid Wash: <b>{{ $data->data['acetic_acid_wash'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Tetanus-containing Vaccine: <b>{{ $data->data['tetanus_containing_vaccine'] }}</b>

				<p>Date given: <b>{{ $data->data['date_given'] }}</b></p>
			</td>
		</tr>
		<tr>
			<td>
				Treatments:
				<ul class="list-unstyled">
					<li>
						<i class="far {{ $data->data['treatments']=='Syphilis' ? 'fa-check-square' : 'fa-square' }}"></i> Syphilis
					</li>
					<li>
						<i class="far {{ $data->data['treatments']=='Antiretroviral (ARV)' ? 'fa-check-square' : 'fa-square' }}"></i> Antiretroviral (ARV)
					</li>
					<li>
						<i class="far {{ $data->data['treatments']=='Bacteriuria' ? 'fa-check-square' : 'fa-square' }}"></i> Bacteriuria
					</li>
					<li>
						<i class="far {{ $data->data['treatments']=='Anemia' ? 'fa-check-square' : 'fa-square' }}"></i> Anemia
					</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td>
				Discussion/Services given:
				<ul class="list-unstyled">
					<li>
						{!! $data->data['discussion_services_given']['avoid_alcohol']=='true'?'<i class="far fa-check-square"></i>':'-' !!}  
						To Avoid alcohol, tobacco, or illegal drugs
					</li>
					<li>
						{!! $data->data['discussion_services_given']['advises_foods']=='true'?'<i class="far fa-check-square"></i>':'-' !!}  
						Advises about the right foods
					</li>
					<li>
						{!! $data->data['discussion_services_given']['advises_sex_safe']=='true'?'<i class="far fa-check-square"></i>':'-' !!}  
						Advises about sex safe
					</li>
					<li>
						{!! $data->data['discussion_services_given']['right_use_of_insecticide']=='true'?'<i class="far fa-check-square"></i>':'-' !!}  
						The right use of insecticide-treated/mosquito net
					</li>
					<li>
						{!! $data->data['discussion_services_given']['birth_plan']=='true'?'<i class="far fa-check-square"></i>':'-' !!}  
						Birth Plan
					</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td>
				Return Date: 
				<b>{{ empty($data->data['return_date'])?'':date('M d, Y', strtotime($data->data['return_date'])) }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Health Service Provider: <b>{{ $data->data['health_service_provider'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Hospital Referral: <b>{{ $data->data['hospital_referral'] }}</b>
			</td>
		</tr>
	</tbody>
</table>