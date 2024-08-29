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
        $canonical = config('seo.canonical').'cong-ty';
        $og_url = config('seo.canonical').'cong-ty';
        $this->setSEO(
						$title,
						$description,
						$canonical,
						$keywords,
                        $og_url
					);

        $query = UserEmployee::query(true);
        if( $request->name ){
            $query->where('name','LIKE',"%$request->name%");
        }
        $items = $query->orderBy('position')->paginate(9);
        $params = [
            'items' => $items
        ];
        return view('website.employees.index',$params);
    }
}
