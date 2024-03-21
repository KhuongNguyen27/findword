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
            'password' => 'required|min:6|max:20|',
            'repeatpassword' => 'required|same:password|max:20|',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập đầy đủ thông tin',
            'repeatpassword.same'=>'Mật khẩu xác nhận không giống nhau',
            'max'=>'Mật khẩu quá dài'
        ];
    }
}
