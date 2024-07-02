<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Log::info('User role ID: ' . $user->role_id); // Log the user's role ID

        if ($user->role_id == 1 && !$request->is('dashboard')) {
            return redirect('/dashboard');
        }

        if ($user->role_id == 2 && !$request->is('home')) {
            return redirect('/home');
        }

        return $next($request);
    }
}
