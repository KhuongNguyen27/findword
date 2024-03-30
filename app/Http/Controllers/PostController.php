<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $items = Post::where('status',1)->paginate(9);
        
    }
    public function show($slug){
        $item = Post::where('slug',$slug)->firstOrFail();
        return view('website.posts.show',[
            'item' => $item
        ]);
    }
}
