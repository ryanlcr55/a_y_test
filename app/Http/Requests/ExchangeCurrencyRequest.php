<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeCurrencyRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source_currency' => 'bail|required|string',
            'target_currency' => 'bail|required|string',
            'amount' => 'bail|required|integer|min:0',
        ];
    }
}
