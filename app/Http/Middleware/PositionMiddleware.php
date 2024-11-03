<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PositionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$position)
    {
        $user = Auth::user();

        // Check if the user has any of the specified roles
        if ($user && $user->positions->count()) {
            return $next($request);
        }

        // Redirect if unauthorized
        return redirect('/')->with('error', 'Unauthorized access');
    }
}
