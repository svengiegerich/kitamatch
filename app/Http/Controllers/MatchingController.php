<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
Illuminate\Http\RedirectResponse;
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
        $match->save();
    }
    
    public function all() {
        $matches = Matching::all();
        return view('matching.all', array('matches' => $matches));
    }
    
    public function findMatchings() {
        //GuzzleHttp\Client
		$client = new Client(); 
		$response = $client->post('https://api.matchingtools.org/hri/demo?optimum=college-optimal', [
			'auth' => [
				'mannheim', 'Exc3llence!'
			],
			'body' =>
				$this->createJson(),
            'headers' => ['Accept' => 'application/json']
		]);
		
        //status code: $response->getStatusCode(); 
        
        //write the matches 
        $result = json_decode($response->getBody(), true);
        $matchingResult = $result['hri_matching'];
        //temp: set active = 0 for all previous entries
        $Matching = new Matching;
        $Matching->resetMatches();
        foreach ($matchingResult as $match) {
            $this->store($match, 1);
        }
        
        return redirect()->route('matching/all');
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