<?php
/*
 * This file is part of the KitaMatch app.
 *
 * (c) Sven Giegerich <sven.giegerich@mailbox.org>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 /*
 |--------------------------------------------------------------------------
 | Preference Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PreferenceRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Preference;
use App\Program;
use App\Provider;
use App\Matching;
use App\Applicant;
use App\Traits\GetPreferences;

/**
* This controller handles the preferences of applicants & programs: add/edit, arrange preferences, distinguish betwenn coordinated & uncoordinated programs.
*/
class PreferenceController extends Controller
{
  //include the trait 'GetPreferences'
  use GetPreferences;

  /**
  * Create a new controller instance, handle authentication
  *
  * @return void
  */
  public function __construct() {
        $this->middleware('auth');
  }

  /**
  * Store a single preference
  *
  * @param Illuminate\Http\Request $request request
  * @return App\Preference
  */
  public function store(Request $request) {
    $preference = new Preference;
    $preference->id_from = $request->from;
    $preference->id_to = $request->to;
    $preference->pr_kind = $request->pr_kind;
    //if no pr_kind, than it is the preference from an applicant
    if (!$request->pr_kind) {
      $preference->pr_kind = 1;
    }
    $preference->rank = $request->rank;
    $preference->status = $request->status;
    $preference->save();

    //set active, if pr_kind = 3 & program is status = 13
    if ($preference->pr_kind == 3) {
      $program = Program::find($preference->id_from);
      if ($program->status == 13) {
        $program->update(array('status' => '12'));
      }
    }
    return $preference;
  }

  /**
  * Update a single preference
  *
  * @param Illuminate\Http\Request $request request
  * @return App\Preference
  */
  public function update(Request $request) {
    $preference = Preference::findOrFail($request->prid);
    $preference->id_from = $request->from;
    $preference->id_to = $request->to;
    $preference->pr_kind = $request->pr_kind;
    //if no pr_kind, than it is preference by applicant
    if (!$request->pr_kind) {
      $preference->pr_kind = 1;
    }
    $preference->rank = $request->rank;
    $preference->status = $request->status;
    $preference->save();
    return $preference;
  }

  /**
  * Show all preferences of an applicant on a view
  *
  * @param integer $aid Applicant-ID
  * @return view preference.showByApplicant
  */
  public function showByApplicant($aid) {
    $Applicant = new Applicant;
    $Program = new Program;
    $Provider = new Provider;
    $applicant = $Applicant::find($aid);
    $preferences = $this->getPreferencesByApplicant($aid);
    $programs = $Program->getAll();
    $providers = $Provider::all();
    foreach ($preferences as $preference) {
      $program = $programs->find($preference->id_to);
      $provider = $providers->find($program->proid);
      $preference->programName = $provider->name . " - " . $program->name;
    }
    $select = array();
    $select[-1] = "---";
    foreach ($programs as $program) {
      if (!($preferences->contains('id_to', $program->pid))) {
        $provider = $providers->find($program->proid);
        $select[$program->pid] = $provider->name . " - " . $program->name;
      }
    }
    asort($select);
    return view('preference.showByApplicant', array('preferences' => $preferences,
                                                    'applicant' => $applicant,
                                                    'programs' => $select
    ));
  }

  /**
  * Add a preference of an applicant
  *
  * @param Illuminate\Http\Request $request request
  * @param integer $aid Applicant-ID
  * @return action PreferenceController@showByApplicant
  */
  public function addByApplicant(Request $request, $aid) {
    $Preference = new Preference;
    $rank = $Preference->getLowestRankApplicant($aid) + 1;
    $preference = new Preference;
    $preference->id_from = $aid;
    $preference->id_to = $request->to;
    $preference->pr_kind = 1;
    $preference->rank = $rank;
    $preference->status = 1;
    $preference->save();
    return redirect()->action('PreferenceController@showByApplicant', $aid);
  }

  /**
  * Change the preference orders of a single applicant, ajax sided
  *
  * @param App\Http\Requests $request request
  * @param integer $aid Applicant-ID
  * @return json
  */
  public function reorderByApplicantAjax(Request $request, $aid) {
    $programIds = $request->all();
    //https://laracasts.com/discuss/channels/laravel/sortable-list-with-change-in-database
    parse_str($request->order, $programs);
    foreach ($programs['item'] as $index => $preferenceId) {
      $preference = Preference::find($preferenceId);
      $preference->rank = $index+1;
      $preference->save();
    }
    return response()->json([
      'success' => true
    ]);
  }

