<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ROG Store — Republic of Gamers')</title>
    <meta name="description" content="@yield('meta_description', 'Official ROG Store — Premium gaming gear, laptops, monitors, peripherals and components from ASUS Republic of Gamers.')">

    {{-- Google Fonts: Rajdhani, Orbitron, and Khmer Battambang --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@400;700;900&family=Orbitron:wght@700;800;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Theme: apply saved preference before paint to avoid flash --}}
    <script>
        (function(){
            var t = localStorage.getItem('rog-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="alternate icon" href="/favicon.ico">

    @stack('head')
</head>
<body>

{{-- ═══ DYNAMIC 3D CYBER AURORA & LIVE PARTICLE BACKGROUND (GLOBAL) ════════════ --}}
<div class="rog-dynamic-bg-layer" id="rogDynamicBg">
    {{-- Animated Nebular Aurora Blobs --}}
    <div class="rog-aurora-blob rog-aurora-1" id="auroraBlob1"></div>
    <div class="rog-aurora-blob rog-aurora-2" id="auroraBlob2"></div>
    <div class="rog-aurora-blob rog-aurora-3" id="auroraBlob3"></div>
    <div class="rog-aurora-blob rog-aurora-4" id="auroraBlob4"></div>
    <div class="rog-aurora-blob rog-aurora-5" id="auroraBlob5"></div>

    {{-- Live Interactive Particle & Constellation Canvas --}}
    <canvas id="rogLiveCyberCanvas" class="rog-live-canvas"></canvas>

    {{-- Dynamic Periodic Laser Scanline Sweep --}}
    <div class="rog-bg-laser-sweep"></div>

    {{-- Interactive Dynamic Mouse Cursor Spotlight --}}
    <div class="rog-bg-mouse-glow" id="rogBgMouseGlow"></div>

    {{-- 3D Cyber Dot Matrix & Circuit Overlay --}}
    <div class="rog-cyber-grid-overlay"></div>
</div>

{{-- ═══ NAVBAR / APP BAR ═════════════════════════════════════════════════════ --}}
<nav class="navbar mobile-app-header">
    <div style="max-width:1280px; width:100%; margin:0 auto; padding:0 1rem; display:flex; align-items:center; justify-content:space-between; height:100%;">

        {{-- Left: Drawer button on mobile + Logo --}}
        <div style="display:flex; align-items:center; gap:.8rem;">
            {{-- Mobile Drawer Trigger --}}
            <button id="drawer-toggle-btn" class="show-mobile" aria-label="Open Navigation Drawer"
                    style="background:none; border:none; color:var(--text-primary); cursor:pointer; padding:.4rem; display:flex; align-items:center; justify-content:center;">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Brand Logo --}}
            <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:.6rem; text-decoration:none;">
                <svg width="34" height="34" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="#e5001e" opacity=".15"/>
                    <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="none" stroke="#e5001e" stroke-width="3"/>
                    <text x="50" y="62" text-anchor="middle" font-family="Orbitron,sans-serif" font-weight="900" font-size="28" fill="#e5001e">ROG</text>
                </svg>
                <div>
                    <div class="nav-logo-text" style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.05rem; color:#fff; line-height:1;">ROG</div>
                    <div style="font-size:.56rem; color:#e5001e; letter-spacing:.2em; text-transform:uppercase; font-weight:700;">Republic of Gamers</div>
                </div>
            </a>
        </div>

        {{-- Desktop Nav --}}
        <div style="display:flex; align-items:center; gap:.25rem;" class="hidden-mobile">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'text-rog' : '' }}">Home</a>
            <a href="{{ route('shop') }}" class="nav-link {{ request()->routeIs('shop') ? 'text-rog' : '' }}">Shop</a>
            {{-- Categories Dropdown --}}
            <div style="position:relative;" class="dropdown-wrap">
                <button class="nav-link" style="background:none;border:none;cursor:pointer;" onclick="toggleDropdown(this)">
                    Categories ▾
                </button>
                <div class="dropdown-menu" style="display:none; position:absolute; top:calc(100%+8px); left:0; background:#111; border:1px solid #2a2a2a; min-width:220px; z-index:200; box-shadow:0 8px 30px rgba(0,0,0,.6);">
                    @foreach($navCategories as $cat)
                    <a href="{{ route('shop', ['category' => $cat->slug]) }}" style="display:block; padding:.65rem 1.2rem; color:#ccc; text-decoration:none; font-size:.85rem; font-weight:600; letter-spacing:.04em; border-bottom:1px solid #1a1a1a; transition:background .2s, color .2s;"
                       onmouseover="this.style.background='#1a1a1a';this.style.color='#e5001e'"
                       onmouseout="this.style.background='';this.style.color='#ccc'">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'text-rog' : '' }}">About</a>
            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'text-rog' : '' }}">Contact</a>
        </div>

        {{-- Right Action Icons --}}
        <div style="display:flex; align-items:center; gap:.7rem;">
            {{-- Desktop Search --}}
            <form action="{{ route('shop') }}" method="GET" class="nav-search-bar hidden-mobile" style="display:flex; align-items:center; background:#1a1a1a; border:1px solid #2a2a2a; padding:.3rem .8rem; gap:.5rem;">
                <input type="text" name="search" placeholder="Search ROG products…" value="{{ request('search') }}"
                       style="background:none; border:none; color:var(--text-primary); font-size:.82rem; width:180px; outline:none;">
                <button type="submit" style="background:none;border:none;color:var(--text-muted);cursor:pointer;">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                </button>
            </form>

            {{-- Mobile Search Trigger Button --}}
            <button id="mobile-search-btn" class="show-mobile" aria-label="Search ROG products"
                    style="background:none; border:none; color:var(--text-primary); cursor:pointer; padding:.4rem; display:flex; align-items:center;">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.3-4.3"/>
                </svg>
            </button>

            {{-- Theme Toggle Switch --}}
            <label class="theme-toggle" title="Toggle light / dark mode" aria-label="Toggle light / dark mode">
                <input type="checkbox" id="theme-checkbox" role="switch" aria-checked="false">
                <span class="theme-track">
                    <span class="t-icon t-moon">🌙</span>
                    <span class="t-icon t-sun">☀️</span>
                </span>
                <span class="theme-thumb"></span>
            </label>

            {{-- Cart Link with Live Badge --}}
            <a href="{{ route('cart') }}" class="cart-icon-link" style="position:relative; color:var(--text-primary); text-decoration:none; display:flex; align-items:center; padding:.4rem;" title="Cart">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m12-9l2 9M9 21h6"/>
                </svg>
                @if($cartCount > 0)
                <span style="position:absolute; top:-3px; right:-3px; background:var(--rog-red); color:#fff; font-size:.65rem; font-weight:900; min-width:18px; height:18px; border-radius:50%; display:flex; align-items:center; justify-content:center; padding:0 3px; box-shadow:0 2px 6px rgba(var(--rog-red-rgb),.5);">
                    {{ $cartCount }}
                </span>
                @endif
            </a>
        </div>
    </div>
</nav>

{{-- ═══ MOBILE SLIDE-IN DRAWER ═══════════════════════════════════════════════ --}}
<div id="drawer-backdrop" class="drawer-backdrop">
    <div class="mobile-drawer-sheet">
        {{-- Header --}}
        <div class="drawer-header">
            <div style="display:flex; align-items:center; gap:.7rem;">
                <div style="width:36px; height:36px; border-radius:8px; background:var(--rog-red); display:flex; align-items:center; justify-content:center; color:#fff; font-family:'Orbitron',sans-serif; font-weight:900; font-size:.9rem;">
                    ROG
                </div>
                <div>
                    <div style="font-family:'Orbitron',sans-serif; font-weight:800; font-size:.9rem; color:#fff;">ROG Store App</div>
                    <div style="font-size:.68rem; color:#22c55e; font-weight:700;">● Online · Elite Gaming</div>
                </div>
            </div>
            <button id="drawer-close-btn" class="drawer-close-btn" aria-label="Close menu">✕</button>
        </div>

        {{-- Navigation Links --}}
        <div class="drawer-links-group">
            <a href="{{ route('home') }}" class="drawer-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <span class="drawer-icon-wrap">🏠</span>
                <span>Home</span>
            </a>
            <a href="{{ route('shop') }}" class="drawer-nav-item {{ request()->routeIs('shop') && !request('category') ? 'active' : '' }}">
                <span class="drawer-icon-wrap">🛍️</span>
                <span>Shop All Gear</span>
            </a>
            <a href="{{ route('cart') }}" class="drawer-nav-item {{ request()->routeIs('cart') ? 'active' : '' }}">
                <span class="drawer-icon-wrap">🛒</span>
                <span>Shopping Cart</span>
                @if($cartCount > 0)
                <span style="margin-left:auto; background:var(--rog-red); color:#fff; font-size:.7rem; font-weight:900; padding:2px 7px; border-radius:99px;">{{ $cartCount }}</span>
                @endif
            </a>
            <a href="{{ route('about') }}" class="drawer-nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                <span class="drawer-icon-wrap">🛡️</span>
                <span>About ROG</span>
            </a>
            <a href="{{ route('contact') }}" class="drawer-nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                <span class="drawer-icon-wrap">✉️</span>
                <span>Support & Contact</span>
            </a>

            {{-- Categories Section --}}
            <div style="padding:1.2rem 1.4rem .4rem;">
                <div style="font-size:.7rem; font-weight:800; color:var(--rog-red); letter-spacing:.15em; text-transform:uppercase;">Hardware Categories</div>
            </div>
            @foreach($navCategories as $cat)
            <a href="{{ route('shop', ['category' => $cat->slug]) }}" 
               class="drawer-nav-item {{ request('category') === $cat->slug ? 'active' : '' }}"
               style="font-size:.85rem; padding-left:1.8rem;">
                <span style="color:var(--text-muted); font-size:.8rem;">›</span>
                <span>{{ $cat->name }}</span>
            </a>
            @endforeach
        </div>

        {{-- Drawer Footer --}}
        <div style="padding:1.2rem; border-top:1px solid var(--border-base); background:var(--bg-elevated); margin-top:auto;">
            <div style="font-size:.75rem; color:var(--text-muted); text-align:center;">
                Republic of Gamers™ · For Those Who Dare
            </div>
        </div>
    </div>
</div>

