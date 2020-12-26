<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
         if(!Auth::check()){
            $url = url()->current();
            session(['url_redirect' => $url]);
            return redirect()->route('users.login');
        }
        return $next($request);
    }
}
