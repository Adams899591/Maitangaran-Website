<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if session has the user and token
        if (!session()->has('user') || !session()->has('api_token')) {
            // Redirect to login page if session doesn't exist
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Session exists, allow access to the requested page
        return $next($request);

    }
}
