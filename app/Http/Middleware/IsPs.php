<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsPs
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'IsPs') {
            return redirect()->route('error.permission');
        }
        return $next($request);
    }
}
