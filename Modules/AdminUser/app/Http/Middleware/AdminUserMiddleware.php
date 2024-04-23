<?php
namespace Modules\AdminUser\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'user') {
                return $next($request);
            }
        }
        return redirect()->route('login');
    }
}
