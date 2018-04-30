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
 | Criterium Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Criterium;
use App\Code;

/**
* This controller handles the criteria catalogue: creation, update.
*/
class CriteriumController extends Controller
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
  * Show criteria of a provider. If there are no previous entries for the provider, it duplicates the standard criteria catalogue (calls store() with store_type = 1, indicated by index = -1).
  *
  * @param integer $pid Provider-ID
  * @return view criterium.edit
  */
  public function showByProvider($p_id) {
    $criteria = Criterium::where('p_id', '=', $p_id)
      ->orderBy('rank', 'asc')
      ->get();
    //no criteria found, duplicate default criteria -> store, with store_type = 1
    if (!($criteria->first())) {
      $request = new Request();
      $request->setMethod('POST');
      $request->request->add(['store_type' => 1,
                             'p_id' => $p_id,
                             'program' => 0]);
      $this->store($request);
      $criteria = Criterium::where('p_id', '=', $p_id)
        ->orderBy('rank', 'asc')
        ->get();
    }
    foreach ($criteria as $criterium) {
      $criterium->code_description = Code::where('code', '=', $criterium->criterium_value)->first()->value;
    }
    return view('criterium.edit', array('criteria' => $criteria));
  }

  /**
  * Show criteria of a program. Same structure as showByProvider()
  *
  * @param integer $pid Program-ID
  * @return view criterium.edit
  */
  public function showByProgram($pid) {
    $criteria = Criterium::where('p_id', '=', $pid)
      ->where('program', '=', 1)
      ->orderBy('rank', 'asc')
      ->get();
    //no criteria found, duplicate default criteria -> store, with store_type = 1
    if (!($criteria->first())) {
      $request = new Request();
      $request->setMethod('POST');
      $request->request->add(['store_type' => 1,
                             'p_id' => $pid,
                             'program' => 1]);
      $this->storeByProgram($request);
      $criteria = Criterium::where('p_id', '=', $pid)
        ->where('program', '=', 1)
        ->orderBy('rank', 'asc')
        ->get();
    }
    foreach ($criteria as $criterium) {
      $criterium->code_description = Code::where('code', '=', $criterium->criterium_value)->first()->value;
    }
    return view('criterium.edit', array('criteria' => $criteria));
  }

  /**
  * Edit the rank of the criteria of a program or provider, ajax sided
  *
  * @param App\Http\Requests $request request
  * @return json
  */
  public function editAjax(Request $request) {
    $criteriaIds = $request->all();
    //https://laracasts.com/discuss/channels/laravel/sortable-list-with-change-in-database
    parse_str($request->order, $criteria);
    foreach ($criteria['item'] as $index => $criteriumId) {
        $criterium = Criterium::find($criteriumId);
        $criterium->rank = $index+1;
        $criterium->save();
    }
    return response()->json([
      'success' => true
    ]);
  }

  /**
  * Store criteria by a provider. Right now
  *
  * @param App\Http\Requests $request request
  * @return void
  */
  public function store(Request $request) {
    //duplicate default criteria
    if ($request->store_type == 1) {
            $defaultCriteria = Criterium::where('p_id', '=', -1)->get();
            foreach ($defaultCriteria as $defaultCriterium) {
                $criterium = new Criterium();
                $criterium->criterium_name = $defaultCriterium->criterium_name;
                $criterium->criterium_value = $defaultCriterium->criterium_value;
                $criterium->rank = $defaultCriterium->rank;
                $criterium->multiplier = $defaultCriterium->multiplier;
                $criterium->p_id = $request->p_id;
                $criterium->program = $request->program;
                $criterium->save();
            }
        }
    }

  /**
  * Store criteria by a program. Adds 'program' = 1 to the store() method.
  *
  * @param App\Http\Requests $request request
  * @return void
  */
  public function storeByProgram(Request $request) {
    $request->request->add(['program' => 1]);
    $this->store($request);
  }

  /**
  * Edit a single criterium
  *
  * @param App\Http\Requests $request request
  * @return App\Criterium
  */
  public function edit(Request $request) {
    $criterium = Criterium::find($request->cid);
    if ($request->criterium_name) { $criterium->criterium_name = $request->criterium_name; }
    if ($request->criterium_value) { $criterium->criterium_value = $request->criterium_value; }
    if ($request->rank) { $criterium->rank = $request->rank; }
    if ($request->multiplier) { $criterium->multiplier = $request->multiplier; }
    if ($request->p_id) { $criterium->p_id = $request->p_id; }
    if ($request->program) { $criterium->program = $request->program; }
    $criterium->save();
    return $criterium;
  }
}
