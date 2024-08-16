<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App; // Import Facade
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('locale')) {

            App::setLocale(session()->get('locale'));
        }

        return $next($request);
    }

}
