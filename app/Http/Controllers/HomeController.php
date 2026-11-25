<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'services' => Service::query()->where('is_active', true)->orderBy('sort_order')->take(6)->get(),
            'posts' => Post::query()->where('is_published', true)->latest('published_at')->take(3)->get(),
        ]);
    }
}
