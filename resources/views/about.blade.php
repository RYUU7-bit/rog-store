@extends('layouts.app')
@section('title', 'About ROG — Republic of Gamers')

@section('content')

{{-- Hero --}}
<div style="position:relative; background:var(--bg-base); border-bottom:1px solid var(--border-base); overflow:hidden; padding:3.5rem 1rem;">
    <div style="position:absolute; inset:0; background:radial-gradient(ellipse at 30% 50%, rgba(229,0,30,.15) 0%, transparent 60%); pointer-events:none;"></div>
    <div style="position:absolute; top:0; left:0; right:0; height:1px; background:linear-gradient(90deg, transparent, var(--rog-red), transparent);"></div>
    <div style="max-width:1280px; margin:0 auto; padding:0 1rem; text-align:center; position:relative;">
        <div style="display:inline-flex; align-items:center; gap:.5rem; background:rgba(229,0,30,0.1); border:1px solid rgba(229,0,30,0.3); padding:.3rem .9rem; border-radius:20px; margin-bottom:.8rem; backdrop-filter:blur(4px);">
            <span style="display:inline-block; width:7px; height:7px; background:var(--rog-red); border-radius:50%; box-shadow:0 0 8px var(--rog-red); animation:pulse-beacon 1.5s infinite;"></span>
            <span style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.25em; text-transform:uppercase;">EST. 2006 • THE REPUBLIC OF GAMERS</span>
        </div>
        <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.8rem,5vw,3.2rem); font-weight:900; color:var(--text-primary); line-height:1.1; margin-bottom:1rem; text-shadow:0 0 30px rgba(229,0,30,0.25);">
            Republic of Gamers
        </h1>
        <p style="color:var(--text-muted); font-size:.95rem; max-width:620px; margin:0 auto 1.8rem; line-height:1.7;">
            The world's most feared gaming brand. Engineered for victory. Built for those who dare.
        </p>
        <div style="display:flex; justify-content:center; gap:1rem; flex-wrap:wrap;">
            <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:.9rem; padding:.75rem 2rem; border-radius:6px; box-shadow:0 4px 20px rgba(229,0,30,0.35);">Shop ROG Gear</a>
            <a href="#product-lines" style="text-decoration:none; font-size:.9rem; padding:.75rem 1.8rem; border-radius:6px; color:var(--text-primary); background:var(--bg-elevated); border:1px solid var(--border-card); font-weight:700; transition:all .2s;" onmouseover="this.style.borderColor='var(--rog-red)';this.style.color='var(--rog-red)'" onmouseout="this.style.borderColor='var(--border-card)';this.style.color='var(--text-primary)'">Explore Lines</a>
        </div>
    </div>
</div>

