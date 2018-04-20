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

      /*if ($guardian->uid == $this->user()->id) {
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
          'phone' => 'nullable|string|min:6',
          'address' => 'nullable|string|min:4',
          'plz' => 'nullable|numeric|min:5',
          'city' => 'nullable|string|min:2',
          'parentalStatus' => 'nullable|numeric|min:820|max:822',
          'volumeOfEmployment' => 'nullable|numeric|min:830|max:833',
          'siblings' => 'nullable|numeric|min:840|max:841'
        ];
    }
}
