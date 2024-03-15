<?php

namespace Modules\Staff\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangepasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'password' => 'required',
            'newpassword' => 'required|min:5',
            'confirmpassword' => 'required|same:newpassword|min:5',
        ];
    }
    public function messages()
    {
        return  [
            'password.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'newpassword.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'newpassword.min' => 'Mật khẩu tối thiểu trên 5 ký tự!',
            'confirmpassword.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'confirmpassword.min' => 'Mật khẩu tối thiểu trên 5 ký tự!',
            'confirmpassword.same' => 'Mật khẩu xác nhận không trùng khớp',
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
