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
        $matches = DB::table('matches')->whereIn('status', [31, 32])->get();
        foreach ($matches as $match) {
          $applicant = Applicant::where('aid', '=', $match->aid)->first();
          $match->applicant_name = $applicant->last_name . " " . $applicant->first_name;
          $program = Program::where('pid', '=', $match->pid)->first();
          $match->program_name = $program->name;
        }
        return view('matching.all', array('matches' => $matches));
    }

    public function findMatchings() {
        $Program = new Program;
        $Applicant = new Applicant;
        $Preference = new Preference;
        $Matching = new Matching;

        //tmp
        //app('App\Http\Controllers\ProgramController')->activityCheck();

        $input = $this->prepareMatching();

        print_r(json_encode($input));

        echo "<br><br><br><br><br><br>";

        //GuzzleHttp\Client
		      $client = new Client();
		        $response = $client->post('https://api.matchingtools.org/hri/demo?optimum=college-optimal',
            [
			           'auth' => [
				               'mannheim', 'Exc3llence!'
			                  ],
			           'body' =>
				             json_encode($input),
                 'headers' => ['Accept' => 'application/json']
		        ]);

        //status code: $response->getStatusCode();

        //write the matches
        $result = json_decode($response->getBody(), true);
        $matchingResult = $result['hri_matching'];

        print_r($result);
        /*
        //temp: set active = 0 for all previous entries
        $Matching->resetMatches();
        $Preference->resetUncoordinated();

        //store the positiv matches
        foreach ($matchingResult as $match) {
            //check if it's the final match
            if ((int)$match['college'] == (int)$input['student_prefs'][(int)$match['student']][0]) {
                $this->store($match, 32);
                //set applicant status to matched
                app('App\Http\Controllers\ApplicantController')->setFinalMatch($match['student']);
            } else {
                $this->store($match, 31);
            }

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
        }*/
        //return redirect()->action('MatchingController@all');
    }

    public function prepareMatching() {
        //https://matchingtools.com/#operation/hri_demo
        $Preference = new Preference;
        $Applicant = new Applicant;
        $json = [];
        $preferencesApplicants = [];

        app('App\Http\Controllers\PreferenceController')->createCoordinatedPreferences();

        //--------------------
        //by applicant
        $applicants = $Applicant->getAll();
        $programsC = DB::table('programs')
            //exclude status code 13: inactive for 7 days
            ->where('status', '=', 12)
            ->where('coordination', '=', 1)
            ->get();
        $programsU = DB::table('programs')
            ->where('status', '=', 12)
            ->where('coordination', '=', 0)
            ->get();

        foreach ($applicants as $applicant) {
            $preferencesByApplicant = $this->getPreferencesByApplicant($applicant->aid);

            $preferenceList = array();
            foreach ($preferencesByApplicant as $preference) {
              if ($programsC->contains('id_to', $preference->id_to) OR $programsU->contains('id_to', $preference->id_to)) {
                $preferenceList[] = (string)$preference->id_to;
              }
            }
            //check if there are any preferences
            if (count($preferenceList) > 0) {
                $preferencesApplicants[$applicant->aid] = $preferenceList;
            }
        }
        if (count($preferencesApplicants)>0) {
          $json["student_prefs"] = $preferencesApplicants;
        } else {
          return;
        }

        //--------------------
        //by program
        //-first: only program that take part in the coordinated way
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
        foreach ($programsU as $program) {
          $preferencesByProgram = $this->getPreferencesUncoordinatedByProgram($program->pid);
          $preferenceList = array();
			    foreach ($preferencesByProgram as $preference) {
				  //list only active preferences
            if ($preference->status == 1) {
              $preferenceList[] = (string)$preference->id_to;
            }
			    }
        //check if there are any preferences
        if (count($preferenceList) > 0) {
          $preferencesPrograms[$program->pid] = $preferenceList;
        }
      }
      if (count($preferencesPrograms) > 0) {
        $json["college_prefs"] = $preferencesPrograms;
      } else {
        return;
      }

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
		return ($json);
    }
}
