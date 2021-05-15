<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pregnant;
use App\Child;

class PatientController extends Controller
{
    public function list(Request $request) {
        return view('pages.user.patient');
    }

    public function getList(Request $request) {
        $type = $request->input('list-type');
        if ($type == 'prenatal') {
            $pregnant = Pregnant::with(['mother'])
            ->whereHas('mother')->paginate($this->limit);
            return response()->json($pregnant);
        }
        else if ($type == 'immunize') {
            $children = Child::with(['parent.mother'])->paginate($this->limit);
            return response()->json($children);
        }
    }
}
