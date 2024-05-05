<?php

namespace Modules\Auth\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'phone' => 'required',
            'birthdate' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'repeatpassword' => 'required|same:password',
            'accept_pp' => 'accepted',
        ];
    }

    public function messages()
    {
        return  [
            'name.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'name.max' => 'Tên không được vượt quá 255 ký tự!',
            'phone.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'year_of_birth.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'email.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'email.unique' => 'Email này đã được sử dụng !',
            'password.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'repeatpassword.required' => 'Vui lòng nhập đầy đủ thông tin!',     
            'accept_pp.accepted' => 'Vui lòng chấp nhận các điều khoản!',
            ];
    }
}