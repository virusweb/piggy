<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\bank_list;
use App\Models\bank_accounts;

class bankController extends Controller
{
    public function autocomplete(Request $request)
    {
        return bank_list::where('name', 'like', '%' . $request->term . '%')
        ->get();
    }

    public function getaccountno(Request $request)
    {
    	$id = $this->hashids->decodeHex($request->bank);
    	return bank_accounts::findOrFail($id)->account_no;
    }
}
