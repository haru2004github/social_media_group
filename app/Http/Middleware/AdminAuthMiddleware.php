<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(!empty(Auth::user())){
            // Permission For login Page and register page during using time nad u can login if u use logout function
            if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage') || url()->current() == url('/')){
             return back();
        }

        if(Auth::user()->role == "member"){
            return back();
        }
        }

        return $next($request);
    }
}
