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
        $fd = (auth()->user()->role === 'admin') ? $fd : $fd::where('user_id',auth()->user()->id) ;
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
        try{
            $response = $fixed_deposits->create($request->merge(['user_id' => Auth::id(),'bank' => $this->hashids->decodeHex($request->bank),'starting_date' => date('Y-m-d', strtotime($request->starting_date)),'ending_date' => date('Y-m-d',strtotime($request->ending_date))])->all());
            Alert::success('Fixed deposit has been added', 'Success')->persistent('Close');
            return redirect()->route('fd.index');
        }catch(\Exception $e){
            Alert::error($e->getMessage(), 'Error!')->persistent('Close');
            return Redirect::back();
        }
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
        if(fixed_deposits::destroy($this->hashids->decodeHex($id))){
            Alert::success('Fixed deposit has been deleted', 'Success')->persistent('Close');
            return redirect()->route('fd.index');
        }else{
            Alert::error('Error in fixed Deposit deletion','Error !')->persistent('Close');
            return Redirect::back();
        }
    }
}