{{-- ═══ MOBILE INSTANT SEARCH MODAL SHEET ════════════════════════════════════ --}}
<div id="mobile-search-modal" class="search-modal-overlay">
    <div class="search-modal-content">
        <div style="padding:1rem 1.2rem; border-bottom:1px solid var(--border-base); display:flex; align-items:center; gap:.8rem;">
            <form action="{{ route('shop') }}" method="GET" style="display:flex; align-items:center; flex:1; background:var(--bg-elevated); border:1px solid var(--border-input); border-radius:8px; padding:.5rem .9rem; gap:.6rem;">
                <span style="color:var(--text-muted); font-size:.9rem;">🔍</span>
                <input type="text" name="search" id="mobile-search-input" placeholder="Search ROG laptops, GPUs, monitors…" value="{{ request('search') }}"
                       style="background:none; border:none; color:var(--text-primary); font-size:.95rem; width:100%; outline:none;">
                <button type="submit" style="background:var(--rog-red); color:#fff; border:none; border-radius:4px; padding:.3rem .6rem; font-size:.75rem; font-weight:700; cursor:pointer;">Search</button>
            </form>
            <button id="search-modal-close" style="background:none; border:none; color:var(--text-primary); font-size:1.2rem; cursor:pointer; padding:.3rem;">✕</button>
        </div>
        <div style="padding:1rem 1.2rem;">
            <div style="font-size:.72rem; font-weight:800; color:var(--text-muted); text-transform:uppercase; letter-spacing:.1em; margin-bottom:.7rem;">🔥 Popular Searches</div>
            <div style="display:flex; flex-wrap:wrap; gap:.5rem;">
                @foreach(['Zephyrus G16', 'RTX 4090', 'ROG Swift OLED', 'Gaming Keyboards', 'ROG Harpe Ace', 'Gaming Headsets'] as $hotTag)
                <a href="{{ route('shop', ['search' => $hotTag]) }}" class="cat-pill" style="font-size:.78rem; padding:.35rem .75rem;">
                    ⚡ {{ $hotTag }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ═══ NATIVE MOBILE APP BOTTOM TAB BAR ═════════════════════════════════════ --}}
<nav class="mobile-tab-bar" aria-label="Mobile Navigation">
    {{-- Home Tab --}}
    <a href="{{ route('home') }}" class="mobile-tab-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <div class="mobile-tab-icon">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
        </div>
        <span>Home</span>
    </a>

    {{-- Shop Tab --}}
    <a href="{{ route('shop') }}" class="mobile-tab-item {{ request()->routeIs('shop*') || request()->routeIs('product.*') ? 'active' : '' }}">
        <div class="mobile-tab-icon">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
        </div>
        <span>Shop</span>
    </a>

    {{-- Search Tab (triggers quick modal) --}}
    <button type="button" id="tab-search-btn" class="mobile-tab-item" style="background:none; border:none; cursor:pointer;">
        <div class="mobile-tab-icon">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.3-4.3"/>
            </svg>
        </div>
        <span>Search</span>
    </button>

    {{-- Cart Tab --}}
    <a href="{{ route('cart') }}" class="mobile-tab-item {{ request()->routeIs('cart*') || request()->routeIs('checkout*') ? 'active' : '' }}">
        <div class="mobile-tab-icon">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m12-9l2 9M9 21h6"/>
            </svg>
            @if($cartCount > 0)
            <span class="mobile-tab-badge">{{ $cartCount }}</span>
            @endif
        </div>
        <span>Cart</span>
    </a>

    {{-- AI Assistant Tab --}}
    <button type="button" id="tab-ai-btn" class="mobile-tab-item" style="background:none; border:none; cursor:pointer;">
        <div class="mobile-tab-icon">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="10" rx="2"/>
                <circle cx="12" cy="5" r="2"/>
                <path d="M12 7v4"/>
                <line x1="8" y1="16" x2="8" y2="16"/>
                <line x1="16" y1="16" x2="16" y2="16"/>
            </svg>
        </div>
        <span>ROG AI</span>
    </button>
</nav>

