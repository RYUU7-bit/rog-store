@extends('layouts.app')
@section('title', 'ROG Store — Republic of Gamers | Ultimate Gaming Gear')

@section('content')
{{-- ═══ HERO SLIDESHOW (DYNAMIC 8K CINEMATIC SHOWCASE) ═══════════════════════ --}}
<section class="slideshow-wrap">

    {{-- Slide 1: Zephyrus G16 (8K) --}}
    <div class="slide active">
        <div class="slide-bg" style="background-image:url('{{ asset('images/rog-hero-slide-1.jpg') }}');"></div>
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <div class="hero-8k-badge">
                <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#e5001e; box-shadow:0 0 8px #e5001e; animation:pulse-beacon 1.3s infinite;"></span>
                <span style="color:#ff4d6d; font-size:.72rem; font-weight:800; letter-spacing:.2em; text-transform:uppercase;">8K UHD // 240HZ NEBULA OLED</span>
            </div>
            <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(2rem,4.5vw,3.6rem); font-weight:900; color:#fff; line-height:1.05; margin-bottom:.8rem; text-shadow:0 0 35px rgba(229,0,30,0.5);">
                ROG Zephyrus G16
            </h1>
            <p style="color:#cbd5e1; font-size:1rem; line-height:1.65; margin-bottom:1.2rem; max-width:520px;">
                Ultra-slim CNC unibody with iconic Slash Lighting. AMD Ryzen 9 AI + RTX 4090 powering an inky-black 2.5K 240Hz OLED display.
            </p>

            {{-- Spec Pills --}}
            <div style="display:flex; gap:.6rem; flex-wrap:wrap; margin-bottom:1.6rem;">
                <span class="hero-spec-pill"><span style="color:#e5001e;">⚡</span> RTX 4090 16GB</span>
                <span class="hero-spec-pill"><span style="color:#c084fc;">🧠</span> Ryzen 9 AI 8945HS</span>
                <span class="hero-spec-pill"><span style="color:#00e5ff;">✨</span> 2.5K 240Hz OLED</span>
                <span class="hero-spec-pill"><span style="color:#10b981;">❄</span> 0dB Ambient Cooling</span>
            </div>

            <div style="display:flex; align-items:center; gap:1.2rem; flex-wrap:wrap;">
                <a href="{{ route('product.show','rog-zephyrus-g16-2024') }}" class="btn-rog" style="text-decoration:none; font-size:.92rem; padding:.8rem 2.2rem; box-shadow:0 0 25px rgba(229,0,30,0.5);">
                    Shop Zephyrus G16
                </a>
                <a href="{{ route('shop',['category'=>'gaming-laptops']) }}" class="btn-rog-outline" style="text-decoration:none; font-size:.92rem; padding:.8rem 1.8rem;">
                    All Laptops &rarr;
                </a>
                <div style="color:#94a3b8; font-size:.85rem; font-weight:600;">
                    From <span style="font-family:'Orbitron',sans-serif; color:#e5001e; font-weight:900; font-size:1.15rem; text-shadow:0 0 10px rgba(229,0,30,0.4);">$2,199.99</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Slide 2: RTX 4090 (8K) --}}
    <div class="slide">
        <div class="slide-bg" style="background-image:url('{{ asset('images/rog-hero-slide-2.jpg') }}');"></div>
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <div class="hero-8k-badge">
                <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#e5001e; box-shadow:0 0 8px #e5001e; animation:pulse-beacon 1.3s infinite;"></span>
                <span style="color:#ff4d6d; font-size:.72rem; font-weight:800; letter-spacing:.2em; text-transform:uppercase;">8K RAY TRACING // 24GB GDDR6X</span>
            </div>
            <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(2rem,4.5vw,3.6rem); font-weight:900; color:#fff; line-height:1.05; margin-bottom:.8rem; text-shadow:0 0 35px rgba(229,0,30,0.5);">
                ROG STRIX RTX 4090
            </h1>
            <p style="color:#cbd5e1; font-size:1rem; line-height:1.65; margin-bottom:1.2rem; max-width:520px;">
                Ada Lovelace flagship with triple Axial-tech cooling fans, massive patented vapor chamber, and full Aura Sync RGB mecha exoskeleton.
            </p>

            {{-- Spec Pills --}}
            <div style="display:flex; gap:.6rem; flex-wrap:wrap; margin-bottom:1.6rem;">
                <span class="hero-spec-pill"><span style="color:#e5001e;">⚡</span> 24GB GDDR6X 384-Bit</span>
                <span class="hero-spec-pill"><span style="color:#00e5ff;">🧠</span> DLSS 3.5 AI Ray Recon</span>
                <span class="hero-spec-pill"><span style="color:#38bdf8;">❄</span> 3.5-Slot Vapor Chamber</span>
                <span class="hero-spec-pill"><span style="color:#eab308;">🛡</span> Die-Cast Exoskeleton</span>
            </div>

            <div style="display:flex; align-items:center; gap:1.2rem; flex-wrap:wrap;">
                <a href="{{ route('product.show','rog-strix-rtx-4090-oc') }}" class="btn-rog" style="text-decoration:none; font-size:.92rem; padding:.8rem 2.2rem; box-shadow:0 0 25px rgba(229,0,30,0.5);">
                    Shop RTX 4090
                </a>
                <a href="{{ route('shop',['category'=>'graphics-cards']) }}" class="btn-rog-outline" style="text-decoration:none; font-size:.92rem; padding:.8rem 1.8rem;">
                    All GPUs &rarr;
                </a>
                <div style="color:#94a3b8; font-size:.85rem; font-weight:600;">
                    From <span style="font-family:'Orbitron',sans-serif; color:#e5001e; font-weight:900; font-size:1.15rem; text-shadow:0 0 10px rgba(229,0,30,0.4);">$1,999.99</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Slide 3: Monitors (8K) --}}
    <div class="slide">
        <div class="slide-bg" style="background-image:url('{{ asset('images/rog-hero-slide-3.jpg') }}');"></div>
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <div class="hero-8k-badge">
                <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#e5001e; box-shadow:0 0 8px #e5001e; animation:pulse-beacon 1.3s infinite;"></span>
                <span style="color:#ff4d6d; font-size:.72rem; font-weight:800; letter-spacing:.2em; text-transform:uppercase;">8K CLARITY // 4K 240HZ QD-OLED</span>
            </div>
            <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(2rem,4.5vw,3.6rem); font-weight:900; color:#fff; line-height:1.05; margin-bottom:.8rem; text-shadow:0 0 35px rgba(229,0,30,0.5);">
                ROG Swift OLED PG32UCDM
            </h1>
            <p style="color:#cbd5e1; font-size:1rem; line-height:1.65; margin-bottom:1.2rem; max-width:520px;">
                32" 4K QD-OLED masterpiece with 240Hz refresh rate, 0.03ms GTG response, graphene custom heatsink, and true 1,500,000:1 contrast.
            </p>

            {{-- Spec Pills --}}
            <div style="display:flex; gap:.6rem; flex-wrap:wrap; margin-bottom:1.6rem;">
                <span class="hero-spec-pill"><span style="color:#e5001e;">⚡</span> 0.03ms GTG Lightning Speed</span>
                <span class="hero-spec-pill"><span style="color:#c084fc;">🌈</span> 99% DCI-P3 Color Gamut</span>
                <span class="hero-spec-pill"><span style="color:#00e5ff;">❄</span> Custom Graphene Heatsink</span>
                <span class="hero-spec-pill"><span style="color:#eab308;">🎯</span> Downward ROG Light Projector</span>
            </div>

            <div style="display:flex; align-items:center; gap:1.2rem; flex-wrap:wrap;">
                <a href="{{ route('product.show','rog-swift-oled-pg32ucdm') }}" class="btn-rog" style="text-decoration:none; font-size:.92rem; padding:.8rem 2.2rem; box-shadow:0 0 25px rgba(229,0,30,0.5);">
                    Shop Swift OLED
                </a>
                <a href="{{ route('shop',['category'=>'gaming-monitors']) }}" class="btn-rog-outline" style="text-decoration:none; font-size:.92rem; padding:.8rem 1.8rem;">
                    All Monitors &rarr;
                </a>
                <div style="color:#94a3b8; font-size:.85rem; font-weight:600;">
                    From <span style="font-family:'Orbitron',sans-serif; color:#e5001e; font-weight:900; font-size:1.15rem; text-shadow:0 0 10px rgba(229,0,30,0.4);">$1,099.99</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Slide 4: Peripherals (8K) --}}
    <div class="slide">
        <div class="slide-bg" style="background-image:url('{{ asset('images/rog-hero-slide-4.jpg') }}');"></div>
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <div class="hero-8k-badge">
                <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#e5001e; box-shadow:0 0 8px #e5001e; animation:pulse-beacon 1.3s infinite;"></span>
                <span style="color:#ff4d6d; font-size:.72rem; font-weight:800; letter-spacing:.2em; text-transform:uppercase;">8K POLLING RATE // PRO ESPORTS BATTLE RIG</span>
            </div>
            <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(2rem,4.5vw,3.6rem); font-weight:900; color:#fff; line-height:1.05; margin-bottom:.8rem; text-shadow:0 0 35px rgba(229,0,30,0.5);">
                ROG Pro Ecosystem
            </h1>
            <p style="color:#cbd5e1; font-size:1rem; line-height:1.65; margin-bottom:1.2rem; max-width:520px;">
                Engineered with world champions: Azoth OLED custom gasket keyboard, Harpe Ace 54g ultralight mouse, and Delta S wireless quad-DAC headset.
            </p>

            {{-- Spec Pills --}}
            <div style="display:flex; gap:.6rem; flex-wrap:wrap; margin-bottom:1.6rem;">
                <span class="hero-spec-pill"><span style="color:#e5001e;">⚡</span> SpeedNova Tri-Mode Wireless</span>
                <span class="hero-spec-pill"><span style="color:#00e5ff;">🎯</span> 36,000 DPI ROG AimPoint</span>
                <span class="hero-spec-pill"><span style="color:#c084fc;">🔊</span> ESS 9281 Quad-DAC Audio</span>
                <span class="hero-spec-pill"><span style="color:#10b981;">🔋</span> 2,000+ Hours Battery Life</span>
            </div>

            <div style="display:flex; align-items:center; gap:1.2rem; flex-wrap:wrap;">
                <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:.92rem; padding:.8rem 2.2rem; box-shadow:0 0 25px rgba(229,0,30,0.5);">
                    Browse Battle Gear
                </a>
                <a href="{{ route('shop',['category'=>'gaming-keyboards']) }}" class="btn-rog-outline" style="text-decoration:none; font-size:.92rem; padding:.8rem 1.8rem;">
                    Keyboards &rarr;
                </a>
            </div>
        </div>
    </div>

    {{-- Mecha Cyber Controls --}}
    <button class="slide-nav-btn" style="left:20px;" id="slide-prev" aria-label="Previous Slide">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button class="slide-nav-btn" style="right:20px;" id="slide-next" aria-label="Next Slide">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- 8K Tabbed Progress Bar Navigation --}}
    <div class="slide-tabs-nav">
        <div class="slide-tab-btn active" data-slide="0">
            <div class="slide-tab-num">01 // LAPTOPS</div>
            <div class="slide-tab-label">Zephyrus G16</div>
            <div class="slide-tab-progress"></div>
        </div>
        <div class="slide-tab-btn" data-slide="1">
            <div class="slide-tab-num">02 // GRAPHICS</div>
            <div class="slide-tab-label">Strix RTX 4090</div>
            <div class="slide-tab-progress"></div>
        </div>
        <div class="slide-tab-btn" data-slide="2">
            <div class="slide-tab-num">03 // DISPLAYS</div>
            <div class="slide-tab-label">Swift OLED 4K</div>
            <div class="slide-tab-progress"></div>
        </div>
        <div class="slide-tab-btn" data-slide="3">
            <div class="slide-tab-num">04 // PRO GEAR</div>
            <div class="slide-tab-label">Pro Ecosystem</div>
            <div class="slide-tab-progress"></div>
        </div>
    </div>
