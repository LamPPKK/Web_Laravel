<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckRole
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

        if (! Auth::check()) {
            return redirect()->route('login');
        }else{
            $user_id = Auth::user()->id;
            $role = DB::table('role_user')->where('user_id',$user_id)->first();
            if ($role->role_id == 10) {
                return redirect()->route('admin.posts.index');
            }
        }
        
    
       
    }
}
