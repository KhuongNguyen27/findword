<?php

namespace Modules\AdminUser\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|max:255',
            'password' => 'required',
            'email' => 'required|email|unique:users,email|max:255',
        ];
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = 'required';
            unset($rules['password']);
        }
        return $rules;
    }
    function messages():array
    {
        return $messages = [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Vui lòng nhập tên có độ dài dưới 255 kí tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Tên email đã sử dụng',
            'email.max'=>'Tên email phải có độ dài dưới 255 kí tự',
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