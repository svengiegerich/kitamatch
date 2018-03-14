<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Preference;
use App\Traits\GetPreferences;

class PreferenceController extends Controller
{
    use GetPreferences;
    
    public function show($prid) {
        $preference = Preference::find($prid);
        return view('preference.show', array('preference' => $preference));
    }
    
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
    
    public function showByProgram($pid) {
        $preferences = $this->getPreferencesByProgram($pid);
        return view('preference.showByApplicant', array('preferences' => $preferences));
    }
    
    public function all() {
        $preferences = Preference::all();
        return view('preference.all', array('preferences' => $preferences));
    }
}