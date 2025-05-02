<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('user')) {
            return redirect('/')->with('info', 'You are already logged in');
        }
        
        return $next($request);
    }
}