<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CreatvStudio\Itexmo\Itexmo;
use Illuminate\Support\Facades\Log;
use App\Child;
use App\Mother;
use App\Prenatal;
use App\Immunize;
use App\Setting;

class SMSController extends Controller
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

    public function send(Request $request, Itexmo $itexmo) {
			// $itexmo->to('09469572178')
   //          ->content('this is testing')
   //          ->send();

    	return $this->itextmoSend('09469572178', $this->getSMS('prenatal', 'Honey Bee', 'Today'));

    	/**
    	// $today = date('Y-m-d').'%';
    	$today = '2021-01-21%';

    	$prenatals = Prenatal::where('return_date', 'LIkE', $today)->get();
    	foreach ($prenatals as $prenatal) {
    		$mother = $prenatal->pregnant->mother;
    		$name = $mother->firstname.' '.$mother->lastname;
    		$sms = 'This is from your City Health Cadiz, We inform you that today is your prenatal schedule. Thank you. \bNote: Do not reply, Computer generated text.';
    		$this->itextmoSend($mother->contact, $sms, $name);
    	}

			$today = '2021-02-22%';
    	$immunizes = Immunize::where('return_date', 'LIkE', $today)->get();
    	foreach ($immunizes as $immunize) {
    		$child = $immunize->child;
    		$mother = $child->parent->mother;
    		$name = $child->firstname.' '.$child->lastname;
    		$sms = 'This is from your City Health Cadiz, We inform you that today your baby <b>'.$name.'</b> has schedule for immunize. Thank you. \bNote: Do not reply, Computer generated text.';
    		$this->itextmoSend($mother->contact, $sms, $name);
    	}
    	**/

    	// return response()->json($prenatals);
    }

    public function itexmo($number, $msg, $apiCode, $passwd){
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

    public function itextmoSend($number, $message="iTexMo: contact support.", $name='iTexMo') {
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

    	// $response = 'trial';
    	// $alert_message = "testing only.";

        $log = [
		      'name' => $name,
		      'number' => $number,
		      'message' => $message,
		      'send_status' => $response==0?true:false,
		      'status' => $response,
		      'remarks' => $alert_message,
		    ];

        Log::channel('itextmo')->info('iTexMo SMS Response: ', $log);

        return response()->json($log);
    }
}
