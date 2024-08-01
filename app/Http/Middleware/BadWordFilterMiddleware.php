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
        // Lấy danh sách từ xấu từ cơ sở dữ liệu
        $badWords = Badword::all()->pluck('name')->toArray();
        
        // Lấy tất cả dữ liệu đầu vào của request
        $input = $request->all();

        foreach ($input as $key => $value) {
            if (is_string($value)) {
                foreach ($badWords as $badWord) {
                    // Tạo pattern regex để tìm từ xấu chỉ khi nó đứng riêng hoặc không phải là phần của từ khác
                    $pattern = "/(?<!\p{L})" . preg_quote($badWord, '/') . "(?!\p{L})/iu";
                    // Thay thế từ xấu bằng ***
                    $value = preg_replace($pattern, '***', $value);
                }
                // Cập nhật giá trị đã được xử lý
                $input[$key] = $value;
            }
        }

        // Thay thế dữ liệu đầu vào trong request với dữ liệu đã xử lý
        $request->replace($input);

        return $next($request);
    }
}
