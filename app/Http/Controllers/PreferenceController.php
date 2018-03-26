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
        $Applicant = new Applicant;
        $applicant = $Applicant::find($aid);
        $preferences = $this->getPreferencesByApplicant($aid);
        return view('preference.showByApplicant', array('preferences' => $preferences,
                                                       'applicant' => $applicant
        ));
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
        //check if coordinated or not
        $program = Program::find($pid);
        if ($program->coordination == 1) {
            //coordination: true
            $preferences = $this->getPreferencesByProgram($pid);
            
            return view('preference.showByProgram', array('preferences' => $preferences,
                                                         'program' => $program));
        } else {
            //coordination: false
            
            $preferences = $this->getPreferencesUncoordinatedByProgram($pid);
            
            $Preference = new Preference;
            $availableApplicants = $Preference->getAvailableApplicants($pid);
            
            //mark every active or closed offer
            //1: active, -1: no match
            //temp: easier?
            $offers = array();
            $openOffers = 0;
            foreach ($preferences as $preference) {
                foreach ($availableApplicants as $applicant) {
                    if ($preference->id_to == $applicant->aid) {
                        if ($preference->status == 1) {
                            $offers[$applicant->aid] = $preference->prid;
                            $openOffers++;
                        } else if ($preference->status == -1) {
                            $offers[$applicant->aid] = -1;
                        }
                    }
                }
            }
            
            foreach ($availableApplicants as $applicant) {
                if (array_key_exists($applicant->aid, $offers)) {
                    if ($offers[$applicant->aid] > 0) {
                        $applicant->rank = 1;
                    } else if ($offers[$applicant->aid] == -1) {
                        $applicant->rank = -1;
                    }
                }  else {
                    $applicant->rank = 0;
                }
            }
            
            $program->openOffers = $openOffers;
            $availableApplicants = $availableApplicants->sortBy('rank', 'arsort'); 
            
            print_r($availableApplicants);
            
            return view('preference.uncoordinated', array('program' => $program, 
                                                          'availableApplicants' => $availableApplicants, 
                                                          'preferences' => $preferences,
                                                          'offers' => $offers)
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
        /*$preferenceApplicant = Preference::where('id_from', '=', $request->aid)
            ->where('id_to', '=', $pid)
            ->first();
        //if not also create pref applicant sided
        if ($preferenceApplicant === null) {
            $preferenceApplicant = new Preference;

            $preferenceApplicant->id_from = $request->aid;
            $preferenceApplicant->id_to = $pid;
            $preferenceApplicant->pr_kind = 4;
            //temp: which rank? now by time order
            $preferenceApplicant->rank = 1;
            $preferenceApplicant->status = 1;

            $preferenceApplicant->save();
        }*/
        return redirect()->action('PreferenceController@showByProgram', $pid);
    }
}