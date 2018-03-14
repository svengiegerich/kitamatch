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
    
    public function store($request, $active) {
        $match = new Matching;
        $match->aid = $request['student'];
        $match->pid = $request['college'];
        $match->active = $active;
        print_r($request);
        $match->save();
    }
    
    public function findMatchings() {
		/*$url = 'https://api.matchingtools.org/hri/demo';

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec ($ch);
		$info = curl_getinfo($ch);
		$http_result = $info ['http_code'];
		curl_close ($ch);
	*/
		$client = new Client(); //GuzzleHttp\Client
		$response = $client->post('https://api.matchingtools.org/hri/demo?optimum=college-optimal', [
			'auth' => [
				'mannheim', 'Exc3llence!'
			],
			'body' =>
				$this->createJson(),
            'headers' => ['Accept' => 'application/json']
		]);
		
        //status code: $response->getStatusCode(); 
        echo $response->getBody();
        
        $result = json_decode($response->getBody(), true);
        $matchingResult = $result['hri_matching'];
        //temp: set active = 0 for all previous entries
        $Matching = new Matching;
        $Matching->resetMatchings();
        foreach ($matchingResult as $match) {
            $this->store($match, 1);
        }
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