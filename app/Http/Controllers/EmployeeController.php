<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEmployee;

use App\Traits\SEOTrait;

class EmployeeController extends Controller
{
    use SEOTrait;

    public function index(Request $request)
    {
        // Cấu hình SEO
        $keywords = config('seo.keywords');
        $title = 'Công ty';
        $description = config('seo.description');
        $canonical = config('seo.canonical') . 'cong-ty';
        $og_url = config('seo.canonical') . 'cong-ty';
        $this->setSEO(
            $title,
            $description,
            $canonical,
            $keywords,
            $og_url
        );

        $query = UserEmployee::whereHas('user', function ($q) {
            $q->where('status', 1);
        });

        if ($request->name) {
            $query->where('name', 'LIKE', "%$request->name%");
        }
          $query->orderByRaw('CASE WHEN position IS NOT NULL AND position > 0 THEN 1 ELSE 0 END DESC')
            ->orderBy('position', 'asc')
            ->orderBy('created_at', 'desc');

        $items = $query->paginate(9);
        $params = [
            'items' => $items
        ];

        // Trả về view và truyền dữ liệu
        return view('website.employees.index', $params);
    }
}
