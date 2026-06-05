<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PublicBlogController extends Controller
{
    public function index()
    {
        $posts = Post::whereNotNull('published_at')
                     ->latest('published_at')
                     ->paginate(10);

        return view('blog.index', [
            'posts' => $posts,
            'blog'  => tenant(),
        ]);
    }

    public function show($slug)
    {
        $post = Post::whereNotNull('published_at')
                    ->where('slug', $slug)
                    ->firstOrFail();

        return view('blog.show', [
            'post' => $post,
            'blog' => tenant(),
        ]);
    }
}