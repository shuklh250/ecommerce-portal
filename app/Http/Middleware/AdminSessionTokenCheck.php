<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminSessionTokenCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::guard('admin')->user();
        $sessionToken = session('admin_session_token');

        if (!$user || $user->session_token !== $sessionToken) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('Error', 'You have been logged out from another device.');
        }

        return $next($request);
    }
}
