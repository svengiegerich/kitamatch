<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Guardian;

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
        return view('guardian.edit', array('guardian' => $guardian));
    }
    
    public function edit(Request $request) {
        
    }
}
