@extends('layouts.app')
@section('title', 'Contact Us — ROG Support & Global Uplink')

@section('content')

{{-- ── Hero Banner ──────────────────────────────────────────────────────── --}}
<div style="position:relative; background:transparent; border-bottom:1px solid rgba(147,51,234,0.2); padding:4rem 1.5rem 3.2rem; text-align:center; overflow:hidden;">
    {{-- Glow orbs --}}
    <div style="position:absolute; top:-60px; left:50%; transform:translateX(-50%); width:750px; height:280px; background:radial-gradient(ellipse, rgba(229,0,30,.2) 0%, rgba(147,51,234,.12) 40%, transparent 70%); pointer-events:none;"></div>
    
    <div style="position:relative; z-index:2; max-width:1280px; margin:0 auto;">
        {{-- Status Pill --}}
        <div style="display:inline-flex; align-items:center; gap:.6rem; background:rgba(229,0,30,0.12); border:1px solid rgba(229,0,30,0.35); padding:.35rem 1.2rem; border-radius:20px; margin-bottom:1.2rem; backdrop-filter:blur(8px);">
            <span style="display:inline-block; width:7px; height:7px; border-radius:50%; background:#00e5ff; box-shadow:0 0 10px #00e5ff; animation:pulse-beacon 1.2s infinite;"></span>
            <span style="color:#ffffff; font-size:.72rem; font-weight:800; letter-spacing:.22em; text-transform:uppercase;">
                ROG GLOBAL SUPPORT GRID // 24/7 ONLINE
            </span>
        </div>

        <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(2rem,4.5vw,3.2rem); font-weight:900; color:#fff; margin-bottom:.9rem; letter-spacing:.05em; text-transform:uppercase; text-shadow:0 0 30px rgba(229,0,30,0.45);">
            Contact <span style="color:var(--rog-red); text-shadow:0 0 25px var(--rog-red);">ROG HQ</span>
        </h1>
        
        <p style="color:#94a3b8; font-size:1.02rem; max-width:560px; margin:0 auto 1.8rem; line-height:1.7;">
            Direct uplink to hardware specialists, order dispatchers, and technical game architects. We've got your back.
        </p>

        {{-- Live Terminal Health Bar --}}
        <div style="display:inline-flex; align-items:center; gap:1.2rem; background:rgba(13,11,24,0.7); border:1px solid rgba(147,51,234,0.3); padding:.4rem 1.2rem; border-radius:6px; font-size:.75rem; color:#cbd5e1; backdrop-filter:blur(10px); flex-wrap:wrap; justify-content:center;">
            <span><strong style="color:#10b981;">● SERVER STATUS:</strong> 100% OPERATIONAL</span>
            <span style="color:rgba(255,255,255,0.2);">|</span>
            <span><strong style="color:#c084fc;">⚡ PING:</strong> 12ms TOKYO GATEWAY</span>
            <span style="color:rgba(255,255,255,0.2);">|</span>
            <span><strong style="color:var(--rog-red);">⏱ QUEUE:</strong> NORMAL (&lt; 2 MINS)</span>
        </div>
    </div>
</div>

