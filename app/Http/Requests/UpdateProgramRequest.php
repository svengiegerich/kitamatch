<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
        'name' => 'required|string|min:5',
        'capacity' => 'required|numeric|min:1|max:200',
        'phone' => 'nullable|string|min:6',
        'address' => 'nullable|string|min:4',
        'plz' => 'nullable|numeric|min:5',
        'city' => 'nullable|string|min:2',
      ];
    }
}