</section>

{{-- ═══ MOBILE CATEGORY QUICK-PILLS ═══════════════════════════════════════════ --}}
<div style="background:rgba(13,11,24,0.6); backdrop-filter:blur(8px); border-bottom:1px solid rgba(147,51,234,0.2); padding:0.75rem 1rem;">
    <div style="max-width:1280px; margin:0 auto;">
        <div class="cat-pill-scroll">
            <a href="{{ route('shop') }}" class="cat-pill active">
                <span>🔥</span>
                <span>All Gear</span>
            </a>
            @foreach($navCategories as $cat)
            <a href="{{ route('shop', ['category' => $cat->slug]) }}" class="cat-pill">
                <span>⚡</span>
                <span>{{ $cat->name }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══ ROG HIGHLIGHTS (DYNAMIC 3D CYBER AURORA) ═════════════════════════════ --}}
<section class="rog-highlights-section">
    {{-- Dynamic Nebula Backdrop --}}
    <div class="rog-highlights-backdrop"></div>
    <div class="rog-cyber-grid-overlay" style="opacity:0.5;"></div>

    {{-- Vertical Cyber Decal Rail (Right) --}}
    <div class="rog-cyber-rail">
        <div class="rog-cyber-rail-text">
            <span>REPUBLIC OF GAMERS</span>
        </div>
        <div style="display:flex; flex-direction:column; align-items:center; gap:8px; margin-top:1.5rem;">
            <span class="rog-cyber-rail-icon">✦</span>
            <span class="rog-cyber-rail-icon">◈</span>
            <span style="color:#c084fc; font-size:.7rem; font-weight:800; letter-spacing:.15em;">+ +</span>
            <span style="width:2px; height:40px; background:linear-gradient(to bottom, #c084fc, transparent);"></span>
            <span style="font-size:.65rem; color:#a855f7; font-family:monospace;">||| | ||||</span>
        </div>
    </div>

    <div style="max-width:1280px; margin:0 auto; padding:0 1.2rem; position:relative; z-index:2;">
        
        {{-- Section Header --}}
        <div style="text-align:center; margin-bottom:2.8rem;">
            <div style="display:inline-flex; align-items:center; gap:.5rem; background:rgba(147,51,234,0.12); border:1px solid rgba(147,51,234,0.3); padding:.3rem 1rem; border-radius:20px; margin-bottom:.8rem; backdrop-filter:blur(6px);">
                <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#c084fc; box-shadow:0 0 8px #c084fc; animation:pulse-beacon 1.4s infinite;"></span>
                <span style="font-size:.68rem; font-weight:800; letter-spacing:.25em; text-transform:uppercase; color:#d8b4fe;">COMMUNITY & STORIES</span>
            </div>
            <h2 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.8rem,4vw,2.6rem); color:#ffffff; letter-spacing:.08em; text-transform:uppercase; margin:0; text-shadow:0 0 25px rgba(168,85,247,0.5);">
                ROG Highlights
            </h2>
        </div>

        {{-- Top Featured Highlights (2 Large 3D Cards) --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:1.6rem; margin-bottom:1.6rem;">
            
            {{-- Highlight Card 1: Back to School --}}
            <div class="rog-highlight-card-wrap">
                <a href="{{ route('shop') }}" style="text-decoration:none;" class="rog-highlight-card">
                    <div class="rog-card-glare"></div>
                    <div class="rog-highlight-img-wrap">
                        <img src="{{ asset('images/rog-highlight-1.jpg') }}" alt="Back to School Gaming PCs" class="rog-highlight-img"
                             onerror="this.src='https://images.unsplash.com/photo-1542751371-adc38448a05e?w=700&q=80'">
                    </div>
                    <div class="rog-highlight-body">
                        <div class="rog-highlight-tag">
                            <span>//</span>
                            <span>GAMING</span>
                        </div>
                        <h3 class="rog-highlight-title">
                            STUDY BY DAY, DOMINATE BY NIGHT: THE BEST BACK TO SCHOOL PCS FROM ROG
                        </h3>
                        <div class="rog-highlight-footer">
                            <div class="rog-highlight-meta">Lane Prescott &bull; Aug 13, 2026</div>
                            <div class="rog-highlight-bar"></div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Highlight Card 2: Google AI Plan --}}
            <div class="rog-highlight-card-wrap">
                <a href="{{ route('shop') }}" style="text-decoration:none;" class="rog-highlight-card">
                    <div class="rog-card-glare"></div>
                    <div class="rog-highlight-img-wrap">
                        <img src="{{ asset('images/rog-highlight-2.jpg') }}" alt="ROG AI Laptop Plan" class="rog-highlight-img"
                             onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=700&q=80'">
                    </div>
                    <div class="rog-highlight-body">
                        <div class="rog-highlight-tag">
                            <span>//</span>
                            <span>ROG GAMING LAPTOPS</span>
                        </div>
                        <h3 class="rog-highlight-title">
                            YOUR ROG PC COMES WITH A GOOGLE AI PRO OR GOOGLE AI PLUS PLAN — HERE'S HOW TO CLAIM IT
                        </h3>
                        <div class="rog-highlight-footer">
                            <div class="rog-highlight-meta">ROG &bull; Aug 12, 2026</div>
                            <div class="rog-highlight-bar"></div>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        {{-- Bottom Highlights Grid (3 Secondary 3D Cards) --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:1.4rem;">
            
            {{-- Highlight Card 3: ROG Ally X --}}
            <div class="rog-highlight-card-wrap">
                <a href="{{ route('shop') }}" style="text-decoration:none;" class="rog-highlight-card">
                    <div class="rog-card-glare"></div>
                    <div class="rog-highlight-img-wrap">
                        <img src="{{ asset('images/rog-highlight-3.jpg') }}" alt="ROG Ally X Handheld" class="rog-highlight-img"
                             onerror="this.src='https://images.unsplash.com/photo-1612287232213-91b4028b1db8?w=500&q=80'">
                    </div>
                    <div class="rog-highlight-body">
                        <div class="rog-highlight-tag">
                            <span>//</span>
                            <span>ROG HANDHELDS</span>
                        </div>
                        <h3 class="rog-highlight-title" style="font-size:.92rem;">
                            ROG ALLY X: UNRIVALED ERGONOMICS, 80WH BATTERY, AND WINDOWS 11 FREEDOM
                        </h3>
                        <div class="rog-highlight-footer">
                            <div class="rog-highlight-meta">ROG &bull; Aug 15, 2026</div>
                            <div class="rog-highlight-bar"></div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Highlight Card 4: 3D Esports Rig --}}
            <div class="rog-highlight-card-wrap">
                <a href="{{ route('about') }}" style="text-decoration:none;" class="rog-highlight-card">
                    <div class="rog-card-glare"></div>
                    <div class="rog-highlight-img-wrap">
                        <img src="{{ asset('images/rog-story-3d.jpg') }}" alt="3D Esports Rig" class="rog-highlight-img">
                    </div>
                    <div class="rog-highlight-body">
                        <div class="rog-highlight-tag">
                            <span>//</span>
                            <span>3D TOKYO PROTOCOL</span>
                        </div>
                        <h3 class="rog-highlight-title" style="font-size:.92rem;">
                            INSIDE THE 2077 CYBER BATTLE RIG: HOW PROS TRAIN FOR ZERO LATENCY
                        </h3>
                        <div class="rog-highlight-footer">
                            <div class="rog-highlight-meta">Esports Labs &bull; Aug 10, 2026</div>
                            <div class="rog-highlight-bar"></div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Highlight Card 5: ROG Swift OLED --}}
            <div class="rog-highlight-card-wrap">
                <a href="{{ route('shop') }}" style="text-decoration:none;" class="rog-highlight-card">
                    <div class="rog-card-glare"></div>
                    <div class="rog-highlight-img-wrap">
                        <img src="https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=600&q=80" alt="ROG Swift OLED" class="rog-highlight-img">
                    </div>
                    <div class="rog-highlight-body">
                        <div class="rog-highlight-tag">
                            <span>//</span>
                            <span>GAMING MONITORS</span>
                        </div>
                        <h3 class="rog-highlight-title" style="font-size:.92rem;">
                            ROG SWIFT OLED: INFINITE CONTRAST AND 240HZ THAT REDEFINES VISUAL SPEED
                        </h3>
                        <div class="rog-highlight-footer">
                            <div class="rog-highlight-meta">Hardware Tech &bull; Aug 08, 2026</div>
                            <div class="rog-highlight-bar"></div>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>
