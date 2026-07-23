@extends('layouts.app')
@section('title', 'ROG Store — Republic of Gamers | Ultimate Gaming Gear')

@section('content')

{{-- ═══ HERO SLIDESHOW ══════════════════════════════════════════════════════ --}}
<section class="slideshow-wrap">

    {{-- Slide 1: Zephyrus G16 --}}
    <div class="slide active" style="background-image:url('https://images.unsplash.com/photo-1593640408182-31c228034c55?w=1600&q=80');">
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <div style="color:var(--rog-red);font-size:.75rem;font-weight:700;letter-spacing:.25em;text-transform:uppercase;margin-bottom:.8rem;">New Arrival 2024</div>
            <h1 style="font-family:'Orbitron',sans-serif;font-size:clamp(1.8rem,4vw,3.2rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;" class="rog-text-glow">
                ROG Zephyrus G16
            </h1>
            <p style="color:#ccc;font-size:1.05rem;line-height:1.6;margin-bottom:1.5rem;max-width:440px;">
                AMD Ryzen 9 + RTX 4090. Ultra-slim powerhouse redefining what a thin gaming laptop can do.
            </p>
            <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                <a href="{{ route('product.show','rog-zephyrus-g16-2024') }}" class="btn-rog" style="text-decoration:none;">Shop Now</a>
                <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none;">View All</a>
            </div>
            <div style="margin-top:1.5rem;color:#888;font-size:.9rem;">Starting from <span style="color:var(--rog-red);font-weight:700;font-size:1.1rem;">$2,199.99</span></div>
        </div>
    </div>

    {{-- Slide 2: RTX 4090 --}}
    <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1591488320449-011701bb6704?w=1600&q=80');">
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <div style="color:var(--rog-red);font-size:.75rem;font-weight:700;letter-spacing:.25em;text-transform:uppercase;margin-bottom:.8rem;">Ultimate GPU</div>
            <h1 style="font-family:'Orbitron',sans-serif;font-size:clamp(1.8rem,4vw,3.2rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;" class="rog-text-glow">
                ROG STRIX RTX 4090
            </h1>
            <p style="color:#ccc;font-size:1.05rem;line-height:1.6;margin-bottom:1.5rem;max-width:440px;">
                24GB GDDR6X. Ada Lovelace architecture. Dominate 4K gaming with ray tracing and DLSS 3.
            </p>
            <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                <a href="{{ route('product.show','rog-strix-rtx-4090-oc') }}" class="btn-rog" style="text-decoration:none;">Shop Now</a>
                <a href="{{ route('shop',['category'=>'graphics-cards']) }}" class="btn-rog-outline" style="text-decoration:none;">GPUs</a>
            </div>
            <div style="margin-top:1.5rem;color:#888;font-size:.9rem;">From <span style="color:var(--rog-red);font-weight:700;font-size:1.1rem;">$1,999.99</span></div>
        </div>
    </div>

    {{-- Slide 3: Monitors --}}
    <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=1600&q=80');">
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <div style="color:var(--rog-red);font-size:.75rem;font-weight:700;letter-spacing:.25em;text-transform:uppercase;margin-bottom:.8rem;">OLED Perfection</div>
            <h1 style="font-family:'Orbitron',sans-serif;font-size:clamp(1.8rem,4vw,3.2rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;" class="rog-text-glow">
                ROG Swift OLED<br>PG32UCDM
            </h1>
            <p style="color:#ccc;font-size:1.05rem;line-height:1.6;margin-bottom:1.5rem;max-width:440px;">
                32" 4K OLED 240Hz. Perfect blacks, infinite contrast. The monitor that changes everything.
            </p>
            <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                <a href="{{ route('product.show','rog-swift-oled-pg32ucdm') }}" class="btn-rog" style="text-decoration:none;">Shop Now</a>
                <a href="{{ route('shop',['category'=>'gaming-monitors']) }}" class="btn-rog-outline" style="text-decoration:none;">Monitors</a>
            </div>
            <div style="margin-top:1.5rem;color:#888;font-size:.9rem;">From <span style="color:var(--rog-red);font-weight:700;font-size:1.1rem;">$1,099.99</span></div>
        </div>
    </div>

    {{-- Slide 4: Peripherals --}}
    <div class="slide" style="background-image:url('https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=1600&q=80');">
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <div style="color:var(--rog-red);font-size:.75rem;font-weight:700;letter-spacing:.25em;text-transform:uppercase;margin-bottom:.8rem;">Pro Peripherals</div>
            <h1 style="font-family:'Orbitron',sans-serif;font-size:clamp(1.8rem,4vw,3.2rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;" class="rog-text-glow">
                ROG Gaming<br>Peripherals
            </h1>
            <p style="color:#ccc;font-size:1.05rem;line-height:1.6;margin-bottom:1.5rem;max-width:440px;">
                Keyboards, mice, headsets — engineered for precision, built for champions. Win every match.
            </p>
            <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none;">Browse All</a>
            </div>
        </div>
    </div>

    {{-- Controls --}}
    <button class="slide-nav-btn" style="left:16px;" id="slide-prev">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button class="slide-nav-btn" style="right:16px;" id="slide-next">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </button>
    <div class="slide-dots" id="slide-dots">
        <div class="slide-dot active"></div>
        <div class="slide-dot"></div>
        <div class="slide-dot"></div>
        <div class="slide-dot"></div>
    </div>
