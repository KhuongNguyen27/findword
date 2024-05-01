<?php

namespace Modules\Employee\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
   

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        // dd(request()->all());

        $rules = [
            'name' => 'required|max:100',
            'career_ids' => 'required',
            'formwork_id' => 'required',
            'deadline' => 'required',
            'experience' => 'required',
            // 'wage_id' => 'required',
            'work_address' => 'required|max:100',
            'province_id' => 'required',
            'country_id' => 'required',
            'country' => 'required|max:100',
            'degree_id' => 'required',
            'country_id' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'rank_id' => 'required',
            'number_day' => 'required',
            'start_day' => 'required',
            'jobpackage_id' => 'required',
            'price' => 'required',
            'end_day' => 'required',
        ];
        if( request()->country == 'NN' ){
            unset( $rules['province_id'] );
        }
        if( request()->country == 'VN' ){
            unset( $rules['country_id'] );
        }
        return $rules;
    }

    public function messages()
    {
        return  [
            'name.required' => 'Trường yêu cầu!',
            'name.max' => 'Tên không được vượt quá 100 ký tự!',
            'career_ids.required' => 'Trường yêu cầu!',
            'formwork_id.required' => 'Trường yêu cầu!',
            'deadline.required' => 'Trường yêu cầu!',
            'experience.required' => 'Trường yêu cầu!',
            'wage_id.required' => 'Trường yêu cầu!',
            'work_address.required' => 'Trường yêu cầu!',
            'degree_id.required' => 'Trường yêu cầu!',
            'country.required' => 'Trường yêu cầu!',
            'province_id.required' => 'Trường yêu cầu!',
            'description.required' => 'Trường yêu cầu!',
            'requirements.required' => 'Trường yêu cầu!',
            'rank_id.required' => 'Trường yêu cầu!',
            'number_day.required' => 'Trường yêu cầu!',
            'start_day.required' => 'Trường yêu cầu!',
            'jobpackage_id.required' => 'Trường yêu cầu!',
            'price.required' => 'Trường yêu cầu!',
            'end_day.required' => 'Trường yêu cầu!',
            'start_hour.required' => 'Trường yêu cầu!',
            'end_hour.required' => 'Trường yêu cầu!',
            'country_id.required' => 'Trường yêu cầu!',
            ];
    }


}