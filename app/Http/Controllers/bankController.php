<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BankList;
use App\Models\BankAccount;

class bankController extends Controller
{
    public function autocomplete(Request $request)
    {
        return BankList::where('name', 'like', '%' . $request->term . '%')
        ->get();
    }

    public function getaccountno(Request $request)
    {
    	$id = $this->hashids->decodeHex($request->bank);
    	return BankAccount::findOrFail($id)->account_no;
    }
}