  /**
  * Prepare the ajay sided deletion of a single preference by an applicant
  *
  * @param App\Http\Requests $request request
  * @param integer $aid Applicant-ID
  * @return json
  */
  public function deleteByApplicantAjax(Request $request, $aid) {
    $prid = substr($request->itemId, strpos($request->itemId, "-") + 1);
    $this->deleteByApplicant($request, $prid);
    return response()->json([
      'success' => true
    ]);
  }

  /**
  * Delete a single preference by an applicant
  *
  * @param App\Http\Requests $request request
  * @param integer $prid Preference-ID
  * @return App\Preference
  */
  public function deleteByApplicant(Request $request, $prid) {
    $preference = Preference::find($prid);
    //temp: set status=0 instead of deleting
    $preference->status = 0;
    $preference->save();
    return $preference;
  }

  /**
  * Show all preferences of a program on a view
  *
  * @param integer $pid Program-ID
  * @return view preference.showByProgram
  */
  public function showByProgram($pid) {
    //check if coordinated or not
    $program = Program::find($pid);
    if ($program->coordination == 1) {
      //coordination: true
      $Matching = new Matching();
      $Preference = new Preference();

      $matches = $Matching->getMatchesByProgram($program->pid);
      $preferences = $this->getPreferencesByProgram($pid);
      $deletedPreferences = $Preference->getAllDeletedCoordinatedPreferences($pid);
      $program->currentOffers = 0;

      foreach ($preferences as $preference) {
        $preference->openOffer = 0;
        $preference->finalMatch = 0;

        $applicant = Applicant::find($preference->id_to);

        if ($applicant->status == 26 AND $matches->contains('aid', $applicant->aid)) {
          $preference->finalMatch = 1;
          $program->currentOffers = $program->currentOffers + 1;
        } elseif ($matches->where('status', '=', 31)->contains('aid', $applicant->aid)) {
          $preference->openOffer = 1;
          $program->currentOffers = $program->currentOffers + 1;
        }

        $preference->applicantLastName = $applicant->last_name;
        $preference->applicantFirstName = $applicant->first_name;
        $preference->applicantBirthday = $applicant->birthday;
        $preference->applicantGender = $applicant->gender;
      }

      //for all deleted prefs
      foreach ($deletedPreferences as $preference) {
        $applicant = Applicant::find($preference->id_to);
        $preference->applicantLastName = $applicant->last_name;
        $preference->applicantFirstName = $applicant->first_name;
        $preference->applicantBirthday = $applicant->birthday;
        $preference->applicantGender = $applicant->gender;
      }

      return view('preference.showByProgram', array('preferences' => $preferences,
                                                    'program' => $program,
                                                    'matches' => $matches,
                                                    'deletedPreferences' => $deletedPreferences));
    } else {
      //coordination: false
      $Program = new Program();
      $Matching = new Matching();
      $Provider = new Provider();
      $lastMatch = $Matching->lastMatch();
      $preferences = $this->getPreferencesUncoordinatedByProgram($pid);
      $providerId = $Program->getProviderId($pid);
      if ($providerId) {
        $provider = true;
        $program->provider_name = Provider::find($providerId)->name;
      } else {
        $provider = false;
      }
      $Preference = new Preference;
      $availableApplicants = $Preference->getAvailableApplicants($pid);
      $availableApplicants = $Preference->orderByCriteria($availableApplicants, $providerId, $provider);
      //mark every active or closed offer
      //1: active, -1: no match
      //temp: easier?
      $offers = array();
      $openOffers = 0;
      $countWaitlist = 0;
      foreach ($preferences as $preference) {
        foreach ($availableApplicants as $applicant) {
          if ($preference->id_to == $applicant->aid) {
            if ($preference->status == 1) {
              $offers[$applicant->aid]['id'] = $preference->prid;
              $offers[$applicant->aid]['rank'] = $preference->rank;
              $offers[$applicant->aid]['id_to'] = $preference->id_to;
              $offers[$applicant->aid]['id_from'] = $preference->id_from;
              $offers[$applicant->aid]['status'] = $preference->status;
              $offers[$applicant->aid]['updated_at'] = $preference->updated_at;
              if ($applicant->status == 26) {
                $offers[$applicant->aid]['final'] = 1;
              } else {
                $offers[$applicant->aid]['final'] = 0;
              }

              if ($preference->rank == 1) {
                $openOffers++;
              } else {
                $countWaitlist++;
              }

            } else if ($preference->status == -1) {
              $offers[$applicant->aid]['id'] = $preference->prid;
              $offers[$applicant->aid]['final'] = -1;
              $offers[$applicant->aid]['status'] = -1;
            }
          }
        }
      }
      $program->openOffers = $openOffers;
            //create display rank
            /*foreach ($availableApplicants as $applicant) {
                if (array_key_exists($applicant->aid, $offers)) {
                    if ($offers[$applicant->aid] > 0) {
                        $applicant->rank = $applicant->aid - 1000000;
                    } else if ($offers[$applicant->aid] == -1) {
                        $applicant->rank = $applicant->aid + 1000000;
                    }
                }  else {
                    //!!!!!!!!!!! to points
                    $applicant->rank = $applicant->aid;
                }
            }
            $availableApplicants = $availableApplicants->sortBy('rank'); */

      return view('preference.uncoordinated', array('program' => $program,
                                                    'lastMatch' => $lastMatch,
                                                    'availableApplicants' => $availableApplicants,
                                                    'preferences' => $preferences,
                                                    'offers' => $offers)
                  );
    }
  }

