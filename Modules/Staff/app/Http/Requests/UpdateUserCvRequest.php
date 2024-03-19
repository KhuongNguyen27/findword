<?php

namespace Modules\Staff\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserCvRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'cv_file' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'city' => 'required',
            'address' => 'required',
            'desired_position' => 'required',
            'desired_rank' => 'required',
            'employment_type' => 'required',
            'industry' => 'required',
            'desired_location' => 'required',
            'desired_salary' => 'required|numeric',
            'career_objective' => 'required',
        ];
    }
   
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
