<?php

namespace Modules\AdminPost\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|unique:posts,name|max:255',
            'description'=>'required|max:255'
        ];
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = 'required|max:255';
            $rules['description'] = 'required|max:255';
        }
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function messages(){
        return [
            'required' => 'Vui lòng điền đầy đủ thông tin',
            'max' => 'Tối đa 255 kí tự'
        ];
    }
}