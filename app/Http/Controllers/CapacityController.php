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
 | Capacity Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Capacity;

/**
* This controller handles the criteria catalogue: creation, update.
*/
class CapacityController extends Controller
{
  /**
   * Create a new controller instance, handle authentication
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  public function update($request) {
    $capacity = Capacity::find($request->id);
    $capacity->capacity = $request->capacity;
    $capacity->save();
    return $capacity;
  }

  public function updateByProgram($request) {
    $inputs = $request->input();
    foreach($inputs as $key => $value) {
      print($key)
      if (strpos($key, 'capacity_') == TRUE) {
        $id = substr($key, 9);
        print($id);
        print($value);
        $capacity = Capacity::find($id);
        $capacity->capacity = $value;
        $capacity->save();
      }
    }
  }

  public function getProgramCapacities($pid) {
    $capacities = Capacity::where('pid', '=', $pid) // default criteria of municipality
      ->orderBy('care_start', 'care_scope')
      ->get();

    return $capacities;
  }

}
