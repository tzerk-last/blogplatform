<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('dashboard.posts.index', [
            'posts' => $posts,
            'blog'  => tenant(),
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('dashboard.posts.create', [
            'categories' => $categories,
            'blog'       => tenant(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required',
            'cover_image' => 'nullable|image|max:2048',
            'categories'  => 'nullable|array',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')
                                 ->store('covers/' . tenant()->id, 'public');
        }

        $post = Post::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . Str::random(5),
            'body'         => $request->body,
            'cover_image'  => $coverPath,
            'published_at' => $request->publish ? now() : null,
        ]);

        if ($request->categories) {
            $post->categories()->attach($request->categories);
        }

        return redirect()->to('/dashboard')->with('success', 'Post creado correctamente');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('dashboard.posts.edit', [
            'post'       => $post,
            'categories' => $categories,
            'blog'       => tenant(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required',
            'cover_image' => 'nullable|image|max:2048',
            'categories'  => 'nullable|array',
        ]);

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')
                                 ->store('covers/' . tenant()->id, 'public');
            $post->cover_image = $coverPath;
        }

        $post->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . Str::random(5),
            'body'         => $request->body,
            'published_at' => $request->publish ? now() : null,
        ]);

        if ($request->categories) {
            $post->categories()->sync($request->categories);
        }

        return redirect()->to('/dashboard')->with('success', 'Post actualizado correctamente');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post eliminado correctamente');
    }
}