<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Program;

use App\Matching;
use App\Applicant;
use App\Program;
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

		//by applicant
        $applicants = Applicant::all();
        foreach ($applicants as $applicant) {
            $preferencesByApplicant = $this->getPreferencesByApplicant($applicant->aid);
			
			$preferenceList = array();
			foreach ($preferencesByApplicant as $preference) {
				$preferenceList[] = (string)$preference->id_to;
			}
			$preferencesApplicants[$applicant->aid] = $preferenceList;
        }
		$json["student_prefs"] = $preferencesApplicants;
        
        //by program
		$programs = Program::all();
        foreach ($programs as $program) {
            $preferencesByProgram = $this->getPreferencesByProgram($applicant->pid);
			
			$preferenceList = array();
			foreach ($preferencesByPorgram as $preference) {
				$preferenceList[] = (string)$preference->id_to;
			}
			$preferencesPrograms[$program->pid] = $preferenceList;
        }
		$json["college_prefs"] = $preferencesPrograms;
		
        //by capacity
		$capacityList = array();
		$Program = new program;
		foreach ($programs as $program) {
			$pid = (string)$program->pid;
			$capacityList[$pid] = $Program->getCapacity($program->pid);
		}
		$json["college_capacity"] = $capacityList;
		
		echo json_encode($json);
    }
}