</section>

{{-- ═══ FEATURED PRODUCTS ═══════════════════════════════════════════════════ --}}
<section style="background:transparent; padding:3.5rem 0; border-top:1px solid rgba(147,51,234,0.15); border-bottom:1px solid rgba(147,51,234,0.15);">
    <div style="max-width:1280px; margin:0 auto; padding:0 1.2rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2rem; flex-wrap:wrap; gap:.8rem;">
            <div>
                <h2 class="section-title">Featured Products</h2>
                <p style="color:var(--text-muted); margin-top:.4rem; font-size:.85rem;">Handpicked ROG elite — the gear champions rely on</p>
            </div>
            <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none;">View All</a>
        </div>
        <div class="product-grid-mobile" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1.2rem;">
            @foreach($featuredProducts as $product)
            <div class="product-card">
                @if($product->sale_price)
                <div class="badge-sale">-{{ $product->discount_percent }}%</div>
                @endif
                <div class="badge-featured">Featured</div>
                <a href="{{ route('product.show',$product->slug) }}">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=400&q=60'">
                </a>
                <div class="product-card-body" style="padding:1rem;">
                    <div style="font-size:.7rem; color:var(--rog-red); font-weight:600; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.25rem;">{{ $product->category->name }}</div>
                    <a href="{{ route('product.show',$product->slug) }}" style="text-decoration:none;">
                        <h3 class="product-card-title" style="font-size:.92rem; font-weight:700; color:var(--text-primary); margin-bottom:.4rem; line-height:1.3; transition:color .2s;"
                            onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-primary)'">
                            {{ $product->name }}
                        </h3>
                    </a>
                    <div style="display:flex; align-items:center; gap:.6rem; margin-bottom:.6rem; flex-wrap:wrap;">
                        @if($product->sale_price)
                        <span class="price-original">${{ number_format($product->price, 2) }}</span>
                        <span class="price-current product-card-price">${{ number_format($product->sale_price, 2) }}</span>
                        @else
                        <span class="price-current product-card-price">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                    <div style="display:flex; gap:.5rem; margin-top:auto;">
                        <form action="{{ route('cart.add') }}" method="POST" style="flex:1;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-rog product-card-btn" style="width:100%; justify-content:center; font-size:.75rem; padding:.5rem;">
                                Add to Cart
                            </button>
                        </form>
                        <a href="{{ route('product.show',$product->slug) }}" class="btn-rog-outline" style="text-decoration:none; font-size:.75rem; padding:.5rem .7rem; display:flex; align-items:center; justify-content:center;">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ ABOUT ROG BANNER ═════════════════════════════════════════════════════ --}}