<div style="max-width:1240px; margin:0 auto; padding:3rem 1.2rem 5rem;">

    {{-- ── 3D Stats Strip ────────────────────────────────────────────────── --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:1.2rem; margin-bottom:3.5rem;">
        @foreach([
            ['⚡', '< 2 Hours', 'Avg Response Time', 'Ticket queue monitored 24/7', '#e5001e'],
            ['🛡️', '24 / 7 / 365', 'Live Dedicated Support', 'Direct engineer chat uplink', '#c084fc'],
            ['⭐', '99.4%', 'Gamers Satisfaction', 'Ranked #1 gaming hardware brand', '#f59e0b'],
            ['🚀', '100% Official', 'ASUS Global Warranty', 'Original parts & direct RMA', '#00e5ff'],
        ] as [$icon,$stat,$label,$sub,$color])
        <div class="rog-pl-card-wrap">
            <div class="rog-pl-card" style="padding:1.4rem 1.2rem; text-align:center;">
                <div class="rog-card-glare"></div>
                <div class="hud-corner hud-tl"></div>
                <div class="hud-corner hud-tr"></div>
                <div class="hud-corner hud-bl"></div>
                <div class="hud-corner hud-br"></div>
                <div style="font-size:1.6rem; margin-bottom:.4rem; filter:drop-shadow(0 0 10px {{ $color }});">{{ $icon }}</div>
                <div style="font-family:'Orbitron',sans-serif; font-size:1.45rem; font-weight:900; color:{{ $color }}; margin-bottom:.2rem; text-shadow:0 0 15px {{ $color }}44;">{{ $stat }}</div>
                <div style="font-size:.78rem; font-weight:800; color:#fff; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.2rem;">{{ $label }}</div>
                <div style="font-size:.68rem; color:#94a3b8;">{{ $sub }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── Main Two-Column Interactive Layout ─────────────────────────────── --}}
    <div style="display:grid; grid-template-columns:1fr 440px; gap:2.2rem; align-items:start;" class="contact-layout-grid">

        {{-- ── Left: Cybernetic Contact Form ────────────────────────────── --}}
        <div class="rog-pl-card-wrap">
            <div class="rog-pl-card" style="padding:0; overflow:hidden;">
                <div class="rog-card-glare"></div>
                
                {{-- Hologram Corner Brackets --}}
                <div class="hud-corner hud-tl"></div>
                <div class="hud-corner hud-tr"></div>
                <div class="hud-corner hud-bl"></div>
                <div class="hud-corner hud-br"></div>

                {{-- Sweeping Scanline --}}
                <div class="rog-hologram-sweep" style="animation-duration:6s;"></div>

                {{-- Form Header --}}
                <div style="background:rgba(22,18,38,0.9); border-bottom:1px solid rgba(147,51,234,0.25); padding:1.2rem 1.6rem; display:flex; justify-content:space-between; align-items:center;">
                    <div style="display:flex; align-items:center; gap:.8rem;">
                        <div style="width:3px; height:20px; background:var(--rog-red); box-shadow:0 0 8px var(--rog-red);"></div>
                        <div>
                            <h2 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:.92rem; letter-spacing:.12em; text-transform:uppercase; color:#ffffff; margin:0;">
                                Transmit Uplink Message
                            </h2>
                            <div style="font-size:.65rem; color:#94a3b8; letter-spacing:.06em;">ENCRYPTED 256-BIT DISPATCH TERMINAL</div>
                        </div>
                    </div>
                    <div style="display:inline-flex; align-items:center; gap:5px; background:rgba(0,0,0,0.6); padding:3px 8px; border-radius:4px; border:1px solid rgba(255,255,255,0.1); font-size:.65rem; color:#c084fc; font-weight:700;">
                        <span>SECURE</span>
                    </div>
                </div>

                <div style="padding:2rem 1.8rem;">
                    
                    {{-- Success State Banner --}}
                    <div id="contact-success" style="display:none; background:rgba(16,185,129,0.12); border:1px solid rgba(16,185,129,0.4); padding:1.2rem 1.4rem; border-radius:8px; margin-bottom:1.8rem; backdrop-filter:blur(10px); box-shadow:0 0 25px rgba(16,185,129,0.2);">
                        <div style="display:flex; align-items:flex-start; gap:.9rem;">
                            <div style="width:36px; height:36px; border-radius:50%; background:rgba(16,185,129,0.2); border:1px solid #10b981; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#10b981; font-size:1.2rem;">✓</div>
                            <div style="flex:1;">
                                <div style="font-family:'Orbitron',sans-serif; font-weight:900; color:#34d399; font-size:.95rem; margin-bottom:.2rem;">
                                    UPLINK TRANSMITTED SUCCESSFULLY!
                                </div>
                                <div style="font-size:.82rem; color:#cbd5e1; line-height:1.5;">
                                    Ticket <strong style="color:#ffffff; font-family:monospace;" id="ticketNum">#ROG-8942</strong> has been queued. A hardware specialist will reply to your email in under 2 hours.
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="contact-form" onsubmit="rogContactSubmit(event)" novalidate>
                        
                        {{-- Name & Email Grid --}}
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; margin-bottom:1.3rem;" class="contact-names-grid">
                            <div>
                                <label class="rog-label" style="display:flex; justify-content:space-between;">
                                    <span>Full Name <span style="color:var(--rog-red);">*</span></span>
                                </label>
                                <input type="text" name="name" class="rog-input" required placeholder="e.g. Alex Mercer" autocomplete="name" style="width:100%;">
                            </div>
                            <div>
                                <label class="rog-label" style="display:flex; justify-content:space-between;">
                                    <span>Email Address <span style="color:var(--rog-red);">*</span></span>
                                </label>
                                <input type="email" name="email" class="rog-input" required placeholder="alex@rog.gg" autocomplete="email" style="width:100%;">
                            </div>
                        </div>

                        {{-- Phone & Order ID Grid --}}
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; margin-bottom:1.3rem;" class="contact-names-grid">
                            <div>
                                <label class="rog-label">Phone Number (Optional)</label>
                                <input type="tel" name="phone" class="rog-input" placeholder="+855 77 273 900" autocomplete="tel" style="width:100%;">
                            </div>
                            <div>
                                <label class="rog-label">Order / Serial ID (Optional)</label>
                                <input type="text" name="order_id" class="rog-input" placeholder="e.g. #ROG-2026-X9" style="width:100%;">
                            </div>
                        </div>

                        {{-- Topic Chips --}}
                        <div style="margin-bottom:1.4rem;">
                            <label class="rog-label" style="margin-bottom:.6rem; display:block;">Select Category Topic <span style="color:var(--rog-red);">*</span></label>
                            <input type="hidden" name="subject" id="selectedSubject" value="technical" required>
                            
                            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(130px, 1fr)); gap:.6rem;">
                                @foreach([
                                    ['technical', '🔧 Tech Support'],
                                    ['order', '📦 Order Dispatch'],
                                    ['warranty', '🛡️ RMA & Warranty'],
                                    ['product', '🎮 Product Inquiries'],
                                    ['partnership', '🤝 Partnerships'],
                                    ['other', '💬 General Gear'],
                                ] as [$val, $label])
                                <button type="button" 
                                        class="topic-chip {{ $val === 'technical' ? 'active' : '' }}" 
                                        onclick="selectTopic('{{ $val }}', this)">
                                    {{ $label }}
                                </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Message Area --}}
                        <div style="margin-bottom:1.8rem;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.4rem;">
                                <label class="rog-label" style="margin:0;">Detailed Message <span style="color:var(--rog-red);">*</span></label>
                                <span style="font-size:.65rem; color:#94a3b8;" id="charCounter">0 / 1000</span>
                            </div>
                            <textarea name="message" class="rog-input" rows="5" required
                                      placeholder="Describe your rig setup, hardware symptoms, or order question in detail…"
                                      style="width:100%; resize:vertical; min-height:130px;"
                                      oninput="document.getElementById('charCounter').textContent = this.value.length + ' / 1000'"></textarea>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" id="contact-submit-btn" class="btn-rog"
                                style="width:100%; font-size:.95rem; padding:.95rem 2rem; border-radius:6px; display:flex; align-items:center; justify-content:center; gap:.7rem; box-shadow:0 0 25px rgba(229,0,30,0.5);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/></svg>
                            <span>Send Uplink Message</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ── Right: Channels & Live Health Terminal ─────────────────────── --}}
        <div style="display:flex; flex-direction:column; gap:1.6rem;">

            {{-- Support Channels --}}
            <div class="rog-pl-card-wrap">
                <div class="rog-pl-card" style="padding:1.6rem;">
                    <div class="rog-card-glare"></div>
                    <div class="hud-corner hud-tl"></div>
                    <div class="hud-corner hud-tr"></div>
                    <div class="hud-corner hud-bl"></div>
                    <div class="hud-corner hud-br"></div>

                    <div style="display:flex; align-items:center; gap:.6rem; margin-bottom:1.4rem;">
                        <div style="width:3px; height:18px; background:var(--rog-red); box-shadow:0 0 8px var(--rog-red);"></div>
                        <h3 style="font-family:'Orbitron',sans-serif; font-weight:800; font-size:.85rem; letter-spacing:.12em; text-transform:uppercase; color:#fff; margin:0;">
                            Live Support Channels
                        </h3>
                    </div>

                    <div style="display:flex; flex-direction:column; gap:1rem;">
                        
                        {{-- Email Channel --}}
                        <div class="contact-channel-box" onclick="copyText('support@rog-store.kh', this)">
                            <div class="channel-icon-wrap" style="color:#e5001e;">📧</div>
                            <div style="flex:1; min-width:0;">
                                <div style="font-size:.65rem; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:.08em;">Official Email</div>
                                <div style="font-size:.88rem; font-weight:700; color:#fff; font-family:monospace;">support@rog-store.kh</div>
                            </div>
                            <button type="button" class="copy-action-pill">
                                <span>Copy</span>
                            </button>
                        </div>

                        {{-- Phone Channel --}}
                        <div class="contact-channel-box" onclick="copyText('+85577273900', this)">
                            <div class="channel-icon-wrap" style="color:#c084fc;">📞</div>
                            <div style="flex:1; min-width:0;">
                                <div style="font-size:.65rem; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:.08em;">Direct Phone Hotline</div>
                                <div style="font-size:.88rem; font-weight:700; color:#fff; font-family:monospace;">+855 77 273 900</div>
                            </div>
                            <a href="tel:+85577273900" class="copy-action-pill" style="text-decoration:none;" onclick="event.stopPropagation();">
                                <span>Call</span>
                            </a>
                        </div>

                        {{-- AI Chat Assistant Channel --}}
                        <div class="contact-channel-box" onclick="document.getElementById('rog-ai-btn')?.click()">
                            <div class="channel-icon-wrap" style="color:#00e5ff;">🤖</div>
                            <div style="flex:1; min-width:0;">
                                <div style="font-size:.65rem; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:.08em;">ROG Neural Assistant</div>
                                <div style="font-size:.85rem; font-weight:700; color:#fff;">Instant AI Specs & Diagnostics</div>
                            </div>
                            <span class="copy-action-pill" style="background:rgba(0,229,255,0.15); border-color:#00e5ff; color:#00e5ff;">
                                <span>Chat ➔</span>
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Location Card --}}
            <div class="rog-pl-card-wrap">
                <div class="rog-pl-card" style="padding:1.6rem;">
                    <div class="rog-card-glare"></div>
                    <div class="hud-corner hud-tl"></div>
                    <div class="hud-corner hud-tr"></div>
                    <div class="hud-corner hud-bl"></div>
                    <div class="hud-corner hud-br"></div>

                    <div style="display:flex; align-items:center; gap:.6rem; margin-bottom:1rem;">
                        <div style="width:3px; height:18px; background:var(--rog-red); box-shadow:0 0 8px var(--rog-red);"></div>
                        <h3 style="font-family:'Orbitron',sans-serif; font-weight:800; font-size:.85rem; letter-spacing:.12em; text-transform:uppercase; color:#fff; margin:0;">
                            Flagship Campus HQ
                        </h3>
                    </div>

                    <div style="display:flex; gap:1rem; align-items:flex-start;">
                        <div class="channel-icon-wrap" style="color:#f59e0b; font-size:1.2rem;">📍</div>
                        <div>
                            <div style="font-weight:800; color:#fff; font-size:.92rem; margin-bottom:.3rem;">ROG Concept Store Cambodia</div>
                            <div style="color:#94a3b8; font-size:.82rem; line-height:1.7;">
                                Choam Chao Boulevard, Sector 3<br>
                                Phnom Penh, Cambodia<br>
                                <span style="color:var(--rog-red); font-weight:700;">★ Adjacent to AEON Mall Mean Chey</span>
                            </div>
                            <div style="margin-top:.8rem; font-size:.75rem; color:#cbd5e1; display:flex; align-items:center; gap:.4rem;">
                                <span>🕒 Hours:</span>
                                <strong>Mon–Sat · 8:00 AM – 8:00 PM</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Self-Service Quick Action Matrix ──────────────────────────────── --}}
    <div style="margin-top:4rem;">
        <div style="text-align:center; margin-bottom:2rem;">
            <div style="font-size:.7rem; color:var(--rog-red); font-weight:800; letter-spacing:.25em; text-transform:uppercase; margin-bottom:.4rem;">Self-Service Portal</div>
            <h2 style="font-family:'Orbitron',sans-serif; font-size:1.4rem; font-weight:900; color:var(--text-primary); text-transform:uppercase; margin:0;">
                Quick Help Diagnostics
            </h2>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:1.4rem;">
            @foreach([
                ['📦', 'Live Order Tracking', 'Real-time GPS parcel and freight tracking', route('shop'), 'Track Parcel ➔', '#00e5ff'],
                ['🔄', 'Returns & Exchanges', '30-day risk-free hardware return policy', route('about'), 'Policy Info ➔', '#c084fc'],
                ['🔧', 'Driver & BIOS Downloads', 'Firmware, Armoury Crate & vBIOS utilities', route('shop', ['category'=>'motherboards']), 'Drivers ➔', '#e5001e'],
                ['🛡️', 'RMA & Warranty Center', 'Register serial numbers & claim coverage', route('about'), 'RMA Center ➔', '#f59e0b'],
            ] as [$icon, $title, $desc, $link, $action, $color])
            <div class="rog-pl-card-wrap">
                <a href="{{ $link }}" class="rog-pl-card" style="padding:1.6rem 1.4rem; text-align:center;">
                    <div class="rog-card-glare"></div>
                    <div class="hud-corner hud-tl"></div>
                    <div class="hud-corner hud-tr"></div>
                    <div class="hud-corner hud-bl"></div>
                    <div class="hud-corner hud-br"></div>
                    <div style="font-size:2rem; margin-bottom:.6rem; filter:drop-shadow(0 0 10px {{ $color }});">{{ $icon }}</div>
                    <h3 style="font-family:'Orbitron',sans-serif; font-weight:800; font-size:.9rem; color:#fff; margin-bottom:.4rem; text-transform:uppercase;">
                        {{ $title }}
                    </h3>
                    <p style="color:#94a3b8; font-size:.8rem; line-height:1.6; margin:0 0 1rem 0;">
                        {{ $desc }}
                    </p>
                    <div style="font-size:.78rem; font-weight:800; color:{{ $color }}; text-transform:uppercase; letter-spacing:.08em;">
                        {{ $action }}
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</div>

