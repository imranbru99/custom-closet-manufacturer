@extends('layouts.app')

@section('title', $post->title.' — Westforge Closet Co.')

@section('content')
<article class="section">
    <div class="wrap" style="max-width:760px;">
        <span class="eyebrow">{{ ucfirst($post->category) }}</span>
        <h1 style="margin:.4rem 0 1rem;">{{ $post->title }}</h1>
        @if($post->cover_image)
            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" style="width:100%;border-radius:1.1rem;margin-bottom:1.5rem;">
        @endif
        <div class="prose">{!! $post->body !!}</div>
        <p style="margin-top:2rem;"><a href="{{ url('/blog') }}" class="btn btn-ghost">Back to journal</a></p>
    </div>
</article>
@endsection
