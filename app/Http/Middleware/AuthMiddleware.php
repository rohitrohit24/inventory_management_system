<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user() ?? Auth::guard('admin')->user();

        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Please login to access this page.');
        }
        if ($user->is_Admin != 1) {
            Auth::logout();
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error', 'Your account is deactivated.');
        }
        return $next($request);
    }
}
