<?php

use App\ResetPassword;

function countResetPassword() {
	return ResetPassword::where([
		['is_expired', false],
		['is_resetted', false],
	])->count();
}

function segment($segment, $param = []) {
	if ( empty($param) ) {
		return Request::segment($segment);
	}
	return Request::segment($segment) === $param[0] ? (isset($param[1]) ? $param[1] : 'active') : '';
}

function active($route) {
	return Route::currentRouteName() == $route ? 'active' : '';
}

function getAge($birthdate, $f='year') {
	$bdy = new DateTime(date('Y-m-d', strtotime($birthdate)));
	$tody = new DateTime(date('Y-m-d'));
	$diff = $tody->diff($bdy);
	// $diff->y, $diff->m, $diff->d;
	if ($f=='day' OR $f=='days') {
		return $diff->days;
	}
	else if ($f=='month' OR $f=='months') {
		return floor($diff->days/30);
	}

	if ($f='default') {
		if ($diff->days <= 30) {
			return $diff->days.' days';
		}
		else if (floor($diff->days/30) < 12) {
			return floor($diff->days/30).' months';
		}
		else {
			return $diff->y.' years';
		}
	}

	// if (floor($diff->days/30) > 1 AND floor($diff->days/30) < 12) {
	// 	return floor($diff->days/30);
	// }
	// else if ($diff->days > 0 AND $diff->days < 30) {
	// 	return $diff->days;
	// }
	
	return $diff->y;
}

function expectedDelivery($d) {
	$date = date_create(date('Y-m-d', strtotime($d)));
	// date_add($date, date_interval_create_from_date_string('7 days'));
	date_add($date, date_interval_create_from_date_string('9 months 7 days'));
	return date_format($date, 'Y-m-d');
}

function getPregnantRank($d) {
	$arr = [
		'1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th',
		'11th', '12th', '13th', '14th', '15th', '16th', '17th', '18th', '19th', '20th',
		'21st', '22nd', '23rd', '24th', '25th', '26th', '27th', '28th', '29th', '30th',
	];
	return $arr[$d];
}

function filterJsonData($data, $ind=null) {
	$store = [];
	foreach ($data as $k => $d) {
		$json = json_decode($d->data, true);
		$keys = ['bcg','hepab','pv','opv','ipv','pcv','mmr'];
		$tags = in_array($json['tags'], $keys)===false?'other':$json['tags'];

		$store[$tags]['tags'] = $json['tags'];
		$store[$tags]['vaccine_title'] = $json['vaccine_title'];
		$store[$tags]['vaccine_dose'][] = $json['vaccine_dose'];
		$store[$tags]['baby_age'][] = $json['baby_age'];
		$store[$tags]['date'][] = $json['date'];
		$store[$tags]['vaccine_date'][] = $json['vaccine_date'];
		$store[$tags]['return_date'][] = $json['return_date'];
		$store[$tags]['remarks'][] = $json['remarks'];
	}

	return $ind==null?$store:(isset($store[$ind])?$store[$ind]:[]);
	// return html_entity_decode(json_encode($store));
}

function getVaccineDate($val, $ind, $empty=false) {
	if (isset($val) OR !empty($val) OR $val !== null OR (is_array($val) AND count($val))) {
		if (isset($val['vaccine_date'][$ind]) AND !empty($val['vaccine_date'][$ind])) {
			return date('M. d, Y', strtotime($val['vaccine_date'][$ind]));
		}
	}
	return $empty;
}

?>