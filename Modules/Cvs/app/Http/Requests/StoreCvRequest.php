<?php

namespace Modules\Cvs\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCvRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'       => 'required|max:100',
            'career_ids' => 'required',
            'style_ids'     => 'required',
            'language'   => 'required',
            'image'      => 'required',
            'file_cv'    => 'required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'required' => 'Trường yêu cầu',
            'max'     => 'Tối đa 100 kí tự'
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