{{-- ═══ Flash Messages ══════════════════════════════════════════════════════ --}}
@if(session('success'))
<div class="alert-success" style="max-width:1280px;margin:.8rem auto;padding:.8rem 1.5rem;">
    ✓ {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert-error" style="max-width:1280px;margin:.8rem auto;padding:.8rem 1.5rem;">
    ✕ {{ session('error') }}
</div>
@endif

{{-- ═══ PAGE CONTENT ════════════════════════════════════════════════════════ --}}
<main>
    @yield('content')
</main>

{{-- ═══ FOOTER & CYBER TICKER ══════════════════════════════════════════════════ --}}
<footer class="rog-footer-root">
    {{-- Ambient Glow and Circuit Background --}}
    <div class="rog-footer-ambient-bg" aria-hidden="true"></div>

    {{-- ── 1. Cyber Marquee Ticker ─────────────────────────────────────────── --}}
    <div class="rog-ticker-ribbon" role="region" aria-label="ROG Announcements Ticker">
        <div class="rog-ticker-track">
            @for($i = 0; $i < 2; $i++)
            <div class="rog-ticker-group">
                <span class="rog-ticker-item rog-ticker-highlight">
                    <span class="rog-ticker-icon">⚔️</span> FOR THOSE WHO DARE
                </span>
                <span class="rog-ticker-item">
                    <span class="rog-ticker-icon">★</span> REPUBLIC OF GAMERS
                </span>
                <span class="rog-ticker-item">
                    <span class="rog-ticker-icon">⚡</span> POWERED BY INNOVATION
                </span>
                <span class="rog-ticker-item rog-ticker-badge-gold">
                    <span class="rog-ticker-icon">🏆</span> BORN TO WIN
                </span>
                <span class="rog-ticker-item">
                    <span class="rog-ticker-icon">🎮</span> ROG ESPORTS SUPREMACY
                </span>
                <span class="rog-ticker-item rog-ticker-highlight">
                    <span class="rog-ticker-icon">💻</span> 2.5K OLED 240Hz NEBULA
                </span>
                <span class="rog-ticker-item">
                    <span class="rog-ticker-icon">🔥</span> UNLEASH YOUR POWER
                </span>
                <span class="rog-ticker-item">
                    <span class="rog-ticker-icon">🛡️</span> 2-YEAR OFFICIAL ASUS WARRANTY
                </span>
                <span class="rog-ticker-item rog-ticker-highlight">
                    <span class="rog-ticker-icon">🚀</span> FREE NATIONWIDE EXPRESS DELIVERY
                </span>
                <span class="rog-ticker-item rog-ticker-badge-gold">
                    <span class="rog-ticker-icon">💳</span> BAKONG KHQR 1-SEC INSTANT CLEARANCE
                </span>
                <span class="rog-ticker-item">
                    <span class="rog-ticker-icon">🤖</span> BILINGUAL ROG AI ASSISTANT 8D
                </span>
            </div>
            @endfor
        </div>
    </div>

    <div class="rog-footer-container">

        {{-- ── 2. VIP Gamer Club / ROG Elite Newsletter Section ───────────────── --}}
        <div class="rog-vip-newsletter-wrap">
            <div class="rog-vip-left">
                <div class="rog-vip-pill">
                    <span>⚡</span> ROG ELITE VIP REWARDS
                </div>
                <h3 class="rog-vip-title">
                    JOIN THE <span>REPUBLIC</span>
                </h3>
                <p class="rog-vip-desc">
                    Unlock exclusive hardware drops, secret discount vouchers, and early RTX 50-series pre-orders directly to your inbox.
                </p>
                <div class="rog-vip-perks">
                    <span class="rog-vip-perk-item">✓ 10% Off Welcome Voucher</span>
                    <span class="rog-vip-perk-item">✓ Priority RMA Warranty</span>
                    <span class="rog-vip-perk-item">✓ VIP Discord Role</span>
                    <span class="rog-vip-perk-item">✓ Zero Spam</span>
                </div>
            </div>

            <form class="rog-vip-form" id="rogVipForm" onsubmit="handleVipSubscribe(event)">
                <div class="rog-vip-input-box">
                    <input type="email" id="rogVipEmail" class="rog-vip-input" placeholder="Enter your gamer email..." required autocomplete="email" aria-label="Email for ROG VIP Club">
                    <button type="submit" class="rog-vip-submit-btn" id="rogVipBtn">
                        <span>JOIN VIP CLUB</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </div>
                <div class="rog-vip-disclaimer" id="rogVipMsg">
                    🔒 By subscribing, you agree to ROG Store Terms & Privacy Policy. Unsubscribe anytime.
                </div>
            </form>
        </div>

        {{-- ── 3. 4-Pillar Advantage HUD Matrix ───────────────────────────────── --}}
        <div class="rog-trust-matrix">
            <div class="rog-trust-card">
                <div class="rog-trust-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                </div>
                <div>
                    <h4 class="rog-trust-title">Express Delivery</h4>
                    <p class="rog-trust-desc">Same-day in Phnom Penh, 24-48h nationwide. Free shipping on $500+.</p>
                </div>
            </div>

            <div class="rog-trust-card">
                <div class="rog-trust-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <div>
                    <h4 class="rog-trust-title">2-Year ASUS Warranty</h4>
                    <p class="rog-trust-desc">100% Genuine ASUS Official Partner with 1-to-1 replacement guarantee.</p>
                </div>
            </div>

            <div class="rog-trust-card">
                <div class="rog-trust-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                </div>
                <div>
                    <h4 class="rog-trust-title">Bakong KHQR 1s Pay</h4>
                    <p class="rog-trust-desc">Instant 1-second auto confirmation via ABA, ACLEDA, Wing & all banks.</p>
                </div>
            </div>

            <div class="rog-trust-card">
                <div class="rog-trust-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 18.72a9 9 0 1 1-12 0"/><path d="M12 2v10"/><circle cx="12" cy="12" r="9"/></svg>
                </div>
                <div>
                    <h4 class="rog-trust-title">Master Tech Support</h4>
                    <p class="rog-trust-desc">Certified ROG technicians, custom PC rigs, thermal repasting & live AI bot.</p>
                </div>
            </div>
        </div>

        {{-- ── 4. Main Multi-Column Footer Grid ───────────────────────────────── --}}
        <div class="rog-footer-main-grid">

            {{-- Column 1: Brand & Community Hub --}}
            <div class="rog-brand-col">
                <a href="{{ route('home') }}" class="rog-brand-header">
                    <svg class="rog-brand-logo-icon" viewBox="0 0 100 100" fill="none">
                        <polygon points="50,4 96,27 96,73 50,96 4,73 4,27" fill="#e5001e" opacity=".18"/>
                        <polygon points="50,4 96,27 96,73 50,96 4,73 4,27" fill="none" stroke="#e5001e" stroke-width="3.5"/>
                        <text x="50" y="63" text-anchor="middle" font-family="'Orbitron', sans-serif" font-weight="900" font-size="28" fill="#e5001e" letter-spacing="1">ROG</text>
                    </svg>
                    <div>
                        <div class="rog-brand-name">
                            ROG STORE
                            <span class="rog-brand-tagline">Republic of Gamers</span>
                        </div>
                    </div>
                </a>

                <p class="rog-brand-text">
                    Republic of Gamers — ASUS's elite gaming division engineered for champions who demand uncompromising performance, precision engineering, and cutting-edge gaming supremacy.
                </p>

                <div class="rog-brand-auth-badges">
                    <span class="rog-auth-badge">🛡️ OFFICIAL ASUS DISTRIBUTOR</span>
                    <span class="rog-auth-badge">⚡ BAKONG VERIFIED</span>
                </div>

                {{-- Social Gaming Hub --}}
                <div class="rog-social-hub">
                    {{-- Discord --}}
                    <a href="https://discord.gg" target="_blank" rel="noopener noreferrer" class="rog-social-btn" title="Join 25K+ Gamers on ROG Discord" aria-label="ROG Discord">
                        <svg viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.894.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                    </a>
                    {{-- YouTube --}}
                    <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="rog-social-btn" title="ROG YouTube Esports" aria-label="ROG YouTube">
                        <svg viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    {{-- Facebook --}}
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="rog-social-btn" title="ROG Facebook Community" aria-label="ROG Facebook">
                        <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    {{-- Telegram --}}
                    <a href="https://t.me" target="_blank" rel="noopener noreferrer" class="rog-social-btn" title="ROG Telegram VIP Channel" aria-label="ROG Telegram">
                        <svg viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.121l-6.871 4.326-2.962-.924c-.643-.204-.657-.643.136-.953l11.57-4.458c.537-.196 1.006.128.832.943z"/></svg>
                    </a>
                    {{-- Instagram --}}
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="rog-social-btn" title="ROG Instagram" aria-label="ROG Instagram">
                        <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                    </a>
                    {{-- Twitch --}}
                    <a href="https://twitch.tv" target="_blank" rel="noopener noreferrer" class="rog-social-btn" title="ROG Twitch Live Streams" aria-label="ROG Twitch">
                        <svg viewBox="0 0 24 24"><path d="M11.571 4.714h1.715v5.143H11.57zm4.715 0H18v5.143h-1.714zM6 0L1.714 4.286v15.428h5.143V24l4.286-4.286h3.428L22.286 12V0zm14.571 11.143l-3.428 3.428h-3.429l-3 3v-3H6.857V1.714h13.714Z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Column 2: Quick Links & Services --}}
            <div>
                <h4 class="rog-footer-col-title">Quick Links</h4>
                <ul class="rog-footer-links">
                    <li class="rog-footer-link-item">
                        <a href="{{ route('home') }}">
                            <span class="rog-link-arrow">►</span> Home
                        </a>
                    </li>
                    <li class="rog-footer-link-item">
                        <a href="{{ route('shop') }}">
                            <span class="rog-link-arrow">►</span> All Gaming Gear <span class="rog-link-tag rog-tag-hot">HOT</span>
                        </a>
                    </li>
                    <li class="rog-footer-link-item">
                        <a href="{{ route('about') }}">
                            <span class="rog-link-arrow">►</span> About ROG
                        </a>
                    </li>
                    <li class="rog-footer-link-item">
                        <a href="{{ route('contact') }}">
                            <span class="rog-link-arrow">►</span> Contact Headquarters
                        </a>
                    </li>
                    <li class="rog-footer-link-item">
                        <a href="{{ route('cart') }}">
                            <span class="rog-link-arrow">►</span> Shopping Cart
                        </a>
                    </li>
                    <li class="rog-footer-link-item">
                        <a href="javascript:void(0)" onclick="document.getElementById('rog-ai-btn')?.click()">
                            <span class="rog-link-arrow">►</span> ROG AI Assistant <span class="rog-link-tag rog-tag-new">8D VOICE</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 3: Categories --}}
            <div>
                <h4 class="rog-footer-col-title">Categories</h4>
                <ul class="rog-footer-links">
                    @forelse($navCategories->take(6) as $cat)
                    <li class="rog-footer-link-item">
                        <a href="{{ route('shop', ['category' => $cat->slug]) }}">
                            <span class="rog-link-arrow">►</span> {{ $cat->name }}
                            @if(stripos($cat->name, 'laptop') !== false)
                                <span class="rog-link-tag rog-tag-oled">OLED</span>
                            @elseif(stripos($cat->name, 'monitor') !== false)
                                <span class="rog-link-tag rog-tag-new">240Hz</span>
                            @endif
                        </a>
                    </li>
                    @empty
                    <li class="rog-footer-link-item"><a href="{{ route('shop') }}"><span class="rog-link-arrow">►</span> Gaming Laptops</a></li>
                    <li class="rog-footer-link-item"><a href="{{ route('shop') }}"><span class="rog-link-arrow">►</span> Gaming Monitors</a></li>
                    <li class="rog-footer-link-item"><a href="{{ route('shop') }}"><span class="rog-link-arrow">►</span> Mechanical Keyboards</a></li>
                    <li class="rog-footer-link-item"><a href="{{ route('shop') }}"><span class="rog-link-arrow">►</span> Gaming Mice</a></li>
                    <li class="rog-footer-link-item"><a href="{{ route('shop') }}"><span class="rog-link-arrow">►</span> Pro Headsets</a></li>
                    <li class="rog-footer-link-item"><a href="{{ route('shop') }}"><span class="rog-link-arrow">►</span> Graphics Cards</a></li>
                    @endforelse
                </ul>
            </div>

            {{-- Column 4: Battle Station Showroom & Support --}}
            <div>
                <h4 class="rog-footer-col-title">Showroom & Support</h4>
                <ul class="rog-contact-list">
                    <li class="rog-contact-item">
                        <span class="rog-contact-icon">📧</span>
                        <div>
                            <div style="font-size:0.75rem; color:#64748b; text-transform:uppercase; font-weight:700;">Gamer Support</div>
                            <a href="mailto:support@rog-store.com">support@rog-store.com</a>
                        </div>
                    </li>
                    <li class="rog-contact-item">
                        <span class="rog-contact-icon">📞</span>
                        <div>
                            <div style="font-size:0.75rem; color:#64748b; text-transform:uppercase; font-weight:700;">Hotline / Toll-Free</div>
                            <a href="tel:18007644263">1-800-ROG-GAME (+855 23 888 999)</a>
                        </div>
                    </li>
                    <li class="rog-contact-item">
                        <span class="rog-contact-icon">📍</span>
                        <div>
                            <div style="font-size:0.75rem; color:#64748b; text-transform:uppercase; font-weight:700;">Flagship Battle Station</div>
                            <span>Monivong Blvd, BKK1, Phnom Penh</span>
                        </div>
                    </li>
                    <li class="rog-contact-item">
                        <span class="rog-contact-icon">🕒</span>
                        <div>
                            <div style="font-size:0.75rem; color:#64748b; text-transform:uppercase; font-weight:700;">Opening Hours</div>
                            <span style="color:#22c55e; font-weight:700;">Open Daily: 8:30 AM – 8:30 PM</span>
                        </div>
                    </li>
                </ul>

                <button type="button" class="rog-ai-quick-btn" onclick="document.getElementById('rog-ai-btn')?.click()">
                    <span>🤖</span> TALK WITH ROG AI 8D
                </button>
            </div>
        </div>

        {{-- ── 5. Cyber Laser Bottom Bar ───────────────────────────────────────── --}}
        <div class="rog-footer-bottom">
            {{-- Left: Copyright & Disclaimers --}}
            <div class="rog-legal-info">
                <p class="rog-copyright-text">
                    © {{ date('Y') }} ROG Store. All rights reserved. Republic of Gamers™ is a registered trademark of ASUSTeK Computer Inc.
                </p>
                <div class="rog-legal-links">
                    <a href="{{ route('about') }}">Privacy Policy</a>
                    <span>•</span>
                    <a href="{{ route('about') }}">Terms of Service</a>
                    <span>•</span>
                    <a href="{{ route('about') }}">Official Warranty Policy</a>
                    <span>•</span>
                    <a href="{{ route('contact') }}">Security Center</a>
                </div>
            </div>

            {{-- Center: Verified Payment Ecosystem --}}
            <div class="rog-payment-ecosystem" title="Supported Payment Methods">
                <span class="rog-pay-badge rog-pay-bakong">⚡ BAKONG KHQR</span>
                <span class="rog-pay-badge rog-pay-aba">ABA PAY</span>
                <span class="rog-pay-badge rog-pay-acleda">ACLEDA</span>
                <span class="rog-pay-badge">WING</span>
                <span class="rog-pay-badge">VISA / MC</span>
                <span class="rog-pay-badge">CASH ON DELIVERY</span>
            </div>

            {{-- Right: Live Status & Back to Top --}}
            <div class="rog-footer-actions">
                <div class="rog-status-pill" title="All ROG Game & Store Servers 100% Operational">
                    <span class="rog-status-dot-pulse"></span>
                    <span>SERVERS ONLINE // 8ms</span>
                </div>

                <button type="button" class="rog-back-to-top-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" aria-label="Scroll back to top">
                    <span>▲</span> TOP
                </button>
            </div>
        </div>

    </div>
</footer>

<script>
// ── VIP Gamer Club Newsletter Client Handler ────────────────────────────────
function handleVipSubscribe(e) {
    e.preventDefault();
    const emailInput = document.getElementById('rogVipEmail');
    const msgEl = document.getElementById('rogVipMsg');
    const btn = document.getElementById('rogVipBtn');
    if (!emailInput || !emailInput.value) return;

    const email = emailInput.value.trim();
    btn.disabled = true;
    btn.innerHTML = '<span>ACTIVATING...</span>';

    setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = '<span>✓ JOINED!</span>';
        btn.style.background = '#22c55e';
        msgEl.innerHTML = '<span style="color:#22c55e; font-weight:700;">🎉 WELCOME TO ROG ELITE!</span> Your 10% voucher code <strong>ROG-VIP-10</strong> has been unlocked.';
        if (window.rogToast) {
            window.rogToast('🎮 Welcome to ROG Elite! Voucher ROG-VIP-10 unlocked!', 'success', 4000);
        }
        emailInput.value = '';
    }, 600);
}
</script>

<style>
@media(max-width:768px){
  .hidden-mobile{display:none!important;}
  .show-mobile{display:flex!important;}
}
@media(min-width:769px){
  .show-mobile{display:none!important;}
}
</style>

<script>
// ── Mobile Drawer Controller ───────────────────────────────────────────────
(function () {
    const backdrop  = document.getElementById('drawer-backdrop');
    const openBtn   = document.getElementById('drawer-toggle-btn');
    const closeBtn  = document.getElementById('drawer-close-btn');

    function openDrawer() {
        backdrop.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }
    function closeDrawer() {
        backdrop.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    openBtn?.addEventListener('click', openDrawer);
    closeBtn?.addEventListener('click', closeDrawer);
    backdrop?.addEventListener('click', function(e) {
        if (e.target === backdrop) closeDrawer();
    });
})();

// ── Mobile Instant Search Modal ─────────────────────────────────────────────
(function () {
    const modal    = document.getElementById('mobile-search-modal');
    const openBtn1 = document.getElementById('mobile-search-btn');
    const openBtn2 = document.getElementById('tab-search-btn');
    const closeBtn = document.getElementById('search-modal-close');
    const input    = document.getElementById('mobile-search-input');

    function openSearch() {
        modal.classList.add('is-open');
        setTimeout(() => input?.focus(), 150);
        document.body.style.overflow = 'hidden';
    }
    function closeSearch() {
        modal.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    openBtn1?.addEventListener('click', openSearch);
    openBtn2?.addEventListener('click', openSearch);
    closeBtn?.addEventListener('click', closeSearch);
    modal?.addEventListener('click', function(e) {
        if (e.target === modal) closeSearch();
    });
})();

// ── AI Tab Button Trigger ───────────────────────────────────────────────────
document.getElementById('tab-ai-btn')?.addEventListener('click', function () {
    document.getElementById('rog-ai-btn')?.click();
});

// ── Dropdown toggle ─────────────────────────────────────────────────────────
function toggleDropdown(btn) {
    const menu = btn.nextElementSibling;
    const isVisible = menu.style.display === 'block';
    document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
    menu.style.display = isVisible ? 'none' : 'block';
}
document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown-wrap')) {
        document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
    }
});

