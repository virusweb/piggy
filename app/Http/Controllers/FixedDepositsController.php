<?php

namespace App\Http\Controllers;

use App\Models\fixed_deposits;
use Illuminate\Http\Request;
use Hashids\Hashids;

class FixedDepositsController extends Controller
{
    public function index(fixed_deposits $fd)
    {
        $hashids = new Hashids();
        return view('fixed_deposits.index', ['fds' => $fd->paginate(15),'hash' => $hashids]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
