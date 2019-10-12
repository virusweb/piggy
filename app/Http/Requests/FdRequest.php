<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FdRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'amount' => ['required','numeric','min:5000'],
            'account_no' => ['required'],
            'bank' => ['required'],
            'starting_date' => ['required','date_format:d/m/Y'],
            'ending_date' => ['required','date_format:d/m/Y'],
            'intrest_rate' => ['required','numeric','max:15','min:5'],
            'maturity_amount' => ['required','numeric'],
            'auto_renewal' => ['required',Rule::in([0, 1])],
            'auto_closer' => ['required',Rule::in([0, 1])],
            'receipt_no' => ['required']
        ];
    }
}
