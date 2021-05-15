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
						<i class="far {{ $data->data['nutritional_status']=='Normal' ? 'fa-check-square' : 'fa-square' }}"></i> 
						Normal
					</li>
					<li>
						<i class="far {{ $data->data['nutritional_status']=='Under Weight' ? 'fa-check-square' : 'fa-square' }}"></i> 
						Underweight
					</li>
					<li>
						<i class="far {{ $data->data['nutritional_status']=='Over Weight' ? 'fa-check-square' : 'fa-square' }}"></i> 
						Overweight
					</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td>
				Pagsusuri ng kalagayan ng buntis: {!! $data->data['pregnant_situation'] !!}</b>
			</td>
		</tr>
		<tr>
			<td>
				Mga payong binigay: <b>{!! $data->data['advice_given'] !!}</b>
			</td>
		</tr>
		<tr>
			<td>
				Mga pagbabago sa birthplan: <b>{!! $data->data['changes_birthplan'] !!}</b>
			</td>
		</tr>
		<tr>
			<td>
				Pagsusuri ng ngipin: <b>{!! $data->data['dental_checkup'] !!}</b>
			</td>
		</tr>
		<tr>
			<td>
				Laboratory Tests Done: {!! $data->data['laboratory_test_done'] !!}
			</td>
		</tr>
		<tr>
			<td>
				Urinalysis: 
				<b>{{ $data->data['urinalysis'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Complete Blood Count (CBC): 
				<b>{{ $data->data['complete_blood_count'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Bacteriuria, kung kinakailangan: <b>{{ $data->data['bacteriuria_if_needed'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Blood/RH group, kung kinakailangan: <b>{{ $data->data['blood_rh_if_needed'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Treatments:
				<ul class="list-unstyled">
					<li>
						<i class="far {{ $data->data['treatments']=='Antiretroviral (ARV)' ? 'fa-check-square' : 'fa-square' }}"></i> Antiretroviral (ARV)
					</li>
					<li>
						<i class="far {{ $data->data['treatments']=='Bacteriuria' ? 'fa-check-square' : 'fa-square' }}"></i> Bacteriuria
					</li>
					<li>
						<i class="far {{ $data->data['treatments']=='Anemia' ? 'fa-check-square' : 'fa-square' }}"></i> Anemia
					</li>
			</td>
		</tr>
		<tr>
			<td>
				Pinag-usapan/Serbisyong ibinigay:
				<ul class="list-unstyled">
					<li>
						{!! $data->data['discussion_services_given']['reminder_previous_discussion']=='true'?'<i class="far fa-check-square"></i>':'-' !!} Pagpaalala ng nakaraang tinalakay
					</li>
					<li>
						{!! $data->data['discussion_services_given']['dsg_reminder_postpartum']=='true'?'<i class="far fa-check-square"></i>':'-' !!} Pagpapayo sa postpartum at postnatal care
					</li>
					<li>
						{!! $data->data['discussion_services_given']['dsg_agwat_ng_anak']=='true'?'<i class="far fa-check-square"></i>':'-' !!} Pagpapayo sa pag-agwat ng anak
					</li>
					<li>
						{!! $data->data['discussion_services_given']['dsg_tetanus_follow_up']=='true'?'<i class="far fa-check-square"></i>':'-' !!} Pagfollow-up ng Tetanus-containing Vaccine
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
				Health Service Provider:
				<b>{{ $data->data['health_service_provider'] }}</b>
			</td>
		</tr>
		<tr>
			<td>
				Hospital Referral:
				<b>{{ $data->data['hospital_referral'] }}</b>
			</td>
		</tr>
	</tbody>
</table>