</section>

{{-- ═══ FEATURED PRODUCTS ═══════════════════════════════════════════════════ --}}
<section style="background:#0d0d0d; padding:4rem 0; border-top:1px solid #1a1a1a; border-bottom:1px solid #1a1a1a;">
    <div style="max-width:1280px; margin:0 auto; padding:0 1.5rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2.5rem; flex-wrap:wrap; gap:1rem;">
            <div>
                <h2 class="section-title">Featured Products</h2>
                <p style="color:#666; margin-top:.6rem; font-size:.9rem;">Handpicked ROG elite — the gear champions rely on</p>
            </div>
            <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none;">View All Products</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1.4rem;">
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
                <div style="padding:1rem;">
                    <div style="font-size:.72rem; color:var(--rog-red); font-weight:600; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.3rem;">{{ $product->category->name }}</div>
                    <a href="{{ route('product.show',$product->slug) }}" style="text-decoration:none;">
                        <h3 style="font-size:.97rem; font-weight:700; color:#ddd; margin-bottom:.5rem; line-height:1.3; transition:color .2s;"
                            onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#ddd'">
                            {{ $product->name }}
                        </h3>
                    </a>
                    <p style="font-size:.8rem; color:#666; margin-bottom:.9rem; line-height:1.5;">{{ Str::limit($product->short_description, 70) }}</p>
                    <div style="display:flex; align-items:center; gap:.7rem; margin-bottom.8rem;">
                        @if($product->sale_price)
                        <span class="price-original">${{ number_format($product->price, 2) }}</span>
                        <span class="price-current">${{ number_format($product->sale_price, 2) }}</span>
                        @else
                        <span class="price-current">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                    <div style="display:flex; gap:.6rem; margin-top:.8rem;">
                        <form action="{{ route('cart.add') }}" method="POST" style="flex:1;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-rog" style="width:100%; justify-content:center; font-size:.78rem; padding:.5rem;">
                                Add to Cart
                            </button>
                        </form>
                        <a href="{{ route('product.show',$product->slug) }}" class="btn-rog-outline" style="text-decoration:none; font-size:.78rem; padding:.5rem .8rem;">
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
<section style="position:relative; overflow:hidden; background:#080808; border-top:1px solid #1a1a1a;">
    <div style="position:absolute; inset:0; background:radial-gradient(ellipse at 70% 50%, rgba(229,0,30,.12) 0%, transparent 65%); pointer-events:none;"></div>
    <div style="max-width:1280px; margin:0 auto; padding:5rem 1.5rem; display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center;">
        <div>
            <div style="color:var(--rog-red); font-size:.75rem; font-weight:700; letter-spacing:.25em; text-transform:uppercase; margin-bottom:1rem;">About ROG</div>
            <h2 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.6rem,3vw,2.4rem); font-weight:900; color:#fff; line-height:1.2; margin-bottom:1.5rem;">
                Republic of Gamers — <span style="color:var(--rog-red);">Born to Win</span>
            </h2>
            <p style="color:#888; line-height:1.8; margin-bottom:1rem; font-size:.95rem;">
                Founded in 2006, ROG (Republic of Gamers) is ASUS's elite gaming brand dedicated to creating the most advanced gaming hardware in the world. From laptops to peripherals, every ROG product is engineered with one purpose: to give you the competitive edge.
            </p>
            <p style="color:#888; line-height:1.8; margin-bottom:2rem; font-size:.95rem;">
                With over 500 innovation awards and a track record of pushing boundaries, ROG continues to set the benchmark for gaming performance. Trusted by professional esports teams worldwide, ROG gear is what champions use to win.
            </p>
            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; margin-bottom:2rem;">
                @foreach([['500+','Innovation Awards'],['#1','Gaming Brand'],['2006','Established']] as [$num,$label])
                <div style="text-align:center; border:1px solid #1e1e1e; padding:1.2rem .8rem; background:#111;">
                    <div style="font-family:'Orbitron',sans-serif; font-size:1.6rem; font-weight:900; color:var(--rog-red); line-height:1;">{{ $num }}</div>
                    <div style="font-size:.75rem; color:#888; margin-top:.4rem; text-transform:uppercase; letter-spacing:.08em;">{{ $label }}</div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('about') }}" class="btn-rog" style="text-decoration:none;">Learn More About ROG</a>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            {{-- ROG Zephyrus G16 2024 — official ASUS gallery --}}
            <img src="https://dlcdnwebimgs.asus.com/gain/1C1F18DA-F930-40E6-8C76-6F9C51A8F0EE/w800/h600"
                 alt="ROG Zephyrus G16 Laptop"
                 style="width:100%; height:200px; object-fit:cover; border:1px solid #2a2a2a;"
                 onerror="this.src='https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&q=80'">
            {{-- Gamer at desk with ROG setup --}}
            <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&q=80"
                 alt="ROG Gaming Setup"
                 style="width:100%; height:200px; object-fit:cover; border:1px solid #2a2a2a; margin-top:2rem;"
                 onerror="this.src='https://images.unsplash.com/photo-1616588589676-62b3bd4ff6d2?w=400&q=80'">
            {{-- ROG STRIX RTX 4090 GPU — official ASUS CDN --}}
            <img src="https://dlcdnwebimgs.asus.com/gain/9E8B3BDF-4BB7-45CC-B7BE-F38810969B9A/w800/h600"
                 alt="ROG Zephyrus Lid Slash Lighting"
                 style="width:100%; height:200px; object-fit:cover; border:1px solid #2a2a2a; margin-top:-2rem;"
                 onerror="this.src='https://images.unsplash.com/photo-1555680202-c86f0e12f086?w=400&q=80'">
            {{-- Gaming PC RGB build --}}
            <img src="https://images.unsplash.com/photo-1555680202-c86f0e12f086?w=400&q=80"
                 alt="ROG RGB Gaming PC"
                 style="width:100%; height:200px; object-fit:cover; border:1px solid #2a2a2a;"
                 onerror="this.src='https://images.unsplash.com/photo-1616588589676-62b3bd4ff6d2?w=400&q=80'">
        </div>
    </div>
