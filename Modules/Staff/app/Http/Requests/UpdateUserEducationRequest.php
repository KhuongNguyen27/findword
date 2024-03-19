<?php

namespace Modules\Staff\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserEducationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'numerical' => 'required',
            'rank_id' => 'required',
            'school_course' => 'required',
            'graduation_date' => 'required',
            'language' => 'required',
            'major' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'numerical.required' => 'Vui lòng nhập đầy đủ thông tincdasd',
            'school_course.required' => 'Vui lòng nhập đầy đủ thông tin.đâsd',
            'start_date.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'graduation_date.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'major.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'language.required' => 'Vui lòng nhập đầy đủ thông tin.',
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
