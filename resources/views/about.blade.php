@extends('layouts.app')
@section('title', 'About ROG — Republic of Gamers')

@section('content')

{{-- Hero --}}
<div style="position:relative; background:var(--bg-base); border-bottom:1px solid var(--border-base); overflow:hidden; padding:3.5rem 1rem;">
    <div style="position:absolute; inset:0; background:radial-gradient(ellipse at 30% 50%, rgba(229,0,30,.1) 0%, transparent 60%); pointer-events:none;"></div>
    <div style="max-width:1280px; margin:0 auto; padding:0 1rem; text-align:center; position:relative;">
        <div style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.25em; text-transform:uppercase; margin-bottom:.6rem;">Est. 2006</div>
        <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.8rem,5vw,3rem); font-weight:900; color:var(--text-primary); line-height:1.1; margin-bottom:1rem;">Republic of Gamers</h1>
        <p style="color:var(--text-muted); font-size:.95rem; max-width:620px; margin:0 auto 1.8rem; line-height:1.7;">The world's most feared gaming brand. Engineered for victory. Built for those who dare.</p>
        <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:.9rem; padding:.75rem 2rem; border-radius:6px;">Shop ROG Gear</a>
    </div>
</div>

<div style="max-width:1280px; margin:0 auto; padding:3rem 1rem 4rem;">

    {{-- Story --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:2.5rem; align-items:center; margin-bottom:4rem;">
        <div>
            <h2 class="section-title" style="margin-bottom:1.2rem;">Our Story</h2>
            <p style="color:var(--text-muted); line-height:1.8; margin-bottom:1rem; font-size:.9rem;">
                In 2006, ASUS launched Republic of Gamers with a single mission: create the ultimate gaming hardware without compromise. What started as a line of extreme gaming motherboards evolved into one of the most iconic gaming brands on the planet.
            </p>
            <p style="color:var(--text-muted); line-height:1.8; margin-bottom:1rem; font-size:.9rem;">
                Today, ROG covers every corner of the gaming ecosystem — from ultra-slim gaming laptops to championship-grade peripherals, professional-grade monitors to component-level excellence.
            </p>
            <p style="color:var(--text-muted); line-height:1.8; font-size:.9rem;">
                ROG isn't just a brand — it's a statement. It's the gear carried by world-champion esports teams. It's the hardware running inside the rigs of the world's best gamers.
            </p>
        </div>
        <div>
            <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=700&q=80" alt="ROG Gaming Battlestation" style="width:100%; border:1px solid var(--border-card); height:320px; object-fit:cover; border-radius:8px;">
        </div>
    </div>

    {{-- Stats --}}
    <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:2rem 1.2rem; margin-bottom:4rem; display:grid; grid-template-columns:repeat(auto-fit, minmax(130px, 1fr)); gap:1.5rem; text-align:center; border-radius:8px;">
        @foreach([
            ['500+', 'Innovation Awards'],
            ['18+',  'Years of Excellence'],
            ['#1',   'Gaming Brand Globally'],
            ['50+',  'Pro Esports Partners'],
        ] as [$num, $label])
        <div>
            <div style="font-family:'Orbitron',sans-serif; font-size:2rem; font-weight:900; color:var(--rog-red); line-height:1; margin-bottom:.4rem;">{{ $num }}</div>
            <div style="font-size:.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:.08em; font-weight:600;">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    {{-- Product Lines --}}
    <div style="margin-bottom:4rem;">
        <h2 class="section-title" style="margin-bottom:2rem; text-align:center; display:block;">ROG Product Lines</h2>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:1.2rem;">
            @foreach([
                ['🎮','ROG','The flagship line. Flagship performance. No compromises whatsoever — only the absolute best.'],
                ['💻','ROG Zephyrus','Ultra-slim laptops that redefine what thin-and-light gaming machines can achieve.'],
                ['⚔','ROG Strix SCAR','Tournament-grade gaming beasts delivering desktop performance in portable form.'],
                ['🌊','ROG Flow','Versatile 2-in-1 gaming laptops that seamlessly transition between work and play.'],
                ['🛡','TUF Gaming','Military-grade durability meets high-performance gaming at incredible value.'],
                ['✨','ROG STRIX GPU','Triple-fan graphics cards with legendary performance for desktop gaming builds.'],
            ] as [$icon,$name,$desc])
            <div class="rog-card" style="padding:1.5rem; background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px;">
                <div style="font-size:1.8rem; margin-bottom:.6rem;">{{ $icon }}</div>
                <h3 style="font-weight:800; color:var(--rog-red); font-size:.9rem; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.5rem;">{{ $name }}</h3>
                <p style="color:var(--text-muted); font-size:.82rem; line-height:1.6; margin:0;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- CTA --}}
    <div style="text-align:center; padding:3rem 1.5rem; background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px;">
        <h2 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.3rem,3vw,1.8rem); font-weight:900; color:var(--text-primary); margin-bottom:.8rem;">Ready to Join the Republic?</h2>
        <p style="color:var(--text-muted); margin-bottom:1.5rem; font-size:.9rem;">Browse our complete lineup of ROG gaming hardware and build your ultimate setup today.</p>
        <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:.95rem; padding:.8rem 2.2rem; border-radius:6px;">Shop Now</a>
    </div>
</div>
@endsection
