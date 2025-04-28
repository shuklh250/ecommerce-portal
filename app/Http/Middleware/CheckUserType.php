<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and the role is 'user'
        if (!Auth::guard('user')->check()) {
            // If user is not authenticated, redirect to login page
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        // If the user is authenticated, but role is not 'user', then deny access
        if (Auth::guard('user')->user()->role != 'user') {
            return redirect()->route('login')->with('error', 'You must be a valid user to access this page.');
        }



        // If everything is fine, allow the request to proceed
        return $next($request);
    }
}
