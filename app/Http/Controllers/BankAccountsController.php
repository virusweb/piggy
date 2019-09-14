<?php

namespace App\Http\Controllers;

use Auth;
use App\bank_accounts;
use Illuminate\Http\Request;
use Hashids\Hashids;

class BankAccountsController extends Controller
{
    public function index(bank_accounts $bank_accounts)
    {
        $hashids = new Hashids();
        $bank_accounts = $bank_accounts->paginate(15);
        return view('accounts.index', ['bank_accounts' => $bank_accounts]);
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request,bank_accounts $bank_accounts)
    {
        $response = $bank_accounts->create($request->merge(['user_id' => Auth::id()])->all());
        return redirect()->route('accounts.index')->withStatus(__($response));
    }

    public function edit(bank_accounts $bank)
    {   
        return view('accounts.edit', compact('bank'));
    }

    public function update(Request $request, bank_accounts $bank)
    {
        $response = $bank->update($request->all());
        return redirect()->route('bank.index')->withStatus(__($response));
    }

    public function destroy(bank_accounts $bank)
    {
        $response = $bank->delete();
        return redirect()->route('bank.index')->withStatus(__($response));
    }
}
