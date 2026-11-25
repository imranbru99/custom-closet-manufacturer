<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('pages.blog.index', [
            'posts' => Post::query()->where('is_published', true)->latest('published_at')->paginate(9),
        ]);
    }

    public function show(string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('pages.blog.show', compact('post'));
    }
}
