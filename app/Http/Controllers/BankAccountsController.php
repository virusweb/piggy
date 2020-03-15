<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\BankAccount;
use App\Models\BankList;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;


class BankAccountsController extends Controller
{
    public function index(BankAccount $bank_accounts)
    {
        $bank_accounts = (auth()->user()->role === 'admin') ? $bank_accounts : $bank_accounts::where('user_id',auth()->user()->id) ;
        $bank_accounts = $bank_accounts->paginate(15);
        return view('accounts.index', ['bank_accounts' => $bank_accounts,'hash' => $this->hashids]);
    }

    public function create(BankList $bank_lists)
    {
        return view('accounts.create',['bank_lists' => $bank_lists->all()]);
    }

    public function store(AccountRequest $request,BankAccount $bank_accounts)
    {
        $response = $bank_accounts->create($request->merge(['user_id' => Auth::id()])->all());
        return redirect()->route('bank.index')->withStatus(__("Bank Account Added"));
    }

    public function edit($id)
    {   
        $id = $this->hashids->decodeHex($id);
        $bank = bank_accounts::findOrFail($id);
        return view('accounts.edit', compact('bank'));
    }

    public function update(AccountRequest $request, BankAccount $bank)
    {
        $response = $bank->update($request->all());
        return redirect()->route('bank.index')->withStatus(__($response));
    }

    public function destroy($id)
    {
        $id = $this->hashids->decodeHex($id);
        $response = BankAccount::destroy($id);
        return redirect()->route('bank.index')->withStatus(__($response));
    }
}
