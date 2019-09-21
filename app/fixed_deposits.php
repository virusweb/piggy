<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fixed_deposits extends Model
{
	protected $fillable = [
        'user_id', 'amount', 'account_no', 'bank','branch','starting_date','ending_date','intrest_rate','maturity_amount','auto_renewal','auto_closer','receipt_no'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
