<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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
use App\Preference;
use App\Traits\GetPreferences;

class MatchingController extends Controller
{
    use GetPreferences;
    
    public function store($request, $status) {
        $match = new Matching;
        $match->aid = $request['student'];
        $match->pid = $request['college'];
        $match->status = $status;
        $match->save();
    }
    
    public function all() {
        $matches = DB::table('matches')->where('status', '=', 1)->get();
        return view('matching.all', array('matches' => $matches));
    }
    
    public function findMatchings() {
        $Program = new Program;
        $Preference = new Preference;
        $Matching = new Matching;
        
        print $this->createJson();
        
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
        $Matching->resetMatches();
        $Preference->resetUncoordinated();
        
        //store the positiv matches
        foreach ($matchingResult as $match) {
            $this->store($match, 1);
            
            //tmp
            //check if program is uncoordinated
            $coordination = $Program->isCoordinated((int)$match['college']);
            if ($coordination == 0) {
                
                // if then update prefs back to 1
                $preferencesUncoordinated = $this->getPreferencesUncoordinatedByProgram((int)$match['college']);
                echo ";";
                print($match['college']);
                foreach ($preferencesUncoordinated as $preference) {
                    //only for this specific match
                    if ((int)$preference->id_to == (int)$match['student']) {
                        $Preference->updateStatus($preference->prid, 1);
                    }
                }
            }
        }
        
        //return redirect()->action('MatchingController@all');
    }
    
    public function createJson() {
        //https://matchingtools.com/#operation/hri_demo
        $Preference = new Preference;
        
        $json = [];
		$preferencesApplicants = [];
        
        //--------------------
		//by applicant
        $applicants = DB::table('applicants')->where('status', '=', 1)->get();
        foreach ($applicants as $applicant) {
            $preferencesByApplicant = $this->getPreferencesByApplicant($applicant->aid);
			
			$preferenceList = array();
			foreach ($preferencesByApplicant as $preference) {
				$preferenceList[] = (string)$preference->id_to;
			}
            //check if there are any preferences
            if (count($preferenceList) > 0) {
                $preferencesApplicants[$applicant->aid] = $preferenceList;
            }
        }
		$json["student_prefs"] = $preferencesApplicants;
        
        //--------------------
        //by program
        
        //-first: only program that take part in the coordinated way
        $programsC = DB::table('programs')->where([
                ['status', '=', 1],
                ['coordination', '=', 1]
            ])
            ->get();
        foreach ($programsC as $program) {
            $preferencesByProgram = $this->getPreferencesByProgram($program->pid);
			
			$preferenceList = array();
			foreach ($preferencesByProgram as $preference) {
				$preferenceList[] = (string)$preference->id_to;
			}
            //check if there are any preferences
            if (count($preferenceList) > 0) {
                $preferencesPrograms[$program->pid] = $preferenceList;
            }
        }
		
        //-second: add the programs that take the uncoordinated way
        $programsU = DB::table('programs')->where([
                ['status', '=', 1],
                ['coordination', '=', 0]
            ])
            ->get();
        foreach ($programsU as $program) {
            $preferencesByProgram = $this->getPreferencesUncoordinatedByProgram($program->pid);
			$preferenceList = array();
			foreach ($preferencesByProgram as $preference) {
				$preferenceList[] = (string)$preference->id_to;
			}
            //check if there are any preferences
            if (count($preferenceList) > 0) {
                $preferencesPrograms[$program->pid] = $preferenceList;
            }
        }

        $json["college_prefs"] = $preferencesPrograms;
        
        //--------------------
        
        //by capacity
		$capacityList = array();
		$Program = new program;
        //coordinated
		foreach ($programsC as $program) {
			if ($Preference->hasPreferencesByProgram($program->pid)) {
                $pid = (string)$program->pid;
			    $capacityList[$pid] = app('App\Http\Controllers\ProgramController')->getCapacity($program->pid);
            }
		}
        
        //uncoordinated
        foreach ($programsU as $program) {
            if ($Preference->hasPreferencesByProgram($program->pid)) {
                $pid = (string)$program->pid;
                $capacityList[$pid] = app('App\Http\Controllers\ProgramController')->getCapacity($program->pid);
            }
		}
		$json["college_capacity"] = $capacityList;
		return (json_encode($json));
    }
}