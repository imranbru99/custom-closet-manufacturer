@extends('layouts.app')

@section('title', 'Journal — Westforge Closet Co.')

@section('content')
<section class="section">
    <div class="wrap">
        <span class="eyebrow">Journal</span>
        <h1 style="margin:.3rem 0 1rem;">Ideas from the shop floor</h1>
        <div class="grid-3">
            @foreach($posts as $post)
                <a href="{{ url('/blog/'.$post->slug) }}" class="article-card">
                    <img src="{{ $post->cover_image }}" alt="{{ $post->title }}">
                    <div class="body">
                        <h3 style="margin:0 0 .4rem;font-size:1.15rem;">{{ $post->title }}</h3>
                        <p class="prose" style="margin:0;">{{ $post->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <div style="margin-top:2rem;">{{ $posts->links() }}</div>
    </div>
</section>
@endsection