  /**
  * Add a preference by program
  *
  * @param App\Http\Requests $request request
  * @param integer $pid Program-ID
  * @return action PreferenceController@showByProgram
  */
  public function addByProgram(Request $request, $pid) {
    $preference = new Preference;
    $preference->id_from = $pid;
    $preference->id_to = $request->to;
    $preference->pr_kind = 2;
    $preference->rank = $request->rank;
    $preference->status = 1;
    $preference->save();
    return redirect()->action('PreferenceController@showByProgram', $pid);
  }

  public function undoByProgram(Request $request, $pid) {
    $preference = Preference::findOrFail($request->prid);
    $preference->status = 1;
    $preference->save();
    return redirect()->action('PreferenceController@showByProgram', $pid);
  }

  /**
  * Update a preference status to 0 by program
  *
  * @param App\Http\Requests $request request
  * @param integer $prid Prefernce-ID
  * @return action PreferenceController@showByProgram
  */
  public function deleteByProgram(Request $request, $prid) {
    $preference = Preference::find($prid);
    $preference->status = -2;
    $preference->save();
    return redirect()->action('PreferenceController@showByProgram', $preference->id_from);
  }

  public function deleteMultipleByProgram(Request $request) {
    foreach($request->deleteRows as $prid) {
      $preference = Preference::find($prid);
      $preference->status = -2;
      $preference->save();
    }
    return redirect()->action('PreferenceController@showByProgram', $preference->id_from);
  }

  /**
  * Add an offer preference by uncoordinated program
  *
  * @param App\Http\Requests $request request
  * @param integer $pid Program-ID
  * @return action PreferenceController@showByProgram
  */
  public function addOfferUncoordinatedProgram(Request $request, $pid) {
    $preference = new Preference;

    $preference->id_from = $pid;
    $preference->id_to = $request->aid;
    $preference->pr_kind = 3;
    $preference->rank = 1;
    $preference->status = 1;
    $preference->save();

    return redirect()->action('PreferenceController@showByProgram', $pid);
  }

  /**
  * Change the preference order in a waitlist by an uncoordinated program, ajax sided
  *
  * @param App\Http\Requests $request request
  * @param integer $pid Program-ID
  * @return json
  */
  public function reorderWaitlistByProgramAjax(Request $request, $pid) {
    $applicantIds = $request->all();
    //https://laracasts.com/discuss/channels/laravel/sortable-list-with-change-in-database
    parse_str($request->order, $applicants);
    foreach ($applicants['item'] as $index => $preferenceId) {
      $preference = Preference::find($preferenceId);
      //waitlist prefs start with rank >= 2 and not 0
      $preference->rank = $index + 2;
      $preference->save();
    }
    return response()->json([
      'success' => $applicants['item']
    ]);
  }