<section style="position:relative; overflow:hidden; background:var(--bg-base); border-top:1px solid var(--border-base);">
    <div style="position:absolute; inset:0; background:radial-gradient(ellipse at 70% 50%, rgba(229,0,30,.12) 0%, transparent 65%); pointer-events:none;"></div>
    <div style="max-width:1280px; margin:0 auto; padding:4rem 1.2rem; display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:3rem; align-items:center;">
        <div>
            <div style="color:var(--rog-red); font-size:.75rem; font-weight:700; letter-spacing:.25em; text-transform:uppercase; margin-bottom:.8rem;">About ROG</div>
            <h2 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.5rem,3vw,2.2rem); font-weight:900; color:var(--text-primary); line-height:1.2; margin-bottom:1.2rem;">
                Republic of Gamers — <span style="color:var(--rog-red);">Born to Win</span>
            </h2>
            <p style="color:var(--text-muted); line-height:1.8; margin-bottom:1rem; font-size:.9rem;">
                Founded in 2006, ROG (Republic of Gamers) is ASUS's elite gaming brand dedicated to creating the most advanced gaming hardware in the world. From laptops to peripherals, every ROG product is engineered to give you the competitive edge.
            </p>
            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-bottom:1.8rem;">
                @foreach([['500+','Awards'],['#1','Gaming Brand'],['2006','Est.']] as [$num,$label])
                <div style="text-align:center; border:1px solid var(--border-card); padding:1rem .5rem; background:var(--bg-card);">
                    <div style="font-family:'Orbitron',sans-serif; font-size:1.4rem; font-weight:900; color:var(--rog-red); line-height:1;">{{ $num }}</div>
                    <div style="font-size:.7rem; color:var(--text-muted); margin-top:.3rem; text-transform:uppercase; letter-spacing:.06em;">{{ $label }}</div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('about') }}" class="btn-rog" style="text-decoration:none;">Learn More About ROG</a>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:.8rem;">
            {{-- ROG Zephyrus G16 2024 --}}
            <img src="https://dlcdnwebimgs.asus.com/gain/1C1F18DA-F930-40E6-8C76-6F9C51A8F0EE/w800/h600"
                 alt="ROG Zephyrus G16 Laptop"
                 style="width:100%; height:160px; object-fit:cover; border:1px solid var(--border-card); border-radius:6px;"
                 onerror="this.src='https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&q=80'">
            {{-- Gamer at desk with ROG 3D setup --}}
            <img src="{{ asset('images/rog-story-3d.jpg') }}"
                 alt="ROG 3D Gaming Setup"
                 style="width:100%; height:160px; object-fit:cover; border:1px solid var(--border-card); border-radius:6px;"
                 onerror="this.src='https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&q=80'">
            {{-- ROG STRIX RTX 4090 GPU --}}
            <img src="https://dlcdnwebimgs.asus.com/gain/9E8B3BDF-4BB7-45CC-B7BE-F38810969B9A/w800/h600"
                 alt="ROG Zephyrus Lid Slash Lighting"
                 style="width:100%; height:160px; object-fit:cover; border:1px solid var(--border-card); border-radius:6px;"
                 onerror="this.src='https://images.unsplash.com/photo-1555680202-c86f0e12f086?w=400&q=80'">
            {{-- Gaming PC RGB build --}}
            <img src="https://images.unsplash.com/photo-1555680202-c86f0e12f086?w=400&q=80"
                 alt="ROG RGB Gaming PC"
                 style="width:100%; height:160px; object-fit:cover; border:1px solid var(--border-card); border-radius:6px;"
                 onerror="this.src='https://images.unsplash.com/photo-1616588589676-62b3bd4ff6d2?w=400&q=80'">
        </div>
    </div>
