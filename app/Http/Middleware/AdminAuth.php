<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{

    /**
     * AdminAuth constructor.
     */
    public function __construct()
    {
    }

    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = 'admin')
    {
        if (!Auth::guard($guard)->user()) {
            return redirect(route('admin.login'));
        }
        return $next($request);
    }
}
