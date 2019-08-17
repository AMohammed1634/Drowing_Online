<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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

        if(!auth()->check()){
            return redirect(route('login'));
        }else {
            if(auth()->user()->role_id == 3){
                //return  view to verfy  password
                //return redirect(route('lockscreen'));
                return $next($request);
            }
            return redirect(route('home'));
        }

    }
}
