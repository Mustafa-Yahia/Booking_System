<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must log in first.');  
              }

        if (Auth::user()->role !== $role) {
            return redirect('/')->with('error', 'You do not have permission to access this page.');   
             }

        return $next($request);
    }
}
