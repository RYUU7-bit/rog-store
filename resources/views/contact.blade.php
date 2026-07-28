@extends('layouts.app')
@section('title', 'Contact Us — ROG Store')

@section('content')

{{-- ── Hero Banner ──────────────────────────────────────────────────────── --}}
<div style="background:linear-gradient(135deg,#0a0a0a 0%,#1a0005 50%,#0a0a0a 100%); border-bottom:1px solid rgba(229,0,30,.2); padding:3.5rem 1.5rem 3rem; text-align:center; position:relative; overflow:hidden;">
    {{-- Glow orbs --}}
    <div style="position:absolute; top:-40px; left:50%; transform:translateX(-50%); width:600px; height:200px; background:radial-gradient(ellipse,rgba(229,0,30,.12) 0%,transparent 70%); pointer-events:none;"></div>
    <div style="position:relative; z-index:1;">
        <div style="display:inline-flex; align-items:center; gap:.5rem; background:rgba(229,0,30,.1); border:1px solid rgba(229,0,30,.3); padding:.3rem 1rem; margin-bottom:1.2rem;">
            <span style="width:6px; height:6px; border-radius:50%; background:var(--rog-red); animation:pulse 1.5s ease-in-out infinite;"></span>
            <span style="color:var(--rog-red); font-size:.7rem; font-weight:700; letter-spacing:.2em; text-transform:uppercase;">Support Online</span>
        </div>
        <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.8rem,3.5vw,2.6rem); font-weight:900; color:#fff; margin-bottom:.8rem; letter-spacing:.04em;">
            Contact <span style="color:var(--rog-red);">ROG Store</span>
        </h1>
        <p style="color:#888; font-size:.95rem; max-width:480px; margin:0 auto; line-height:1.7;">
            Hardware issues, order questions, or just want to talk gear — we've got you covered.
        </p>
    </div>
</div>

