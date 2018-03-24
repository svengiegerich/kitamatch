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
        $guardian->address = $request->address;
        $guardian->city = $request->city;
        $guardian->plz = $request->plz;
        $guardian->phone = $request->phone;
        $guardian->parental_status = $request->parentalStatus;
        $guardian->volume_of_employment = $request->volumeOfEmployment;
        
        $guardian->save();
        
    }
    
    public function show($gid) {
        $guardian = Guardian::find($gid);
        $Applicant = new Applicant;
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
        $guardian = Guardian::find($request->gid);
        $guardian->first_name = $request->firstName;
        $guardian->last_name = $request->lastName;
        $guardian->address = $request->address;
        $guardian->city = $request->city;
        $guardian->plz = $request->plz;
        $guardian->phone = $request->phone;
        $guardian->parental_status = $request->parentalStatus;
        $guardian->volume_of_employment = $request->volumeOfEmployment;
        $guardian->save();
        return $guardian;
    }
}
