<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Preference;
use App\Program;
use App\Applicant;
use App\Traits\GetPreferences;

class PreferenceController extends Controller
{
    use GetPreferences;
    
    public function show($prid) {
        $preference = Preference::find($prid);
        return view('preference.show', array('preference' => $preference));
    }
    
    public function all() {
        $preferences = Preference::all();
        return view('preference.all', array('preferences' => $preferences));
    }
    
    // by applicant
    public function showByApplicant($aid) {
        $preferences = $this->getPreferencesByApplicant($aid);
        return view('preference.showByApplicant', array('preferences' => $preferences));
    }
    
    public function addByApplicant(Request $request, $aid) {
        $preference = new Preference;
        
        $preference->id_from = $aid;
        $preference->id_to = $request->to;
        $preference->pr_kind = 1;
        $preference->rank = $request->rank;
        $preference->active = 1;
        
        $preference->save();
        
        return redirect()->action('PreferenceController@showByApplicant', $aid);
    }
    
    public function deleteByApplication(Request $request, $prid) {
        $preference = Preference::find($prid);
        $aid = $preference->id_from;
        //temp: set active=0 instead of deleting
        $preference->delete();
        return redirect()->action('PreferenceController@showByApplicant', $aid);
    }
    
    
    // by program - coordinated
    public function showByProgram($pid) {
        $preferences = $this->getPreferencesByProgram($pid);
        
        //check if coordinated or not
        $program = Program::find($pid);
        print_r($program);
        if ($program->coordination == 1) {
            return view('preference.showByProgram', array('preferences' => $preferences));
        } else {
            $program->freeApplicants = Applicant::all();;
            return view('preference.uncoordinated', array('program' => $program));
        }
    }
    
    public function addByProgram(Request $request, $pid) {
        $preference = new Preference;
        
        $preference->id_from = $pid;
        $preference->id_to = $request->to;
        $preference->pr_kind = 2;
        $preference->rank = $request->rank;
        $preference->active = 1;
        
        $preference->save();
        
        return redirect()->action('PreferenceController@showByProgram', $pid);
    }
    
    public function deleteByProgram(Request $request, $prid) {
        $preference = Preference::find($prid);
        $pid = $preference->id_from;
        //temp: set active=0 instead of deleting
        $preference->delete();
        return redirect()->action('PreferenceController@showByProgram', $pid);
    }
    
    // by program - uncoordinated
    public function addUncoordinatedProgram(Request $request, $pid) {
        $preference = new Preference;
        
        $preference->id_from = $pid;
        $preference->id_to = $request->aid;
        $preference->pr_kind = 3;
        //temp: which rank?
        $preference->rank = -1;
        $preference->active = 1;
        
        $preference->save();
        
        return redirect()->action('PreferenceController@showByProgram', $pid);
    }
}