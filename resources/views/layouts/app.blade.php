<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Westforge Closet Co. — Custom Closet Manufacturer')</title>
    <meta name="description" content="@yield('meta_description', 'Westforge Closet Co. manufactures custom walk-in and reach-in closet systems in Portland, Oregon.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,700&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --wf-ink: #0E1F2B;
            --wf-teal: #1F7A6C;
            --wf-teal-deep: #155E54;
            --wf-brass: #A67C52;
            --wf-mist: #E8EEF2;
            --wf-cloud: #F7FAFC;
            --wf-steel: #4A6270;
            --wf-white: #ffffff;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Sora', sans-serif;
            color: var(--wf-ink);
            background:
                radial-gradient(1200px 600px at 10% -10%, rgba(31,122,108,.18), transparent 60%),
                radial-gradient(900px 500px at 100% 0%, rgba(166,124,82,.12), transparent 55%),
                linear-gradient(180deg, var(--wf-cloud), var(--wf-mist));
            min-height: 100vh;
        }
        h1, h2, h3, .brand {
            font-family: 'Fraunces', serif;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        a { color: inherit; text-decoration: none; }
        .wrap { width: min(1120px, calc(100% - 2rem)); margin-inline: auto; }
        .site-header {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(14px);
            background: rgba(247,250,252,.86);
            border-bottom: 1px solid rgba(14,31,43,.08);
        }
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 0; gap: 1rem;
        }
        .brand { font-size: 1.35rem; color: var(--wf-ink); }
        .brand span { color: var(--wf-teal); }
        .nav-links { display: flex; gap: 1.1rem; flex-wrap: wrap; align-items: center; font-size: .92rem; }
        .nav-links a { color: var(--wf-steel); font-weight: 500; }
        .nav-links a:hover { color: var(--wf-teal); }
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            gap: .4rem; border: 0; cursor: pointer;
            border-radius: .7rem; padding: .8rem 1.2rem;
            font-weight: 600; font-family: inherit;
            transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: var(--wf-teal); color: white; box-shadow: 0 10px 24px rgba(31,122,108,.25); }
        .btn-primary:hover { background: var(--wf-teal-deep); }
        .btn-ghost { background: transparent; color: var(--wf-ink); border: 1px solid rgba(14,31,43,.15); }
        .hero {
            display: grid; grid-template-columns: 1.05fr .95fr; gap: 2rem;
            align-items: end; padding: 3.5rem 0 2.5rem;
            min-height: calc(100vh - 72px);
        }
        .hero-copy h1 { font-size: clamp(2.4rem, 5vw, 4.2rem); line-height: 1.05; margin: .4rem 0 1rem; }
        .hero-copy p { color: var(--wf-steel); font-size: 1.05rem; max-width: 34rem; line-height: 1.65; }
        .hero-actions { display: flex; gap: .8rem; flex-wrap: wrap; margin-top: 1.6rem; }
        .hero-visual {
            position: relative; min-height: 420px; border-radius: 1.4rem;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(14,31,43,.2);
            animation: rise .9s ease both;
        }
        .hero-visual img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .eyebrow {
            display: inline-block; color: var(--wf-brass); font-weight: 600;
            text-transform: uppercase; letter-spacing: .12em; font-size: .75rem;
        }
        .section { padding: 4rem 0; }
        .section h2 { font-size: clamp(1.8rem, 3vw, 2.6rem); margin: 0 0 .6rem; }
        .section-lead { color: var(--wf-steel); max-width: 38rem; line-height: 1.6; margin-bottom: 2rem; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
        .service-tile {
            padding: 0; overflow: hidden; border-radius: 1.1rem;
            background: rgba(255,255,255,.72);
            border: 1px solid rgba(14,31,43,.07);
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .service-tile:hover { transform: translateY(-4px); box-shadow: 0 18px 40px rgba(14,31,43,.12); }
        .service-tile img { width: 100%; height: 180px; object-fit: cover; display: block; }
        .service-tile .body { padding: 1.2rem 1.25rem 1.4rem; }
        .service-tile h3 { margin: 0 0 .45rem; font-size: 1.2rem; }
        .service-tile p { margin: 0; color: var(--wf-steel); font-size: .92rem; line-height: 1.55; }
        .dash-preview {
            display: grid; grid-template-columns: 1.2fr .8fr; gap: 1.25rem;
            background: var(--wf-ink); color: white; border-radius: 1.4rem; padding: 1.5rem;
            overflow: hidden; position: relative;
        }
        .dash-preview::after {
            content: ''; position: absolute; inset: auto -10% -40% auto; width: 280px; height: 280px;
            background: radial-gradient(circle, rgba(31,122,108,.5), transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }
        .metric {
            background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.08);
            border-radius: 1rem; padding: 1rem 1.1rem;
        }
        .metric strong { display: block; font-size: 1.6rem; font-family: 'Fraunces', serif; }
        .metric span { color: rgba(255,255,255,.7); font-size: .85rem; }
        .bars { display: flex; align-items: flex-end; gap: .45rem; height: 140px; margin-top: 1rem; }
        .bars i {
            flex: 1; display: block; border-radius: .4rem .4rem 0 0;
            background: linear-gradient(180deg, var(--wf-brass), var(--wf-teal));
            animation: grow 1.2s ease both;
        }
        .article-card, .kb-card, .content-panel {
            background: rgba(255,255,255,.75);
            border: 1px solid rgba(14,31,43,.07);
            border-radius: 1.1rem; overflow: hidden;
        }
        .article-card img { width: 100%; height: 180px; object-fit: cover; }
        .article-card .body, .kb-card, .content-panel { padding: 1.2rem 1.25rem; }
        .prose { line-height: 1.75; color: var(--wf-steel); }
        .prose h2, .prose h3 { color: var(--wf-ink); }
        form .field { display: flex; flex-direction: column; gap: .35rem; margin-bottom: 1rem; }
        form label { font-weight: 600; font-size: .9rem; }
        form input, form textarea, form select {
            border: 1px solid rgba(14,31,43,.14); border-radius: .7rem;
            padding: .85rem 1rem; font: inherit; background: white;
        }
        .flash {
            background: rgba(31,122,108,.12); color: var(--wf-teal-deep);
            border: 1px solid rgba(31,122,108,.25); padding: .9rem 1rem; border-radius: .8rem; margin-bottom: 1rem;
        }
        .site-footer {
            margin-top: 3rem; padding: 2.5rem 0; background: var(--wf-ink); color: rgba(255,255,255,.78);
        }
        .site-footer .brand { color: white; }
        .footer-grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr; gap: 1.5rem; }
        .whatsapp-float {
            position: fixed; right: 1.2rem; bottom: 1.2rem; z-index: 50;
            background: #25D366; color: white; width: 56px; height: 56px; border-radius: 50%;
            display: grid; place-items: center; box-shadow: 0 12px 28px rgba(0,0,0,.25);
            font-weight: 700; animation: bob 2.8s ease-in-out infinite;
        }
        .chat-widget {
            position: fixed; right: 1.2rem; bottom: 5.2rem; z-index: 50; width: min(340px, calc(100vw - 2rem));
            background: white; border-radius: 1.1rem; box-shadow: 0 20px 50px rgba(14,31,43,.22);
            border: 1px solid rgba(14,31,43,.08); overflow: hidden; display: none;
        }
        .chat-widget.open { display: flex; flex-direction: column; max-height: 420px; }
        .chat-head { background: var(--wf-ink); color: white; padding: .9rem 1rem; font-weight: 600; }
        .chat-body { padding: .9rem; overflow-y: auto; flex: 1; display: flex; flex-direction: column; gap: .6rem; background: var(--wf-cloud); }
        .bubble { padding: .7rem .85rem; border-radius: .8rem; font-size: .9rem; line-height: 1.45; max-width: 90%; }
        .bubble.bot { background: white; align-self: flex-start; }
        .bubble.user { background: var(--wf-teal); color: white; align-self: flex-end; }
        .chat-form { display: flex; gap: .4rem; padding: .7rem; border-top: 1px solid rgba(14,31,43,.08); }
        .chat-form input { flex: 1; border: 1px solid rgba(14,31,43,.12); border-radius: .6rem; padding: .65rem .75rem; font: inherit; }
        .chat-toggle {
            position: fixed; right: 5rem; bottom: 1.35rem; z-index: 50;
            background: var(--wf-ink); color: white; border: 0; border-radius: 999px;
            padding: .7rem 1rem; font: inherit; font-weight: 600; cursor: pointer;
            box-shadow: 0 12px 28px rgba(14,31,43,.25);
        }
        @keyframes rise { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
        @keyframes grow { from { height: 12%; } }
        @keyframes pulse { 0%,100% { transform: scale(1); opacity: .7; } 50% { transform: scale(1.15); opacity: 1; } }
        @keyframes bob { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }
        @media (max-width: 900px) {
            .hero, .grid-3, .grid-2, .dash-preview, .footer-grid { grid-template-columns: 1fr; }
            .hero { min-height: auto; padding-top: 2rem; }
            .nav-links { display: none; }
        }
    </style>
    @stack('head')
</head>
<body>
    <header class="site-header">
        <div class="wrap nav">
            <a href="{{ url('/') }}" class="brand">Westforge <span>Closet Co.</span></a>
            <nav class="nav-links">
                <a href="{{ url('/services') }}">Systems</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="{{ url('/blog') }}">Journal</a>
                <a href="{{ url('/knowledge') }}">Knowledge</a>
                <a href="{{ url('/contact') }}">Contact</a>
                <a href="{{ url('/admin') }}" class="btn btn-ghost" style="padding:.55rem .9rem;">ERP Login</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="wrap footer-grid">
            <div>
                <div class="brand">Westforge Closet Co.</div>
                <p style="margin:.7rem 0 0; max-width:28rem;">Precision-built custom closets manufactured in Portland, Oregon for homes that need more than a builder-grade rod and shelf.</p>
            </div>
            <div>
                <strong style="color:#fff;">Visit</strong>
                <p style="margin:.5rem 0 0;">2140 NW Thurman St<br>Portland, OR 97210</p>
            </div>
            <div>
                <strong style="color:#fff;">Connect</strong>
                <p style="margin:.5rem 0 0;">(503) 555-0187<br>hello@westforgecloset.com</p>
            </div>
        </div>
    </footer>

    <button class="chat-toggle" id="chatToggle" type="button">Ask Westforge AI</button>
    <a class="whatsapp-float" href="https://wa.me/15035550187" target="_blank" rel="noopener" aria-label="WhatsApp">WA</a>

    <div class="chat-widget" id="chatWidget">
        <div class="chat-head">Westforge Closet Assistant</div>
        <div class="chat-body" id="chatBody">
            <div class="bubble bot">Hi — ask about lead times, materials, walk-ins, warranties, or booking a measure.</div>
        </div>
        <form class="chat-form" id="chatForm">
            <input type="text" id="chatInput" placeholder="Ask a question..." autocomplete="off" required>
            <button class="btn btn-primary" type="submit" style="padding:.65rem .9rem;">Send</button>
        </form>
    </div>

    <script>
        const toggle = document.getElementById('chatToggle');
        const widget = document.getElementById('chatWidget');
        const form = document.getElementById('chatForm');
        const input = document.getElementById('chatInput');
        const body = document.getElementById('chatBody');
        toggle?.addEventListener('click', () => widget.classList.toggle('open'));
        form?.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = input.value.trim();
            if (!message) return;
            body.insertAdjacentHTML('beforeend', `<div class="bubble user"></div>`);
            body.lastElementChild.textContent = message;
            input.value = '';
            body.scrollTop = body.scrollHeight;
            try {
                const res = await fetch('{{ url('/api/ai/chat') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ message })
                });
                const data = await res.json();
                body.insertAdjacentHTML('beforeend', `<div class="bubble bot"></div>`);
                body.lastElementChild.textContent = data.reply || 'Sorry, try again shortly.';
            } catch (err) {
                body.insertAdjacentHTML('beforeend', `<div class="bubble bot">Connection issue — please use the contact form.</div>`);
            }
            body.scrollTop = body.scrollHeight;
        });
    </script>
    @stack('scripts')
</body>
</html>
