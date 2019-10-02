<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\bank_list;

class bankController extends Controller
{
    public function autocomplete(Request $request)
    {
        return bank_list::where('name', 'like', '%' . $request->term . '%')
        ->get();
    }
}
