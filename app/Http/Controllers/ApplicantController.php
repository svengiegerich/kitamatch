<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $guardian = Guardian::find($gid);
        return view('applicant.add', array('guardian' => $guardian));
    }
    
    public function create(Request $request, $gid) {
        $request->request->add(['gid' => $gid]);
        $this->store($request);
        return redirect()->action('Guardian@show', [$gid]);
    }
    
    public function store(Request $request) {
        //Validation
        
        $applicant = new Applicant;
        $applicant->gid = $request->gid;
        $applicant->first_name = $request->firstName;
        $applicant->last_name = $request->lastName;
        $applicant->birthday = $request->birthday;
        $applicant->gender = $request->gender;
        //status: 1->active, 0->inactive, ...
        //tmp
        $applicant->status = 1;
        
        $applicant->save();
    }
    
    public function show($aid) {
        $applicant = Applicant::find($aid);
        print_r("eh");
        return view('applicant.edit', array('applicant' => $applicant));
    }
    
    public function all() {
        $applicants = Applicant::all();
        return view('applicant.all', array('applicants' => $applicants));
    }
    
    public function edit(Request $request, $aid) {
        print_r("huh");
        $request->request->add(['aid' => $aid]);
        $applicant = $this->update($request);
        return view('applicant.edit', array('applicant' => $applicant));
    }
    
    public function delete(Request $request, $aid) {
        $applicant = applicant::find($aid);
        //temp: set active=0 instead of deleting
        $applicant->delete();
        return redirect()->action('ApplicantController@all');
    }
    
    public function update($request) {
        $applicant = Applicant::find($request->aid);
        $applicant->first_name = $request->firstName;
        $applicant->last_name = $request->lastName;
        $applicant->gender = $request->gender;
        $applicant->birthday = $request->birthday;
        $applicant->save();
        return $applicant;
    }
}
