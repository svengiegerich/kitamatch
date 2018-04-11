<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Applicant;
use App\Guardian;

class ApplicantController extends Controller
{
    public function index() {
        return view('applicant.index');
    }
    
    public function add($gid) {
        $guardian = Guardian::findOrFail($gid);
        return view('applicant.add', array('guardian' => $guardian));
    }
    
    public function create(Request $request, $gid) {
        $request->request->add(['gid' => $gid]);
        $this->store($request);
        return redirect()->action('GuardianController@show', $gid);
    }
    
    public function store(Request $request) {
        //Validation
        $applicant = new Applicant;
        $applicant->gid = $request->gid;
        $applicant->first_name = $request->firstName;
        $applicant->last_name = $request->lastName;
        $applicant->birthday = $request->birthday;
        $applicant->gender = $request->gender;
        $applicant->status = 21; 
        $applicant->save();
        
        //tmp: set all valid
        $this->setValid($applicant->id);
        
        return $applicant;
    }
    
    public function show($aid) {
        $applicant = Applicant::findOrFail($aid);
        return view('applicant.edit', array('applicant' => $applicant));
    }
    
    public function all() {
        $applicants = Applicant::all();
        return view('applicant.all', array('applicants' => $applicants));
    }
    
    public function edit(Request $request, $aid) {
        $request->request->add(['aid' => $aid]);
        $applicant = $this->update($request);
        return view('applicant.edit', array('applicant' => $applicant));
    }
    
    public function delete(Request $request, $aid) {
        $applicant = applicant::findOrFail($aid);
        //temp: set active=0 instead of deleting
        $applicant->delete();
        return redirect()->action('ApplicantController@all');
    }
    
    public function update(Request $request) {
        $applicant = Applicant::findOrFail($request->aid);
        if ($request->firstName) { $applicant->first_name = $request->firstName; }
        if ($request->lastName) { $applicant->last_name = $request->lastName; }
        if ($request->gender) { $applicant->gender = $request->gender; }
        if ($request->birthday) { $applicant->birthday = strtotime($request->birthday); }
        if ($request->status) { $applicant->status = $request->status; }
        $applicant->save();
        return $applicant;
    }
    
    public function setFinalMatch($aid) {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(['aid' => $aid,
                               'status' => 26]);
        $this->update($request);
    }
    
    public function setValid($aid) {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(['aid' => $aid,
                               'status' => 22]);
        $this->update($request);
    }
    
    public function setPriority($aid) {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(['aid' => $aid,
                               'status' => 25]);
        $this->update($request);
    }
} 
