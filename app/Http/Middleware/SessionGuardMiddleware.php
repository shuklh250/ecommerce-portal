<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SessionGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == 'admin') {
            config(['session.cookie' => 'admin_session']);
        } elseif ($guard == 'user') {
            config(['session.cookie' => 'user_session']);
        }

        return $next($request);
    }
}
