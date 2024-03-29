<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekLogin
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
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.dashboard');
        } elseif (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
