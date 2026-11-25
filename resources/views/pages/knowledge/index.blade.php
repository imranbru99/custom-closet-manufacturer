@extends('layouts.app')

@section('title', 'Knowledge Base — Westforge Closet Co.')

@section('content')
<section class="section">
    <div class="wrap">
        <span class="eyebrow">Knowledge base</span>
        <h1 style="margin:.3rem 0 1rem;">Guides, issues, admin manual & troubleshooting</h1>
        <p class="section-lead">Practical documentation for homeowners, installers, and Westforge admin users.</p>
        @foreach($articles as $category => $items)
            <h2 style="margin:2rem 0 1rem;font-size:1.4rem;">{{ str_replace('-', ' ', ucfirst($category)) }}</h2>
            <div class="grid-2">
                @foreach($items as $article)
                    <a href="{{ url('/knowledge/'.$article->slug) }}" class="kb-card">
                        <h3 style="margin:0 0 .4rem;">{{ $article->title }}</h3>
                        <p class="prose" style="margin:0;">Open article →</p>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</section>
@endsection
