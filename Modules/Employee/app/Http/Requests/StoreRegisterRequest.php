<?php

namespace Modules\Employee\app\Http\Requests;

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
            'name' => 'required|max:100',
            'email' => 'required|unique:users|email',
            'cp_name' => 'required|max:100',
            'phone' => 'required|min:10|max:11',
            'address' => 'required|max:255',
            'website' => 'required|max:255',
            'password' => 'required|min:6|max:255',
            'repeatpassword'=> 'required|same:password|max:255',
            'image'=> 'required|max:255',
            'year_of_birth'=> 'required|min:4|max:4',
        ];
    }

    public function messages()
    {
        return  [
            'name.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'name.max' => 'Tên không được vượt quá 100 ký tự!',
            'email.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'email.unique' => 'Email đã tồn tại!',
            'email.email' => 'Email không hợp lệ!',
            'cp_name.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'cp_name.max' => 'Tên không được vượt quá 100 ký tự!',
            'phone.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'phone.max'=>'Vui lòng nhập đúng định dạng số điện thoại',
            'address.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'website.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'password.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'password.min'=>'Mật khẩu tối thiếu là 6 ký tự',
            'password.max'=>'Mật khẩu tối đa là 25 ký tự',
            'repeatpassword.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'repeatpassword.same' => 'Mật khẩu không khớp!',
            'image.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'year_of_birth'=>'Vui lòng nhập đầy đủ thông tin',
            'year_of_birth.min'=>'Năm sinh chưa đúng định dạng',
            'year_of_birth.max'=>'Năm sinh chưa đúng định dạng',
        ];
    }
}