<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'bank_name' => ['required','exists:bank_lists,name'],
            'account_no' => ['required','numeric','digits_between:1,20'],
            'balance' => ['required','numeric'],
            'account_type' => ['required','in:saving,current']
        ];
    }
}
