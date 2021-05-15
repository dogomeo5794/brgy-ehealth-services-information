<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Child;
use App\Mother;
use App\Prenatal;
use App\Immunize;
use App\Setting;

class Reminder extends Model
{
	public function getSMS($type="prenatal", $m=null, $s=null, $b=null) {
        $message = "";
        if ($type=="prenatal") {
            $sms = Setting::where('type', 'sms-format-prenatal')->first()->data;
            $sms = json_decode($sms)->sms_format;
            $message = str_replace(['<mother>', '<sched>'], [$m, $s], $sms);
        }
        else {
            $sms = Setting::where('type', 'sms-format-immunize')->first()->data;
            $sms = json_decode($sms)->sms_format;
            $message = str_replace(['<mother>', '<sched>', '<baby>'], [$m, $s, $b], $sms);
        }
        return $message;
    }

	public function sendReminders()
	{
		if (getenv('SMS_STATUS') == 'testing') {
			$this->sms_testing();
			exit();
		}

		$today = date('Y-m-d') . '%';
        $tom = date('Y-m-d', strtotime('+1 days')) . '%';

		$prenatals = Prenatal::where('return_date', 'LIkE', $today)->orWhere('return_date', 'LIkE', $tom)->get();
		foreach ($prenatals as $prenatal) {
			$mother = $prenatal->pregnant->mother;
			$name = $mother->firstname . ' ' . $mother->lastname;
			$mobile = $mother->contact;
            $return = strtotime($prenatal->return_date);
            $now = strtotime(date('Y-m-d'));
            $diff = $return == $now;
			$sms = $this->getSMS('prenatal', $name, $diff?'Today':'Tomorrow');
			$this->itextmoSend($mobile, $sms, $name, 'Prenatal', null);
		}

		$immunizes = Immunize::where('return_date', 'LIkE', $today)->orWhere('return_date', 'LIkE', $tom)->get();
		foreach ($immunizes as $immunize) {
			$child = $immunize->child;
			$mother = $child->parent->mother;
			$childName = $child->firstname . ' ' . $child->lastname;
			$motherName = $mother->firstname . ' ' . $mother->lastname;
			$mobile = $mother->contact;
            $return = strtotime($immunize->return_date);
            $now = strtotime(date('Y-m-d'));
            $diff = $return == $now;
			$sms = $this->getSMS('immunization', $motherName, $diff?'Today':'Tomorrow', $childName);
			$this->itextmoSend($mobile, $sms, $name, "Immunization", $childName);
		}
	}

	public function itexmo($number, $msg, $apiCode, $passwd)
	{
		$url = 'https://www.itexmo.com/php_api/api.php';
		$itexmo = array('1' => $number, '2' => $msg, '3' => $apiCode, 'passwd' => $passwd);
		$param = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($itexmo),
			),
		);
		$context  = stream_context_create($param);
		return file_get_contents($url, false, $context);
	}

	public function itextmoSend($number, $message = "iTexMo: contact support.", $name = 'iTexMo', $type='Prenatal', $baby)
	{
		$now = date('Y-m-d H:i:s');
		$apiCode = getenv('ITEXTMO_CODE');
		$apiPass = getenv('ITEXMO_PASSWORD');
		$response = $this->itexmo($number, $message, $apiCode, $apiPass);

		if ($response == ""){
		    $alert_message = 'iTexMo: No response from server!!!
		            Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
		            Please CONTACT US for help.';
		} 
		else if ($response == 0){
		    $alert_message = 'Message Succesfully Sent!';
		} 
		else {   
		    $alert_message = "Error: ". $response . " was encountered!";
		}

		$log = [
			'type' => $type,
			'name' => $name,
			'number' => $number,
			'message' => $message,
			'status' => $response,
			'remarks' => $alert_message,
		];

		if ($type == 'Immunization') {
			$log['child'] = $baby;
		}

		Log::channel('itextmo')->info('iTexMo SMS Response: ', $log);
	}

	public function sms_testing()
	{
		$number = '09469572178';
		$message = $this->getSMS('prenatal', 'Honey Bee', 'Today');
		$name = 'Honey Bee';
		$now = date('Y-m-d H:i:s');
		$apiCode = getenv('ITEXTMO_CODE');
		$apiPass = getenv('ITEXMO_PASSWORD');
		$response = $this->itexmo($number, $message, $apiCode, $apiPass);

		if ($response == "") {
			$alert_message = 'iTexMo: No response from server!!!
                Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                Please CONTACT US for help.';
		} else if ($response == 0) {
			$alert_message = 'Message Succesfully Sent!';
		} else {
			$alert_message = "Error: " . $response . " was encountered!";
		}

		$log = [
			'name' => $name,
			'number' => $number,
			'message' => $message,
			'status' => $response,
			'remarks' => $alert_message,
		];

		Log::channel('itextmo')->info('iTexMo SMS Response: ', $log);
	}
}
