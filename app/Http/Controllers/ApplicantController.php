<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Applicant;

class ApplicantController extends Controller
{
    public function index() {
	   
        
        return view('applicant.index');
    }
    
    public function show($aid) {
        $applicant = Applicant::find($aid);
        return view('applicant.show', array('applicant' => $applicant));
    }
    
    public function getAll() {
        $applicants = Applicant::all();
        return view('applicant.all', array('applicants' => $applicants))
    }
    
    public function edit($aid) {
        //
    }
    
    public function update($aid) {
        //
    }
}
