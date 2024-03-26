<?php

namespace Modules\Staff\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserStaffRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'birthdate' => 'required',
            'gender' => 'required',
            'address' => 'required|string|max:255',
            'province_id'=>'required',
            'district_id'=>'required',
            'ward_id'=>'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'name.max' => 'Tên không được qua 255 ký tự',
            'email.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'email.email' => 'Địa chỉ email không đúng',
            'phone.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'phone.numeric' => 'Vui lòng không nhập chữ',
            'birthdate.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'gender.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'city.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'city.max' => 'Tên tỉnh thành phố không được qua 255 ký tự.',
            'address.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'address.max' => 'Địa chỉ không được qua 255 ký tự.',
            'outstanding_achievements.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'outstanding_achievements.max' => 'Thành tích nổi bật không được qua 255 ký tự.',
            'experience_years.required' => 'Vui lòng nhập đầy đủ thông tin.',
            'experience_years.numeric' => 'Vui lòng nhập không nhập chữ', 
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
