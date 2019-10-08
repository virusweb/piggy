<?php

namespace App\Http\Controllers;

use App\Models\fixed_deposits;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Redirect;

class FixedDepositsController extends Controller
{
    public function index(fixed_deposits $fd)
    {
        return view('fixed_deposits.index', ['fds' => $fd->paginate(15),'hash' => $this->hashids]);
    }

    public function create()
    {
        $user_accounts = Auth::user()->accounts;

        if($user_accounts->count() < 1){
            Alert::error('Without bank account you can not add FD', 'Sorry!')->persistent('Close');
            return Redirect::back();
        }

        return view('fixed_deposits.create',['accounts' => $user_accounts,'hash' => $this->hashids]);
    }

    public function store(Request $request,fixed_deposits $fixed_deposits)
    {
        $response = $fixed_deposits->create($request->merge(['user_id' => Auth::id()])->all());
        return redirect()->route('fd.index')->withStatus(__("FD Added"));
    }

    public function show(fixed_deposits $fixed_deposits)
    {
        //
    }

    public function edit(fixed_deposits $fixed_deposits)
    {
        //
    }

    public function update(Request $request, fixed_deposits $fixed_deposits)
    {
        //
    }

    public function destroy($id)
    {
        $hashids = new Hashids();
        $id = $hashids->decodeHex($id);
        $response = fixed_deposits::destroy($id);
        return redirect()->route('fd.index')->withStatus(__($response));
    }
}
