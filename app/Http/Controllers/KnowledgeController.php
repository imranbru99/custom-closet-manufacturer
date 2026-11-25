<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeArticle;
use Illuminate\View\View;

class KnowledgeController extends Controller
{
    public function index(): View
    {
        $articles = KnowledgeArticle::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('pages.knowledge.index', compact('articles'));
    }

    public function show(string $slug): View
    {
        $article = KnowledgeArticle::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('pages.knowledge.show', compact('article'));
    }
}
