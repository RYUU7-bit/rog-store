@extends('layouts.app')
@section('title', 'Contact Us — ROG Store')

@section('content')
<div style="max-width:1080px; margin:0 auto; padding:2rem 1.5rem;">

    {{-- Page header --}}
    <div style="text-align:center; margin-bottom:3rem;">
        <div style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.25em; text-transform:uppercase; margin-bottom:.8rem;">Get in Touch</div>
        <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.6rem,3vw,2.2rem); font-weight:900; color:var(--text-primary); margin-bottom:.8rem;">Contact ROG Store</h1>
        <p style="color:var(--text-muted); font-size:.95rem;">Have questions? Need support? We're here to help.</p>
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:2rem; margin-bottom:4rem;">

        {{-- Contact Info --}}
        <div style="display:flex; flex-direction:column; gap:1.5rem;">

            {{-- Support card --}}
            <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:2rem;">
                <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.5rem;">📞 Customer Support</h2>
                <div style="display:flex; flex-direction:column; gap:.9rem; font-size:.9rem;">
                    <div style="display:flex; align-items:center; gap:.8rem;">
                        <span style="color:var(--rog-red); flex-shrink:0;">📧</span>
                        <a href="mailto:support@rog-store.com"
                           style="color:var(--text-secondary); text-decoration:none; transition:color .2s;"
                           onmouseover="this.style.color='var(--rog-red)'"
                           onmouseout="this.style.color='var(--text-secondary)'">Cambodiat@rog-store.com</a>
                    </div>
                    <div style="display:flex; align-items:center; gap:.8rem;">
                        <span style="color:var(--rog-red); flex-shrink:0;">📞</span>
                        <span style="color:var(--text-secondary);">+855772739</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:.8rem;">
                        <span style="color:var(--rog-red); flex-shrink:0;">💬</span>
                        <span style="color:var(--text-secondary);">Live Chat: Available 24/7</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:.8rem;">
                        <span style="color:var(--rog-red); flex-shrink:0;">🕐</span>
                        <span style="color:var(--text-secondary);">Mon–Fri: 9:00 AM – 6:00 PM PST</span>
                    </div>
                </div>
            </div>

            {{-- HQ card --}}
            <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:2rem;">
                <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.5rem;">📍 Headquarters</h2>
                <div style="color:var(--text-muted); line-height:2; font-size:.9rem;">
                    <div style="color:var(--text-secondary); font-weight:600;">Republic of Gamers HQ</div>
                    <div>ASUS Computer International</div>
                    <div>Choam Chao Street 3</div>
                    <div>Phnom Penh</div>
                    <div>Cambodia</div>
                </div>
            </div>

            {{-- Response time badge --}}
            <div style="background:rgba(229,0,30,.08); border:1px solid rgba(229,0,30,.25); padding:1.2rem 1.5rem; display:flex; align-items:center; gap:.8rem;">
                <span style="font-size:1.4rem;">⚡</span>
                <div>
                    <div style="font-weight:700; font-size:.85rem; color:var(--text-primary);">Typical Response Time</div>
                    <div style="font-size:.8rem; color:var(--rog-red); font-weight:600;">Under 2 hours during business hours</div>
                </div>
            </div>
        </div>

        {{-- Contact Form --}}
        <div>
            <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:2rem;">
                <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.5rem;">✉️ Send Us a Message</h2>

                @if(session('contact_success'))
                <div class="alert-success" style="margin-bottom:1.5rem;">
                    ✓ Message sent! We'll get back to you within 24 hours.
                </div>
                @endif

                <form onsubmit="rogContactSubmit(event)">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                        <div>
                            <label class="rog-label">Your Name *</label>
                            <input type="text" class="rog-input" required placeholder="John Doe" autocomplete="name">
                        </div>
                        <div>
                            <label class="rog-label">Email Address *</label>
                            <input type="email" class="rog-input" required placeholder="you@example.com" autocomplete="email">
                        </div>
                    </div>
                    <div style="margin-bottom:1rem;">
                        <label class="rog-label">Subject *</label>
                        <select class="rog-input" required>
                            <option value="">Select topic…</option>
                            <option>Product Inquiry</option>
                            <option>Technical Support</option>
                            <option>Order Status</option>
                            <option>Warranty Claim</option>
                            <option>Partnership</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div style="margin-bottom:1.5rem;">
                        <label class="rog-label">Message *</label>
                        <textarea class="rog-input" rows="5" required
                                  placeholder="Tell us how we can help…"
                                  style="resize:vertical;"></textarea>
                    </div>
                    <button type="submit" class="btn-rog" id="contact-submit-btn"
                            style="width:100%; justify-content:center; font-size:.9rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/></svg>
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:2rem;">
        <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.5rem; text-align:center;">🔗 Quick Links</h2>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px,1fr)); gap:1rem; text-align:center;">
            @foreach([
                ['📦','Order Tracking','Track your order status'],
                ['🔄','Returns & Warranty','30-day returns policy'],
                ['💬','FAQ','Common questions answered'],
                ['🎓','Support Center','Guides & tutorials'],
            ] as [$icon,$title,$desc])
            <div class="contact-quick-card"
                 style="padding:1.4rem 1rem; border:1px solid var(--border-card); background:var(--bg-surface-2); cursor:pointer; transition:border-color .2s, transform .2s, box-shadow .2s; border-radius:2px;"
                 onmouseover="this.style.borderColor='var(--rog-red)';this.style.transform='translateY(-3px)';this.style.boxShadow='0 6px 20px rgba(229,0,30,.15)'"
                 onmouseout="this.style.borderColor='var(--border-card)';this.style.transform='';this.style.boxShadow=''">
                <div style="font-size:1.9rem; margin-bottom:.6rem;">{{ $icon }}</div>
                <div style="font-weight:700; color:var(--text-primary); font-size:.85rem; margin-bottom:.3rem;">{{ $title }}</div>
                <div style="font-size:.75rem; color:var(--text-muted);">{{ $desc }}</div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@push('scripts')
<script>
function rogContactSubmit(e) {
    e.preventDefault();
    var btn = document.getElementById('contact-submit-btn');
    btn.disabled = true;
    btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="animation:spin .7s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Sending…';
    setTimeout(function () {
        e.target.reset();
        btn.disabled = false;
        btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 2 11 13M22 2 15 22l-4-9-9-4 20-7z"/></svg> Send Message';
        var flash = document.createElement('div');
        flash.className = 'alert-success';
        flash.style.cssText = 'margin-bottom:1.5rem; animation:rogMsgIn .3s ease both;';
        flash.innerHTML = '✓ Message sent! We\'ll get back to you within 24 hours.';
        e.target.prepend(flash);
        setTimeout(function () {
            flash.style.transition = 'opacity .5s';
            flash.style.opacity = '0';
            setTimeout(function () { flash.remove(); }, 500);
        }, 4000);
    }, 1200);
}
</script>
<style>
@keyframes spin { to { transform: rotate(360deg); } }
@media (max-width: 640px) {
    .contact-quick-card { padding: 1rem .8rem !important; }
}
</style>
@endpush
@endsection
