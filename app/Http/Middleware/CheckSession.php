<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$requiredSessions  The required session keys passed from the route
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$requiredSessions)
    {
        // Loop through each required session key
        foreach ($requiredSessions as $sessionKey) {
            if (!$request->session()->has($sessionKey)) {
                // If any required session key is missing, redirect to the home route
                return redirect()->route('air.hotel');
            }
        }

        return $next($request);
    }
}
