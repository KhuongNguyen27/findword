<?php

namespace Modules\Employee\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'website' => 'required',
            'about' => 'required',
        ];
    }

    public function messages()
    {
        return  [
            'required' => 'Vui lòng nhập đầy đủ thông tin!',
            'max' => 'Tên không được vượt quá 100 ký tự!',
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