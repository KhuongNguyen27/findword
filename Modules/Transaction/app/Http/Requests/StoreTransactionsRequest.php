<?php

namespace Modules\Transaction\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric|gt:0|max:100000000',
            'status' => 'required',
        ];
    }
    function messages():array
    {

        return [
            'amount.required' => 'Vui lòng nhập số tiền',
            'amount.gt' => 'Số tiền phải lớn hơn 0',
            'amount.numeric' => 'Vui lòng nhập số tiền',
            'amount.max' => 'Số tiền vượt quá giới hạn',
            'required' => 'Trường bắt buộc'
        ];
    }
}