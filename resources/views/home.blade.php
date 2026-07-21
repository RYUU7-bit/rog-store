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

{{-- ═══ STATS STRIP ══════════════════════════════════════════════════════════ --}}
<div style="background:#111; border-bottom:1px solid #1e1e1e;">
    <div style="max-width:1280px; margin:0 auto; padding:1.4rem 1.5rem; display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; text-align:center;">
        @foreach([
            ['🚀','Free Shipping','On orders over $500'],
            ['🔒','Secure Payment','100% safe & encrypted'],
            ['🏆','Genuine ROG','Official ASUS products'],
            ['🔧','2-Year Warranty','Full manufacturer warranty'],
        ] as [$icon,$title,$sub])
        <div style="display:flex; align-items:center; gap:.8rem; justify-content:center;">
            <span style="font-size:1.6rem;">{{ $icon }}</span>
            <div style="text-align:left;">
                <div style="font-weight:700; font-size:.9rem; color:#fff;">{{ $title }}</div>
                <div style="font-size:.75rem; color:#666;">{{ $sub }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ═══ CATEGORIES ═══════════════════════════════════════════════════════════ --}}
<section style="max-width:1280px; margin:0 auto; padding:4rem 1.5rem;">
    <div style="text-align:center; margin-bottom:2.5rem;">
        <h2 class="section-title" style="margin:0 auto;">Shop by Category</h2>
        <p style="color:#666; margin-top:.8rem; font-size:.95rem;">Find exactly what you need for your ultimate gaming setup</p>
    </div>
    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(140px,1fr)); gap:1rem;">
        @php
        $catIcons = ['gaming-laptops'=>'💻','gaming-monitors'=>'🖥️','gaming-keyboards'=>'⌨️','gaming-mice'=>'🖱️','gaming-headsets'=>'🎧','graphics-cards'=>'🎮','motherboards'=>'🔌','gaming-chairs'=>'🪑'];
        @endphp
        @foreach($categories as $cat)
        <a href="{{ route('shop', ['category'=>$cat->slug]) }}" style="text-decoration:none;">
            <div class="cat-card">
                <div class="cat-icon">{{ $catIcons[$cat->slug] ?? '🎮' }}</div>
                <div style="font-weight:700; font-size:.85rem; color:#ddd; margin-bottom:.3rem;">{{ $cat->name }}</div>
                <div style="font-size:.73rem; color:#666;">{{ $cat->active_products_count ?? 0 }} Products</div>
            </div>
        </a>
        @endforeach
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
<section style="max-width:1280px; margin:0 auto; padding:4rem 1.5rem;">
    <h2 class="section-title" style="margin:0 auto 2.5rem; text-align:center; display:block;">Why Choose ROG?</h2>
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.5rem;">
        @foreach([
            ['⚡','Maximum Performance','Every ROG product is pushed to its limits before it reaches your hands. We test beyond the extremes.'],
            ['🔬','Cutting-Edge Tech','From OLED panels to PCIe 5.0, ROG implements the latest technologies ahead of the competition.'],
            ['🏅','Pro Esports Trust','The gear preferred by world-champion esports teams across all major tournaments globally.'],
            ['🎨','Aura Sync RGB','Customizable per-key and system-wide RGB lighting synchronized across your entire ROG setup.'],
            ['🔊','Premium Audio','ROG audio tech delivers positional accuracy and immersive soundscapes that give you the edge.'],
            ['🛡️','Military-Grade Build','TUF standards. Stress-tested components. Durability tested to survive the most intense sessions.'],
        ] as [$icon,$title,$desc])
        <div class="rog-card" style="padding:1.8rem 1.4rem; text-align:center;">
            <div style="font-size:2.2rem; margin-bottom:.9rem;">{{ $icon }}</div>
            <h3 style="font-weight:700; font-size:.95rem; color:#ddd; margin-bottom:.7rem; text-transform:uppercase; letter-spacing:.06em;">{{ $title }}</h3>
            <p style="color:#666; font-size:.83rem; line-height:1.6;">{{ $desc }}</p>
        </div>
        @endforeach
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
@endpush
