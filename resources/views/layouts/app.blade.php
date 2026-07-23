<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ROG Store — Republic of Gamers')</title>
    <meta name="description" content="@yield('meta_description', 'Official ROG Store — Premium gaming gear, laptops, monitors, peripherals and components from ASUS Republic of Gamers.')">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Orbitron:wght@700;900&display=swap" rel="stylesheet">

    {{-- Assets --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-Bj3S1EWV.css') }}">
    <script type="module" src="{{ asset('build/assets/app-Cp0MBnBs.js') }}" defer></script>

    {{-- Theme: apply saved preference before paint to avoid flash --}}
    <script>
        (function(){
            var t = localStorage.getItem('rog-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎮</text></svg>">

    @stack('head')
</head>
<body>

{{-- ═══ NAVBAR ═══════════════════════════════════════════════════════════════ --}}
<nav class="navbar">
    <div style="max-width:1280px; margin:0 auto; padding:0 1.5rem; display:flex; align-items:center; justify-content:space-between; height:64px;">

        {{-- Logo --}}
        <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:.7rem; text-decoration:none;">
            <svg width="38" height="38" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="#e5001e" opacity=".15"/>
                <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="none" stroke="#e5001e" stroke-width="3"/>
                <text x="50" y="62" text-anchor="middle" font-family="Orbitron,sans-serif" font-weight="900" font-size="28" fill="#e5001e">ROG</text>
            </svg>
            <div>
                <div class="nav-logo-text" style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.1rem; color:#fff; line-height:1;">ROG</div>
                <div style="font-size:.6rem; color:#e5001e; letter-spacing:.2em; text-transform:uppercase;">Republic of Gamers</div>
            </div>
        </a>

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

        {{-- Right Icons --}}
        <div style="display:flex; align-items:center; gap:1rem;">
            {{-- Search --}}
            <form action="{{ route('shop') }}" method="GET" class="nav-search-bar hidden-mobile" style="display:flex; align-items:center; background:#1a1a1a; border:1px solid #2a2a2a; padding:.3rem .8rem; gap:.5rem;">
                <input type="text" name="search" placeholder="Search ROG products…" value="{{ request('search') }}"
                       style="background:none; border:none; color:var(--text-primary); font-size:.82rem; width:180px; outline:none;">
                <button type="submit" style="background:none;border:none;color:var(--text-muted);cursor:pointer;">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                </button>
            </form>

            {{-- Theme Toggle --}}
            <label class="theme-toggle" title="Toggle light / dark mode" aria-label="Toggle light / dark mode">
                <input type="checkbox" id="theme-checkbox" role="switch" aria-checked="false">
                <span class="theme-track">
                    <span class="t-icon t-moon">🌙</span>
                    <span class="t-icon t-sun">☀️</span>
                </span>
                <span class="theme-thumb"></span>
            </label>

            {{-- Cart --}}
            <a href="{{ route('cart') }}" class="cart-icon-link" style="position:relative; color:var(--text-nav); text-decoration:none; display:flex; align-items:center; padding:.4rem;" title="Cart">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m12-9l2 9M9 21h6"/>
                </svg>
                @if($cartCount > 0)
                <span style="position:absolute; top:-4px; right:-4px; background:var(--rog-red); color:#fff; font-size:.65rem; font-weight:700; min-width:18px; height:18px; border-radius:50%; display:flex; align-items:center; justify-content:center; padding:0 3px;">
                    {{ $cartCount }}
                </span>
                @endif
            </a>

            {{-- Mobile hamburger --}}
            <button id="mobile-toggle" style="background:none;border:none;color:#ccc;cursor:pointer;" class="show-mobile">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" style="background:#0d0d0d; border-top:1px solid #1e1e1e; padding:1rem 1.5rem;">
        <form action="{{ route('shop') }}" method="GET" style="display:flex; align-items:center; background:#1a1a1a; border:1px solid #2a2a2a; padding:.5rem 1rem; gap:.5rem; margin-bottom:1rem;">
            <input type="text" name="search" placeholder="Search products…" value="{{ request('search') }}"
                   style="background:none;border:none;color:#ddd;font-size:.85rem;width:100%;outline:none;">
            <button type="submit" style="background:none;border:none;color:#888;cursor:pointer;">🔍</button>
        </form>
        <a href="{{ route('home') }}" class="nav-link" style="display:block;margin:.4rem 0;">Home</a>
        <a href="{{ route('shop') }}" class="nav-link" style="display:block;margin:.4rem 0;">Shop</a>
        <a href="{{ route('about') }}" class="nav-link" style="display:block;margin:.4rem 0;">About</a>
        <a href="{{ route('contact') }}" class="nav-link" style="display:block;margin:.4rem 0;">Contact</a>
        <div style="border-top:1px solid #1e1e1e;margin:.8rem 0;padding-top:.8rem;">
            @foreach($navCategories as $cat)
            <a href="{{ route('shop', ['category' => $cat->slug]) }}" style="display:block;color:#aaa;text-decoration:none;padding:.4rem 0;font-size:.85rem;font-weight:600;">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>
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

{{-- ═══ FOOTER ══════════════════════════════════════════════════════════════ --}}
<footer>
    {{-- Marquee --}}
    <div class="marquee-wrap" style="padding:.45rem 0;">
        <div class="marquee-inner" style="font-size:.72rem; font-weight:700; letter-spacing:.15em; text-transform:uppercase; color:#fff;">
            @for($i=0;$i<2;$i++)
            <span>⚔ For Those Who Dare</span>
            <span>★ Republic of Gamers</span>
            <span>⚡ Powered by Innovation</span>
            <span>🏆 Born to Win</span>
            <span>🎮 ROG Gaming</span>
            <span>💻 Ultimate Performance</span>
            <span>🔥 Unleash Your Power</span>
            <span>⚔ For Those Who Dare</span>
            <span>★ Republic of Gamers</span>
            <span>⚡ Powered by Innovation</span>
            @endfor
        </div>
    </div>

    <div style="max-width:1280px; margin:0 auto; padding:3rem 1.5rem;">
        <div style="display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:2.5rem; margin-bottom:3rem;">

            {{-- Brand --}}
            <div>
                <div style="display:flex; align-items:center; gap:.7rem; margin-bottom:1.2rem;">
                    <svg width="36" height="36" viewBox="0 0 100 100" fill="none">
                        <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="#e5001e" opacity=".15"/>
                        <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" fill="none" stroke="#e5001e" stroke-width="3"/>
                        <text x="50" y="62" text-anchor="middle" font-family="Orbitron,sans-serif" font-weight="900" font-size="28" fill="#e5001e">ROG</text>
                    </svg>
                    <div style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.1rem; color:#fff;">ROG Store</div>
                </div>
                <p style="color:#666; font-size:.88rem; line-height:1.7; max-width:280px;">
                    Republic of Gamers — ASUS's elite gaming brand engineered for those who demand the best in gaming technology. From laptops to peripherals, ROG delivers uncompromising performance.
                </p>
                <div style="display:flex; gap:.8rem; margin-top:1.2rem;">
                    <a href="#" style="color:#666; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#666'">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" style="color:#666; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#666'">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                    </a>
                    <a href="#" style="color:#666; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#666'">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 style="font-weight:700; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem;">Quick Links</h4>
                <ul style="list-style:none; padding:0; margin:0;">
                    @foreach([['Home',route('home')],['Shop',route('shop')],['About',route('about')],['Contact',route('contact')],['Cart',route('cart')]] as [$label,$url])
                    <li style="margin-bottom:.6rem;">
                        <a href="{{ $url }}" style="color:#666; text-decoration:none; font-size:.87rem; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#666'">
                            › {{ $label }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Categories --}}
            <div>
                <h4 style="font-weight:700; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem;">Categories</h4>
                <ul style="list-style:none; padding:0; margin:0;">
                    @foreach($navCategories->take(6) as $cat)
                    <li style="margin-bottom:.6rem;">
                        <a href="{{ route('shop', ['category'=>$cat->slug]) }}" style="color:#666; text-decoration:none; font-size:.87rem; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#666'">
                            › {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 style="font-weight:700; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem;">Contact Us</h4>
                <ul style="list-style:none; padding:0; margin:0; color:#666; font-size:.87rem; line-height:1.9;">
                    <li>📧 support@rog-store.com</li>
                    <li>📞 1-800-ROG-GAME</li>
                    <li>📍 Republic of Gamers HQ</li>
                    <li>🕐 Mon–Fri 9AM–6PM</li>
                </ul>
            </div>
        </div>

        <div style="border-top:1px solid #1a1a1a; padding-top:1.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
            <p style="color:#444; font-size:.8rem;">© {{ date('Y') }} ROG Store. All rights reserved. Republic of Gamers™ is a trademark of ASUSTeK Computer Inc.</p>
            <div style="display:flex; gap:1.5rem;">
                <a href="#" style="color:#444; font-size:.8rem; text-decoration:none; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#444'">Privacy Policy</a>
                <a href="#" style="color:#444; font-size:.8rem; text-decoration:none; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#444'">Terms of Service</a>
                <a href="#" style="color:#444; font-size:.8rem; text-decoration:none; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#444'">Warranty</a>
            </div>
        </div>
    </div>
</footer>

<style>
@media(max-width:768px){
  .hidden-mobile{display:none!important;}
  .show-mobile{display:flex!important;}
  footer > div > div:first-child div{grid-template-columns:1fr 1fr!important;}
}
@media(min-width:769px){
  .show-mobile{display:none!important;}
}
</style>

<script>
// Mobile nav toggle
document.getElementById('mobile-toggle')?.addEventListener('click', () => {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('open');
});

// Dropdown toggle
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

{{-- ═══ ROG AI ASSISTANT WIDGET ════════════════════════════════════════════ --}}

{{-- Floating robot trigger button --}}
<button id="rog-ai-btn" aria-label="Open ROG AI Assistant" title="ROG AI Assistant">
    {{-- Animated ROG Robot SVG --}}
    <div class="rog-robot-icon" aria-hidden="true">
        <svg class="rog-robot-svg" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            {{-- Antenna --}}
            <line class="robot-antenna" x1="32" y1="6" x2="32" y2="13" stroke="#e5001e" stroke-width="2.5" stroke-linecap="round"/>
            <circle class="robot-antenna-ball" cx="32" cy="4.5" r="2.5" fill="#e5001e"/>
            {{-- Head --}}
            <rect class="robot-head" x="16" y="13" width="32" height="22" rx="5" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.8"/>
            {{-- Eyes --}}
            <circle class="robot-eye robot-eye-l" cx="24" cy="23" r="4" fill="#e5001e"/>
            <circle class="robot-eye-inner" cx="24" cy="23" r="2" fill="#fff"/>
            <circle class="robot-eye robot-eye-r" cx="40" cy="23" r="4" fill="#e5001e"/>
            <circle class="robot-eye-inner" cx="40" cy="23" r="2" fill="#fff"/>
            {{-- Mouth --}}
            <rect class="robot-mouth" x="24" y="30" width="16" height="3" rx="1.5" fill="#e5001e" opacity=".7"/>
            {{-- Neck --}}
            <rect x="29" y="35" width="6" height="4" rx="1" fill="#e5001e" opacity=".6"/>
            {{-- Body --}}
            <rect class="robot-body" x="12" y="39" width="40" height="22" rx="5" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.8"/>
            {{-- Chest panel --}}
            <rect x="20" y="44" width="24" height="12" rx="3" fill="#111" stroke="#e5001e" stroke-width="1" opacity=".8"/>
            <circle cx="26" cy="50" r="2.5" fill="#e5001e" opacity=".9"/>
            <circle cx="32" cy="50" r="2.5" fill="#e5001e" opacity=".5"/>
            <circle cx="38" cy="50" r="2.5" fill="#e5001e" opacity=".9"/>
            {{-- Arms --}}
            <rect class="robot-arm-l" x="4" y="40" width="8" height="18" rx="4" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.5"/>
            <rect class="robot-arm-r" x="52" y="40" width="8" height="18" rx="4" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.5"/>
            {{-- Legs --}}
            <rect x="18" y="61" width="10" height="3" rx="1.5" fill="#e5001e" opacity=".7"/>
            <rect x="36" y="61" width="10" height="3" rx="1.5" fill="#e5001e" opacity=".7"/>
        </svg>
    </div>
    <span class="rog-ai-btn-label">ROG AI</span>
    <span class="rog-ai-pulse"></span>
</button>

{{-- Chat Panel --}}
<div id="rog-ai-panel" role="dialog" aria-modal="true" aria-label="ROG AI Assistant" aria-hidden="true">

    {{-- Header --}}
    <div class="rog-ai-header">
        <div class="rog-ai-header-left">
            <div class="rog-ai-avatar">
                <svg class="rog-robot-svg rog-robot-svg--sm" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="32" y1="4" x2="32" y2="10" stroke="#e5001e" stroke-width="2.5" stroke-linecap="round"/>
                    <circle cx="32" cy="2.5" r="2.5" fill="#e5001e"/>
                    <rect x="16" y="10" width="32" height="22" rx="5" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.8"/>
                    <circle cx="24" cy="20" r="4" fill="#e5001e"/><circle cx="24" cy="20" r="2" fill="#fff"/>
                    <circle cx="40" cy="20" r="4" fill="#e5001e"/><circle cx="40" cy="20" r="2" fill="#fff"/>
                    <rect x="24" y="27" width="16" height="3" rx="1.5" fill="#e5001e" opacity=".7"/>
                    <rect x="29" y="32" width="6" height="4" rx="1" fill="#e5001e" opacity=".6"/>
                    <rect x="12" y="36" width="40" height="22" rx="5" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.8"/>
                    <rect x="20" y="41" width="24" height="12" rx="3" fill="#111" stroke="#e5001e" stroke-width="1" opacity=".8"/>
                    <circle cx="26" cy="47" r="2.5" fill="#e5001e" opacity=".9"/>
                    <circle cx="32" cy="47" r="2.5" fill="#e5001e" opacity=".5"/>
                    <circle cx="38" cy="47" r="2.5" fill="#e5001e" opacity=".9"/>
                    <rect x="4" y="37" width="8" height="18" rx="4" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.5"/>
                    <rect x="52" y="37" width="8" height="18" rx="4" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.5"/>
                </svg>
            </div>
            <div>
                <div class="rog-ai-title">ROG AI Assistant</div>
                <div class="rog-ai-status"><span class="rog-ai-online-dot"></span>Online</div>
            </div>
        </div>
        <div class="rog-ai-header-actions">
            <button class="rog-ai-icon-btn" id="rog-ai-menu-btn" aria-label="More options" title="More options">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="5" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>
            <button class="rog-ai-icon-btn" id="rog-ai-close" aria-label="Close AI Assistant">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Messages --}}
    <div class="rog-ai-messages" id="rog-ai-messages" role="log" aria-live="polite">

        {{-- Welcome message --}}
        <div class="rog-ai-msg rog-ai-msg--bot" id="rog-ai-welcome">
            <div class="rog-ai-msg-avatar">
                <svg class="rog-robot-svg rog-robot-svg--xs" viewBox="0 0 64 64" fill="none">
                    <line x1="32" y1="4" x2="32" y2="10" stroke="#e5001e" stroke-width="2.5" stroke-linecap="round"/>
                    <circle cx="32" cy="2.5" r="2.5" fill="#e5001e"/>
                    <rect x="16" y="10" width="32" height="22" rx="5" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.8"/>
                    <circle cx="24" cy="20" r="4" fill="#e5001e"/><circle cx="24" cy="20" r="2" fill="#fff"/>
                    <circle cx="40" cy="20" r="4" fill="#e5001e"/><circle cx="40" cy="20" r="2" fill="#fff"/>
                    <rect x="24" y="27" width="16" height="3" rx="1.5" fill="#e5001e" opacity=".7"/>
                    <rect x="29" y="32" width="6" height="4" rx="1" fill="#e5001e" opacity=".5"/>
                    <rect x="12" y="36" width="40" height="22" rx="5" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.8"/>
                    <rect x="20" y="41" width="24" height="12" rx="3" fill="#111" stroke="#e5001e" stroke-width="1" opacity=".8"/>
                    <circle cx="26" cy="47" r="2.5" fill="#e5001e" opacity=".9"/>
                    <circle cx="32" cy="47" r="2.5" fill="#e5001e" opacity=".4"/>
                    <circle cx="38" cy="47" r="2.5" fill="#e5001e" opacity=".9"/>
                    <rect x="4" y="37" width="8" height="18" rx="4" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.5"/>
                    <rect x="52" y="37" width="8" height="18" rx="4" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.5"/>
                </svg>
            </div>
            <div class="rog-ai-msg-body">
                <div class="rog-ai-bubble">
                    Hello! I'm the <strong>ROG AI Assistant</strong>, your trusted source for all things ROG. Looking for the latest gear or top-tier gaming rigs? Let's elevate your game.
                </div>

                {{-- Suggestion cards --}}
                <div class="rog-ai-suggestions">
                    <button class="rog-ai-suggest-card" data-query="What are the specs of the ROG Zephyrus G16 (2024)?">
                        <span class="rog-ai-suggest-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                        </span>
                        <div>
                            <div class="rog-ai-suggest-title">Product Specifications</div>
                            <div class="rog-ai-suggest-sub">What are the specs of the ROG Zephyrus G16 (2024)?</div>
                        </div>
                    </button>
                    <button class="rog-ai-suggest-card" data-query="Can you recommend the best 16-inch gaming laptop?">
                        <span class="rog-ai-suggest-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"/><path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                        </span>
                        <div>
                            <div class="rog-ai-suggest-title">Product Recommendation</div>
                            <div class="rog-ai-suggest-sub">Can you recommend the best 16-inch gaming laptop?</div>
                        </div>
                    </button>
                    <button class="rog-ai-suggest-card" data-query="What's the difference between ROG Strix SCAR 16 and SCAR 18?">
                        <span class="rog-ai-suggest-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><path d="M14 17h7M17.5 14v7"/></svg>
                        </span>
                        <div>
                            <div class="rog-ai-suggest-title">Compare Products</div>
                            <div class="rog-ai-suggest-sub">What's the difference between ROG Strix SCAR 16 and SCAR 18?</div>
                        </div>
                    </button>
                    <button class="rog-ai-suggest-card" data-query="Can you recommend a wireless gaming keyboard?">
                        <span class="rog-ai-suggest-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M6 10h.01M10 10h.01M14 10h.01M18 10h.01M6 14h12"/></svg>
                        </span>
                        <div>
                            <div class="rog-ai-suggest-title">Accessory Suggestion</div>
                            <div class="rog-ai-suggest-sub">Can you recommend a wireless gaming keyboard?</div>
                        </div>
                    </button>
                </div>
                <div class="rog-ai-timestamp" id="rog-ai-ts"></div>
            </div>
        </div>

    </div>

    {{-- Input --}}
    <div class="rog-ai-footer">
        <div class="rog-ai-input-wrap">
            <input type="text" id="rog-ai-input" class="rog-ai-input"
                   placeholder="Message AI Assistant"
                   maxlength="500"
                   autocomplete="off"
                   aria-label="Message ROG AI Assistant">
            <button id="rog-ai-send" class="rog-ai-send-btn" aria-label="Send message">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
        Clear conversation
    </button>
    <button class="rog-ai-context-item" id="rog-ai-minimize">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14"/></svg>
        Minimize
    </button>
</div>

<script>
(function () {
    'use strict';

    /* ── DOM refs ───────────────────────────────────────── */
    var btn      = document.getElementById('rog-ai-btn');
    var panel    = document.getElementById('rog-ai-panel');
    var closeBtn = document.getElementById('rog-ai-close');
    var msgBox   = document.getElementById('rog-ai-messages');
    var input    = document.getElementById('rog-ai-input');
    var sendBtn  = document.getElementById('rog-ai-send');
    var menuBtn  = document.getElementById('rog-ai-menu-btn');
    var ctxMenu  = document.getElementById('rog-ai-context-menu');
    var clearBtn = document.getElementById('rog-ai-clear');
    var minBtn   = document.getElementById('rog-ai-minimize');
    var tsEl     = document.getElementById('rog-ai-ts');
    var open     = false;

    /* ── Timestamp ─────────────────────────────────────── */
    function getTime() {
        var d = new Date();
        return d.getHours().toString().padStart(2,'0') + ':' + d.getMinutes().toString().padStart(2,'0');
    }
    if (tsEl) tsEl.textContent = getTime();

    /* ── ROG product knowledge base ────────────────────── */
    var KB = [
        { keys: ['zephyrus g16','g16 2024','gu605'],
          answer: 'The <strong>ROG Zephyrus G16 (2024)</strong> features:<br>• Intel Core Ultra 9 185H / AMD Ryzen 9<br>• NVIDIA RTX 4090 Laptop GPU<br>• 16" 2.5K OLED 240Hz Nebula Display<br>• 32GB DDR5 RAM, 2TB NVMe SSD<br>• 90Wh battery, 0.59" thin<br><a href="/shop/rog-zephyrus-g16-2024" style="color:var(--rog-red);text-decoration:underline;">View in store →</a>' },
        { keys: ['strix scar 18','scar18','scar 18'],
          answer: 'The <strong>ROG Strix SCAR 18 (2024)</strong> is the ultimate esports weapon:<br>• Intel Core i9-14900HX<br>• NVIDIA RTX 4090 at 175W TGP<br>• 18" 2.5K Mini LED 240Hz<br>• 64GB DDR5, 2×2TB RAID 0<br><a href="/shop/rog-strix-scar-18-2024" style="color:var(--rog-red);text-decoration:underline;">View in store →</a>' },
        { keys: ['compare scar','scar 16 vs scar 18','difference scar'],
          answer: '<strong>SCAR 16 vs SCAR 18:</strong><br>• Screen: 16" vs 18" Mini LED<br>• Weight: lighter vs heavier<br>• GPU TGP: 150W vs 175W<br>• RAM: 32GB vs 64GB max<br>Choose SCAR 18 for absolute max performance, SCAR 16 for slightly better portability.' },
        { keys: ['keyboard','falchion','scope'],
          answer: 'Top ROG wireless keyboards:<br>• <strong>ROG Falchion RX Low Profile</strong> — 65%, SpeedNova 2.4GHz, 430hr battery<br>• <strong>ROG Strix Scope II 96 Wireless</strong> — 96%, NX Snow switches, 2000hr battery<br><a href="/shop?category=gaming-keyboards" style="color:var(--rog-red);text-decoration:underline;">Browse all keyboards →</a>' },
        { keys: ['mouse','harpe','keris'],
          answer: 'Top ROG gaming mice:<br>• <strong>ROG Harpe Ace</strong> — 54g ultralight, 36,000 DPI, SpeedNova wireless<br>• <strong>ROG Keris II Ace</strong> — 42,000 DPI AimPoint Pro, 150hr battery<br><a href="/shop?category=gaming-mice" style="color:var(--rog-red);text-decoration:underline;">Browse all mice →</a>' },
        { keys: ['headset','delta','cetra'],
          answer: 'ROG audio picks:<br>• <strong>ROG Delta S Wireless</strong> — 50mm drivers, AI mic, 25hr battery<br>• <strong>ROG Cetra TWS Pro</strong> — true wireless earbuds, ANC, 27ms gaming mode<br><a href="/shop?category=gaming-headsets" style="color:var(--rog-red);text-decoration:underline;">Browse all headsets →</a>' },
        { keys: ['gpu','rtx 4090','graphics card'],
          answer: 'Flagship ROG GPU:<br>• <strong>ROG STRIX RTX 4090 OC</strong> — 24GB GDDR6X, 2640MHz boost, triple Axial-tech fans<br>• Best 4K gaming with DLSS 3 & ray tracing<br><a href="/shop/rog-strix-rtx-4090-oc" style="color:var(--rog-red);text-decoration:underline;">View in store →</a>' },
        { keys: ['monitor','oled','pg32','swift'],
          answer: 'Top ROG monitors:<br>• <strong>ROG Swift OLED PG32UCDM</strong> — 32" 4K QD-OLED 240Hz, 0.03ms<br>• <strong>ROG Swift 360Hz PG259QNR</strong> — 24.5" FHD, G-SYNC, esports<br><a href="/shop?category=gaming-monitors" style="color:var(--rog-red);text-decoration:underline;">Browse all monitors →</a>' },
        { keys: ['laptop','recommend','best laptop','gaming laptop'],
          answer: 'For a <strong>16-inch gaming laptop</strong>, I recommend:<br>• <strong>ROG Zephyrus G16</strong> — thin, beautiful OLED, RTX 4090<br>• <strong>ROG Flow X13</strong> — versatile 2-in-1, RTX 4070<br>Your budget and use-case? I can refine the pick!' },
        { keys: ['price','cost','how much'],
          answer: 'ROG product pricing ranges:<br>• Laptops: <strong>$1,599 – $3,499</strong><br>• Monitors: <strong>$699 – $1,299</strong><br>• Keyboards: <strong>$149 – $199</strong><br>• Mice: <strong>$89 – $149</strong><br>• GPUs: <strong>$749 – $1,999</strong><br><a href="/shop" style="color:var(--rog-red);text-decoration:underline;">Browse all products →</a>' },
        { keys: ['shipping','delivery','ship'],
          answer: 'ROG Store shipping info:<br>• 🚀 <strong>Free shipping</strong> on orders over $500<br>• Standard: 5–7 business days<br>• Express: 2–3 business days<br>• All orders are 🔒 secure & insured.' },
        { keys: ['warranty','repair','return'],
          answer: 'All ROG Store products include:<br>• 🔧 <strong>2-Year manufacturer warranty</strong><br>• 30-day hassle-free returns<br>• Genuine ASUS products — no grey market<br>Contact support@rog-store.com for claims.' },
        { keys: ['hello','hi','hey','start','help'],
          answer: 'Hey there, gamer! 👋 I can help you with:<br>• Product specs & comparisons<br>• Personalized recommendations<br>• Pricing & availability<br>• Shipping & warranty info<br><br>What are you looking for today?' },
    ];

    function findAnswer(q) {
        q = q.toLowerCase();
        for (var i = 0; i < KB.length; i++) {
            for (var j = 0; j < KB[i].keys.length; j++) {
                if (q.indexOf(KB[i].keys[j]) !== -1) return KB[i].answer;
            }
        }
        return 'Great question! For the most accurate and up-to-date info, visit the <a href="/shop" style="color:var(--rog-red);text-decoration:underline;">ROG Store</a> or contact our team at <strong>support@rog-store.com</strong>.<br>Try asking about:<br>• A specific product (e.g. "Zephyrus G16 specs")<br>• Category (e.g. "best gaming keyboard")<br>• Pricing or shipping';
    }

    /* ── Panel open / close ─────────────────────────────── */
    function openPanel() {
        open = true;
        panel.classList.add('is-open');
        panel.setAttribute('aria-hidden', 'false');
        btn.classList.add('is-active');
        input.focus();
    }
    function closePanel() {
        open = false;
        panel.classList.remove('is-open');
        panel.setAttribute('aria-hidden', 'true');
        btn.classList.remove('is-active');
        ctxMenu.style.display = 'none';
    }

    btn.addEventListener('click', function () { open ? closePanel() : openPanel(); });
    closeBtn.addEventListener('click', closePanel);
    minBtn.addEventListener('click', closePanel);

    /* ── Escape key ────────────────────────────────────── */
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

    /* ── Robot SVG string (reused in dynamic messages) ── */
    var ROBOT_SVG =
        '<svg class="rog-robot-svg rog-robot-svg--xs" viewBox="0 0 64 64" fill="none">' +
        '<line x1="32" y1="4" x2="32" y2="10" stroke="#e5001e" stroke-width="2.5" stroke-linecap="round"/>' +
        '<circle cx="32" cy="2.5" r="2.5" fill="#e5001e"/>' +
        '<rect x="16" y="10" width="32" height="22" rx="5" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.8"/>' +
        '<circle cx="24" cy="20" r="4" fill="#e5001e"/><circle cx="24" cy="20" r="2" fill="#fff"/>' +
        '<circle cx="40" cy="20" r="4" fill="#e5001e"/><circle cx="40" cy="20" r="2" fill="#fff"/>' +
        '<rect x="24" y="27" width="16" height="3" rx="1.5" fill="#e5001e" opacity=".7"/>' +
        '<rect x="29" y="32" width="6" height="4" rx="1" fill="#e5001e" opacity=".5"/>' +
        '<rect x="12" y="36" width="40" height="22" rx="5" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.8"/>' +
        '<rect x="20" y="41" width="24" height="12" rx="3" fill="#111" stroke="#e5001e" stroke-width="1" opacity=".8"/>' +
        '<circle cx="26" cy="47" r="2.5" fill="#e5001e" opacity=".9"/>' +
        '<circle cx="32" cy="47" r="2.5" fill="#e5001e" opacity=".4"/>' +
        '<circle cx="38" cy="47" r="2.5" fill="#e5001e" opacity=".9"/>' +
        '<rect x="4" y="37" width="8" height="18" rx="4" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.5"/>' +
        '<rect x="52" y="37" width="8" height="18" rx="4" fill="#1a1a1a" stroke="#e5001e" stroke-width="1.5"/>' +
        '</svg>';

    /* ── Render messages ───────────────────────────────── */
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
                  '<div class="rog-ai-timestamp" id="' + tsId + '"></div>' +
                '</div>';
            msgBox.appendChild(wrap);
            msgBox.scrollTop = msgBox.scrollHeight;

            var bubble = document.getElementById('bubble-' + tsId);
            var tsNode = document.getElementById(tsId);

            if (typewrite) {
                /* Typewriter: strip html tags for plain chars, then reveal innerHTML char-by-char */
                typewriteHTML(bubble, html, function () {
                    tsNode.textContent = getTime();
                    msgBox.scrollTop = msgBox.scrollHeight;
                });
            } else {
                bubble.innerHTML = html;
                tsNode.textContent = getTime();
                msgBox.scrollTop = msgBox.scrollHeight;
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
        /* Render full HTML into a temp node, then extract text segments */
        var tmp = document.createElement('div');
        tmp.innerHTML = html;
        var fullText = tmp.innerHTML;   /* keep tags, reveal char by char via textContent trick */
        /* Simple approach: reveal HTML string char by char, skip inside tags */
        var i = 0;
        var speed = 12; /* ms per char */
        el.innerHTML = '';
        function tick() {
            if (i >= fullText.length) { el.innerHTML = fullText; if (onDone) onDone(); return; }
            /* skip full tags in one step so markup renders correctly */
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
        appendMsg(text, 'user', false);
        /* robot idle → talking animation */
        btn.classList.add('is-talking');
        var typing = showTyping();
        var delay = 700 + Math.random() * 500;
        setTimeout(function () {
            typing.remove();
            appendMsg(findAnswer(text), 'bot', true);
            sendBtn.disabled = false;
            btn.classList.remove('is-talking');
            input.focus();
        }, delay);
    }

    sendBtn.addEventListener('click', function () { sendMessage(); });
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });

    /* ── Suggestion cards ──────────────────────────────── */
    document.querySelectorAll('.rog-ai-suggest-card').forEach(function (card) {
        card.addEventListener('click', function () {
            if (!open) openPanel();
            sendMessage(card.dataset.query);
        });
    });

    /* ── Input send-btn active state ───────────────────── */
    input.addEventListener('input', function () {
        sendBtn.classList.toggle('has-text', input.value.trim().length > 0);
    });

})();
</script>
</body>
</html>
