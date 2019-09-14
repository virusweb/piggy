<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    private $auth;
    public function handle($request, Closure $next)
    {
        $this->auth = auth()->user() ? (auth()->user()->role === 'admin') : false ;

        if($this->auth === true)
            return $next($request);
        return redirect('/login')
            ->with(['error' => "You do not have the permission to enter this site. Please login with correct user."]);
    }
}
