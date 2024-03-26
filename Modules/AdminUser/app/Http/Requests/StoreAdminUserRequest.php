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
        if(request()->type == 'staff'){
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:255',
                'phone' => 'required',
                'name' => 'required',
                'birthdate' => 'required',
                'experience_years' => 'required',
                'gender' => 'required',
                'city' => 'required',
                'address' => 'required',
                'outstanding_achievements' => 'required',
            ];
        }
        if(request()->type == 'employee'){
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:255',
                'phone' => 'required',
                'name' => 'required',
                'name_company' => 'required',
                'address' => 'required',
                'website' => 'required',
                'about' => 'required',
            ];
        }
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = 'required';
            unset($rules['password']);
        }
        return $rules;
    }
    public function messages():array
    {
        return [
            'required'=>'Vui lòng điền đẩy đủ thông tin',
            'max'=>'Không quá 255 ký tự',
            'unique'=>'Tên đã sử dụng'
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