</section>

{{-- ═══ NEW ARRIVALS ══════════════════════════════════════════════════════════ --}}
<section style="max-width:1280px; margin:0 auto; padding:4rem 1.5rem;">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2.5rem; flex-wrap:wrap; gap:1rem;">
        <div>
            <h2 class="section-title">New Arrivals</h2>
            <p style="color:#666; margin-top:.6rem; font-size:.9rem;">The latest ROG products just landed</p>
        </div>
        <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none;">See All</a>
    </div>
    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1.4rem;">
        @foreach($newArrivals as $product)
        <div class="product-card">
            <div style="position:absolute; top:12px; left:12px; background:#00a651; color:#fff; font-size:.65rem; font-weight:700; padding:2px 8px; text-transform:uppercase; z-index:2;">NEW</div>
            <a href="{{ route('product.show',$product->slug) }}">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy"
                     onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=400&q=60'">
            </a>
            <div style="padding:1rem;">
                <div style="font-size:.72rem; color:var(--rog-red); font-weight:600; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.3rem;">{{ $product->category->name }}</div>
                <a href="{{ route('product.show',$product->slug) }}" style="text-decoration:none;">
                    <h3 style="font-size:.95rem; font-weight:700; color:#ddd; margin-bottom:.7rem; line-height:1.3;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#ddd'">{{ $product->name }}</h3>
                </a>
                <div style="display:flex; align-items:center; justify-content:space-between;">
                    <span class="price-current">${{ number_format($product->sale_price ?? $product->price, 2) }}</span>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-rog" style="font-size:.73rem; padding:.4rem .9rem;">+ Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ═══ SALE PRODUCTS ════════════════════════════════════════════════════════ --}}
