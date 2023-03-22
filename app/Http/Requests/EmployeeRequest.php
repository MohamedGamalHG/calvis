<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends ApiRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'      =>'required|min:3|max:20',
            'last_name'      =>'required|min:3|max:20',
            'email'     =>'required|unique:companies',
            'phone'   => 'required|regex:/[0-9]/',
            'company'   => 'required'
        ];
    }
}
