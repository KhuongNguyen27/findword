<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

use App\Traits\SEOTrait;

class PageController extends Controller
{
    use SEOTrait;

    public function index(){
        $items = Page::where('status',1)->paginate(9);
    }
    public function show($slug){
        $item = Page::where('slug',$slug)->firstOrFail();

        $plainText = strip_tags($item->description);
        $plainText = html_entity_decode($plainText);
        $summaryText = mb_substr($plainText, 0, 160);
        $summaryText = preg_replace('/\s+/', ' ', $summaryText);
        $summaryText = trim($summaryText);

        // Cấu hình SEO
		$keywords = config('seo.keywords');
        $title = $item->name;
        $description = $summaryText;
        $canonical = config('seo.canonical').$slug;
        $og_url = config('seo.canonical').$slug;

        $this->setSEO(
						$title,
						$description,
						$canonical,
						$keywords,
                        $og_url
					);
        
        return view('website.pages.show',[
            'item' => $item
        ]);
    }
}
