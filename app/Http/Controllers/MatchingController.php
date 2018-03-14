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
		$preferenceList = [];
		
        $applicants = Applicant::all();
        
        foreach ($applicants as $applicant) {
            $preferencesByApplicant = $this->getPreferencesByApplicant($applicant->aid);
			
			foreach ($preferencesByApplicant as $preference) {
				$preferenceList[$applicant->aid][] = $preference->id_to;
			}
			
        }
		
		print_r ($preferenceList);
        
        //by program
        
        //by capacity
    }
}