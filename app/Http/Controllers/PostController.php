<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use App\Traits\SEOTrait;


class PostController extends Controller
{
    use SEOTrait;

    public function index(){
        // $items = Post::where('status',1)->paginate(9);
                // Lấy các bài viết theo category
                $careerGuidePosts = Post::where('status', 1)->where('category', 1)->limit(10)->get(); // Chuyên mục "Cẩm nang"
                $entertainmentPosts = Post::where('status', 1)->where('category', 2)->limit(10)->get(); // Chuyên mục "Giải trí"
        
                return view('website.posts.index', [
                    'careerGuidePosts' => $careerGuidePosts,
                    'entertainmentPosts' => $entertainmentPosts
                ]);
        
    }
    public function show($slug){
        $item = Post::where('slug',$slug)->firstOrFail();

        // Cấu hình SEO
		$keywords = $item->short_description;
        $title = $item->name;
        $description = $item->short_description;
        $canonical = config('seo.canonical');
        $this->setSEO(
						$title,
						$description,
						$canonical,
						$keywords,
					);

        return view('website.posts.show',[
            'item' => $item
        ]);
    }
    // public function show($slug)
    // {
    //     // Lấy bài viết hiện tại theo slug
    //     $item = Post::where('slug', $slug)->firstOrFail();
        
    //     // Lấy tên chuyên mục hiện tại
    //     // Giả sử bạn lưu tên chuyên mục trong trường 'category_name' trong bảng 'posts'
    //     $categoryMap = [
    //         1 => 'Cẩm Nang Nghề Nghiệp',
    //         2 => 'Góc Giải Trí',
    //     ];
    
    //     // Lấy tên chuyên mục hiện tại từ ánh xạ
    //     $categoryName = $categoryMap[$item->category] ?? 'Chuyên Mục Khác';
    //  // Đảm bảo trường này tồn tại và chứa tên chuyên mục
    
    //     // Lấy các bài viết liên quan cùng chuyên mục với bài viết hiện tại
    //     $relatedPosts = Post::where('status', 1)
    //         ->where('category', $item->category) // Lọc theo chuyên mục của bài viết hiện tại
    //         ->where('slug', '!=', $slug) // Loại bỏ bài viết hiện tại
    //         ->limit(10) // Giới hạn số lượng bài viết liên quan
    //         ->get();
    
    //     return view('website.posts.show', [
    //         'item' => $item,
    //         'relatedPosts' => $relatedPosts, // Truyền dữ liệu bài viết liên quan vào view
    //         'categoryName' => $categoryName, // Truyền tên chuyên mục vào view
    //     ]);
    // }
    
}
