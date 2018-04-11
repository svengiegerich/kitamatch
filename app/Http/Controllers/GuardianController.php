<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Guardian;
use App\Applicant;

class GuardianController extends Controller
{    
    public function store(Request $request) {
        //Validation
        
        $guardian = new Guardian;
        $guardian->uid = $request->uid;
        $guardian->first_name = $request->firstName;
        $guardian->last_name = $request->lastName;
        $guardian->status = 51;
        $guardian->address = $request->address;
        $guardian->city = $request->city;
        $guardian->plz = $request->plz;
        $guardian->phone = $request->phone;
        $guardian->siblings = $request->siblings;
        $guardian->parental_status = $request->parentalStatus;
        $guardian->volume_of_employment = $request->volumeOfEmployment;
        
        $guardian->save();
        
    }
    
    public function show($gid) {
        $Applicant = new Applicant;
        
        $guardian = Guardian::findOrFail($gid);
        $applicants = $Applicant->getAppliantsByGid($gid);
        return view('guardian.edit', array('guardian' => $guardian,
                                          'applicants' => $applicants));
    }
    
    public function edit(Request $request, $gid) {
        $request->request->add(['gid' => $gid]);
        $guardian = $this->update($request);
        return redirect()->action('GuardianController@show', $guardian->gid);
    }
    
    public function update(Request $request) {
        $guardian = Guardian::findOrFail($request->gid);
        $guardian->first_name = $request->firstName;
        $guardian->last_name = $request->lastName;
        $guardian->status = $request->status;
        $guardian->address = $request->address;
        $guardian->city = $request->city;
        $guardian->plz = $request->plz;
        $guardian->phone = $request->phone;
        $guardian->siblings = $request->siblings;
        $guardian->parental_status = $request->parentalStatus;
        $guardian->volume_of_employment = $request->volumeOfEmployment;
        $guardian->save();
        return $guardian;
    }
    
    public function all() {
        $guardians = Guardian::all();
        //add mail 
        foreach ($guardians as $guardian) {
            $user = Guardian::where('uid', '=', $guardian->uid)->first();
            $guardian->email = $user->email;
        }
        return view('guardian.all', array('guardians' => $guardians));
    }
    
    public function verify($gid) {
        $Applicant = new Applicant;
        
        //verify guardian
        $requestG = new Request();
        $requestG->setMethod('POST');
        $requestG->request->add(['gid' => $gid,
                                'status' => 52
                                ]);
        $this->update($requestG);
        
        //verfiy applicant(s)
        $applicants = $Applicant->getAppliantsByGid($gid);
        foreach ($applicants as $applicant) {
            app('App\Http\Controllers\ApplicantController')->setValid($applicant->aid);
        }
        
        return redirect()->action('GuardianController@all');
    }
}