// ── Theme Toggle ─────────────────────────────────────────────────────────────
(function () {
    var html     = document.documentElement;
    var checkbox = document.getElementById('theme-checkbox');
    if (!checkbox) return;

    // Sync checkbox to current theme
    function syncCheckbox() {
        var current = html.getAttribute('data-theme') || 'dark';
        checkbox.checked = (current === 'light');
        checkbox.setAttribute('aria-checked', checkbox.checked);
    }
    syncCheckbox();

    checkbox.addEventListener('change', function () {
        var next = this.checked ? 'light' : 'dark';
        html.setAttribute('data-theme', next);
        localStorage.setItem('rog-theme', next);
        this.setAttribute('aria-checked', this.checked);
    });
})();
</script>

@stack('scripts')

{{-- ═══ ROG BILINGUAL AI ASSISTANT WIDGET (KHMER 🇰🇭 + ENGLISH 🇬🇧 + VOICE TTS) ═══ --}}

{{-- Floating 3D Holographic AI Orb Trigger --}}
<button id="rog-ai-btn" aria-label="Open ROG AI Assistant" title="ROG AI Assistant — Khmer & English Voice AI">
    <div class="rog-ai-orb-wrap">
        {{-- 3D Rotating Orbital Ring --}}
        <div class="rog-ai-orb-ring"></div>
        <div class="rog-ai-orb-ring-rev"></div>

        <div class="rog-robot-icon" aria-hidden="true">
            <svg class="rog-robot-svg" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                {{-- Antenna --}}
                <line class="robot-antenna" x1="32" y1="6" x2="32" y2="13" stroke="#ff0055" stroke-width="2.5" stroke-linecap="round"/>
                <circle class="robot-antenna-ball" cx="32" cy="4.5" r="2.5" fill="#ff0055"/>
                {{-- Head --}}
                <rect class="robot-head" x="16" y="13" width="32" height="22" rx="5" fill="#120e24" stroke="#ff0055" stroke-width="1.8"/>
                {{-- Eyes with glowing scan --}}
                <circle class="robot-eye robot-eye-l" cx="24" cy="23" r="4" fill="#e5001e"/>
                <circle class="robot-eye-inner" cx="24" cy="23" r="2" fill="#fff"/>
                <circle class="robot-eye robot-eye-r" cx="40" cy="23" r="4" fill="#e5001e"/>
                <circle class="robot-eye-inner" cx="40" cy="23" r="2" fill="#fff"/>
                {{-- Mouth audio wave --}}
                <rect class="robot-mouth" x="24" y="30" width="16" height="3" rx="1.5" fill="#00f0ff" opacity=".85"/>
                {{-- Body & Shield --}}
                <rect class="robot-body" x="12" y="39" width="40" height="22" rx="5" fill="#120e24" stroke="#ff0055" stroke-width="1.8"/>
                <rect x="20" y="44" width="24" height="12" rx="3" fill="#090714" stroke="#a855f7" stroke-width="1" opacity=".9"/>
                <circle cx="26" cy="50" r="2.5" fill="#00f0ff"/>
                <circle cx="32" cy="50" r="2.5" fill="#e5001e"/>
                <circle cx="38" cy="50" r="2.5" fill="#22c55e"/>
                {{-- Arms --}}
                <rect class="robot-arm-l" x="4" y="40" width="8" height="18" rx="4" fill="#120e24" stroke="#ff0055" stroke-width="1.5"/>
                <rect class="robot-arm-r" x="52" y="40" width="8" height="18" rx="4" fill="#120e24" stroke="#ff0055" stroke-width="1.5"/>
            </svg>
        </div>
    </div>
    <div class="rog-ai-badge-pill">
        <span class="adm-live-dot" style="width:6px; height:6px; background:#22c55e;"></span>
        <span class="rog-ai-btn-label">ROG AI 8D</span>
    </div>
    <span class="rog-ai-pulse"></span>
</button>

{{-- Cyber AI Chat Panel --}}
<div id="rog-ai-panel" role="dialog" aria-modal="true" aria-label="ROG AI Assistant" aria-hidden="true">
    <div class="hud-corner-tl"></div>
    <div class="hud-corner-br"></div>
    <div class="qr-laser-scanner" style="opacity:.4;"></div>

    {{-- Header --}}
    <div class="rog-ai-header">
        <div class="rog-ai-header-left">
            <div class="rog-ai-avatar">
                <img src="{{ asset('images/rog-ai-avatar-3d.jpg') }}" alt="ROG AI" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
            </div>
            <div>
                <div class="rog-ai-title">
                    ROG AI <span style="font-size:.65rem; color:#00f0ff; background:rgba(0,240,255,0.12); padding:1px 5px; border-radius:3px; border:1px solid rgba(0,240,255,0.3);">8D VOICE</span>
                </div>
                <div class="rog-ai-status">
                    <span class="rog-ai-online-dot"></span>
                    <span id="rog-ai-status-text">NEURAL CORE 4.0 // ONLINE</span>
                </div>
            </div>
        </div>

        {{-- Header Controls: Language Toggle & Voice Toggle --}}
        <div class="rog-ai-header-actions">
            {{-- Language Toggle (Khmer / English) --}}
            <div class="rog-ai-lang-toggle" title="Switch Language / ប្តូរភាសា">
                <button type="button" id="rog-lang-kh" class="rog-lang-btn" data-lang="kh">🇰🇭 KH</button>
                <button type="button" id="rog-lang-en" class="rog-lang-btn active" data-lang="en">🇬🇧 EN</button>
            </div>

            {{-- Voice Audio Speech Toggle --}}
            <button type="button" id="rog-ai-voice-toggle" class="rog-ai-icon-btn is-voice-on" title="Toggle AI Voice Speaking (Text-to-Speech)">
                <svg id="rog-voice-icon-on" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/></svg>
                <svg id="rog-voice-icon-off" style="display:none;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><line x1="23" y1="9" x2="17" y2="15"/><line x1="17" y1="9" x2="23" y2="15"/></svg>
            </button>

            <button class="rog-ai-icon-btn" id="rog-ai-menu-btn" aria-label="More options" title="More options">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="5" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>
            <button class="rog-ai-icon-btn" id="rog-ai-close" aria-label="Close AI Assistant">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Messages Body --}}
    <div class="rog-ai-messages" id="rog-ai-messages" role="log" aria-live="polite">

        {{-- Welcome message --}}
        <div class="rog-ai-msg rog-ai-msg--bot" id="rog-ai-welcome">
            <div class="rog-ai-msg-avatar">
                <svg class="rog-robot-svg rog-robot-svg--xs" viewBox="0 0 64 64" fill="none">
                    <line x1="32" y1="4" x2="32" y2="10" stroke="#ff0055" stroke-width="2.5"/>
                    <circle cx="32" cy="2.5" r="2.5" fill="#ff0055"/>
                    <rect x="16" y="10" width="32" height="22" rx="5" fill="#120e24" stroke="#ff0055" stroke-width="1.8"/>
                    <circle cx="24" cy="20" r="4" fill="#e5001e"/><circle cx="40" cy="20" r="4" fill="#e5001e"/>
                </svg>
            </div>
            <div class="rog-ai-msg-body">
                <div class="rog-ai-bubble" id="rog-ai-welcome-text">
                    Hello! I'm the <strong>ROG AI Assistant</strong> 🤖, your bilingual companion for all ROG gear. I can speak and understand both <strong>English</strong> and <strong>ភាសាខ្មែរ (Khmer)</strong> with live voice response!<br><br>How can I elevate your gaming battle station today?
                </div>

                {{-- Suggestion Quick Cards (Bilingual Container) --}}
                <div class="rog-ai-suggestions" id="rog-ai-suggestions">
                    {{-- Dynamically populated based on active language --}}
                </div>
                <div class="rog-ai-timestamp" id="rog-ai-ts"></div>
            </div>
        </div>

    </div>

    {{-- Input Footer with Speech-To-Text & Send --}}
    <div class="rog-ai-footer">
        <div class="rog-ai-input-wrap">
            {{-- Microphone Speech Recognition Button --}}
            <button type="button" id="rog-ai-mic-btn" class="rog-ai-mic-btn" title="Speak with Voice / និយាយជាសម្លេង">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
            </button>

            <input type="text" id="rog-ai-input" class="rog-ai-input"
                   placeholder="Ask in English or ភាសាខ្មែរ..."
                   maxlength="500"
                   autocomplete="off"
                   aria-label="Message ROG AI Assistant">

            <button id="rog-ai-send" class="rog-ai-send-btn" aria-label="Send message">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/>
                </svg>
            </button>
        </div>
    </div>
</div>

{{-- Context-menu dropdown --}}
<div id="rog-ai-context-menu" class="rog-ai-context-menu" style="display:none;">
    <button class="rog-ai-context-item" id="rog-ai-clear">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
        Clear conversation / សម្អាតសារ
    </button>
    <button class="rog-ai-context-item" id="rog-ai-minimize">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14"/></svg>
        Minimize / បង្រួម
    </button>
</div>

