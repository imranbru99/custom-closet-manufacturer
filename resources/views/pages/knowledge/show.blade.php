@extends('layouts.app')

@section('title', $article->title.' — Knowledge Base')

@section('content')
<article class="section">
    <div class="wrap" style="max-width:760px;">
        <span class="eyebrow">{{ str_replace('-', ' ', $article->category) }}</span>
        <h1 style="margin:.4rem 0 1rem;">{{ $article->title }}</h1>
        <div class="content-panel">
            <div class="prose">{!! $article->body !!}</div>
        </div>
        <p style="margin-top:2rem;"><a href="{{ url('/knowledge') }}" class="btn btn-ghost">All articles</a></p>
    </div>
</article>
@endsection
