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
            'name' => 'required',
            'email' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'website' => 'required',
        ];
    }

    public function messages()
    {
        return  [
            'name.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'email.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'name.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'phone.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'address.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'website.required' => 'Vui lòng nhập đầy đủ thông tin!',
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