@if($saleProducts->count())
<section style="background:#0d0d0d; padding:4rem 0; border-top:1px solid #1a1a1a;">
    <div style="max-width:1280px; margin:0 auto; padding:0 1.5rem;">
        <div style="text-align:center; margin-bottom:2.5rem;">
            <div style="display:inline-block; background:var(--rog-red); color:#fff; font-size:.72rem; font-weight:700; letter-spacing:.15em; text-transform:uppercase; padding:.3rem 1rem; margin-bottom:.8rem;">Limited Time</div>
            <h2 class="section-title" style="margin:0 auto;">Hot Deals</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:1.4rem;">
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

{{-- ═══ WHY ROG ═══════════════════════════════════════════════════════════════ --}}
<section style="background:#0a0a0a; padding:5rem 0; border-top:1px solid #1a1a1a; border-bottom:1px solid #1a1a1a; overflow:hidden; position:relative;">

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

        {{-- Cards Grid --}}
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem;">

            @php
            $features = [
                [
                    'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.5" stroke-linecap="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
                    'title' => 'Maximum Performance',
                    'desc'  => 'Every ROG product is pushed to its limits before it reaches your hands. We test beyond the extremes so you never have to.',
                    'featured' => false,
                ],
                [
                    'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.5" stroke-linecap="round"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"/></svg>',
                    'title' => 'Cutting-Edge Tech',
                    'desc'  => 'From OLED panels to PCIe 5.0 and DDR5, ROG implements the latest technologies ahead of the competition.',
                    'featured' => false,
                ],
                [
                    'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>',
                    'title' => 'Pro Esports Trust',
                    'desc'  => 'The gear preferred by world-champion esports teams across all major international tournaments globally.',
                    'featured' => true,
                ],
                [
                    'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>',
                    'title' => 'Aura Sync RGB',
                    'desc'  => 'Customizable per-key and system-wide RGB lighting synchronized across your entire ROG setup.',
                    'featured' => false,
                ],
                [
                    'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.5" stroke-linecap="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/></svg>',
                    'title' => 'Premium Audio',
                    'desc'  => 'ROG audio tech delivers precise positional accuracy and immersive soundscapes that give you a critical edge.',
                    'featured' => false,
                ],
                [
                    'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.5" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                    'title' => 'Military-Grade Build',
                    'desc'  => 'TUF standards. Stress-tested components. Durability tested to survive the most intense and demanding sessions.',
                    'featured' => false,
                ],
            ];
            @endphp

            @foreach($features as $f)
            <div style="
                position:relative;
                background:{{ $f['featured'] ? 'linear-gradient(135deg,#1a0505 0%,#0f0f0f 100%)' : '#111' }};
                border:1px solid {{ $f['featured'] ? '#e5001e' : '#1e1e1e' }};
                padding:2rem 1.6rem;
                transition:all .3s ease;
                cursor:default;
                {{ $f['featured'] ? 'box-shadow:0 0 30px rgba(229,0,30,.12), inset 0 0 30px rgba(229,0,30,.03);' : '' }}
            "
            onmouseover="
                this.style.borderColor='#e5001e';
                this.style.transform='translateY(-4px)';
                this.style.boxShadow='0 8px 32px rgba(229,0,30,.15)';
                this.querySelector('.feat-icon-wrap').style.background='rgba(229,0,30,.12)';
            "
            onmouseout="
                this.style.borderColor='{{ $f['featured'] ? '#e5001e' : '#1e1e1e' }}';
                this.style.transform='none';
                this.style.boxShadow='{{ $f['featured'] ? '0 0 30px rgba(229,0,30,.12)' : 'none' }}';
                this.querySelector('.feat-icon-wrap').style.background='{{ $f['featured'] ? 'rgba(229,0,30,.1)' : 'rgba(229,0,30,.05)' }}';
            ">

                @if($f['featured'])
                <div style="position:absolute; top:-1px; left:50%; transform:translateX(-50%); background:#e5001e; color:#fff; font-size:.6rem; font-weight:800; letter-spacing:.15em; padding:.2rem .8rem; text-transform:uppercase; white-space:nowrap;">
                    ★ MOST TRUSTED
                </div>
                @endif

                {{-- Icon --}}
                <div class="feat-icon-wrap" style="
                    width:60px; height:60px;
                    background:{{ $f['featured'] ? 'rgba(229,0,30,.1)' : 'rgba(229,0,30,.05)' }};
                    border:1px solid rgba(229,0,30,.15);
                    display:flex; align-items:center; justify-content:center;
                    margin-bottom:1.2rem;
                    transition:background .3s;
                ">{!! $f['icon'] !!}</div>

                {{-- Title --}}
                <h3 style="font-family:'Orbitron',sans-serif; font-weight:700; font-size:.78rem; color:#fff; text-transform:uppercase; letter-spacing:.12em; margin-bottom:.8rem; line-height:1.3;">
                    {{ $f['title'] }}
                </h3>

                {{-- Divider --}}
                <div style="width:30px; height:2px; background:#e5001e; margin-bottom:.9rem; opacity:.6;"></div>

                {{-- Description --}}
                <p style="color:#666; font-size:.82rem; line-height:1.7; margin:0;">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Bottom stat bar --}}
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:0; margin-top:3.5rem; border:1px solid #1e1e1e; overflow:hidden;">
            @foreach([
                ['500+', 'Products'],
                ['99.8%', 'Uptime'],
                ['50,000+', 'Happy Gamers'],
                ['24/7', 'Support'],
            ] as [$num, $label])
            <div style="padding:1.5rem; text-align:center; border-right:1px solid #1e1e1e; background:#111;"
                 onmouseover="this.style.background='#161616'" onmouseout="this.style.background='#111'">
                <div style="font-family:'Orbitron',sans-serif; font-size:1.6rem; font-weight:900; color:#e5001e; line-height:1;">{{ $num }}</div>
                <div style="font-size:.72rem; color:#555; text-transform:uppercase; letter-spacing:.12em; margin-top:.4rem; font-weight:600;">{{ $label }}</div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ═══ ROG PRODUCT LINES ══════════════════════════════════════════════════════ --}}
