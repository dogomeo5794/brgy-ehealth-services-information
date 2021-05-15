<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogsController extends Controller
{
	public function AccountsLog(Request $request) {
		$filePath = storage_path('logs/accounts.log');
		$data = [];
		if (File::exists($filePath)) {
			$data = [
				'lastModified' => date('Y-m-d h:m:i a', strtotime(File::lastModified($filePath))),
				'size' => File::size($filePath),
				'file' => File::get($filePath)
			];
		}
		return view('pages.admin.accountLogs', ['data' => $data]);
	}

	public function SMSLogs(Request $request) {
		$filePath = storage_path('logs/iTextmo.log');
		$data = [];
		if (File::exists($filePath)) {
			$data = [
				'lastModified' => date('Y-m-d h:m:i a', strtotime(File::lastModified($filePath))),
				'size' => File::size($filePath),
				'file' => File::get($filePath)
			];
		}
		return view('pages.admin.smsLogs', ['data' => $data]);
	}
}
