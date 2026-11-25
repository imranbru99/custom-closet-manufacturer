@extends('layouts.app')

@section('title', 'Closet Systems — Westforge Closet Co.')

@section('content')
<section class="section">
    <div class="wrap">
        <span class="eyebrow">Manufactured systems</span>
        <h1 style="margin:.3rem 0 1rem;">Choose the closet we build for you</h1>
        <p class="section-lead">Walk-ins, reach-ins, wardrobe walls, mudrooms, pantries, and factory design services.</p>
        <div class="grid-3">
            @foreach($services as $service)
                <a href="{{ url('/services/'.$service->slug) }}" class="service-tile">
                    <img src="{{ $service->image }}" alt="{{ $service->title }}">
                    <div class="body">
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->summary }}</p>
                        @if($service->starting_price)
                            <p style="margin-top:.7rem;font-weight:600;color:var(--wf-teal);">From ${{ number_format($service->starting_price, 0) }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
