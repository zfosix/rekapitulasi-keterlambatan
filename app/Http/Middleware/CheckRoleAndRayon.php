<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleAndRayon
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
        if (Auth::check()) {
            $user = Auth::user();
            $email = $user->email;

            $rayonPattern = '/^ps([a-z]+)(\d+)@gmail\.com$/i';

            if (preg_match($rayonPattern, $email, $matches)) {
                $rayon = $matches[1];
                $rayonNumber = $matches[2];

                $request->merge(['rayon' => $rayon, 'rayonNumber' => $rayonNumber]);
            }
        }

        return $next($request);
    }
}
