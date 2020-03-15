<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixedDeposit extends Model
{
	protected $fillable = [
        'user_id', 'amount', 'account_no', 'bank_id','branch','starting_date','ending_date','intrest_rate','maturity_amount','auto_renewal','auto_closer','receipt_no'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function bank()
    {
        return $this->hasOne('App\Models\BankList','id','bank_id');
    }
}