<script>
(function () {
    'use strict';

    /* ── DOM refs ───────────────────────────────────────── */
    var btn         = document.getElementById('rog-ai-btn');
    var panel       = document.getElementById('rog-ai-panel');
    var closeBtn    = document.getElementById('rog-ai-close');
    var msgBox      = document.getElementById('rog-ai-messages');
    var input       = document.getElementById('rog-ai-input');
    var sendBtn     = document.getElementById('rog-ai-send');
    var menuBtn     = document.getElementById('rog-ai-menu-btn');
    var ctxMenu     = document.getElementById('rog-ai-context-menu');
    var clearBtn    = document.getElementById('rog-ai-clear');
    var minBtn      = document.getElementById('rog-ai-minimize');
    var tsEl        = document.getElementById('rog-ai-ts');
    var langKhBtn   = document.getElementById('rog-lang-kh');
    var langEnBtn   = document.getElementById('rog-lang-en');
    var voiceBtn    = document.getElementById('rog-ai-voice-toggle');
    var voiceIconOn = document.getElementById('rog-voice-icon-on');
    var voiceIconOff= document.getElementById('rog-voice-icon-off');
    var micBtn      = document.getElementById('rog-ai-mic-btn');
    var suggestBox  = document.getElementById('rog-ai-suggestions');
    var welcomeText = document.getElementById('rog-ai-welcome-text');

    var open        = false;
    var currentLang = 'en'; // 'en' or 'kh'
    var voiceActive = true;  // Voice TTS enabled by default

    function getTime() {
        var d = new Date();
        return d.getHours().toString().padStart(2,'0') + ':' + d.getMinutes().toString().padStart(2,'0');
    }
    if (tsEl) tsEl.textContent = getTime();

    /* ── Bilingual Suggestion Prompts ───────────────────── */
    var SUGGESTIONS = {
        en: [
            { icon: '💻', title: 'Product Specifications', sub: 'What are the specs of the ROG Zephyrus G16 (2024)?', query: 'What are the specs of the ROG Zephyrus G16 (2024)?' },
            { icon: '🏆', title: 'Product Recommendation', sub: 'Can you recommend the best 16-inch gaming laptop?', query: 'Can you recommend the best 16-inch gaming laptop?' },
            { icon: '⚖️', title: 'Compare Products', sub: 'What is the difference between SCAR 16 and SCAR 18?', query: "What's the difference between ROG Strix SCAR 16 and SCAR 18?" },
            { icon: '💳', title: 'Bakong KHQR Payment', sub: 'How does fast 1s Bakong QR payment work?', query: 'How does Bakong KHQR payment work?' },
            { icon: '📍', title: 'Store & Warranty', sub: 'Where is ROG Store in Phnom Penh & Warranty terms?', query: 'Where is your store in Phnom Penh and what is the warranty?' }
        ],
        kh: [
            { icon: '💻', title: 'លក្ខណៈសម្បត្តិ Specs', sub: 'សុំមើល Specs របស់ ROG Zephyrus G16 (2024)?', query: 'សុំមើល Specs របស់ ROG Zephyrus G16 (2024)' },
            { icon: '🏆', title: 'ណែនាំ Laptop Gaming', sub: 'តើមាន Laptop Gaming ណាខ្លាំងសម្រាប់លេងហ្គេម និងធ្វើការងារ?', query: 'ណែនាំ Laptop Gaming ណាខ្លាំងសម្រាប់លេងហ្គេម' },
            { icon: '⚖️', title: 'ប្រៀបធៀបម៉ូឌែល', sub: 'តើ SCAR 16 និង SCAR 18 ខុសគ្នាយ៉ាងដូចម្តេច?', query: 'តើ SCAR 16 និង SCAR 18 ខុសគ្នាយ៉ាងដូចម្តេច?' },
            { icon: '💳', title: 'ការទូទាត់ Bakong KHQR', sub: 'តើអាចទូទាត់តាម Bakong KHQR បានយ៉ាងដូចម្តេច?', query: 'តើទូទាត់តាម Bakong KHQR យ៉ាងដូចម្តេច?' },
            { icon: '📍', title: 'ទីតាំងហាង & ការធានា', sub: 'ទីតាំងហាងនៅភ្នំពេញ និងការធានាផ្លូវការ ASUS?', query: 'ទីតាំងហាងនៅភ្នំពេញ និងលក្ខខណ្ឌធានាផ្លូវការ' }
        ]
    };

    function renderSuggestions() {
        if (!suggestBox) return;
        suggestBox.innerHTML = '';
        var list = SUGGESTIONS[currentLang] || SUGGESTIONS.en;
        list.forEach(function (item) {
            var btnEl = document.createElement('button');
            btnEl.className = 'rog-ai-suggest-card';
            btnEl.dataset.query = item.query;
            btnEl.innerHTML =
                '<span class="rog-ai-suggest-icon" style="font-size:1.1rem;">' + item.icon + '</span>' +
                '<div>' +
                    '<div class="rog-ai-suggest-title">' + item.title + '</div>' +
                    '<div class="rog-ai-suggest-sub">' + item.sub + '</div>' +
                '</div>';
            btnEl.addEventListener('click', function () {
                if (!open) openPanel();
                sendMessage(item.query);
            });
            suggestBox.appendChild(btnEl);
        });

        if (input) {
            input.placeholder = currentLang === 'kh' ? 'សួរសំណួរជាភាសាខ្មែរ ឬ English...' : 'Ask in English or ភាសាខ្មែរ...';
        }
    }

    function setLanguage(lang) {
        currentLang = lang;
        if (lang === 'kh') {
            langKhBtn.classList.add('active');
            langEnBtn.classList.remove('active');
            welcomeText.innerHTML = 'សួស្តីបាទ! ខ្ញុំជា <strong>ROG AI Assistant</strong> 🤖 ដែលជាជំនួយការឆ្លាតវៃផ្នែកបច្ចេកវិទ្យា ROG។ ខ្ញុំអាចនិយាយ និងឆ្លើយជា <strong>ភាសាខ្មែរ</strong> និង <strong>English</strong> ជាមួយសម្លេងផ្ទាល់!<br><br>តើបងចង់ស្វែងរក Laptop, អេក្រង់ Monitor, ឬគ្រឿង Hardware ណាដែរ?';
        } else {
            langEnBtn.classList.add('active');
            langKhBtn.classList.remove('active');
            welcomeText.innerHTML = 'Hello! I\'m the <strong>ROG AI Assistant</strong> 🤖, your bilingual companion for all ROG gear. I can speak and understand both <strong>English</strong> and <strong>ភាសាខ្មែរ (Khmer)</strong> with live voice response!<br><br>How can I elevate your gaming battle station today?';
        }
        renderSuggestions();
    }

    if (langKhBtn) langKhBtn.addEventListener('click', function () { setLanguage('kh'); });
    if (langEnBtn) langEnBtn.addEventListener('click', function () { setLanguage('en'); });

    /* ── High-Quality Audio Voice Engine (Khmer 🇰🇭 & English 🇬🇧) ── */
    var currentAiAudio = null;

    function speakText(htmlText) {
        if (!voiceActive) return;

        // Stop any currently playing audio stream or speech
        if (currentAiAudio) {
            currentAiAudio.pause();
            currentAiAudio.currentTime = 0;
            currentAiAudio = null;
        }
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();
        }

        // Strip HTML tags for clean speech
        var div = document.createElement('div');
        div.innerHTML = htmlText;
        var plainText = (div.textContent || div.innerText || '').trim();
        plainText = plainText.replace(/•/g, '').replace(/→/g, '').replace(/https?:\/\/\S+/g, '').replace(/[⚡⚔️🏆💻💳📍🛡️👋🤖]/g, '').trim();

        if (!plainText) return;

        var isKhmer = /[\u1780-\u17FF]/.test(plainText);
        var langCode = isKhmer ? 'km' : 'en';

        // Animate robot speaking
        btn.classList.add('is-talking');

        // Play audio directly from our server TTS audio engine
        var ttsUrl = '/api/ai/tts?lang=' + encodeURIComponent(langCode) + '&text=' + encodeURIComponent(plainText.substring(0, 260));
        var audio = new Audio(ttsUrl);
        currentAiAudio = audio;

        audio.onplay = function () {
            btn.classList.add('is-talking');
        };

        audio.onended = function () {
            btn.classList.remove('is-talking');
            currentAiAudio = null;
        };

        audio.onerror = function () {
            btn.classList.remove('is-talking');
            currentAiAudio = null;
            // Fallback for English if audio element encounters issue
            if ('speechSynthesis' in window && !isKhmer) {
                var utterance = new SpeechSynthesisUtterance(plainText);
                utterance.lang = 'en-US';
                window.speechSynthesis.speak(utterance);
            }
        };

        var playPromise = audio.play();
        if (playPromise !== undefined) {
            playPromise.catch(function () {
                btn.classList.remove('is-talking');
            });
        }
    }

    if (voiceBtn) {
        voiceBtn.addEventListener('click', function () {
            voiceActive = !voiceActive;
            if (voiceActive) {
                voiceBtn.classList.add('is-voice-on');
                voiceIconOn.style.display = 'block';
                voiceIconOff.style.display = 'none';
                if (window.rogToast) window.rogToast('AI Voice Speech ON 🔊', 'success', 2000);
            } else {
                voiceBtn.classList.remove('is-voice-on');
                voiceIconOn.style.display = 'none';
                voiceIconOff.style.display = 'block';
                window.speechSynthesis.cancel();
                if (window.rogToast) window.rogToast('AI Voice Speech Muted 🔇', 'default', 2000);
            }
        });
    }

    /* ── Speech Recognition (Microphone Voice Input) ────── */
    if (micBtn && ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window)) {
        var SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
        var recognition = new SpeechRec();
        recognition.continuous = false;
        recognition.interimResults = false;

        micBtn.addEventListener('click', function () {
            recognition.lang = currentLang === 'kh' ? 'km-KH' : 'en-US';
            micBtn.classList.add('is-listening');
            micBtn.style.color = '#ef4444';
            micBtn.style.boxShadow = '0 0 12px #ef4444';
            if (window.rogToast) window.rogToast('🎙️ Listening... Speak now!', 'default', 2500);
            recognition.start();
        });

        recognition.onresult = function (e) {
            var transcript = e.results[0][0].transcript;
            if (input) {
                input.value = transcript;
                sendMessage(transcript);
            }
        };

        recognition.onend = function () {
            micBtn.classList.remove('is-listening');
            micBtn.style.color = '';
            micBtn.style.boxShadow = '';
        };

        recognition.onerror = function () {
            micBtn.classList.remove('is-listening');
            micBtn.style.color = '';
            micBtn.style.boxShadow = '';
        };
    }

    /* ── Comprehensive Bilingual Knowledge Engine ────────── */
    var KB = [
        // 1. Zephyrus G16
        {
            keys: ['zephyrus g16','g16 2024','gu605','g16 specs','ហ្សេហ្វាយរ៉ាស'],
            en: 'The <strong>ROG Zephyrus G16 (2024)</strong> is our ultra-sleek OLED powerhouse:<br>• <strong>Processor:</strong> Intel Core Ultra 9 185H / AMD Ryzen 9<br>• <strong>Graphics:</strong> NVIDIA GeForce RTX 4090 (16GB GDDR6)<br>• <strong>Display:</strong> 16" 2.5K OLED 240Hz, 0.2ms, 100% DCI-P3<br>• <strong>Memory & Storage:</strong> 32GB LPDDR5X + 2TB NVMe PCIe 4.0 SSD<br>• <strong>Price:</strong> <strong>$2,699 USD</strong> (≈ ៛10,930,000 KHR)<br><a href="/shop" class="rog-ai-link-btn">⚡ View Zephyrus G16 in Store →</a>',
            kh: 'ម៉ូឌែល <strong>ROG Zephyrus G16 (2024)</strong> គឺជាកំពូល Laptop កម្រាស់ស្តើងអេក្រង់ OLED ដ៏ប្រណិតបំផុត៖<br>• <strong>ស៊ីភីយូ:</strong> Intel Core Ultra 9 185H / AMD Ryzen 9 AI<br>• <strong>ក្រាហ្វិកកាត:</strong> NVIDIA GeForce RTX 4090 (16GB GDDR6)<br>• <strong>អេក្រង់:</strong> 16" 2.5K OLED 240Hz, 0.2ms Nebula Display<br>• <strong>រ៉េម & អង្គចងចាំ:</strong> 32GB RAM + 2TB SSD NVMe Gen 4<br>• <strong>តម្លៃ:</strong> <strong>$2,699 USD</strong> (≈ ៛10,930,000 KHR)<br><a href="/shop" class="rog-ai-link-btn">⚡ មើលផលិតផលក្នុងហាង →</a>'
        },
        // 2. Strix SCAR 18
        {
            keys: ['strix scar 18','scar18','scar 18','g834','ស្កា ១៨'],
            en: 'The <strong>ROG Strix SCAR 18 (2024)</strong> is the ultimate esports colossus:<br>• <strong>Processor:</strong> Intel Core i9-14900HX (24 cores, 32 threads)<br>• <strong>GPU:</strong> NVIDIA RTX 4090 at full 175W max TGP<br>• <strong>Display:</strong> 18" 2.5K Mini LED Nebula HDR 240Hz, 1100 nits<br>• <strong>Memory & Storage:</strong> 64GB DDR5 5600MHz + 4TB RAID 0 SSD<br>• <strong>Price:</strong> <strong>$3,899 USD</strong> (≈ ៛15,790,000 KHR)<br><a href="/shop" class="rog-ai-link-btn">⚡ View SCAR 18 in Store →</a>',
            kh: 'ម៉ូឌែល <strong>ROG Strix SCAR 18 (2024)</strong> ជាកំពូលស្តេច Gaming Laptop កម្លាំងខ្លាំងបំផុតគ្មានគូប្រៀប៖<br>• <strong>ស៊ីភីយូ:</strong> Intel Core i9-14900HX (24 Cores / 32 Threads)<br>• <strong>ក្រាហ្វិកកាត:</strong> NVIDIA RTX 4090 Max TGP 175W<br>• <strong>អេក្រង់:</strong> 18" 2.5K Mini LED 240Hz (1100 nits HDR)<br>• <strong>រ៉េម & អង្គចងចាំ:</strong> 64GB DDR5 + 4TB NVMe RAID 0<br>• <strong>តម្លៃ:</strong> <strong>$3,899 USD</strong> (≈ ៛15,790,000 KHR)<br><a href="/shop" class="rog-ai-link-btn">⚡ មើល SCAR 18 ក្នុងហាង →</a>'
        },
        // 3. Compare SCAR 16 vs 18
        {
            keys: ['compare scar','scar 16 vs scar 18','difference scar','ប្រៀបធៀប scar','scar ណា្អ'],
            en: '<strong>⚔️ ROG SCAR 16 vs SCAR 18 Comparison:</strong><br>• <strong>Screen Size:</strong> 16" Mini LED (Portable) vs 18" Mini LED (Desktop replacement)<br>• <strong>Cooling:</strong> Tri-Fan technology with Conductonaut Extreme Liquid Metal on both<br>• <strong>TGP Performance:</strong> 175W RTX 4090 capability on both models<br>• <strong>Recommendation:</strong> Pick SCAR 16 for LAN parties and travel, pick SCAR 18 for max immersion.',
            kh: '<strong>⚔️ ការប្រៀបធៀបរវាង SCAR 16 និង SCAR 18៖</strong><br>• <strong>ទំហំអេក្រង់:</strong> SCAR 16 (16 អ៊ីញ ស្រួលយកតាមខ្លួន) vs SCAR 18 (18 អ៊ីញ ធំត្រជាក់ភ្នែកជំនួស Desktop)<br>• <strong>ប្រព័ន្ធត្រជាក់:</strong> កង្ហារ ៣ Tri-Fan + ទឹកលោហៈរាវ Liquid Metal ដូចគ្នា<br>• <strong>កម្លាំង GPU:</strong> RTX 4090 175W ខ្លាំងដូចគ្នា<br>• <strong>ការណែនាំ:</strong> ជ្រើសយក SCAR 16 បើចង់បានភាពងាយស្រួល ឬ SCAR 18 សម្រាប់ការលេងហ្គេមអេក្រង់ធំពេញចិត្ត។'
        },
        // 4. Laptop Recommendation
        {
            keys: ['recommend','best laptop','gaming laptop','laptop ណា','ណែនាំ','laptop ខ្លាំង'],
            en: 'Here are our <strong>Top 3 ROG Laptop Recommendations</strong> for 2026:<br>1. <strong>ROG Zephyrus G16</strong> — Best for Creators & Ultra-portable Gaming ($2,699)<br>2. <strong>ROG Strix SCAR 18</strong> — Absolute Best Maximum Performance ($3,899)<br>3. <strong>ROG Ally X</strong> — Best Handheld Gaming PC on the go ($799)<br><a href="/shop" class="rog-ai-link-btn">Browse Full Laptop Lineup →</a>',
            kh: 'នេះជាការណែនាំ <strong>កំពូល Laptop ROG ទាំង ៣</strong> ល្អបំផុតប្រចាំឆ្នាំ ២០២៦៖<br>១. <strong>ROG Zephyrus G16:</strong> ល្អឥតខ្ចោះសម្រាប់ការងារកាត់ត និងលេងហ្គេម កម្រាស់ស្តើង ($2,699)<br>២. <strong>ROG Strix SCAR 18:</strong> កម្លាំងខ្លាំងបំផុតសម្រាប់អ្នកលេងហ្គេមធ្ងន់ៗ ($3,899)<br>៣. <strong>ROG Ally X:</strong> ម៉ាស៊ីន Handheld Gaming ចល័តកាន់លេងបានគ្រប់ទីកន្លែង ($799)<br><a href="/shop" class="rog-ai-link-btn">មើលម៉ូឌែលទាំងអស់ក្នុងហាង →</a>'
        },
        // 5. Bakong KHQR Payment
        {
            keys: ['bakong','khqr','qr','payment','pay','ទូទាត់','បង់ប្រាក់','បាគង'],
            en: '💳 <strong>Bakong KHQR Instant Payment:</strong><br>• Fast 1-Second Auto Verification Sync ⚡<br>• Supports all Cambodian Banks: <strong>ABA Mobile, ACLEDA, Canadia, Wing Bank, Bakong App</strong><br>• Zero transaction fees with both <strong>USD</strong> and <strong>KHR (៛)</strong> support.<br>Simply select Bakong KHQR at checkout, scan the dynamic QR, and your order clears instantly!',
            kh: '💳 <strong>ការទូទាត់ប្រាក់តាម Bakong KHQR ដ៏រហ័ស៖</strong><br>• ពិនិត្យផ្ទៀងផ្ទាត់ស្វ័យប្រវត្តិតែ ១ វិនាទីប៉ុណ្ណោះ ⚡<br>• គាំទ្រគ្រប់កម្មវិធីធនាគារក្នុងប្រទេសកម្ពុជា៖ <strong>ABA Mobile, ACLEDA, Canadia, Wing, Bakong</strong><br>• ឥតគិតថ្លៃសេវា គាំទ្រទាំងប្រាក់ដុល្លារ <strong>USD</strong> និងប្រាក់រៀល <strong>KHR (៛)</strong><br>គ្រាន់តែជ្រើសរើស Bakong KHQR ពេលទូទាត់ រួចស្កេន QR កូដ នោះការបញ្ជាទិញនឹងជោគជ័យភ្លាមៗ!'
        },
        // 6. Price & Cost
        {
            keys: ['price','cost','how much','តម្លៃ','ប៉ុន្មាន','ថ្លៃ'],
            en: '💰 <strong>ROG Hardware Official Pricing Range:</strong><br>• Laptops: <strong>$1,299 – $3,899 USD</strong><br>• Handheld (ROG Ally X): <strong>$799 USD</strong><br>• OLED & Fast Monitors: <strong>$599 – $1,499 USD</strong><br>• Keyboards & Mice: <strong>$89 – $219 USD</strong><br>• Graphics Cards (RTX 4090): <strong>$1,999 USD</strong><br><a href="/shop" class="rog-ai-link-btn">View All Live Prices →</a>',
            kh: '💰 <strong>តារាងតម្លៃផលិតផល ROG ផ្លូវការ៖</strong><br>• កុំព្យូទ័រយួរដៃ Laptop: <strong>$1,299 – $3,899 USD</strong><br>• ម៉ាស៊ីនហ្គេម ROG Ally X: <strong>$799 USD</strong><br>• អេក្រង់ Gaming OLED: <strong>$599 – $1,499 USD</strong><br>• ក្តារចុច & កណ្តុរ Gaming: <strong>$89 – $219 USD</strong><br>• កាតក្រាហ្វិក RTX 4090: <strong>$1,999 USD</strong><br><a href="/shop" class="rog-ai-link-btn">ពិនិត្យតម្លៃផលិតផលទាំងអស់ →</a>'
        },
        // 7. Store Location & Delivery
        {
            keys: ['store','location','address','where','phnom penh','shipping','delivery','ហាង','ទីតាំង','ដឹកជញ្ជូន','កន្លែងណា'],
            en: '📍 <strong>ROG Flagship Store & Delivery Info:</strong><br>• <strong>Location:</strong> Preah Monivong Blvd, Sangkat Boeung Keng Kang 1, Phnom Penh, Cambodia<br>• <strong>Store Hours:</strong> Open Daily (8:30 AM – 8:00 PM)<br>• 🚀 <strong>Nationwide Delivery:</strong> Free express shipping on orders over $500 across all 25 provinces in Cambodia!<br>• 📞 <strong>Direct Hotline:</strong> +855 23 888 999',
            kh: '📍 <strong>ទីតាំងហាង ROG Store និងព័ត៌មានដឹកជញ្ជូន៖</strong><br>• <strong>ទីតាំងហាង:</strong> មហាវិថីព្រះមុនីវង្ស សង្កាត់បឹងកេងកង១ រាជធានីភ្នំពេញ ប្រទេសកម្ពុជា<br>• <strong>ម៉ោងធ្វើការ:</strong> រៀងរាល់ថ្ងៃ (8:30 ព្រឹក – 8:00 យប់)<br>• 🚀 <strong>ការដឹកជញ្ជូន:</strong> ដឹកជញ្ជូនឥតគិតថ្លៃទូទាំង ២៥ ខេត្ត-ក្រុង សម្រាប់ការទិញលើសពី $500!<br>• 📞 <strong>ទំនាក់ទំនង:</strong> +855 23 888 999'
        },
        // 8. Warranty & Return
        {
            keys: ['warranty','guarantee','return','repair','ធានា','ខូច','ដូរ'],
            en: '🛡️ <strong>Official ASUS ROG Warranty:</strong><br>• <strong>2-Year Official International Warranty</strong> on all laptops and desktops<br>• 30-Day Hassle-Free Exchange Policy<br>• 100% Genuine Certified Hardware (No grey market imports)<br>• Authorized Service Center support in Phnom Penh.',
            kh: '🛡️ <strong>ការធានាផ្លូវការពី ASUS ROG៖</strong><br>• <strong>ធានាផ្លូវការរយៈពេល ២ ឆ្នាំពេញ</strong> លើរាល់ផលិតផល Laptop និង Desktop<br>• គោលការណ៍ប្តូរថ្មីក្នុងរយៈពេល ៣០ ថ្ងៃ ប្រសិនបើមានបញ្ហាបច្ចេកទេស<br>• ធានាផលិតផលសុទ្ធ ១០០% នាំចូលស្របច្បាប់<br>• មជ្ឈមណ្ឌលសេវាកម្មជួសជុលផ្លូវការនៅរាជធានីភ្នំពេញ។'
        },
        // 9. Greetings
        {
            keys: ['hello','hi','hey','suosdei','chumreap sour','សួស្តី','ជម្រាបសួរ','ជួយ'],
            en: 'Hello gamer! 👋 Welcome to ROG Store! I am ready to assist you with specs, pricing, comparisons, or Bakong KHQR checkout in English or Khmer. What are you looking for today?',
            kh: 'ជម្រាបសួរ និងសួស្តីបង! 👋 សូមស្វាគមន៍មកកាន់ ROG Store! ខ្ញុំជាជំនួយការ AI ត្រៀមខ្លួនជាស្រេចក្នុងការជួយបងស្វែងរក Laptop, តម្លៃ, លក្ខណៈបច្ចេកទេស ឬការទូទាត់តាម Bakong KHQR។ តើបងចង់ដឹងព័ត៌មានអ្វីដែរ?'
        }
    ];

    function findAnswer(q) {
        var queryLower = q.toLowerCase();
        var isKhmerQuery = /[\u1780-\u17FF]/.test(q) || currentLang === 'kh';

        for (var i = 0; i < KB.length; i++) {
            for (var j = 0; j < KB[i].keys.length; j++) {
                if (queryLower.indexOf(KB[i].keys[j]) !== -1) {
                    return isKhmerQuery ? KB[i].kh : KB[i].en;
                }
            }
        }

        if (isKhmerQuery) {
            return 'សំណួរល្អណាស់បង! សម្រាប់ព័ត៌មានលម្អិតបំផុត សូមចូលទៅកាន់ <a href="/shop" class="rog-ai-link-btn">ហាងទំនិញ ROG Store</a> ឬទាក់ទងមកកាន់ក្រុមការងារតាមទូរស័ព្ទ <strong>+855 23 888 999</strong>។<br>បងអាចសាកល្បងសួរអំពី៖<br>• ម៉ូឌែលជាក់លាក់ (ឧទាហរណ៍៖ "Specs របស់ Zephyrus G16")<br>• ការណែនាំ Laptop Gaming<br>• តម្លៃ ឬការបង់ប្រាក់តាម Bakong KHQR';
        } else {
            return 'Great question! For the most accurate and up-to-date specs, explore our <a href="/shop" class="rog-ai-link-btn">ROG Hardware Store</a> or speak directly with our gear specialists.<br>You can ask me about:<br>• Specific hardware (e.g. "Zephyrus G16 specs" or "SCAR 18")<br>• Best gaming laptop recommendations<br>• Bakong KHQR 1s payment & shipping';
        }
    }

    /* ── Panel open / close ─────────────────────────────── */
    function openPanel() {
        open = true;
        panel.classList.add('is-open');
        panel.setAttribute('aria-hidden', 'false');
        btn.classList.add('is-active');
        renderSuggestions();
        if (input) input.focus();
    }
    function closePanel() {
        open = false;
        panel.classList.remove('is-open');
        panel.setAttribute('aria-hidden', 'true');
        btn.classList.remove('is-active');
        ctxMenu.style.display = 'none';
        if ('speechSynthesis' in window) window.speechSynthesis.cancel();
    }

    btn.addEventListener('click', function () { open ? closePanel() : openPanel(); });
    closeBtn.addEventListener('click', closePanel);
    minBtn.addEventListener('click', closePanel);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && open) closePanel();
    });

    /* ── Context menu ──────────────────────────────────── */
    menuBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        var rect = menuBtn.getBoundingClientRect();
        ctxMenu.style.display = ctxMenu.style.display === 'block' ? 'none' : 'block';
        ctxMenu.style.top  = (rect.bottom + 4) + 'px';
        ctxMenu.style.right = (window.innerWidth - rect.right) + 'px';
    });
    document.addEventListener('click', function (e) {
        if (!e.target.closest('#rog-ai-menu-btn') && !e.target.closest('#rog-ai-context-menu')) {
            ctxMenu.style.display = 'none';
        }
    });
    clearBtn.addEventListener('click', function () {
        var msgs = msgBox.querySelectorAll('.rog-ai-msg');
        msgs.forEach(function (m, i) { if (i > 0) m.remove(); });
        ctxMenu.style.display = 'none';
    });

    /* ── Robot SVG string ──────────────────────────────── */
    var ROBOT_SVG =
        '<svg class="rog-robot-svg rog-robot-svg--xs" viewBox="0 0 64 64" fill="none">' +
        '<line x1="32" y1="4" x2="32" y2="10" stroke="#ff0055" stroke-width="2.5" stroke-linecap="round"/>' +
        '<circle cx="32" cy="2.5" r="2.5" fill="#ff0055"/>' +
        '<rect x="16" y="10" width="32" height="22" rx="5" fill="#120e24" stroke="#ff0055" stroke-width="1.8"/>' +
        '<circle cx="24" cy="20" r="4" fill="#e5001e"/><circle cx="24" cy="20" r="2" fill="#fff"/>' +
        '<circle cx="40" cy="20" r="4" fill="#e5001e"/><circle cx="40" cy="20" r="2" fill="#fff"/>' +
        '<rect x="24" y="27" width="16" height="3" rx="1.5" fill="#00f0ff"/>' +
        '<rect x="12" y="36" width="40" height="22" rx="5" fill="#120e24" stroke="#ff0055" stroke-width="1.8"/>' +
        '</svg>';

    /* ── Render Messages ───────────────────────────────── */
    function appendMsg(html, role, typewrite) {
        var wrap = document.createElement('div');
        wrap.className = 'rog-ai-msg rog-ai-msg--' + role;
        if (role === 'user') {
            wrap.innerHTML = '<div class="rog-ai-bubble rog-ai-bubble--user">' + escHtml(html) + '</div>' +
                '<div class="rog-ai-timestamp">' + getTime() + '</div>';
        } else {
            var tsId = 'ts-' + Date.now();
            wrap.innerHTML =
                '<div class="rog-ai-msg-avatar">' + ROBOT_SVG + '</div>' +
                '<div class="rog-ai-msg-body">' +
                  '<div class="rog-ai-bubble" id="bubble-' + tsId + '"></div>' +
                  '<div class="rog-ai-msg-footer">' +
                    '<div class="rog-ai-timestamp" id="' + tsId + '"></div>' +
                    '<button type="button" class="rog-ai-speak-bubble-btn" title="Speak Voice / បន្លឺសម្លេង" data-html="' + encodeURIComponent(html) + '">' +
                        '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>' +
                        '<span>Listen 🔊</span>' +
                    '</button>' +
                  '</div>' +
                '</div>';
            msgBox.appendChild(wrap);
            msgBox.scrollTop = msgBox.scrollHeight;

            var bubble = document.getElementById('bubble-' + tsId);
            var tsNode = document.getElementById(tsId);
            var speakBtn = wrap.querySelector('.rog-ai-speak-bubble-btn');
            if (speakBtn) {
                speakBtn.addEventListener('click', function () {
                    speakText(decodeURIComponent(speakBtn.dataset.html));
                });
            }

            if (typewrite) {
                typewriteHTML(bubble, html, function () {
                    tsNode.textContent = getTime();
                    msgBox.scrollTop = msgBox.scrollHeight;
                    // Speak text aloud if voice is active!
                    speakText(html);
                });
            } else {
                bubble.innerHTML = html;
                tsNode.textContent = getTime();
                msgBox.scrollTop = msgBox.scrollHeight;
                speakText(html);
            }
            return wrap;
        }
        msgBox.appendChild(wrap);
        msgBox.scrollTop = msgBox.scrollHeight;
        return wrap;
    }

    function escHtml(s) {
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    /* ── Typewriter effect ─────────────────────────────── */
    function typewriteHTML(el, html, onDone) {
        var tmp = document.createElement('div');
        tmp.innerHTML = html;
        var fullText = tmp.innerHTML;
        var i = 0;
        var speed = 10;
        el.innerHTML = '';
        function tick() {
            if (i >= fullText.length) { el.innerHTML = fullText; if (onDone) onDone(); return; }
            if (fullText[i] === '<') {
                var end = fullText.indexOf('>', i);
                if (end !== -1) { i = end + 1; }
            }
            el.innerHTML = fullText.slice(0, i);
            i++;
            setTimeout(tick, speed);
        }
        tick();
    }

    function showTyping() {
        var wrap = document.createElement('div');
        wrap.className = 'rog-ai-msg rog-ai-msg--bot rog-ai-typing-wrap';
        wrap.innerHTML =
            '<div class="rog-ai-msg-avatar">' + ROBOT_SVG + '</div>' +
            '<div class="rog-ai-msg-body"><div class="rog-ai-bubble rog-ai-typing">' +
            '<span></span><span></span><span></span>' +
            '</div></div>';
        msgBox.appendChild(wrap);
        msgBox.scrollTop = msgBox.scrollHeight;
        return wrap;
    }

    /* ── Send message ──────────────────────────────────── */
    function sendMessage(text) {
        text = (text || input.value).trim();
        if (!text) return;
        input.value = '';
        sendBtn.disabled = true;
        sendBtn.classList.remove('has-text');

        // Auto-detect Khmer script in user input
        if (/[\u1780-\u17FF]/.test(text)) {
            setLanguage('kh');
        }

        appendMsg(text, 'user', false);
        btn.classList.add('is-talking');
        var typing = showTyping();
        var delay = 600 + Math.random() * 400;
        setTimeout(function () {
            typing.remove();
            appendMsg(findAnswer(text), 'bot', true);
            sendBtn.disabled = false;
            btn.classList.remove('is-talking');
            if (input) input.focus();
        }, delay);
    }

    sendBtn.addEventListener('click', function () { sendMessage(); });
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });

    input.addEventListener('input', function () {
        sendBtn.classList.toggle('has-text', input.value.trim().length > 0);
    });

    renderSuggestions();

})();

