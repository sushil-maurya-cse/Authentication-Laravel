<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('LoggedUser') && ($request->path() != 'login' && $request->path() != 'register')) {
            return redirect('/login')->with('fail', "You must be logged in");
        }
        if (session()->has('LoggedUser') && ($request->path() == 'login' || $request->path() == 'register')) {
            return back();
        }

        return $next($request)->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                              ->header('Pragma','no-cache')    // use fresh version of cache
                              ->header('Expires','Sat 01 Jan 1990 00:00:00 GMT');    // use fresh version of cache

    }
}
