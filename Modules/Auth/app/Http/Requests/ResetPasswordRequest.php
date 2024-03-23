<?php

namespace Modules\Auth\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|min:6|max:255',
            'repeatpassword' => 'required|same:password|min:6|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Trường yêu cầu',
            'min' => 'Tối thiểu 6 kí tự',
            'max' => 'Tối đa 255 kí tự',
            'same' => 'Mật khẩu nhập lại không giống',
        ];
    }
}