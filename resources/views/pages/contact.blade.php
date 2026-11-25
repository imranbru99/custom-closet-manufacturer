@extends('layouts.app')

@section('title', 'Contact — Westforge Closet Co.')

@section('content')
<section class="section">
    <div class="wrap grid-2">
        <div>
            <span class="eyebrow">Contact</span>
            <h1 style="margin:.3rem 0 1rem;">Tell us about your closet project</h1>
            <p class="prose">Share room photos, rough dimensions, or a remodel timeline. We’ll reply within one business day.</p>
            <div class="content-panel" style="margin-top:1.5rem;">
                <p><strong>Phone:</strong> (503) 555-0187</p>
                <p><strong>Email:</strong> hello@westforgecloset.com</p>
                <p><strong>Showroom:</strong> 2140 NW Thurman St, Portland, OR 97210</p>
                <p><strong>WhatsApp:</strong> +1 503 555 0187</p>
            </div>
        </div>
        <div class="content-panel">
            @if(session('success'))
                <div class="flash">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ url('/contact') }}">
                @csrf
                <div class="field">
                    <label for="name">Name</label>
                    <input id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')<small style="color:#b42318;">{{ $message }}</small>@enderror
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<small style="color:#b42318;">{{ $message }}</small>@enderror
                </div>
                <div class="field">
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}">
                </div>
                <div class="field">
                    <label for="subject">Subject</label>
                    <input id="subject" name="subject" value="{{ old('subject') }}">
                </div>
                <div class="field">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                    @error('message')<small style="color:#b42318;">{{ $message }}</small>@enderror
                </div>
                <button class="btn btn-primary" type="submit">Send message</button>
            </form>
        </div>
    </div>
</section>
@endsection
