<?php

namespace App\Http\Controllers;

use App\Models\FixedDeposit;
use App\Models\BankList;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Redirect;

class FixedDepositsController extends Controller
{
    public function index(FixedDeposit $fd)
    {
        $fd = (auth()->user()->role === 'admin') ? $fd : $fd::where('user_id',auth()->user()->id) ;
        return view('fixed_deposits.index', ['fds' => $fd->paginate(15),'hash' => $this->hashids]);
    }

    public function create(BankList $bank_lists)
    {
        $user_accounts = Auth::user()->accounts;

        if($user_accounts->count() < 1){
            Alert::error('Without bank account you can not add FD', 'Sorry!')->persistent('Close');
            return Redirect::back();
        }

        return view('fixed_deposits.create',[
            'accounts' => $user_accounts,
            'hash' => $this->hashids,
            'bank_lists' => $bank_lists->all()
        ]);
    }

    public function store(Request $request,FixedDeposit $fixed_deposits)
    {
        
        $response = $fixed_deposits->create($request->merge([
            'user_id' => Auth::id(),
            'starting_date' => date('Y-m-d', strtotime($request->starting_date)),
            'ending_date' => date('Y-m-d',strtotime($request->ending_date))
        ])->all());

        if($response)
        {
            Alert::success('Fixed deposit has been added', 'Success')->persistent('Close');
            return redirect()->route('fd.index');
        }
        else
        {
            Alert::error('Fixed deposit not added', 'Error!')->persistent('Close');
            return Redirect::back();
        }
    }

    public function show(FixedDeposit $fixed_deposits)
    {
        //
    }

    public function edit($id,BankList $bank_lists)
    {
        $id = $this->hashids->decodeHex($id);
        $fd = FixedDeposit::findOrFail($id);

        $fd->ending_date = date('d-m-Y', strtotime($fd->ending_date));
        $fd->starting_date = date('d-m-Y', strtotime($fd->starting_date));

        return view('fixed_deposits.edit',[
            'fd' => $fd,
            'bank_lists' => $bank_lists->all()
        ]);
    }

    public function update(Request $request, FixedDeposit $fd)
    {
        $response = $fd->update($request->merge([
            'starting_date' => date('Y-m-d', strtotime($request->starting_date)),
            'ending_date' => date('Y-m-d',strtotime($request->ending_date))
        ])->all());

        if($response)
        {
            Alert::success('Fixed deposit has been updated', 'Success')->persistent('Close');
            return redirect()->route('fd.index')->withStatus(__($response));
        }
    }

    public function destroy($id)
    {
        if(FixedDeposit::destroy($this->hashids->decodeHex($id)))
        {
            Alert::success('Fixed deposit has been deleted', 'Success')->persistent('Close');
            return redirect()->route('fd.index');
        }
        else
        {
            Alert::error('Error in fixed Deposit deletion','Error !')->persistent('Close');
            return Redirect::back();
        }
    }
}
