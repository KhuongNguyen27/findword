<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post; // Giả sử bạn có một model Post

class SitemapController extends Controller
{
    public function index()
    {
        // Tạo sitemap và thêm các trang tĩnh
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'))
            ->add(Url::create('/about')->setPriority(0.8));

        // Thêm các bài viết từ cơ sở dữ liệu vào sitemap
        $posts = Post::all();
        foreach ($posts as $post) {
            $sitemap->add(
                Url::create("/post/{$post->slug}")
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.7)
            );
        }

        // Xuất ra file sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json('Sitemap created successfully.');
    }
}
