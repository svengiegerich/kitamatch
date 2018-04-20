<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Guardian;

class UpdateGuardianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      /*$guardianId = $this->route('guardian');
      $guardian = Guardian::find($guardianId);
      if ($guardian->uid == $this->user()->id) {
        return true;
      } else {
        return false;
      }*/
      return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'firstName' => 'required|string|min:2',
          'lastName' => 'required|string|min:2',
        ];
    }
}
