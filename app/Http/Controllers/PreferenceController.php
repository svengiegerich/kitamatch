<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Preference;

class PreferenceController extends Controller
{
    
    
    public function show($prid) {
        $preference = Preference::find($prid);
        return view('preference.show', array('preference' => $preference));
    }
    
    public function showByApplicant($aid) {
        $preferences = $this->getPreferencesByApplicant($aid);
        return view('preference.showByApplicant', array('preferences' => $preferences));
    }
    
    public function all() {
        $preference = Preference::all();
        return view('preference.all', array('preferences' => $preferences));
    }
    
    
    //get all preferences of an applicant
    private function getPreferencesByApplicant($aid) {
        $preferences = App\Preference::whereColumn([
                                        ['aid', '=', $aid],
                                        ['active', '=', 1],
                                            ])
                            ->orderBy('rank', 'asc')
                            ->get();
        return $preferences;
    }
    
    //get all preferences of an program
    private function getPreferencesByProgram($pid) {
        $preferences = App\Preference::whereColumn([
                                        ['pid', '=', $pid],
                                        ['active', '=', 1],
                                            ])
                            ->orderBy('rank', 'asc')
                            ->get();
        return $preferences;
    }
    
}