  public function reorderByProgramAjax(Request $request, $pid) {
    $preferenceIds = $request->all();
    parse_str($request->order, $preferences);
    foreach ($preferences['item'] as $index => $preferenceId) {
      $preference = Preference::find($preferenceId);
      //waitlist prefs start with rank >= 2 and not 0
      $preference->rank = $index + 2;
      $preference->save();
    }
    return response()->json([
      'success' => 1
    ]);
  }

  /**
  * Update an waitinglist preference to an definite offer by uncoordinated program
  *
  * @param App\Http\Requests $request request
  * @param integer $prid Preference-ID
  * @return action PreferenceController@showByProgram
  */
  public function updateOfferUncoordinatedProgram(Request $request) {
    $preference = Preference::find($request->prid);
    $preference->rank = 1;
    $preference->save();

    return redirect()->action('PreferenceController@showByProgram', $preference->id_from);
  }

  /**
  * Add a waitlist preference by uncoordinated program
  *
  * @param App\Http\Requests $request request
  * @param integer $pid Program-ID
  * @return action PreferenceController@showByProgram
  */
  public function addWaitlistUncoordinatedProgram(Request $request, $pid) {
    $preference = new Preference;
    $lowestRank = $preference->getLowestRankUncoordinatedProgram($pid);

    $preference->id_from = $pid;
    $preference->id_to = $request->aid;
    $preference->pr_kind = 3;
    if ($lowestRank > 1) {
      $preference->rank = $lowestRank + 1;
    } else {
      $preference->rank = 2;
    }
    $preference->status = 1;
    $preference->save();

    return redirect()->action('PreferenceController@showByProgram', $pid);
  }

  /**
  * Create the preferences of all coordinated programs by their corresponding criteria catalogues.
  *
  * @return void
  */
  public function createCoordinatedPreferences() {
    $Program = new Program;
    //get all programs with coordination = true
    $programs = $Program->getCoordinated();
    foreach ($programs as $program) {
      $this->createCoordinatedPreferencesByProgram($program);
    }
  }

  public function createCoordinatedPreferencesByProgram($program) {
    $Program = new Program;
    $Preference = new Preference;
    $Applicant = new Applicant;
    //$applicants = $Applicant->getAll();
    //not all but only the available ones
    $applicants = $Preference->getAvailableApplicants($program->pid);


    //als eigene funktion bauen & die drüber nur diese aufrufen lassen
      $providerId = $Program->getProviderId($program->pid);
      if ($providerId) {
        $provider = true;
        $p_id = $program->proid;
      } else {
        $provider = false;
        $p_id = $program->pid;
      }

      $applicantsByProgram = $Preference->orderByCriteria($applicants, $p_id, $provider);
      //print_r($applicantsByProgram);

      $rank = 1;
      foreach ($applicantsByProgram as $applicant) {
        //look if preference exists and if it has to be updated
        $preference = Preference::where('id_from', '=', $program->pid)
          ->where('id_to', '=', $applicant->aid)
          ->where('pr_kind', '=', 2)
          ->where('status', '=', 1)->first();
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(['from' => $program->pid,
                                'to' => $applicant->aid,
                                'pr_kind' => 2,
                                'rank' => $rank,
                                'status' => 1
                              ]);
        if ($preference != null) {
          //update
          $request->request->add(['prid' => $preference->prid]);
          $this->update($request);
        } else {
          //generate preference
          $this->store($request);
        }
        $rank = $rank + 1;
      }
  }

  public function rebuildCoordinatedProgramPreferences($pid) {
    $Preference = new Preference();
    $program = Program::find($pid);
    $Preference->deleteAllActivePreferences($pid, 1);
    $this->createCoordinatedPreferencesByProgram($program);

    return redirect()->action('PreferenceController@showByProgram', $pid);
  }

  /**
  * Show a single preference in a view
  *
  * @param integer $prid Preference-ID
  * @return view preference.edit
  */
  public function show($prid) {
    $preference = Preference::find($prid);
    return view('preference.show', array('preference' => $preference));
  }

  /**
  * Show a listed preferences
  *
  * @return view preference.all
  */
  public function all() {
    $preferences = Preference::all();
    return view('preference.all', array('preferences' => $preferences));
  }

}