</section>

{{-- ═══ NEW ARRIVALS ══════════════════════════════════════════════════════════ --}}
<section style="max-width:1280px; margin:0 auto; padding:3.5rem 1.2rem;">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2rem; flex-wrap:wrap; gap:.8rem;">
        <div>
            <h2 class="section-title">New Arrivals</h2>
            <p style="color:var(--text-muted); margin-top:.4rem; font-size:.85rem;">The latest ROG products just landed</p>
        </div>
        <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none;">See All</a>
    </div>
    <div class="product-grid-mobile" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1.2rem;">
        @foreach($newArrivals as $product)
        <div class="product-card">
            <div style="position:absolute; top:10px; left:10px; background:#00a651; color:#fff; font-size:.65rem; font-weight:700; padding:2px 8px; text-transform:uppercase; z-index:2; border-radius:3px;">NEW</div>
            <a href="{{ route('product.show',$product->slug) }}">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy"
                     onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=400&q=60'">
            </a>
            <div class="product-card-body" style="padding:1rem;">
                <div style="font-size:.7rem; color:var(--rog-red); font-weight:600; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.25rem;">{{ $product->category->name }}</div>
                <a href="{{ route('product.show',$product->slug) }}" style="text-decoration:none;">
                    <h3 class="product-card-title" style="font-size:.92rem; font-weight:700; color:var(--text-primary); margin-bottom:.5rem; line-height:1.3;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-primary)'">{{ $product->name }}</h3>
                </a>
                <div style="display:flex; align-items:center; justify-content:space-between; margin-top:auto; gap:.5rem;">
                    <span class="price-current product-card-price">${{ number_format($product->sale_price ?? $product->price, 2) }}</span>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-rog product-card-btn" style="font-size:.73rem; padding:.4rem .8rem;">+ Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ═══ SALE PRODUCTS ════════════════════════════════════════════════════════ --}}
@if($saleProducts->count())
<section style="background:var(--bg-surface-2); padding:3.5rem 0; border-top:1px solid var(--border-base);">
    <div style="max-width:1280px; margin:0 auto; padding:0 1.2rem;">
        <div style="text-align:center; margin-bottom:2rem;">
            <div style="display:inline-block; background:var(--rog-red); color:#fff; font-size:.7rem; font-weight:700; letter-spacing:.15em; text-transform:uppercase; padding:.3rem .9rem; margin-bottom:.6rem; border-radius:3px;">Limited Time</div>
            <h2 class="section-title" style="margin:0 auto;">Hot Deals</h2>
        </div>
        <div class="product-grid-mobile" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:1.2rem;">
            @foreach($saleProducts as $product)
            <div class="product-card" style="display:flex; gap:0; flex-direction:row; align-items:center; padding:.8rem;">
                <div class="badge-sale">-{{ $product->discount_percent }}%</div>
                <a href="{{ route('product.show',$product->slug) }}" style="flex-shrink:0;">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy" style="width:110px; height:90px; object-fit:contain; background:#0d0d0d; padding:8px;"
                         onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=200&q=60'">
                </a>
                <div style="padding:.5rem 1rem; flex:1; min-width:0;">
                    <div style="font-size:.68rem; color:var(--rog-red); font-weight:600; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.2rem;">{{ $product->category->name }}</div>
                    <a href="{{ route('product.show',$product->slug) }}" style="text-decoration:none;">
                        <h4 style="font-size:.87rem; font-weight:700; color:#ddd; line-height:1.3; margin-bottom:.5rem; transition:color .2s;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#ddd'">{{ Str::limit($product->name,35) }}</h4>
                    </a>
                    <div style="display:flex; align-items:center; gap:.5rem;">
                        <span class="price-original" style="font-size:.8rem;">${{ number_format($product->price,2) }}</span>
                        <span class="price-current" style="font-size:1rem;">${{ number_format($product->sale_price,2) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ WHY ROG ═══════════════════════════════════════════════════════ --}}
