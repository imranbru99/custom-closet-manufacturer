@extends('layouts.app')

@section('title', 'About Westforge Closet Co.')

@section('content')
<section class="section">
    <div class="wrap grid-2" style="align-items:center;">
        <div>
            <span class="eyebrow">Our story</span>
            <h1 style="font-size:clamp(2rem,4vw,3.2rem);margin:.4rem 0 1rem;">A closet manufacturer, not a reseller.</h1>
            <p class="prose">Westforge Closet Co. was founded in Portland to bring factory discipline to residential closet work. We cut our own panels, kit our own hardware, and train our own installers so every system fits the drawings we approve with you.</p>
            <p class="prose">From Lake Oswego walk-ins to multi-home builder packages, we stay focused on one craft: manufacturing custom storage that lasts.</p>
        </div>
        <div class="hero-visual" style="min-height:360px;animation:rise .8s ease both;">
            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1400&q=80" alt="Westforge manufacturing and CNC workflow">
        </div>
    </div>
</section>
<section class="section" style="padding-top:0;">
    <div class="wrap grid-3">
        <div class="content-panel"><h3 style="margin-top:0;">Design desk</h3><p class="prose">Consultations, finish boards, and shop drawings before a single panel is cut.</p></div>
        <div class="content-panel"><h3 style="margin-top:0;">Portland plant</h3><p class="prose">CNC nesting, edgebanding, and hardware staging under one roof.</p></div>
        <div class="content-panel"><h3 style="margin-top:0;">Field crews</h3><p class="prose">Certified installers who protect floors, hang doors true, and leave broom-clean.</p></div>
    </div>
</section>
@endsection
