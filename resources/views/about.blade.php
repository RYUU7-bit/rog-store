@extends('layouts.app')
@section('title', 'About ROG — Republic of Gamers')

@section('content')

{{-- Hero --}}
<div style="position:relative; background:#080808; border-bottom:1px solid #1e1e1e; overflow:hidden; padding:5rem 0;">
    <div style="position:absolute; inset:0; background:radial-gradient(ellipse at 30% 50%, rgba(229,0,30,.1) 0%, transparent 60%); pointer-events:none;"></div>
    <div style="max-width:1280px; margin:0 auto; padding:0 1.5rem; text-align:center; position:relative;">
        <div style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.25em; text-transform:uppercase; margin-bottom:.8rem;">Est. 2006</div>
        <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(2rem,5vw,3.5rem); font-weight:900; color:#fff; line-height:1.1; margin-bottom:1.2rem;">Republic of Gamers</h1>
        <p style="color:#888; font-size:1.05rem; max-width:620px; margin:0 auto 2rem; line-height:1.7;">The world's most feared gaming brand. Engineered for victory. Built for those who dare.</p>
        <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:.95rem; padding:.8rem 2.2rem;">Shop ROG Gear</a>
    </div>
</div>

<div style="max-width:1280px; margin:0 auto; padding:4rem 1.5rem;">

    {{-- Story --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center; margin-bottom:5rem;">
        <div>
            <h2 class="section-title" style="margin-bottom:1.5rem;">Our Story</h2>
            <p style="color:#888; line-height:1.9; margin-bottom:1rem; font-size:.95rem;">
                In 2006, ASUS launched Republic of Gamers with a single mission: create the ultimate gaming hardware without compromise. What started as a line of extreme gaming motherboards evolved into one of the most iconic gaming brands on the planet.
            </p>
            <p style="color:#888; line-height:1.9; margin-bottom:1rem; font-size:.95rem;">
                Today, ROG covers every corner of the gaming ecosystem — from ultra-slim gaming laptops to championship-grade peripherals, professional-grade monitors to component-level excellence. Every product is obsessively engineered, rigorously tested, and relentlessly pushed beyond the competition.
            </p>
            <p style="color:#888; line-height:1.9; font-size:.95rem;">
                ROG isn't just a brand — it's a statement. It's the gear carried by world-champion esports teams. It's the hardware running inside the rigs of the world's best gamers. It's technology that refuses to settle for second place.
            </p>
        </div>
        <div>
            <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=700&q=80" alt="ROG Gaming Battlestation" style="width:100%; border:1px solid #2a2a2a; height:380px; object-fit:cover;">
        </div>
    </div>

    {{-- Stats --}}
    <div style="background:#111; border:1px solid #1e1e1e; padding:3rem; margin-bottom:5rem; display:grid; grid-template-columns:repeat(4,1fr); gap:2rem; text-align:center;">
        @foreach([
            ['500+', 'Innovation Awards'],
            ['18+',  'Years of Excellence'],
            ['#1',   'Gaming Brand Globally'],
            ['50+',  'Pro Esports Partners'],
        ] as [$num, $label])
        <div>
            <div style="font-family:'Orbitron',sans-serif; font-size:2.5rem; font-weight:900; color:var(--rog-red); line-height:1; margin-bottom:.5rem;">{{ $num }}</div>
            <div style="font-size:.8rem; color:#666; text-transform:uppercase; letter-spacing:.1em;">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    {{-- Product Lines --}}
    <div style="margin-bottom:5rem;">
        <h2 class="section-title" style="margin-bottom:2.5rem; text-align:center; display:block;">ROG Product Lines</h2>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:1.5rem;">
            @foreach([
                ['🎮','ROG','The flagship line. Flagship performance. No compromises whatsoever — only the absolute best.'],
                ['💻','ROG Zephyrus','Ultra-slim laptops that redefine what thin-and-light gaming machines can achieve.'],
                ['⚔','ROG Strix SCAR','Tournament-grade gaming beasts delivering desktop performance in portable form.'],
                ['🌊','ROG Flow','Versatile 2-in-1 gaming laptops that seamlessly transition between work and play.'],
                ['🛡','TUF Gaming','Military-grade durability meets high-performance gaming at incredible value.'],
                ['✨','ROG STRIX GPU','Triple-fan graphics cards with legendary performance for desktop gaming builds.'],
            ] as [$icon,$name,$desc])
            <div class="rog-card" style="padding:1.8rem;">
                <div style="font-size:2rem; margin-bottom:.8rem;">{{ $icon }}</div>
                <h3 style="font-weight:800; color:var(--rog-red); font-size:.95rem; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.7rem;">{{ $name }}</h3>
                <p style="color:#666; font-size:.85rem; line-height:1.7;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- CTA --}}
    <div style="text-align:center; padding:4rem 2rem; background:#111; border:1px solid #1e1e1e;">
        <h2 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.4rem,3vw,2rem); font-weight:900; color:#fff; margin-bottom:1rem;">Ready to Join the Republic?</h2>
        <p style="color:#666; margin-bottom:2rem; font-size:.95rem;">Browse our complete lineup of ROG gaming hardware and build your ultimate setup today.</p>
        <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:1rem; padding:.9rem 2.5rem;">Shop Now</a>
    </div>
</div>
@endsection
