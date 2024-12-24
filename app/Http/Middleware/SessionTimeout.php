<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    protected $timeout = 1200; // 30 minutes in seconds

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('lastActivityTime');
            if ($lastActivity && (time() - $lastActivity > $this->timeout)) {
                Auth::logout();
                session()->flush(); // Clear all session data
                return redirect()->route('destroy')->with('message', 'You have been logged out due to inactivity.');
            }
            session(['lastActivityTime' => time()]);
        }

        return $next($request);
    }
}
