<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TrackUserActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('lastActivityTime');
            $currentTime = now();

            if ($lastActivity && $currentTime->diffInMinutes($lastActivity) > 5) {
                Auth::logout();
                return redirect()->route('lockscreen');
            }

            session(['lastActivityTime' => $currentTime]);
        }

        return $next($request);
    }
}