<section id="rogWhySection" style="background:transparent; padding:5rem 0; border-top:1px solid rgba(147,51,234,0.15); border-bottom:1px solid rgba(147,51,234,0.15); overflow:hidden; position:relative;">

    {{-- Background accent --}}
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:600px; height:600px; background:radial-gradient(circle, rgba(229,0,30,0.04) 0%, transparent 70%); pointer-events:none;"></div>

    <div style="max-width:1280px; margin:0 auto; padding:0 1.5rem;">

        {{-- Section Header --}}
        <div style="text-align:center; margin-bottom:3.5rem;">
            <div style="display:inline-flex; align-items:center; gap:.6rem; background:rgba(229,0,30,.08); border:1px solid rgba(229,0,30,.2); padding:.3rem 1rem; border-radius:2px; margin-bottom:1rem;">
                <div style="width:6px; height:6px; background:#e5001e; border-radius:50%;"></div>
                <span style="font-size:.65rem; font-weight:800; letter-spacing:.2em; text-transform:uppercase; color:#e5001e;">Republic of Gamers</span>
            </div>
            <h2 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.6rem,3vw,2.4rem); color:#fff; letter-spacing:.05em; text-transform:uppercase; margin:0; line-height:1.1;">
                WHY CHOOSE <span style="color:#e5001e;">ROG?</span>
            </h2>
            <div style="width:60px; height:3px; background:linear-gradient(90deg,#e5001e,transparent); margin:1rem auto 0;"></div>
        </div>

        {{-- 8K 3D Holographic Cards Grid --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:1.4rem;">

            @php
            $features = [
                [
                    'title'       => 'Maximum Performance',
                    'tag'         => 'APEX VOLTAGE',
                    'desc'        => 'Every ROG product is pushed beyond factory limits. Ultra-low latency, custom binning, and extreme thermal headroom so you dominate every frame.',
                    'featured'    => false,
                    'color'       => '#e5001e',
                    'color2'      => '#ff0055',
                    'svg'         => '<svg class="rog-8k-svg" viewBox="0 0 24 24" fill="none" stroke="#ff0055" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/><circle cx="12" cy="12" r="1" fill="#fff"/></svg>',
                ],
                [
                    'title'       => 'Cutting-Edge Tech',
                    'tag'         => 'NEURAL ARCH',
                    'desc'        => 'From QD-OLED 240Hz Nebula panels to PCIe 5.0 and DDR5-7200, ROG implements tomorrow’s computing innovations ahead of the industry.',
                    'featured'    => false,
                    'color'       => '#00f0ff',
                    'color2'      => '#0284c7',
                    'svg'         => '<svg class="rog-8k-svg" viewBox="0 0 24 24" fill="none" stroke="#00f0ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></svg>',
                ],
                [
                    'title'       => 'Pro Esports Trust',
                    'tag'         => 'CHAMPIONSHIP APEX',
                    'desc'        => 'The battle-tested gear preferred by world-champion esports organizations across Major Tier-1 tournaments worldwide.',
                    'featured'    => true,
                    'color'       => '#fbbf24',
                    'color2'      => '#ea580c',
                    'svg'         => '<svg class="rog-8k-svg" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/><polygon points="12 4 13.2 6.5 16 6.8 14 8.7 14.5 11.5 12 10.1 9.5 11.5 10 8.7 8 6.8 10.8 6.5" fill="#fbbf24" stroke="none"/></svg>',
                ],
                [
                    'title'       => 'Aura Sync RGB',
                    'tag'         => '16.8M CHROMATIC',
                    'desc'        => 'Customizable per-key and multi-zone ecosystem illumination dynamically synchronized across all connected ROG peripherals.',
                    'featured'    => false,
                    'color'       => '#a855f7',
                    'color2'      => '#ec4899',
                    'svg'         => '<svg class="rog-8k-svg" viewBox="0 0 24 24" fill="none" stroke="#c084fc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>',
                ],
                [
                    'title'       => 'Premium Audio',
                    'tag'         => 'ESS QUAD-DAC',
                    'desc'        => 'Precision positional acoustics, AI noise-canceling mic matrices, and studio-grade soundstages that pinpoint enemy movements.',
                    'featured'    => false,
                    'color'       => '#22c55e',
                    'color2'      => '#10b981',
                    'svg'         => '<svg class="rog-8k-svg" viewBox="0 0 24 24" fill="none" stroke="#34d399" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><line x1="23" y1="2" x2="23" y2="22" stroke-dasharray="2 2"/></svg>',
                ],
                [
                    'title'       => 'Military-Grade Build',
                    'tag'         => 'MIL-SPEC 810H',
                    'desc'        => 'CNC aluminum chassis, vapor-chamber thermal envelopes, and vibration stress-testing engineered to withstand extreme gaming marathons.',
                    'featured'    => false,
                    'color'       => '#38bdf8',
                    'color2'      => '#6366f1',
                    'svg'         => '<svg class="rog-8k-svg" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>',
                ],
            ];
            @endphp

            @foreach($features as $f)
            <div class="rog-why-card {{ $f['featured'] ? 'is-featured' : '' }}" style="--pod-color: {{ $f['color'] }}; --pod-color-2: {{ $f['color2'] }};">
                <div class="hud-corner-tl"></div>
                <div class="rog-why-laser"></div>

                @if($f['featured'])
                <div style="position:absolute; top:-1px; left:50%; transform:translateX(-50%); background:linear-gradient(135deg,#e5001e,#ff0055); color:#fff; font-family:'Orbitron',sans-serif; font-size:.62rem; font-weight:900; letter-spacing:.15em; padding:.25rem .9rem; text-transform:uppercase; white-space:nowrap; border-radius:0 0 6px 6px; box-shadow:0 0 15px rgba(229,0,30,0.6); z-index:4;">
                    ★ MOST TRUSTED ESPORTS
                </div>
                @endif

                {{-- 8K Dynamic 3D Holographic Icon Pod --}}
                <div class="rog-8k-icon-pod">
                    <div class="rog-8k-ring"></div>
                    <div class="rog-8k-ring-rev"></div>
                    <div class="rog-8k-pod-core">
                        {!! $f['svg'] !!}
                    </div>
                </div>

                {{-- Tag Badge --}}
                <div style="font-family:'Orbitron',sans-serif; font-size:.65rem; font-weight:800; letter-spacing:.15em; color:{{ $f['color'] }}; text-transform:uppercase; margin-bottom:.35rem; display:flex; align-items:center; gap:5px;">
                    <span style="display:inline-block; width:5px; height:5px; border-radius:50%; background:currentColor; box-shadow:0 0 6px currentColor;"></span>
                    {{ $f['tag'] }}
                </div>

                {{-- Title --}}
                <h3 style="font-family:'Orbitron',sans-serif; font-weight:800; font-size:.86rem; color:#fff; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.6rem; line-height:1.3;">
                    {{ $f['title'] }}
                </h3>

                {{-- Divider --}}
                <div style="width:36px; height:2px; background:linear-gradient(90deg, {{ $f['color'] }}, transparent); margin-bottom:.8rem;"></div>

                {{-- Description --}}
                <p style="color:#94a3b8; font-size:.83rem; line-height:1.65; margin:0; flex-grow:1;">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Bottom 8K Holographic Stat Bar --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem; margin-top:3.5rem;">
            @foreach([
                ['500+', 'Active Hardware SKUs', '#e5001e', '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>'],
                ['99.8%', 'Global Hardware Uptime', '#00f0ff', '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00f0ff" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>'],
                ['50,000+', 'Active Elite Gamers', '#c084fc', '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c084fc" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'],
                ['24/7', 'Live Telemetry Support', '#22c55e', '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>'],
            ] as [$num, $label, $clr, $svg])
            <div class="rog-stat-pod">
                <div class="hud-corner-tl"></div>
                <div class="rog-stat-num" style="color:{{ $clr }}; text-shadow:0 0 16px {{ $clr }}80;">
                    {!! $svg !!}
                    <span>{{ $num }}</span>
                </div>
                <div class="rog-stat-label">{{ $label }}</div>
            </div>
            @endforeach
        </div>

    </div>
</section>

    </div>
</section>

{{-- ═══ ROG PRODUCT LINES (8K 3D ANIMATED HOLOGRAPHIC MATRIX) ═══════════════ --}}
<section class="rog-product-lines-section">
    <div style="max-width:1280px; margin:0 auto; padding:0 1.5rem; position:relative; z-index:2;">

        {{-- Section Header --}}
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:3.2rem; flex-wrap:wrap; gap:1.2rem;">
            <div>
                <div style="display:inline-flex; align-items:center; gap:.5rem; background:rgba(229,0,30,0.12); border:1px solid rgba(229,0,30,0.3); padding:.3rem 1rem; border-radius:20px; margin-bottom:.8rem; backdrop-filter:blur(6px);">
                    <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#e5001e; box-shadow:0 0 8px #e5001e; animation:pulse-beacon 1.3s infinite;"></span>
                    <span style="font-size:.68rem; font-weight:800; letter-spacing:.25em; text-transform:uppercase; color:#ff4d6d;">8K HARDWARE MATRIX</span>
                </div>
                <h2 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.6rem,3.5vw,2.4rem); color:#ffffff; text-transform:uppercase; letter-spacing:.06em; margin:0; text-shadow:0 0 25px rgba(229,0,30,0.4);">
                    ROG Product Lines
                </h2>
            </div>
            <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none; font-size:.82rem; padding:.6rem 1.6rem;">
                Explore All Series &rarr;
            </a>
        </div>

        {{-- 8K 3D Holographic Grid (3x2 Balanced Grid) --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:1.6rem;">
            @php
            $productLines = [
                [
                    'name'  => 'ROG Flagship',
                    'tag'   => '8K APEX MATRIX',
                    'desc'  => 'The pinnacle of gaming hardware. Extreme overclocking, zero thermal bottleneck, custom liquid cooling readiness.',
                    'link'  => route('shop'),
                    'action'=> 'Explore Flagship',
                    'color' => '#e5001e',
                    'svg'   => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/><circle cx="12" cy="12" r="2" fill="#e5001e"/></svg>'
                ],
                [
                    'name'  => 'ROG Zephyrus',
                    'tag'   => '8K SLASH LIGHTING',
                    'desc'  => 'Ultra-slim CNC aluminum chassis redefining thin-and-light gaming laptops with stunning high-refresh OLED displays.',
                    'link'  => route('shop', ['category' => 'gaming-laptops']),
                    'action'=> 'View Zephyrus',
                    'color' => '#c084fc',
                    'svg'   => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#c084fc" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="12" rx="2"/><line x1="2" y1="20" x2="22" y2="20"/><line x1="7" y1="8" x2="17" y2="12" stroke="#e5001e" stroke-width="2.2"/></svg>'
                ],
                [
                    'name'  => 'ROG Strix SCAR',
                    'tag'   => '360HZ TOURNAMENT',
                    'desc'  => 'Tournament-grade esports beasts delivering 360Hz refresh rates, desktop-class GPU wattage and per-key RGB armor glow.',
                    'link'  => route('shop', ['category' => 'gaming-laptops']),
                    'action'=> 'View SCAR Beasts',
                    'color' => '#ff0055',
                    'svg'   => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ff0055" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 11l6-9 6 9M6 13l6 9 6-9"/><circle cx="12" cy="11" r="2" fill="#ff0055"/></svg>'
                ],
                [
                    'name'  => 'ROG Flow',
                    'tag'   => '2-IN-1 TRANSFORM',
                    'desc'  => 'Versatile 2-in-1 convertible machines that seamlessly morph from ultraportable touch powerhouse to 4K battle workstation with XG Mobile.',
                    'link'  => route('shop', ['category' => 'gaming-laptops']),
                    'action'=> 'View Flow Series',
                    'color' => '#00e5ff',
                    'svg'   => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#00e5ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/></svg>'
                ],
                [
                    'name'  => 'TUF Gaming',
                    'tag'   => 'MIL-SPEC 810H',
                    'desc'  => 'Military-grade durability meets high-performance components for gamers who demand unstoppable reliability and rugged power.',
                    'link'  => route('shop'),
                    'action'=> 'View TUF Gear',
                    'color' => '#eab308',
                    'svg'   => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#eab308" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>'
                ],
                [
                    'name'  => 'ROG Strix GPUs',
                    'tag'   => 'TRIPLE AXIAL 8K',
                    'desc'  => 'Triple-fan axial-tech graphics cards engineered for maximum thermal dissipation, extreme clocks, and whisper-silent 8K gaming dominance.',
                    'link'  => route('shop', ['category' => 'graphics-cards']),
                    'action'=> 'View GPUs',
                    'color' => '#38bdf8',
                    'svg'   => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="12" r="4"/><circle cx="17" cy="12" r="4"/><path d="M2 12h1M21 12h1M12 2v20"/></svg>'
                ],
            ];
            @endphp

            @foreach($productLines as $item)
            <div class="rog-pl-card-wrap">
                <a href="{{ $item['link'] }}" class="rog-pl-card">
                    {{-- Dynamic Specular Light Glare --}}
                    <div class="rog-card-glare"></div>

                    {{-- Sweeping Hologram Scanline --}}
                    <div class="rog-hologram-sweep" style="animation-duration: 5s;"></div>

                    {{-- Cyber HUD Corner Brackets --}}
                    <div class="hud-corner hud-tl"></div>
                    <div class="hud-corner hud-tr"></div>
                    <div class="hud-corner hud-bl"></div>
                    <div class="hud-corner hud-br"></div>

                    {{-- 8K Hologram Badge (Top-Right) --}}
                    <div class="rog-pl-badge-8k">
                        <span style="display:inline-block; width:5px; height:5px; border-radius:50%; background:{{ $item['color'] }}; box-shadow:0 0 6px {{ $item['color'] }};"></span>
                        <span>{{ $item['tag'] }}</span>
                    </div>

                    {{-- Mecha Icon Box --}}
                    <div class="rog-pl-icon-box">
                        {!! $item['svg'] !!}
                    </div>

                    {{-- Name --}}
                    <h3 class="rog-pl-name">
                        {{ $item['name'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="rog-pl-desc">
                        {{ $item['desc'] }}
                    </p>

                    {{-- Action Link --}}
                    <div class="rog-pl-action">
                        <span>{{ $item['action'] }}</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
(function(){
    const slides = document.querySelectorAll('.slide');
    const tabs   = document.querySelectorAll('.slide-tab-btn');
    let current  = 0;
    let timer    = null;
    let progressInterval = null;
    const duration = 6500; // 6.5s per slide

    function updateProgress(tab, percent) {
        const bar = tab.querySelector('.slide-tab-progress');
        if (bar) bar.style.width = percent + '%';
    }

    function resetAllProgress() {
        tabs.forEach(t => {
            const bar = t.querySelector('.slide-tab-progress');
            if (bar) bar.style.width = '0%';
        });
    }

    function startProgress() {
        if (progressInterval) clearInterval(progressInterval);
        const startTime = Date.now();
        const activeTab = tabs[current];
        
        progressInterval = setInterval(() => {
            const elapsed = Date.now() - startTime;
            const percent = Math.min((elapsed / duration) * 100, 100);
            if (activeTab) updateProgress(activeTab, percent);
            
            if (elapsed >= duration) {
                clearInterval(progressInterval);
            }
        }, 50);
    }

    function goTo(n) {
        if (slides.length === 0) return;
        
        slides[current].classList.remove('active');
        if (tabs[current]) tabs[current].classList.remove('active');
        
        resetAllProgress();
        current = (n + slides.length) % slides.length;
        
        slides[current].classList.add('active');
        if (tabs[current]) tabs[current].classList.add('active');
        
        startProgress();
    }

    function autoPlay() {
        if (timer) clearInterval(timer);
        startProgress();
        timer = setInterval(() => {
            goTo(current + 1);
        }, duration);
    }

    document.getElementById('slide-prev')?.addEventListener('click', () => {
        clearInterval(timer);
        goTo(current - 1);
        autoPlay();
    });

    document.getElementById('slide-next')?.addEventListener('click', () => {
        clearInterval(timer);
        goTo(current + 1);
        autoPlay();
    });

    tabs.forEach((tab, i) => {
        tab.addEventListener('click', () => {
            clearInterval(timer);
            goTo(i);
            autoPlay();
        });
    });

    // Pause on hover
    const wrap = document.querySelector('.slideshow-wrap');
    if (wrap) {
        wrap.addEventListener('mouseenter', () => {
            if (timer) clearInterval(timer);
            if (progressInterval) clearInterval(progressInterval);
        });
        wrap.addEventListener('mouseleave', () => {
            autoPlay();
        });
    }

    goTo(0);
    autoPlay();
})();
</script>
<style>
div:hover > .pl-line { width: 100% !important; }
</style>
@endpush
