<?php

namespace Modules\Transaction\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|gt:0|max:100',
        ];
    }
    function messages():array
    {

        return [
            'amount.required' => 'Vui lòng nhập số tiền',
            'amount.gt' => 'Số tiền phải lớn hơn 0',
            'amount.numeric' => 'Vui lòng nhập số tiền',
            'amount.max' => 'Số tiền vượt quá giới hạn',
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