<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bank_accounts extends Model
{
    protected $fillable = [
        'bank_name', 'account_no', 'balance', 'account_type','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
