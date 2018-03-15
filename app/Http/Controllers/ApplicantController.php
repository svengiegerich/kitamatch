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
    
    public function add() {
        return view('applicant.add');
    }
    
    public function store(Request $request) {
        //Validation
        
        $applicant = new Applicant;
        $applicant->first_name = $request->firstName;
        $applicant->last_name = $request->lastName;
        $applicant->adress = $request->adress;
        
        $applicant->save();
        
        return redirect()->action('ApplicantController@all');
    }
    
    public function show($aid) {
        $applicant = Applicant::find($aid);
        return view('applicant.show', array('applicant' => $applicant));
    }
    
    public function all() {
        $applicants = Applicant::all();
        return view('applicant.all', array('applicants' => $applicants));
    }
    
    public function edit($aid) {
        //
    }
    
    public function update($request) {
        $applicant = App\Applicant::find($request->aid);
        
        //...
        
        $applicant->save();
    }
}
