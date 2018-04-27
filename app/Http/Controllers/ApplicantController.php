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
 | Applican Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Requests\ApplicantRequest;
use App\Http\Controllers\Controller;
use App\Applicant;
use App\Guardian;


/**
* This controller handles with applicants: the creation of new and update of existing ones, as well as status changes (e.g. priority match).
*/
class ApplicantController extends Controller
{
  /**
   * Create a new controller instance, handle authentication
   *
   * @return void
   */
  public function __construct() {
      $this->middleware('auth');
  }

  /**
  * Call the 'add applicant' view
  *
  * @param integer $gid Guardian-ID
  * @return view applicant.add
  */
  public function add($gid) {
    $guardian = Guardian::findOrFail($gid);
    return view('applicant.add', array('guardian' => $guardian));
  }

  /**
  * Handle the creation of an applicant
  *
  * @param App\Http\Requests\ApplicantRequest $request
  * @param integer $gid Guardian-ID
  * @return action PreferenceController@showByApplicant
  */
  public function create(ApplicantRequest $request, $gid) {
      $request->request->add(['gid' => $gid]);
      $applicant = $this->store($request);
      return redirect()->action('PreferenceController@showByApplicant', ['aid' => $applicant->aid]);
  }

  /**
  * Store a new applicant
  *
  * @param App\Http\Requests\ApplicantRequest $request
  * @param integer $gid Guardian-ID
  * @return action PreferenceController@showByApplicant
  */
  public function store(ApplicantRequest $request) {
    $applicant = new Applicant;
    $applicant->gid = $request->gid;
    $applicant->first_name = $request->firstName;
    $applicant->last_name = $request->lastName;
    $applicant->birthday = strtotime($request->birthday);
    $applicant->gender = $request->gender;
    $applicant->status = 21;
    $applicant->save();
    return $applicant;
  }

  /**
  * Show a single applicant
  *
  * @param integer $aid Applicant-ID
  * @return view applicant.edit
  */
  public function show($aid) {
    $applicant = Applicant::findOrFail($aid);
    $guardian = Guardian::find($applicant->gid);
    $applicant->guardianName = $guardian->last_name . " " . $guardian->first_name;
    return view('applicant.edit', array('applicant' => $applicant));
  }

  /**
  * Show all applicants
  *
  * @return view applicant.all
  */
  public function all() {
    $applicants = Applicant::all();
    return view('applicant.all', array('applicants' => $applicants));
  }

  /**
  * Call the 'edit applicant' view
  *
  * @param App\Http\Requests\ApplicantRequest $request
  * @param integer $aid Applicant-ID
  * @return view applicant.edit
  */
  public function edit(ApplicantRequest $request, $aid) {
    $request->request->add(['aid' => $aid]);
    $applicant = $this->update($request);
    return view('applicant.edit', array('applicant' => $applicant));
  }

  /**
  * Delete an applicant
  *
  * @param App\Http\Requests\ApplicantRequest $request
  * @param integer $aid Applicant-ID
  * @return action ApplicantController@all
  */
  public function delete(ApplicantRequest $request, $aid) {
    $applicant = applicant::findOrFail($aid);
    $applicant->delete();
    return redirect()->action('ApplicantController@all');
  }

  /**
  * Update an applicant
  *
  * @param App\Http\Requests\ApplicantRequest $request
  * @return App\Applicant
  */
  public function update(ApplicantRequest $request) {
    $applicant = Applicant::findOrFail($request->aid);
    if ($request->firstName) { $applicant->first_name = $request->firstName; }
    if ($request->lastName) { $applicant->last_name = $request->lastName; }
    if ($request->gender) { $applicant->gender = $request->gender; }
    if ($request->birthday) { $applicant->birthday = strtotime($request->birthday); }
    if ($request->status) { $applicant->status = $request->status; }
    $applicant->save();
    return $applicant;
  }

  /**
  * Update status of an applicant to the final successfull matching status (applicant got first preference and is out of the matching process)
  *
  * @param integer $aid Applicant-ID
  */
  public function setFinalMatch($aid) {
    Applicant::where('aid', '=', $aid)->update(array('status' => '26'));
  }

  /**
  * Update status of an applicant to verified
  *
  * @param integer $aid Applicant-ID
  */
  public function setValid($aid) {
    Applicant::where('aid', '=', $aid)->update(array('status' => '22'));
  }

  /**
  * Update status of an applicant to priority for matching (first in line)
  *
  * @param integer $aid Applicant-ID
  */
  public function setPriority($aid) {
    Applicant::where('aid', '=', $aid)->update(array('status' => '25'));
    return redirect()->action('ApplicantController@show', $aid);;
  }
}
