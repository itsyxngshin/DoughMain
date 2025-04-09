<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $credential = Auth::user(); // You're authenticated as Credential

        // Check if the related User has a role in the allowed roles
        if (!$credential || !$credential->user || !in_array($credential->user->role->role_name, $roles)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
