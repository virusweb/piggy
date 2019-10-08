<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LicInvestmentsController extends Controller
{
    /**
     *
     * Index page of controller
     *
    */
	public function index()
	{
		return view('lic.index');
	}

}