<section style="background:#0d0d0d; padding:5rem 0; border-bottom:1px solid #1a1a1a;">
    <div style="max-width:1280px; margin:0 auto; padding:0 1.5rem;">

        {{-- Header --}}
        <div style="margin-bottom:3rem;">
            <h2 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.4rem,2.5vw,2rem); color:#fff; text-transform:uppercase; letter-spacing:.08em; margin:0 0 .6rem;">
                ROG PRODUCT LINES
            </h2>
            <div style="width:80px; height:3px; background:linear-gradient(90deg,#e5001e,transparent);"></div>
        </div>

        {{-- Grid --}}
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:1px; background:#1a1a1a; border:1px solid #1a1a1a;">
            @php
            $lines = [
                [
                    'svg'   => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#9b59b6" stroke-width="1.4" stroke-linecap="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="12"/><path d="M8 12h.01M16 12h.01"/></svg>',
                    'name'  => 'ROG',
                    'desc'  => 'The flagship line. Flagship performance. No compromises whatsoever — only the absolute best.',
                ],
                [
                    'svg'   => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.4" stroke-linecap="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
                    'name'  => 'ROG ZEPHYRUS',
                    'desc'  => 'Ultra-slim laptops that redefine what thin-and-light gaming machines can achieve.',
                ],
                [
                    'svg'   => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.4" stroke-linecap="round"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"/><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"/><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"/><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"/><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"/><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"/><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"/></svg>',
                    'name'  => 'ROG STRIX SCAR',
                    'desc'  => 'Tournament-grade gaming beasts delivering desktop performance in portable form.',
                ],
                [
                    'svg'   => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#3498db" stroke-width="1.4" stroke-linecap="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>',
                    'name'  => 'ROG FLOW',
                    'desc'  => 'Versatile 2-in-1 gaming laptops that seamlessly transition between work and play.',
                ],
                [
                    'svg'   => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#95a5a6" stroke-width="1.4" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                    'name'  => 'TUF GAMING',
                    'desc'  => 'Military-grade durability meets high-performance gaming at incredible value.',
                ],
                [
                    'svg'   => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#f1c40f" stroke-width="1.4" stroke-linecap="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
                    'name'  => 'ROG STRIX GPU',
                    'desc'  => 'Triple-fan graphics cards with legendary performance for desktop gaming builds.',
                ],
            ];
            @endphp

            @foreach($lines as $i => $line)
            <div style="
                background:#111;
                padding:2rem 1.5rem;
                position:relative;
                transition:all .25s ease;
                cursor:pointer;
                {{ $i >= 4 ? 'border-top:1px solid #1a1a1a;' : '' }}
            "
            onmouseover="
                this.style.background='#161616';
                this.style.zIndex='2';
                this.querySelector('.pl-name').style.color='#e5001e';
                this.querySelector('.pl-icon').style.transform='scale(1.1)';
            "
            onmouseout="
                this.style.background='#111';
                this.style.zIndex='1';
                this.querySelector('.pl-name').style.color='#e5001e';
                this.querySelector('.pl-icon').style.transform='scale(1)';
            ">
                {{-- Icon --}}
                <div class="pl-icon" style="margin-bottom:1.2rem; transition:transform .25s; display:inline-block;">
                    {!! $line['svg'] !!}
                </div>

                {{-- Name --}}
                <div class="pl-name" style="font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:800; color:#e5001e; text-transform:uppercase; letter-spacing:.12em; margin-bottom:.7rem; transition:color .25s;">
                    {{ $line['name'] }}
                </div>

                {{-- Desc --}}
                <p style="color:#555; font-size:.8rem; line-height:1.65; margin:0;">
                    {{ $line['desc'] }}
                </p>

                {{-- Hover accent line --}}
                <div style="position:absolute; bottom:0; left:0; width:0%; height:2px; background:#e5001e; transition:width .3s ease;" class="pl-line"></div>
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
    const dots   = document.querySelectorAll('.slide-dot');
    let current  = 0, timer;

    function goTo(n) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (n + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    function autoPlay() { timer = setInterval(() => goTo(current + 1), 5500); }

    document.getElementById('slide-prev')?.addEventListener('click', () => { clearInterval(timer); goTo(current - 1); autoPlay(); });
    document.getElementById('slide-next')?.addEventListener('click', () => { clearInterval(timer); goTo(current + 1); autoPlay(); });
    dots.forEach((d, i) => d.addEventListener('click', () => { clearInterval(timer); goTo(i); autoPlay(); }));
    autoPlay();
})();
</script>
<style>
div:hover > .pl-line { width: 100% !important; }
</style>
@endpush
