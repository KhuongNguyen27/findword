<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\SEOTrait;

class OperatingRegulationController extends Controller
{
    use SEOTrait;

    public function index(){
        // Cấu hình SEO
		$keywords = config('seo.keywords');
        $title = 'Quy chế hoạt động';
        $description = config('seo.description');
        $canonical = config('seo.canonical').'quy-che-hoat-dong';
        $og_url = config('seo.canonical').'quy-che-hoat-dong';
        $this->setSEO(
						$title,
						$description,
						$canonical,
						$keywords,
                        $og_url
					);
        return view('website/htmlpages/quychehoatdong');
    }
}
