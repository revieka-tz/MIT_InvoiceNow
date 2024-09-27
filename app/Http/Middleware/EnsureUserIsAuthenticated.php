<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAuthenticated
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
        // Check if the user session exists, if not, redirect to login page
        if (!session()->has('user')) {
            return redirect()->route('login')->withErrors(['You must log in to access this page.']);
        }

        return $next($request); // Continue if the user is authenticated
    }
}