<div style="max-width:1280px; margin:0 auto; padding:3.5rem 1rem 4.5rem;">

    {{-- Story Section with 3D Animated Showcase --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:3rem; align-items:center; margin-bottom:4.5rem;">
        <div>
            <div style="display:inline-flex; align-items:center; gap:.4rem; color:var(--rog-red); font-size:.75rem; font-weight:800; letter-spacing:.15em; text-transform:uppercase; margin-bottom:.5rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                Legacy of Innovation
            </div>
            <h2 class="section-title" style="margin-bottom:1.2rem; font-size:1.85rem;">Our Story</h2>
            <p style="color:var(--text-muted); line-height:1.85; margin-bottom:1rem; font-size:.92rem;">
                In 2006, ASUS launched Republic of Gamers with a single mission: create the ultimate gaming hardware without compromise. What started as a line of extreme gaming motherboards evolved into one of the most iconic gaming brands on the planet.
            </p>
            <p style="color:var(--text-muted); line-height:1.85; margin-bottom:1rem; font-size:.92rem;">
                Today, ROG covers every corner of the gaming ecosystem — from ultra-slim gaming laptops to championship-grade peripherals, professional-grade monitors to component-level excellence.
            </p>
            <p style="color:var(--text-muted); line-height:1.85; margin-bottom:1.5rem; font-size:.92rem;">
                ROG isn't just a brand — it's a statement. It's the gear carried by world-champion esports teams. It's the hardware running inside the rigs of the world's best gamers.
            </p>

            {{-- Feature Pills --}}
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(130px, 1fr)); gap:.8rem;">
                <div style="display:flex; align-items:center; gap:.6rem; background:rgba(255,255,255,0.02); border:1px solid var(--border-card); padding:.6rem .8rem; border-radius:6px; transition:border-color .2s;" onmouseover="this.style.borderColor='rgba(229,0,30,.4)'" onmouseout="this.style.borderColor='var(--border-card)'">
                    <span style="font-size:1.1rem; color:var(--rog-red);">⚡</span>
                    <div>
                        <div style="font-size:.78rem; font-weight:700; color:var(--text-primary);">Zero Compromise</div>
                        <div style="font-size:.65rem; color:var(--text-muted);">Max Overclocking</div>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:.6rem; background:rgba(255,255,255,0.02); border:1px solid var(--border-card); padding:.6rem .8rem; border-radius:6px; transition:border-color .2s;" onmouseover="this.style.borderColor='rgba(229,0,30,.4)'" onmouseout="this.style.borderColor='var(--border-card)'">
                    <span style="font-size:1.1rem; color:var(--rog-red);">🛡</span>
                    <div>
                        <div style="font-size:.78rem; font-weight:700; color:var(--text-primary);">Elite Reliability</div>
                        <div style="font-size:.65rem; color:var(--text-muted);">Military Grade</div>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:.6rem; background:rgba(255,255,255,0.02); border:1px solid var(--border-card); padding:.6rem .8rem; border-radius:6px; transition:border-color .2s;" onmouseover="this.style.borderColor='rgba(229,0,30,.4)'" onmouseout="this.style.borderColor='var(--border-card)'">
                    <span style="font-size:1.1rem; color:var(--rog-red);">🏆</span>
                    <div>
                        <div style="font-size:.78rem; font-weight:700; color:var(--text-primary);">Pro Esports</div>
                        <div style="font-size:.65rem; color:var(--text-muted);">World Champions</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3D Animated Battlestation Card with Interactive Parallax Tilt --}}
        <div class="rog-3d-wrapper" style="perspective:1200px; display:flex; justify-content:center;">
            <div id="rog3dCard" class="rog-3d-card" style="position:relative; width:100%; max-width:540px; border-radius:14px; transform-style:preserve-3d; transition:transform 0.15s ease-out, box-shadow 0.3s ease; box-shadow:0 15px 35px rgba(0,0,0,0.6), 0 0 30px rgba(229,0,30,0.25);">
                
                {{-- Ambient Glowing Neon Backdrop behind card --}}
                <div style="position:absolute; inset:-4px; background:linear-gradient(135deg, rgba(229,0,30,0.8), rgba(255,60,80,0.2), rgba(229,0,30,0.6)); border-radius:16px; z-index:-1; filter:blur(10px); opacity:0.65; animation:rogNeonPulse 4s ease-in-out infinite;"></div>
                
                {{-- Card Inner Container --}}
                <div style="position:relative; border-radius:12px; overflow:hidden; background:#080808; border:1px solid rgba(229,0,30,0.4); aspect-ratio:16/9; display:flex;">
                    
                    {{-- 3D Animated Image --}}
                    <img id="rog3dImage"
                         src="{{ asset('images/rog-story-3d.jpg') }}" 
                         alt="ROG 3D Animated Cyber Battlestation" 
                         style="width:100%; height:100%; object-fit:cover; display:block; transform:scale(1.03); transition:transform 0.4s ease; filter:contrast(1.05) saturate(1.1);"
                         onerror="this.src='https://images.unsplash.com/photo-1542751371-adc38448a05e?w=700&q=80'">

                    {{-- Dynamic Specular Light Glare Overlay --}}
                    <div id="rog3dGlare" style="position:absolute; inset:0; pointer-events:none; background:radial-gradient(circle at 50% 50%, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0) 60%); opacity:0; transition:opacity 0.2s ease; mix-blend-mode:overlay;"></div>

                    {{-- Holographic Scanline Overlay --}}
                    <div class="rog-scanlines" style="position:absolute; inset:0; pointer-events:none; background:linear-gradient(rgba(18,16,16,0) 50%, rgba(0, 0, 0, 0.25) 50%), linear-gradient(90deg, rgba(255,0,0,0.03), rgba(0,255,0,0.01), rgba(0,0,255,0.03)); background-size:100% 3px, 6px 100%; opacity:0.6;"></div>
                    
                    {{-- Holographic Sweeping Laser Line --}}
                    <div class="rog-hologram-sweep"></div>

                    {{-- Cyberpunk HUD Corner Brackets --}}
                    <div class="hud-corner hud-tl"></div>
                    <div class="hud-corner hud-tr"></div>
                    <div class="hud-corner hud-bl"></div>
                    <div class="hud-corner hud-br"></div>

                    {{-- Live 3D Badge Overlay (Top-Left) --}}
                    <div style="position:absolute; top:12px; left:12px; display:inline-flex; align-items:center; gap:6px; background:rgba(0,0,0,0.75); backdrop-filter:blur(8px); border:1px solid rgba(229,0,30,0.5); padding:4px 10px; border-radius:4px; transform:translateZ(30px);">
                        <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#e5001e; box-shadow:0 0 8px #e5001e; animation:pulse-beacon 1.2s infinite;"></span>
                        <span style="font-family:'Orbitron',sans-serif; font-size:.65rem; font-weight:800; color:#fff; letter-spacing:.12em;">ROG 3D NEURAL RIG</span>
                    </div>

                    {{-- 3D Tech Spec Badge (Top-Right) --}}
                    <div style="position:absolute; top:12px; right:12px; display:inline-flex; align-items:center; gap:6px; background:rgba(10,10,10,0.8); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.15); padding:4px 8px; border-radius:4px; font-size:.62rem; color:#aaa; font-weight:700; letter-spacing:.08em; transform:translateZ(25px);">
                        <span style="color:var(--rog-red);">4K UHD</span>
                        <span>•</span>
                        <span style="color:#00e5ff;">144 FPS</span>
                    </div>

                    {{-- Bottom HUD Bar with Animated Soundwave & Watermark --}}
                    <div style="position:absolute; bottom:0; left:0; right:0; padding:10px 14px; background:linear-gradient(to top, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.6) 60%, transparent 100%); display:flex; justify-content:space-between; align-items:flex-end; transform:translateZ(20px);">
                        <div>
                            <div style="font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:900; color:#fff; letter-spacing:.1em; text-transform:uppercase;">
                                TOKYO 2077 // ARENA PROTOCOL
                            </div>
                            <div style="font-size:.62rem; color:rgba(255,255,255,0.6); letter-spacing:.06em;">
                                NEXT-GEN ESPORTS COMBAT SIMULATION
                            </div>
                        </div>

                        {{-- Animated Audio/Data Bars --}}
                        <div style="display:flex; align-items:flex-end; gap:3px; height:16px;">
                            <span class="hud-bar hud-bar-1"></span>
                            <span class="hud-bar hud-bar-2"></span>
                            <span class="hud-bar hud-bar-3"></span>
                            <span class="hud-bar hud-bar-4"></span>
                            <span class="hud-bar hud-bar-5"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:2.2rem 1.2rem; margin-bottom:4.5rem; display:grid; grid-template-columns:repeat(auto-fit, minmax(140px, 1fr)); gap:1.8rem; text-align:center; border-radius:10px; box-shadow:0 6px 24px rgba(0,0,0,0.25); position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg, transparent, var(--rog-red), transparent);"></div>
        @foreach([
            ['500+', 'Innovation Awards', 'Globally Recognized'],
            ['18+',  'Years of Excellence', 'Since 2006'],
            ['#1',   'Gaming Brand', 'Global Market Leader'],
            ['50+',  'Pro Esports Partners', 'Tier 1 Champions'],
        ] as [$num, $label, $sub])
        <div class="stat-card-item" style="transition:transform .2s ease;">
            <div style="font-family:'Orbitron',sans-serif; font-size:2.2rem; font-weight:900; color:var(--rog-red); line-height:1; margin-bottom:.4rem; text-shadow:0 0 15px rgba(229,0,30,0.3);">{{ $num }}</div>
            <div style="font-size:.78rem; color:var(--text-primary); text-transform:uppercase; letter-spacing:.08em; font-weight:700; margin-bottom:.2rem;">{{ $label }}</div>
            <div style="font-size:.65rem; color:var(--text-muted); font-weight:500;">{{ $sub }}</div>
        </div>
        @endforeach
    </div>

    {{-- Product Lines --}}
    <div id="product-lines" style="margin-bottom:4.5rem;">
        <div style="text-align:center; margin-bottom:2.8rem;">
            <div style="display:inline-flex; align-items:center; gap:.5rem; background:rgba(229,0,30,0.12); border:1px solid rgba(229,0,30,0.3); padding:.3rem 1rem; border-radius:20px; margin-bottom:.8rem; backdrop-filter:blur(6px);">
                <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#e5001e; box-shadow:0 0 8px #e5001e; animation:pulse-beacon 1.3s infinite;"></span>
                <span style="font-size:.68rem; font-weight:800; letter-spacing:.25em; text-transform:uppercase; color:#ff4d6d;">8K HARDWARE MATRIX</span>
            </div>
            <h2 class="section-title" style="margin-bottom:0; display:block;">ROG Product Lines</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:1.6rem;">
            @foreach([
                ['ROG Flagship', '8K APEX MATRIX', 'The pinnacle of gaming hardware. Extreme overclocking, zero thermal bottleneck, custom liquid cooling readiness.', route('shop'), 'Explore Flagship', '#e5001e', '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/><circle cx="12" cy="12" r="2" fill="#e5001e"/></svg>'],
                ['ROG Zephyrus', '8K SLASH LIGHTING', 'Ultra-slim CNC aluminum chassis redefining thin-and-light gaming laptops with stunning high-refresh OLED displays.', route('shop', ['category' => 'gaming-laptops']), 'View Zephyrus', '#c084fc', '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#c084fc" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="12" rx="2"/><line x1="2" y1="20" x2="22" y2="20"/><line x1="7" y1="8" x2="17" y2="12" stroke="#e5001e" stroke-width="2.2"/></svg>'],
                ['ROG Strix SCAR', '360HZ TOURNAMENT', 'Tournament-grade esports beasts delivering 360Hz refresh rates, desktop-class GPU wattage and per-key RGB armor glow.', route('shop', ['category' => 'gaming-laptops']), 'View SCAR Beasts', '#ff0055', '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ff0055" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 11l6-9 6 9M6 13l6 9 6-9"/><circle cx="12" cy="11" r="2" fill="#ff0055"/></svg>'],
                ['ROG Flow', '2-IN-1 TRANSFORM', 'Versatile 2-in-1 convertible machines that seamlessly morph from ultraportable touch powerhouse to 4K battle workstation with XG Mobile.', route('shop', ['category' => 'gaming-laptops']), 'View Flow Series', '#00e5ff', '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#00e5ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/></svg>'],
                ['TUF Gaming', 'MIL-SPEC 810H', 'Military-grade durability meets high-performance components for gamers who demand unstoppable reliability and rugged power.', route('shop'), 'View TUF Gear', '#eab308', '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#eab308" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>'],
                ['ROG Strix GPUs', 'TRIPLE AXIAL 8K', 'Triple-fan axial-tech graphics cards engineered for maximum thermal dissipation, extreme clocks, and whisper-silent 8K gaming dominance.', route('shop', ['category' => 'graphics-cards']), 'View GPUs', '#38bdf8', '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="12" r="4"/><circle cx="17" cy="12" r="4"/><path d="M2 12h1M21 12h1M12 2v20"/></svg>'],
            ] as [$name, $tag, $desc, $link, $action, $color, $svg])
            <div class="rog-pl-card-wrap">
                <a href="{{ $link }}" class="rog-pl-card">
                    <div class="rog-card-glare"></div>
                    <div class="rog-hologram-sweep" style="animation-duration: 5s;"></div>
                    <div class="hud-corner hud-tl"></div>
                    <div class="hud-corner hud-tr"></div>
                    <div class="hud-corner hud-bl"></div>
                    <div class="hud-corner hud-br"></div>
                    <div class="rog-pl-badge-8k">
                        <span style="display:inline-block; width:5px; height:5px; border-radius:50%; background:{{ $color }}; box-shadow:0 0 6px {{ $color }};"></span>
                        <span>{{ $tag }}</span>
                    </div>
                    <div class="rog-pl-icon-box">
                        {!! $svg !!}
                    </div>
                    <h3 class="rog-pl-name">{{ $name }}</h3>
                    <p class="rog-pl-desc">{{ $desc }}</p>
                    <div class="rog-pl-action">
                        <span>{{ $action }}</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    {{-- CTA Banner --}}
    <div style="text-align:center; padding:3.5rem 1.5rem; background:linear-gradient(135deg, var(--bg-card) 0%, rgba(229,0,30,0.06) 100%); border:1px solid rgba(229,0,30,0.3); border-radius:12px; position:relative; overflow:hidden; box-shadow:0 8px 30px rgba(0,0,0,0.4);">
        <div style="position:absolute; -right:60px; -bottom:60px; width:220px; height:220px; background:radial-gradient(circle, rgba(229,0,30,0.18), transparent 70%); pointer-events:none;"></div>
        <h2 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.4rem,3.5vw,2rem); font-weight:900; color:var(--text-primary); margin-bottom:.8rem;">Ready to Join the Republic?</h2>
        <p style="color:var(--text-muted); margin-bottom:1.8rem; font-size:.95rem; max-width:560px; margin-left:auto; margin-right:auto; line-height:1.6;">Browse our complete lineup of ROG gaming hardware, laptops, monitors and custom battle components.</p>
        <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:1rem; padding:.85rem 2.5rem; border-radius:6px; box-shadow:0 4px 25px rgba(229,0,30,0.4);">Shop Now</a>
    </div>
