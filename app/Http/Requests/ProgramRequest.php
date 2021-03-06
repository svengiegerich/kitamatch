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
 | Program Request
 |--------------------------------------------------------------------------
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* This class handles the requests of programs
*/
class ProgramRequest extends FormRequest
{
  /**
  * Determine if the user is authorized to make this request.
  *
  * @return bool
  */
  public function authorize() {
      return true;
  }

  /**
  * Validation rules that apply to the request.
  *
  * @return array
  */
  public function rules() {
    return [
      'name' => 'required|string|min:1',
      //'capacity' => 'required|numeric|min:0|max:200',
      'phone' => 'nullable|string|min:6',
      'address' => 'nullable|string|min:4',
      'plz' => 'nullable|numeric|min:5',
      'city' => 'nullable|string|min:2',
    ];
  }
}
