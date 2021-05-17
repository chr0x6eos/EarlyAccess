<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        // Only allow access if user is admin
        if(Auth::user() && Auth::user()->role === "admin")
            return $next($request);
        return  redirect()->route('dashboard')->withErrors("You are not authorized to access this resource!");
    }
}
