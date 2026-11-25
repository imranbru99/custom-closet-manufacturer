@extends('layouts.app')

@section('title', $service->title.' — Westforge Closet Co.')

@section('content')
<section class="section">
    <div class="wrap grid-2" style="align-items:start;">
        <div>
            <span class="eyebrow">System</span>
            <h1 style="margin:.3rem 0 1rem;">{{ $service->title }}</h1>
            <p class="prose">{{ $service->summary }}</p>
            <div class="prose">{!! $service->body !!}</div>
            @if($service->starting_price)
                <p style="font-weight:700;color:var(--wf-teal);font-size:1.2rem;">Starting at ${{ number_format($service->starting_price, 0) }}</p>
            @endif
            <a href="{{ url('/contact') }}" class="btn btn-primary" style="margin-top:1rem;">Request a quote</a>
        </div>
        <div class="hero-visual" style="min-height:380px;">
            <img src="{{ $service->image }}" alt="{{ $service->title }}">
        </div>
    </div>
</section>
@if($others->count())
<section class="section" style="padding-top:0;">
    <div class="wrap">
        <h2>Related systems</h2>
        <div class="grid-3" style="margin-top:1.2rem;">
            @foreach($others as $item)
                <a href="{{ url('/services/'.$item->slug) }}" class="service-tile">
                    <img src="{{ $item->image }}" alt="{{ $item->title }}">
                    <div class="body"><h3>{{ $item->title }}</h3><p>{{ $item->summary }}</p></div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
