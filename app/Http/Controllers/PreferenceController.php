<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Applicant;

class PreferenceController extends Controller
{
    
    
    public function show($prid) {
        $preference = Applicant::find($prid);
        return view('preference.show', array('preference' => $prefence));
    }
    
}