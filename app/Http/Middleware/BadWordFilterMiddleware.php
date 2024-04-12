<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BadWordFilterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $badWords = ['cặc','lol','loz','dm', 'lồn', 'địt', 'má', 'thằng khốn nạn', 'con cac', 'lòn', 'đĩ', 'đụ', 'lôz', 'buồi', 'đéo', 'cái lồn', 'buồn cười', 'cứt', 'buồn ngủ', 'thằng ngu', 'mẹ mày', 'đồ chó', 'ngu ngốc', 'cock', 'fuck', 'shit', 'asshole', 'bitch', 'motherfucker', 'dick', 'pussy', 'bastard', 'idiot', 'damn'];
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
