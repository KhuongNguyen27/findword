<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Badword;

class BadWordFilterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $badWords = Badword::all()->pluck('name')->toArray();
        $input = $request->all();

        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = str_replace($badWords, '***', $value);
            }
        }

        $request->replace($input);

        return $next($request);
    }
}