<div style="max-width:1100px; margin:0 auto; padding:3rem 1.5rem 4rem;">

    {{-- ── Stats Strip ──────────────────────────────────────────────────── --}}
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:var(--border-card); border:1px solid var(--border-card); margin-bottom:3rem;">
        @foreach([
            ['⚡','< 2 Hours','Average response time'],
            ['🕐','24 / 7','Live support available'],
            ['⭐','4.9 / 5','Customer satisfaction'],
        ] as [$icon,$stat,$label])
        <div style="background:var(--bg-card); padding:1.5rem; text-align:center;">
            <div style="font-size:1.4rem; margin-bottom:.4rem;">{{ $icon }}</div>
            <div style="font-family:'Orbitron',sans-serif; font-size:1.1rem; font-weight:900; color:var(--rog-red); margin-bottom:.2rem;">{{ $stat }}</div>
            <div style="font-size:.75rem; color:var(--text-muted); letter-spacing:.06em; text-transform:uppercase;">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    <div style="display:grid; grid-template-columns:1fr 420px; gap:2rem; align-items:start;">

        {{-- ── Left: Contact Form ───────────────────────────────────────── --}}
        <div>
            <div style="background:var(--bg-card); border:1px solid var(--border-card); overflow:hidden;">
                {{-- Card header --}}
                <div style="background:var(--bg-elevated); border-bottom:1px solid var(--border-divider); padding:1.2rem 1.8rem; display:flex; align-items:center; gap:.7rem;">
                    <div style="width:3px; height:20px; background:var(--rog-red);"></div>
                    <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--text-primary); margin:0;">✉️ Send Us a Message</h2>
                </div>

                <div style="padding:2rem 1.8rem;">
                    {{-- Success state --}}
                    <div id="contact-success" style="display:none; background:rgba(34,197,94,.08); border:1px solid rgba(34,197,94,.3); padding:1rem 1.2rem; margin-bottom:1.5rem; display:none; align-items:center; gap:.7rem;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
                        <div>
                            <div style="font-weight:700; color:#22c55e; font-size:.88rem;">Message sent successfully!</div>
                            <div style="font-size:.78rem; color:#4ade80; margin-top:.1rem;">We'll reply within 2 hours during business hours.</div>
                        </div>
                    </div>

                    <form id="contact-form" onsubmit="rogContactSubmit(event)" novalidate>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; margin-bottom:1.2rem;">
                            <div>
                                <label class="rog-label">Full Name *</label>
                                <input type="text" name="name" class="rog-input" required placeholder="John Doe" autocomplete="name">
                            </div>
                            <div>
                                <label class="rog-label">Email Address *</label>
                                <input type="email" name="email" class="rog-input" required placeholder="you@example.com" autocomplete="email">
                            </div>
                        </div>
                        <div style="margin-bottom:1.2rem;">
                            <label class="rog-label">Phone (Optional)</label>
                            <input type="tel" name="phone" class="rog-input" placeholder="+855 xx xxx xxxx" autocomplete="tel">
                        </div>
                        <div style="margin-bottom:1.2rem;">
                            <label class="rog-label">Topic *</label>
                            <select name="subject" class="rog-input" required>
                                <option value="">Select a topic…</option>
                                <option value="order">📦 Order Status / Tracking</option>
                                <option value="product">🎮 Product Inquiry</option>
                                <option value="technical">🔧 Technical Support</option>
                                <option value="warranty">🛡️ Warranty Claim</option>
                                <option value="payment">💳 Payment Issue</option>
                                <option value="return">🔄 Returns & Refunds</option>
                                <option value="partnership">🤝 Business Partnership</option>
                                <option value="other">💬 Other</option>
                            </select>
                        </div>
                        <div style="margin-bottom:1.8rem;">
                            <label class="rog-label">Message *</label>
                            <textarea name="message" class="rog-input" rows="5" required
                                      placeholder="Describe your issue or question in detail…"
                                      style="resize:vertical; min-height:120px;"></textarea>
                        </div>
                        <button type="submit" id="contact-submit-btn"
                                style="width:100%; background:var(--rog-red); color:#fff; border:none; padding:.85rem 1.5rem; font-weight:900; font-size:.88rem; letter-spacing:.1em; text-transform:uppercase; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.5rem; clip-path:polygon(0 0,calc(100% - 12px) 0,100% 12px,100% 100%,12px 100%,0 calc(100% - 12px)); transition:background .2s, box-shadow .2s;"
                                onmouseover="this.style.background='var(--rog-red-dark)';this.style.boxShadow='0 0 24px rgba(229,0,30,.5)'"
                                onmouseout="this.style.background='var(--rog-red)';this.style.boxShadow='none'">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/></svg>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ── Right: Info Cards ─────────────────────────────────────────── --}}
        <div style="display:flex; flex-direction:column; gap:1.2rem;">

            {{-- Support info --}}
            <div style="background:var(--bg-card); border:1px solid var(--border-card); overflow:hidden;">
                <div style="background:var(--bg-elevated); border-bottom:1px solid var(--border-divider); padding:1rem 1.4rem; display:flex; align-items:center; gap:.6rem;">
                    <div style="width:3px; height:18px; background:var(--rog-red);"></div>
                    <span style="font-weight:800; font-size:.75rem; letter-spacing:.15em; text-transform:uppercase; color:var(--text-primary);">📞 Customer Support</span>
                </div>
                <div style="padding:1.4rem; display:flex; flex-direction:column; gap:1rem;">
                    @foreach([
                        ['📧','Email','support@rog-store.kh','mailto:support@rog-store.kh',true],
                        ['📞','Phone','+855 77 273 900','tel:+85577273900',true],
                        ['💬','Live Chat','Available 24/7','#',false],
                        ['🕐','Business Hours','Mon–Sat · 8AM – 8PM','#',false],
                    ] as [$icon,$label,$value,$href,$isLink])
                    <div style="display:flex; align-items:center; gap:.9rem; padding:.7rem; background:var(--bg-surface-2); border:1px solid var(--border-divider);">
                        <div style="width:36px; height:36px; background:rgba(229,0,30,.08); border:1px solid rgba(229,0,30,.2); display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:1rem;">{{ $icon }}</div>
                        <div style="min-width:0;">
                            <div style="font-size:.68rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:.08em;">{{ $label }}</div>
                            @if($isLink)
                            <a href="{{ $href }}" style="color:var(--text-secondary); font-size:.88rem; font-weight:600; text-decoration:none; transition:color .2s;"
                               onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-secondary)'">{{ $value }}</a>
                            @else
                            <div style="color:var(--text-secondary); font-size:.88rem; font-weight:600;">{{ $value }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- HQ Location --}}
            <div style="background:var(--bg-card); border:1px solid var(--border-card); overflow:hidden;">
                <div style="background:var(--bg-elevated); border-bottom:1px solid var(--border-divider); padding:1rem 1.4rem; display:flex; align-items:center; gap:.6rem;">
                    <div style="width:3px; height:18px; background:var(--rog-red);"></div>
                    <span style="font-weight:800; font-size:.75rem; letter-spacing:.15em; text-transform:uppercase; color:var(--text-primary);">📍 Store Location</span>
                </div>
                <div style="padding:1.4rem;">
                    <div style="display:flex; gap:.9rem; align-items:flex-start;">
                        <div style="width:36px; height:36px; background:rgba(229,0,30,.08); border:1px solid rgba(229,0,30,.2); display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:1rem; margin-top:.1rem;">🏢</div>
                        <div>
                            <div style="font-weight:700; color:var(--text-primary); font-size:.9rem; margin-bottom:.3rem;">ROG Store Cambodia</div>
                            <div style="color:var(--text-muted); font-size:.83rem; line-height:1.9;">
                                Choam Chao Street 3<br>
                                Phnom Penh, Cambodia<br>
                                <span style="color:var(--rog-red); font-weight:600;">Next to AEON Mall</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Response badge --}}
            <div style="background:rgba(229,0,30,.06); border:1px solid rgba(229,0,30,.2); padding:1.2rem 1.4rem; display:flex; align-items:center; gap:.9rem;">
                <div style="font-size:1.6rem; flex-shrink:0;">⚡</div>
                <div>
                    <div style="font-weight:800; font-size:.85rem; color:var(--text-primary);">Lightning-Fast Support</div>
                    <div style="font-size:.78rem; color:var(--rog-red); font-weight:600; margin-top:.15rem;">Typical reply under 2 hours · Business hours</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Quick Help Cards ──────────────────────────────────────────────── --}}
    <div style="margin-top:3rem;">
        <div style="text-align:center; margin-bottom:1.8rem;">
            <div style="font-size:.7rem; color:var(--rog-red); font-weight:700; letter-spacing:.2em; text-transform:uppercase; margin-bottom:.5rem;">Self-Service</div>
            <h2 style="font-family:'Orbitron',sans-serif; font-size:1.1rem; font-weight:900; color:var(--text-primary);">Quick Help</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:1px; background:var(--border-card); border:1px solid var(--border-card);">
            @foreach([
                ['📦','Order Tracking','Track your shipment in real time','#'],
                ['🔄','Returns & Refunds','30-day hassle-free returns','#'],
                ['🔧','Technical Support','Driver downloads & guides','#'],
                ['🛡️','Warranty','Register & claim warranty','#'],
            ] as [$icon,$title,$desc,$href])
            <a href="{{ $href }}" style="background:var(--bg-card); padding:1.8rem 1.2rem; text-align:center; text-decoration:none; display:block; transition:background .2s, transform .2s; border:none;"
               onmouseover="this.style.background='var(--bg-card-hover)';this.querySelector('.qh-icon').style.transform='scale(1.2)'"
               onmouseout="this.style.background='var(--bg-card)';this.querySelector('.qh-icon').style.transform='scale(1)'">
                <div class="qh-icon" style="font-size:2rem; margin-bottom:.7rem; display:block; transition:transform .25s;">{{ $icon }}</div>
                <div style="font-weight:800; color:var(--text-primary); font-size:.88rem; margin-bottom:.3rem;">{{ $title }}</div>
                <div style="font-size:.75rem; color:var(--text-muted); line-height:1.5;">{{ $desc }}</div>
                <div style="margin-top:.8rem; color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase;">Learn more →</div>
            </a>
            @endforeach
        </div>
    </div>

</div>

@push('scripts')
<script>
function rogContactSubmit(e) {
    e.preventDefault();
    const form = document.getElementById('contact-form');
    const btn  = document.getElementById('contact-submit-btn');
    const succ = document.getElementById('contact-success');

    // Basic validation
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

    // Loading state
    btn.disabled = true;
    btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="animation:spin .7s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Sending…';

    // Simulate send (replace with real AJAX if needed)
    setTimeout(() => {
        form.reset();
        btn.disabled = false;
        btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/></svg> Send Message';
        succ.style.display = 'flex';
        succ.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        setTimeout(() => {
            succ.style.transition = 'opacity .5s';
            succ.style.opacity = '0';
            setTimeout(() => { succ.style.display = 'none'; succ.style.opacity = '1'; }, 500);
        }, 5000);
    }, 1200);
}
</script>
<style>
@keyframes spin  { to { transform: rotate(360deg); } }
@keyframes pulse { 0%,100%{opacity:1;transform:scale(1);}50%{opacity:.4;transform:scale(.75);} }
@media (max-width: 900px) {
    /* Stack to single column on tablet */
}
@media (max-width: 640px) {
    .contact-grid { grid-template-columns: 1fr !important; }
}
</style>
@endpush
@endsection
