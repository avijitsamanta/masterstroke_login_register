<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin_users')->check()) {
            // User is authenticated as an admin
            return $next($request);
        }

        // Redirect or throw an unauthorized exception
        return redirect()->route('admin.login');
    }
}
