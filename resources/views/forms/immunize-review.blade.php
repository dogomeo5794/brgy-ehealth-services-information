@php
	$obj = json_decode($data->data, true);
@endphp

<table class="table table-bordered">
	<tbody>
		<tr>
			<td style="width: 200px;">
				<strong>Vaccine</strong>
			</td>
			<td>{{ $obj['vaccine_title'] }}</td>
		</tr>
		<tr>
			<td style="width: 200px;">
				<strong>Doses</strong>
			</td>
			<td>
				{{ $obj['vaccine_dose'] }} Dose - 
				<small>{{ $data->record_status=='no-data'?'Not taken':'Taken' }}</small>
			</td>
		</tr>
		<tr>
			<td style="width: 200px;">
				<strong>Baby Age</strong>
			</td>
			<td>{{ $obj['baby_age']?$obj['baby_age']:'----' }}</td>
		</tr>
		<tr>
			<td style="width: 200px;">
				<strong>Vaccination Date</strong>
			</td>
			<td>{{ $obj['vaccine_date']?date('M d, Y', strtotime($obj['vaccine_date'])):'----' }}</td>
		</tr>
		<tr>
			<td style="width: 200px;">
				<strong>Remarks</strong>
			</td>
			<td>{!! $obj['remarks']?$obj['remarks']:'----' !!}</td>
		</tr>
	</tbody>
</table>