<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\auth;
use Closure;
use Illuminate\Http\Request;

class admin
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
        if(auth::user() && auth::user()->type=="admin" && auth::user()->status == "0")
        {
            return $next($request);
        }
        else{
            return redirect('login');
        }
    }
}
