<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // public function handle(Request $request, Closure $next ): Response
    // {
    //     if(Auth::check() && Auth::user()->role !== 'admin'){
    //             return redirect()->route('login')->with('Error',"You must be an admin to access this page.");

    //     }

    //     return $next($request);
    // }


    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::guard(name: 'admin')->check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('Error', 'You must be logged in to access this page.');
        }

        // Check if user is not admin
        if (Auth::guard('admin')->user()->role !== 'admin') {
            // Redirect to login if not an admin
            return redirect()->route('login')->with('Error', 'You must be an admin to access this page.');
        }

        // If the user is an admin, continue with the request
        return $next($request);
    }
}