/* ═══ LIVE DYNAMIC CYBER PARTICLE & CONSTELLATION ENGINE ═════════════════ */
(function () {
    var canvas = document.getElementById('rogLiveCyberCanvas');
    if (!canvas) return;
    var ctx = canvas.getContext('2d');
    if (!ctx) return;

    var mouseGlow = document.getElementById('rogBgMouseGlow');

    var width = 0;
    var height = 0;
    var dpr = Math.min(window.devicePixelRatio || 1, 2);

    var mouse = { x: -1000, y: -1000, targetX: -1000, targetY: -1000, isHovering: false };
    var ripples = [];
    var particles = [];
    var glyphs = [];

    var COLORS = [
        { r: 229, g: 0,   b: 30  }, // ROG Crimson
        { r: 168, g: 85,  b: 247 }, // Neon Violet
        { r: 0,   g: 240, b: 255 }, // Cyber Cyan
        { r: 251, g: 191, b: 36  }, // Core Amber
        { r: 99,  g: 102, b: 241 }  // Indigo
    ];

    function resize() {
        width = canvas.parentElement ? canvas.parentElement.clientWidth : window.innerWidth;
        height = canvas.parentElement ? canvas.parentElement.clientHeight : window.innerHeight;
        canvas.width = width * dpr;
        canvas.height = height * dpr;
        ctx.scale(dpr, dpr);
    }

    function initParticles() {
        particles = [];
        var count = Math.floor(Math.min(width, 1920) / 30); // ~50-65 particles
        if (count < 35) count = 35;

        for (var i = 0; i < count; i++) {
            var col = COLORS[Math.floor(Math.random() * COLORS.length)];
            particles.push({
                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.7,
                vy: (Math.random() - 0.5) * 0.7,
                radius: 1.2 + Math.random() * 2.2,
                col: col,
                alpha: 0.2 + Math.random() * 0.6,
                pulse: Math.random() * Math.PI * 2,
                pulseSpeed: 0.02 + Math.random() * 0.03
            });
        }

        // Floating wireframe geometry glyphs (hexagons and triangles)
        glyphs = [];
        for (var g = 0; g < 8; g++) {
            glyphs.push({
                x: Math.random() * width,
                y: Math.random() * height,
                vy: -0.2 - Math.random() * 0.35,
                rot: Math.random() * Math.PI * 2,
                rotSpeed: (Math.random() - 0.5) * 0.008,
                size: 14 + Math.random() * 22,
                sides: Math.random() > 0.5 ? 6 : 3,
                col: COLORS[Math.floor(Math.random() * COLORS.length)],
                alpha: 0.12 + Math.random() * 0.18
            });
        }
    }

    // Draw regular polygon
    function drawPolygon(x, y, radius, sides, rotation) {
        ctx.beginPath();
        for (var i = 0; i < sides; i++) {
            var angle = rotation + (i * 2 * Math.PI / sides);
            var px = x + radius * Math.cos(angle);
            var py = y + radius * Math.sin(angle);
            if (i === 0) ctx.moveTo(px, py);
            else ctx.lineTo(px, py);
        }
        ctx.closePath();
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        // Smooth mouse spotlight lerp
        if (mouseGlow) {
            if (mouse.isHovering) {
                mouse.x += (mouse.targetX - mouse.x) * 0.12;
                mouse.y += (mouse.targetY - mouse.y) * 0.12;
                mouseGlow.style.left = mouse.x + 'px';
                mouseGlow.style.top = mouse.y + 'px';
                mouseGlow.style.opacity = '1';
            } else {
                mouseGlow.style.opacity = '0';
            }
        }

        // 1. Render and expand click ripples
        for (var r = ripples.length - 1; r >= 0; r--) {
            var rip = ripples[r];
            rip.radius += 4.5;
            rip.alpha -= 0.016;

            if (rip.alpha <= 0) {
                ripples.splice(r, 1);
                continue;
            }

            ctx.beginPath();
            ctx.arc(rip.x, rip.y, rip.radius, 0, Math.PI * 2);
            ctx.strokeStyle = 'rgba(' + rip.col.r + ',' + rip.col.g + ',' + rip.col.b + ',' + rip.alpha + ')';
            ctx.lineWidth = 2;
            ctx.stroke();
        }

        // 2. Render Floating Mecha Glyphs
        for (var g = 0; g < glyphs.length; g++) {
            var gl = glyphs[g];
            gl.y += gl.vy;
            gl.rot += gl.rotSpeed;
            if (gl.y < -50) {
                gl.y = height + 50;
                gl.x = Math.random() * width;
            }

            drawPolygon(gl.x, gl.y, gl.size, gl.sides, gl.rot);
            ctx.strokeStyle = 'rgba(' + gl.col.r + ',' + gl.col.g + ',' + gl.col.b + ',' + gl.alpha + ')';
            ctx.lineWidth = 1;
            ctx.stroke();
        }

        // 3. Update & Render Particles
        var pLen = particles.length;
        for (var i = 0; i < pLen; i++) {
            var p = particles[i];

            // Movement & Boundary bounce
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0 || p.x > width) p.vx *= -1;
            if (p.y < 0 || p.y > height) p.vy *= -1;

            // Breathing alpha pulse
            p.pulse += p.pulseSpeed;
            var currentAlpha = p.alpha * (0.65 + 0.35 * Math.sin(p.pulse));

            // Mouse Interactive Repulsion
            if (mouse.isHovering) {
                var dx = p.x - mouse.x;
                var dy = p.y - mouse.y;
                var dist = Math.sqrt(dx * dx + dy * dy);
                var maxDist = 140;

                if (dist < maxDist && dist > 0) {
                    var force = (maxDist - dist) / maxDist;
                    p.x += (dx / dist) * force * 3.5;
                    p.y += (dy / dist) * force * 3.5;

                    // Draw laser connection to mouse pointer!
                    var mouseAlpha = force * 0.45;
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(mouse.x, mouse.y);
                    ctx.strokeStyle = 'rgba(229,0,30,' + mouseAlpha + ')';
                    ctx.lineWidth = 1;
                    ctx.stroke();
                }
            }

            // Click ripple kinetic push
            for (var k = 0; k < ripples.length; k++) {
                var rk = ripples[k];
                var rdx = p.x - rk.x;
                var rdy = p.y - rk.y;
                var rdist = Math.sqrt(rdx * rdx + rdy * rdy);
                if (Math.abs(rdist - rk.radius) < 25) {
                    p.x += (rdx / (rdist || 1)) * 3;
                    p.y += (rdy / (rdist || 1)) * 3;
                }
            }

            // Draw particle glowing node
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(' + p.col.r + ',' + p.col.g + ',' + p.col.b + ',' + currentAlpha + ')';
            ctx.shadowBlur = p.radius * 4;
            ctx.shadowColor = 'rgba(' + p.col.r + ',' + p.col.g + ',' + p.col.b + ', 0.9)';
            ctx.fill();
            ctx.shadowBlur = 0; // reset

            // 4. Dynamic Constellation Connections
            for (var j = i + 1; j < pLen; j++) {
                var p2 = particles[j];
                var cdx = p.x - p2.x;
                var cdy = p.y - p2.y;
                var cdist = Math.sqrt(cdx * cdx + cdy * cdy);

                if (cdist < 115) {
                    var linkAlpha = (1 - (cdist / 115)) * 0.28;
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(p2.x, p2.y);
                    ctx.strokeStyle = 'rgba(' + p.col.r + ',' + p.col.g + ',' + p.col.b + ',' + linkAlpha + ')';
                    ctx.lineWidth = 0.8;
                    ctx.stroke();
                }
            }
        }

        requestAnimationFrame(animate);
    }

    // Window events
    window.addEventListener('resize', function () {
        resize();
        initParticles();
    });

    window.addEventListener('mousemove', function (e) {
        mouse.targetX = e.clientX;
        mouse.targetY = e.clientY;
        if (!mouse.isHovering) {
            mouse.x = e.clientX;
            mouse.y = e.clientY;
            mouse.isHovering = true;
        }
    }, { passive: true });

    window.addEventListener('mouseleave', function () {
        mouse.isHovering = false;
    });

    window.addEventListener('click', function (e) {
        ripples.push({
            x: e.clientX,
            y: e.clientY,
            radius: 5,
            alpha: 0.8,
            col: COLORS[Math.floor(Math.random() * COLORS.length)]
        });
    });

    resize();
    initParticles();
    requestAnimationFrame(animate);
})();

