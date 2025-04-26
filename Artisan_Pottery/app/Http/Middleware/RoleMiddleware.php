<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
{
    // Check if the user is authenticated and the session has the correct role
    if (!$request->session()->has('role') || $request->session()->get('role') !== $role) {
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}
}