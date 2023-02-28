<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthLock
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
        // If the user is not subscribed, show a different payments page.
        if ($request->session()->has('locked'))
        {
            return redirect('/locked');
        }
     
         return $next($request);
    }
}