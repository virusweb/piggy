<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sip extends Model
{
    protected $fillable = [
        'folio_no', 'scheme_name', 'unit_balance', 'last_declare_nav','current_value','cost_value','email','mobile','amount','installment','user_id','bank_id'
    ];
}
