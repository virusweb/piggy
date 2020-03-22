<?php

namespace App\Http\Controllers;

use App\Models\Sip;
use Illuminate\Http\Request;

class SipController extends Controller
{
    public function index(Sip $sip)
    {
        $sip = (auth()->user()->role == 'admin') ? $sip : $sip::where('user_id',auth()->user()->id) ;

        return view('sips.index', ['sips' => $sip->paginate(15),'hash' => $this->hashids]);
    }

    public function create()
    {
        return view('sips.create',['user_bank_acconts' => auth()->user()->accounts,'hash' => $this->hashids]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Sip $sip)
    {
        //
    }

    public function edit(Sip $sip)
    {
        //
    }

    public function update(Request $request, Sip $sip)
    {
        //
    }

    public function destroy(Sip $sip)
    {
        //
    }
}