{{-- Dynamic Styles for Contact Page --}}
<style>
    .topic-chip {
        background: rgba(13, 11, 24, 0.6);
        border: 1px solid rgba(147, 51, 234, 0.25);
        color: #cbd5e1;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.76rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
        user-select: none;
    }

    .topic-chip:hover {
        border-color: rgba(229, 0, 30, 0.5);
        color: #fff;
        background: rgba(229, 0, 30, 0.1);
    }

    .topic-chip.active {
        background: linear-gradient(135deg, rgba(229,0,30,0.25) 0%, rgba(147,51,234,0.2) 100%);
        border-color: var(--rog-red);
        color: #ffffff;
        box-shadow: 0 0 15px rgba(229, 0, 30, 0.3);
    }

    .contact-channel-box {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 0.85rem 1rem;
        background: rgba(13, 11, 24, 0.6);
        border: 1px solid rgba(147, 51, 234, 0.2);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .contact-channel-box:hover {
        background: rgba(24, 18, 44, 0.8);
        border-color: rgba(192, 132, 252, 0.6);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5), 0 0 15px rgba(147, 51, 234, 0.25);
        transform: translateY(-2px);
    }

    .channel-icon-wrap {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .copy-action-pill {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #cbd5e1;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .contact-channel-box:hover .copy-action-pill {
        border-color: var(--rog-red);
        color: #ffffff;
        background: rgba(229, 0, 30, 0.2);
    }

    @media (max-width: 960px) {
        .contact-layout-grid {
            grid-template-columns: 1fr !important;
        }
        .contact-names-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@push('scripts')
<script>
function selectTopic(topic, btn) {
    document.getElementById('selectedSubject').value = topic;
    document.querySelectorAll('.topic-chip').forEach(c => c.classList.remove('active'));
    btn.classList.add('active');
}

function copyText(text, container) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
            const pill = container.querySelector('.copy-action-pill');
            if (pill) {
                const originalText = pill.innerHTML;
                pill.innerHTML = '<span>COPIED! ✓</span>';
                pill.style.background = '#10b981';
                pill.style.borderColor = '#10b981';
                pill.style.color = '#fff';
                setTimeout(() => {
                    pill.innerHTML = originalText;
                    pill.style.background = '';
                    pill.style.borderColor = '';
                    pill.style.color = '';
                }, 2000);
            }
        });
    }
}

function rogContactSubmit(e) {
    e.preventDefault();
    const form = document.getElementById('contact-form');
    const btn  = document.getElementById('contact-submit-btn');
    const succ = document.getElementById('contact-success');

    // Validation
    const required = form.querySelectorAll('[required]');
    let valid = true;
    required.forEach(el => {
        el.style.borderColor = '';
        if (!el.value.trim()) {
            el.style.borderColor = 'var(--rog-red)';
            valid = false;
        }
    });
    if (!valid) return;

    // Generate random ticket number
    const randomTicket = '#ROG-' + Math.floor(1000 + Math.random() * 9000);
    document.getElementById('ticketNum').textContent = randomTicket;

    // Loading state
    btn.disabled = true;
    btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="animation:spin .7s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Transmitting to ROG Grid…';

    setTimeout(() => {
        form.reset();
        document.getElementById('charCounter').textContent = '0 / 1000';
        btn.disabled = false;
        btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/></svg> <span>Send Uplink Message</span>';
        
        succ.style.display = 'block';
        succ.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        if (window.rogToast) {
            window.rogToast('Uplink confirmed! Ticket ' + randomTicket + ' created.', 'success', 5000);
        }
    }, 1100);
}
</script>
<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush
@endsection

