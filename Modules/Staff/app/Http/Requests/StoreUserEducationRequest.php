<?php

namespace Modules\Staff\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserEducationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'numerical' => 'required|max:255',
            'rank_id' => 'required',
            'school_course' => 'required|max:255',
            'graduation_date' => 'required',
            'language' => 'required',
            'major' => 'required|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'numerical.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'school_course.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'start_date.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'graduation_date.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'major.required' => 'Vui lòng nhập đầy đủ thông tin',
            'language.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'max'=>'Vui lòng không nhập quá 255 kí tự'
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
