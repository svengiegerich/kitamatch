<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProgramController;

//Guzzle
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Matching;
use App\Applicant;
use App\Program;
use App\Traits\GetPreferences;

class MatchingController extends Controller
{
    use GetPreferences;
    
    public function getMatchings() {

	
		$client = new Client(); //GuzzleHttp\Client
		$result = $client->post('https://api.matchingtools.org/hri/demo', [
			'form_params' => [
				'header' => 'Content-Type: application/json',
				'u' => 'mannheim:Exc3llence!',
				'd' => $this->createJson()
			]
		]);
		print_r($result);
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
            $preferencesByProgram = $this->getPreferencesByProgram($program->pid);
			
			print_r($preferencesByProgram);
			
			$preferenceList = array();
			foreach ($preferencesByProgram as $preference) {
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
			$capacityList[$pid] = app('App\Http\Controllers\ProgramController')->getCapacity($program->pid);
		}
		$json["college_capacity"] = $capacityList;
		return (json_encode($json));
    }
}