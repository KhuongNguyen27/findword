<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index(){
        $items = Page::where('status',1)->paginate(9);
    }
    public function show($slug){
        $item = Page::where('slug',$slug)->firstOrFail();
        return view('website.pages.show',[
            'item' => $item
        ]);
    }
}