/* ═══ DYNAMIC 3D PARALLAX & CARD TILT SYSTEM ═════════════════════════════ */
document.addEventListener('DOMContentLoaded', function () {
    // 1. Dynamic 3D Aurora parallax on mousemove
    var blob1 = document.getElementById('auroraBlob1');
    var blob2 = document.getElementById('auroraBlob2');
    var blob3 = document.getElementById('auroraBlob3');
    var blob4 = document.getElementById('auroraBlob4');
    var blob5 = document.getElementById('auroraBlob5');

    var ticking = false;
    window.addEventListener('mousemove', function (e) {
        if (!ticking) {
            window.requestAnimationFrame(function () {
                var normX = (e.clientX / window.innerWidth - 0.5);
                var normY = (e.clientY / window.innerHeight - 0.5);

                if (blob1) blob1.style.transform = 'translate(' + (normX * -50) + 'px, ' + (normY * -50) + 'px)';
                if (blob2) blob2.style.transform = 'translate(' + (normX * 45) + 'px, ' + (normY * 45) + 'px)';
                if (blob3) blob3.style.transform = 'translate(' + (normX * -35) + 'px, ' + (normY * 35) + 'px)';
                if (blob4) blob4.style.transform = 'translate(' + (normX * 40) + 'px, ' + (normY * -40) + 'px)';
                if (blob5) blob5.style.transform = 'translate(' + (normX * -30) + 'px, ' + (normY * -20) + 'px)';
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    // 2. Interactive 3D Card Tilt on .rog-highlight-card and .product-card
    function setup3DCardTilt(cardSelector) {
        document.querySelectorAll(cardSelector).forEach(function (card) {
            var glare = card.querySelector('.rog-card-glare');

            card.addEventListener('mousemove', function (e) {
                var rect = card.getBoundingClientRect();
                var x = e.clientX - rect.left;
                var y = e.clientY - rect.top;

                var centerX = rect.width / 2;
                var centerY = rect.height / 2;

                var rotateX = ((y - centerY) / centerY) * -10; // max 10 deg
                var rotateY = ((x - centerX) / centerX) * 10;  // max 10 deg

                card.style.transform = 'perspective(1000px) rotateX(' + rotateX.toFixed(2) + 'deg) rotateY(' + rotateY.toFixed(2) + 'deg) translateZ(8px)';

                if (glare) {
                    var glareX = (x / rect.width) * 100;
                    var glareY = (y / rect.height) * 100;
                    glare.style.opacity = '1';
                    glare.style.background = 'radial-gradient(circle at ' + glareX + '% ' + glareY + '%, rgba(255,255,255,0.3) 0%, rgba(147,51,234,0.15) 40%, transparent 70%)';
                }
            });

            card.addEventListener('mouseleave', function () {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0px)';
                if (glare) glare.style.opacity = '0';
            });
        });
    }

    setup3DCardTilt('.rog-highlight-card');
    setup3DCardTilt('.rog-pl-card');
    setup3DCardTilt('.cat-card');
});
</script>
</body>
</html>
