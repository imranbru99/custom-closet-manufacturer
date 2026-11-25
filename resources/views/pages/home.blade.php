@extends('layouts.app')

@section('title', 'Westforge Closet Co. — Custom Closet Manufacturer in Portland')
@section('meta_description', 'Factory-built walk-in and reach-in closets from Westforge Closet Co. CNC manufacturing, design consults, and certified installation across Oregon.')

@section('content')
<section class="wrap hero">
    <div class="hero-copy" style="animation: rise .7s ease both;">
        <span class="eyebrow">Portland custom closet manufacturer</span>
        <h1>Closets engineered in our factory, fitted to your home.</h1>
        <p>Westforge Closet Co. designs, CNC-cuts, and installs walk-in suites, reach-ins, wardrobe walls, and mudroom systems with furniture-grade materials and soft-close hardware.</p>
        <div class="hero-actions">
            <a href="{{ url('/contact') }}" class="btn btn-primary">Book a design consult</a>
            <a href="{{ url('/services') }}" class="btn btn-ghost">Explore systems</a>
        </div>
    </div>
    <div class="hero-visual">
        <img src="https://images.unsplash.com/photo-1595428774223-ef52624120d2?auto=format&fit=crop&w=1600&q=80" alt="Custom walk-in closet manufactured by Westforge">
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>Manufactured systems</h2>
        <p class="section-lead">Every Westforge package leaves our Portland plant as labeled panels, hardware kits, and install drawings — not stick-built guesswork.</p>
        <div class="grid-3">
            @foreach($services as $service)
                <a href="{{ url('/services/'.$service->slug) }}" class="service-tile">
                    <img src="{{ $service->image }}" alt="{{ $service->title }}">
                    <div class="body">
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->summary }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section" style="padding-top:0;">
    <div class="wrap">
        <h2>About the forge</h2>
        <p class="section-lead">We are a US SME manufacturer focused exclusively on custom closet systems — from laser measure to CNC nest to white-glove install.</p>
        <div class="grid-2">
            <div class="content-panel">
                <h3 style="margin-top:0;">Factory-first process</h3>
                <p class="prose">Design consults feed precise shop drawings. Panels are nested for yield, edged, drilled, and staged with soft-close hardware before a certified crew arrives on site.</p>
            </div>
            <div class="content-panel">
                <h3 style="margin-top:0;">Built for Pacific Northwest homes</h3>
                <p class="prose">Furniture-grade plywood cores, sealed edges, and moisture-aware finishes keep systems true through Oregon winters — with a limited lifetime construction warranty.</p>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0;">
    <div class="wrap">
        <h2>Operations at a glance</h2>
        <p class="section-lead">A visual preview of the Westforge ERP — orders, production pipeline, and install scheduling in one Filament admin.</p>
        <div class="dash-preview">
            <div>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.8rem;">
                    <div class="metric"><strong>48</strong><span>Active closet orders</span></div>
                    <div class="metric"><strong>$186k</strong><span>Production pipeline</span></div>
                    <div class="metric"><strong>12</strong><span>Installs this week</span></div>
                </div>
                <div class="bars">
                    <i style="height:45%;animation-delay:.05s"></i>
                    <i style="height:62%;animation-delay:.1s"></i>
                    <i style="height:38%;animation-delay:.15s"></i>
                    <i style="height:78%;animation-delay:.2s"></i>
                    <i style="height:55%;animation-delay:.25s"></i>
                    <i style="height:88%;animation-delay:.3s"></i>
                </div>
            </div>
            <div class="metric" style="position:relative;z-index:1;">
                <strong style="font-size:1.2rem;">Live shop board</strong>
                <p style="color:rgba(255,255,255,.72);line-height:1.55;margin:.7rem 0 0;">Track CNC nests, low-stock rails, deposit invoices, and measure appointments from <a href="{{ url('/admin') }}" style="color:#9fd6cb;">/admin</a>.</p>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0;">
    <div class="wrap">
        <h2>From the journal</h2>
        <p class="section-lead">Manufacturing notes, finish guidance, and design ideas for better closets.</p>
        <div class="grid-3">
            @foreach($posts as $post)
                <a href="{{ url('/blog/'.$post->slug) }}" class="article-card">
                    <img src="{{ $post->cover_image }}" alt="{{ $post->title }}">
                    <div class="body">
                        <h3 style="margin:0 0 .4rem;font-size:1.1rem;">{{ $post->title }}</h3>
                        <p class="prose" style="margin:0;">{{ $post->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section" style="padding-top:0;">
    <div class="wrap content-panel" style="display:flex;flex-wrap:wrap;justify-content:space-between;gap:1rem;align-items:center;">
        <div>
            <h2 style="margin:0 0 .4rem;">Ready for a factory-built closet?</h2>
            <p class="prose" style="margin:0;">Tell us about your space — we’ll recommend a system and schedule a measure.</p>
        </div>
        <a href="{{ url('/contact') }}" class="btn btn-primary">Contact Westforge</a>
    </div>
</section>
@endsection
