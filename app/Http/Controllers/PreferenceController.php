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
        $preference->status = 1;
        
        $preference->save();
        
        return redirect()->action('PreferenceController@showByApplicant', $aid);
    }
    
    public function deleteByApplication(Request $request, $prid) {
        $preference = Preference::find($prid);
        $aid = $preference->id_from;
        //temp: set status=0 instead of deleting
        $preference->delete();
        return redirect()->action('PreferenceController@showByApplicant', $aid);
    }
    
    
    // by program - coordinated
    public function showByProgram($pid) {
        $preferences = $this->getPreferencesUncoordinatedByProgram($pid);
        
        //check if coordinated or not
        $program = Program::find($pid);
        if ($program->coordination == 1) {
            return view('preference.showByProgram', array('preferences' => $preferences));
        } else {
            //temp: get all open and reassonable applicants
            $availableApplicants = Applicant::all();
            //mark every active offer
            //temp: easier?
            $activeOffers = array();
            foreach ($preferences as $preference) {
                foreach ($availableApplicants as $applicant) {
                    if ($preference->id_to == $applicant->aid) {
                        $activeOffers[$applicant->aid] = 1;
                    }
                }
            }
            return view('preference.uncoordinated', array('program' => $program, 
                                                          'availableApplicants' => $availableApplicants, 
                                                          'preferences' => $preferences,
                                                          'activeOffers' => $activeOffers)
                       );
        }
    }
    
    public function addByProgram(Request $request, $pid) {
        $preference = new Preference;
        
        $preference->id_from = $pid;
        $preference->id_to = $request->to;
        $preference->pr_kind = 2;
        $preference->rank = $request->rank;
        $preference->status = 1;
        
        $preference->save();
        
        return redirect()->action('PreferenceController@showByProgram', $pid);
    }
    
    public function deleteByProgram(Request $request, $prid) {
        $preference = Preference::find($prid);
        $pid = $preference->id_from;
        //temp: set status=0 instead of deleting
        $preference->delete();
        return redirect()->action('PreferenceController@showByProgram', $pid);
    }
    
    // by program - uncoordinated
    public function addUncoordinatedProgram(Request $request, $pid) {
        
        //for the program
        $preference = new Preference;
        
        $preference->id_from = $pid;
        $preference->id_to = $request->aid;
        $preference->pr_kind = 3;
        //temp: which rank? now by time order
        $preference->rank = 1;
        $preference->status = 1;
        
        $preference->save();
        
        //temp?!
        //for the applicant
        //check if a hight ranking from applicant side exists
        $preferenceApplicant = Preference::where('id_from', '=', $request->aid)
            ->where('id_to', '=', $pid)
            ->first();
        //if not also create pref applicant sided
        if ($user === null) {
            $preferenceApplicant = new Preference;

            $preference->id_from = $request->aid;
            $preference->id_to = $pid;
            $preference->pr_kind = 4;
            //temp: which rank? now by time order
            $preference->rank = 1;
            $preference->status = 1;

            $preference->save();
        }
        return redirect()->action('PreferenceController@showByProgram', $pid);
    }
}