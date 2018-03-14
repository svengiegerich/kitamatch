<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Matching;
use App\Applicant;
use App\Traits\GetPreferences;

class MatchingController extends Controller
{
    use GetPreferences;
    
    public function getMatchings() {
        
    }
    
    public function createJson() {
        //https://matchingtools.com/#operation/hri_demo
        $json = [];
		$preferencesApplicants = [];
		
        $applicants = Applicant::all();
        
        foreach ($applicants as $applicant) {
            $preferencesByApplicant = $this->getPreferencesByApplicant($applicant->aid);
			
			preferenceList = "";
			foreach ($preferencesByApplicant as $preference) {
				$preferenceList .= $preference->id_to;
				$preferenceList .= ",";
			}
			$preferencesApplicants[$applicant->aid] = $preferenceList;
        }
		
		echo json_encode($preferencesApplicants);
        
        //by program
        
        //by capacity
    }
}