</div>

{{-- 3D Styles and Parallax Interaction Script --}}
<style>
    @keyframes pulse-beacon {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.4); opacity: 0.5; }
    }

    @keyframes rogNeonPulse {
        0%, 100% { opacity: 0.5; filter: blur(10px); }
        50% { opacity: 0.85; filter: blur(14px); }
    }

    @keyframes scanlineSweep {
        0% { transform: translateY(-100%); }
        100% { transform: translateY(400%); }
    }

    .rog-hologram-sweep {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 40px;
        background: linear-gradient(180deg, transparent, rgba(229, 0, 30, 0.25), transparent);
        pointer-events: none;
        animation: scanlineSweep 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* HUD Corner Brackets */
    .hud-corner {
        position: absolute;
        width: 14px;
        height: 14px;
        pointer-events: none;
        z-index: 10;
    }
    .hud-tl { top: 6px; left: 6px; border-top: 2px solid #e5001e; border-left: 2px solid #e5001e; }
    .hud-tr { top: 6px; right: 6px; border-top: 2px solid #e5001e; border-right: 2px solid #e5001e; }
    .hud-bl { bottom: 6px; left: 6px; border-bottom: 2px solid #e5001e; border-left: 2px solid #e5001e; }
    .hud-br { bottom: 6px; right: 6px; border-bottom: 2px solid #e5001e; border-right: 2px solid #e5001e; }

    /* Animated Audio / Equalizer bars */
    .hud-bar {
        width: 3px;
        background: #e5001e;
        border-radius: 1px;
        box-shadow: 0 0 4px #e5001e;
    }
    .hud-bar-1 { height: 6px; animation: eqPulse 0.8s ease-in-out infinite alternate; }
    .hud-bar-2 { height: 12px; animation: eqPulse 1.1s ease-in-out infinite 0.2s alternate; }
    .hud-bar-3 { height: 16px; animation: eqPulse 0.7s ease-in-out infinite 0.4s alternate; }
    .hud-bar-4 { height: 9px; animation: eqPulse 1.3s ease-in-out infinite 0.1s alternate; }
    .hud-bar-5 { height: 14px; animation: eqPulse 0.9s ease-in-out infinite 0.3s alternate; }

    @keyframes eqPulse {
        0% { transform: scaleY(0.3); }
        100% { transform: scaleY(1); }
    }

    .stat-card-item:hover {
        transform: translateY(-4px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const card = document.getElementById('rog3dCard');
        const glare = document.getElementById('rog3dGlare');
        const img = document.getElementById('rog3dImage');

        if (!card) return;

        let isHovered = false;

        card.addEventListener('mouseenter', function () {
            isHovered = true;
            if (glare) glare.style.opacity = '1';
            card.style.transition = 'transform 0.1s ease-out, box-shadow 0.3s ease';
        });

        card.addEventListener('mousemove', function (e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * -12; // max 12 deg
            const rotateY = ((x - centerX) / centerX) * 14;  // max 14 deg

            card.style.transform = `perspective(1000px) rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg) scale3d(1.03, 1.03, 1.03)`;
            card.style.boxShadow = `0 20px 45px rgba(0,0,0,0.8), 0 0 35px rgba(229,0,30,0.45)`;

            if (glare) {
                const glareX = (x / rect.width) * 100;
                const glareY = (y / rect.height) * 100;
                glare.style.background = `radial-gradient(circle at ${glareX}% ${glareY}%, rgba(255,255,255,0.3) 0%, rgba(229,0,30,0.1) 40%, transparent 70%)`;
            }
        });

        card.addEventListener('mouseleave', function () {
            isHovered = false;
            if (glare) glare.style.opacity = '0';
            card.style.transition = 'transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.6s ease';
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
            card.style.boxShadow = '0 15px 35px rgba(0,0,0,0.6), 0 0 30px rgba(229,0,30,0.25)';
        });

        // Touch support for mobile devices
        card.addEventListener('touchmove', function(e) {
            if (!e.touches[0]) return;
            const rect = card.getBoundingClientRect();
            const x = e.touches[0].clientX - rect.left;
            const y = e.touches[0].clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -8;
            const rotateY = ((x - centerX) / centerX) * 10;
            card.style.transform = `perspective(1000px) rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg) scale3d(1.02, 1.02, 1.02)`;
        }, { passive: true });

        card.addEventListener('touchend', function() {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        });
    });
</script>
@endsection

