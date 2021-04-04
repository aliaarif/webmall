<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckLPSession
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
        if($request->session()->get('username'))
        {
            $request->session()->put('login', 1);
            return $next($request);
        }else{
            $data = ['page_title' => 'Welcome to Durham Ecommerce' ];
            abort(403, 'Unauthorized action2.');
            
        }
    }
}
