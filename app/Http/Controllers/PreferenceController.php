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
    
    public function addByApplicant(Request $request) {
        $preference = new Preference;
        
        
        print_r($request);
        //$preference->id_from = $request->preference-id-from;
        //$preference->id_to = $request->preference-id-to;
        
        $preference->save();
        
        return redirect()->action('PreferenceController@all');
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