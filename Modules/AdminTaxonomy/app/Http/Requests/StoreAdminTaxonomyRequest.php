<?php

namespace Modules\AdminTaxonomy\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminTaxonomyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $tableName = 'taxonomies';
        $modelName = $this->type ? $this->type : '';
        if($modelName){
            $modelClass = '\App\Models\\' . $modelName;
            $tableName = with(new $modelClass)->getTable();
        }
        $rules = [
            'name' => 'required|unique:'.$tableName.',name|max:255',
            'description'=>'required|max:255',
        ];
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = 'required';
        }
        return $rules;
    }
    function messages():array
    {
        return $messages = [
            'name.required'=>'Vui lòng nhập tên',
            'name.max'=>'Tên không được quá 255 ký tự',
            'description'=>'Vui lòng nhập mô tả',
            'description.max'=>'Mô tả phải dưới 255 ký tự',
            'name.unique'=>'Trường này đã tồn tại'
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
