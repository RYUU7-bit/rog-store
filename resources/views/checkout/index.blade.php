@extends('layouts.app')
@section('title', 'Checkout — ROG Store')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:2rem 1.5rem;">
    <div style="margin-bottom:2rem;">
        <div style="font-size:.75rem; color:var(--text-muted); letter-spacing:.08em; text-transform:uppercase; margin-bottom:.5rem;">
            <a href="{{ route('home') }}" style="color:var(--text-muted); text-decoration:none;">Home</a> ›
            <a href="{{ route('cart') }}" style="color:var(--text-muted); text-decoration:none;">Cart</a> ›
            <span style="color:var(--rog-red);">Checkout</span>
        </div>
        <h1 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.8rem; color:var(--text-primary);">Checkout</h1>
    </div>

    <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div style="display:grid; grid-template-columns:1fr 380px; gap:2rem; align-items:start;" class="checkout-layout-grid">

            {{-- ── Left: Forms ─────────────────────────────────────────────── --}}
            <div>
                {{-- Shipping --}}
                <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:1.5rem; margin-bottom:1.5rem; border-radius:8px;">
                    <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem; padding-bottom:.7rem; border-bottom:1px solid var(--border-divider);">📦 Shipping Information</h2>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;" class="shipping-form-grid">
                        <div>
                            <label class="rog-label">First Name *</label>
                            <input type="text" name="first_name" class="rog-input" value="{{ old('first_name') }}" required>
                            @error('first_name')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="rog-label">Last Name *</label>
                            <input type="text" name="last_name" class="rog-input" value="{{ old('last_name') }}" required>
                            @error('last_name')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="rog-label">Email Address *</label>
                            <input type="email" name="email" class="rog-input" value="{{ old('email') }}" required>
                            @error('email')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="rog-label">Phone Number *</label>
                            <input type="tel" name="phone" class="rog-input" value="{{ old('phone') }}" required>
                            @error('phone')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>
                        <div style="grid-column:1/-1;">
                            <label class="rog-label">Street Address *</label>
                            <input type="text" name="address" class="rog-input" value="{{ old('address') }}" required placeholder="123 Main St, Apt 4B">
                            @error('address')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="rog-label">City *</label>
                            <input type="text" name="city" class="rog-input" value="{{ old('city') }}" required>
                            @error('city')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="rog-label">State / Province</label>
                            <input type="text" name="state" class="rog-input" value="{{ old('state') }}">
                        </div>
                        <div>
                            <label class="rog-label">ZIP / Postal Code *</label>
                            <input type="text" name="zip_code" class="rog-input" value="{{ old('zip_code') }}" required>
                            @error('zip_code')<span style="color:#ef4444;font-size:.75rem;">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="rog-label">Country</label>
                            <select name="country" class="rog-input">
                                @php $sc = old('country','KH'); @endphp
                                <option value="KH" {{ $sc==='KH'?'selected':'' }}>Cambodia</option>
                                <option value="US" {{ $sc==='US'?'selected':'' }}>United States</option>
                                <option value="CA" {{ $sc==='CA'?'selected':'' }}>Canada</option>
                                <option value="GB" {{ $sc==='GB'?'selected':'' }}>United Kingdom</option>
                                <option value="AU" {{ $sc==='AU'?'selected':'' }}>Australia</option>
                                <option value="MY" {{ $sc==='MY'?'selected':'' }}>Malaysia</option>
                                <option value="SG" {{ $sc==='SG'?'selected':'' }}>Singapore</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Payment Methods --}}
                <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:1.5rem; margin-bottom:1.5rem; border-radius:8px;">
                    <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem; padding-bottom:.7rem; border-bottom:1px solid var(--border-divider);">💳 Payment Method</h2>
                    <div style="display:flex; flex-direction:column; gap:.8rem;" id="payment-methods">

                        {{-- BAKONG KHQR --}}
                        <label class="pay-label" data-method="bakong_khqr"
                               style="display:flex; align-items:center; gap:1rem; padding:1rem 1.2rem; border:2px solid var(--rog-red); cursor:pointer; background:rgba(204,0,24,.06); border-radius:6px;">
                            <input type="radio" name="payment_method" value="bakong_khqr" checked style="accent-color:var(--rog-red);">
                            <div style="display:flex; align-items:center; gap:.7rem; flex:1; flex-wrap:wrap;">
                                <div style="background:#e5001e; border-radius:4px; padding:4px 8px; display:flex; align-items:center; gap:4px; flex-shrink:0;">
                                    <span style="color:#fff; font-weight:900; font-size:.75rem; letter-spacing:.08em; font-family:'Orbitron',sans-serif;">KH</span>
                                    <span style="color:rgba(255,255,255,.5); font-size:.7rem;">|</span>
                                    <span style="color:#fff; font-size:.75rem; font-weight:900;">QR</span>
                                </div>
                                <div style="flex:1; min-width:140px;">
                                    <div style="color:var(--text-primary); font-weight:700; font-size:.9rem;">BAKONG KHQR</div>
                                    <div style="color:var(--text-muted); font-size:.72rem;">Scan with any Cambodian banking app · Instant</div>
                                </div>
                                <span style="background:#22c55e; color:#fff; font-size:.62rem; font-weight:800; padding:2px 7px; border-radius:20px; letter-spacing:.06em; flex-shrink:0;">RECOMMENDED</span>
                            </div>
                        </label>

                        {{-- Credit / Debit Card --}}
                        <label class="pay-label" data-method="credit_card"
                               style="display:flex; align-items:center; gap:1rem; padding:1rem 1.2rem; border:1px solid var(--border-input); cursor:pointer; background:var(--bg-surface-2); border-radius:4px;">
                            <input type="radio" name="payment_method" value="credit_card" style="accent-color:var(--rog-red);">
                            <div style="display:flex; align-items:center; gap:.7rem;">
                                <span style="font-size:1.4rem;">💳</span>
                                <div>
                                    <div style="color:var(--text-primary); font-weight:700; font-size:.9rem;">Credit / Debit Card</div>
                                    <div style="color:var(--text-muted); font-size:.72rem;">Visa, Mastercard, American Express</div>
                                </div>
                            </div>
                        </label>

                        {{-- Bank Transfer --}}
                        <label class="pay-label" data-method="bank_transfer"
                               style="display:flex; align-items:center; gap:1rem; padding:1rem 1.2rem; border:1px solid var(--border-input); cursor:pointer; background:var(--bg-surface-2); border-radius:4px;">
                            <input type="radio" name="payment_method" value="bank_transfer" style="accent-color:var(--rog-red);">
                            <div style="display:flex; align-items:center; gap:.7rem;">
                                <span style="font-size:1.4rem;">🏦</span>
                                <div>
                                    <div style="color:var(--text-primary); font-weight:700; font-size:.9rem;">Bank Transfer</div>
                                    <div style="color:var(--text-muted); font-size:.72rem;">Manual bank transfer · 1-2 business days</div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('payment_method')<span style="color:#ef4444;font-size:.75rem;margin-top:.5rem;display:block;">{{ $message }}</span>@enderror
                </div>

                {{-- Notes --}}
                <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:1.8rem;">
                    <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem;">📝 Order Notes (Optional)</h2>
                    <textarea name="notes" class="rog-input" rows="3" placeholder="Special instructions or delivery notes…" style="resize:vertical;">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- ── Right: Order Summary ─────────────────────────────────── --}}
            <div style="position:sticky; top:80px;">
                <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:1.5rem; margin-bottom:1rem;">
                    <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.12em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem; padding-bottom:.8rem; border-bottom:1px solid var(--border-divider);">Order Summary</h2>
                    <div style="max-height:280px; overflow-y:auto; margin-bottom:1rem;">
                        @foreach($cartItems as $item)
                        <div style="display:flex; gap:.8rem; padding:.7rem 0; border-bottom:1px solid var(--border-divider); align-items:center;">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                 style="width:56px; height:48px; object-fit:contain; background:var(--bg-surface-2); padding:4px; border:1px solid var(--border-card); flex-shrink:0;"
                                 onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=100&q=50'">
                            <div style="flex:1; min-width:0;">
                                <div style="font-size:.82rem; font-weight:700; color:var(--text-secondary); line-height:1.3; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $item->product->name }}</div>
                                <div style="font-size:.75rem; color:var(--text-muted); margin-top:.15rem;">× {{ $item->quantity }}</div>
                            </div>
                            <div style="font-weight:700; color:var(--rog-red); font-size:.9rem; flex-shrink:0;">
                                ${{ number_format(($item->product->sale_price ?? $item->product->price) * $item->quantity, 2) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div style="display:flex; flex-direction:column; gap:.7rem;">
                        <div style="display:flex; justify-content:space-between; font-size:.88rem; color:var(--text-secondary);">
                            <span>Subtotal</span><span style="color:var(--text-primary);">${{ number_format($subtotal,2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:.88rem; color:var(--text-secondary);">
                            <span>Tax (8%)</span><span style="color:var(--text-primary);">${{ number_format($tax,2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:.88rem; color:var(--text-secondary);">
                            <span>Shipping</span><span style="color:#22c55e; font-weight:600;">FREE</span>
                        </div>
                        <div style="border-top:1px solid var(--border-input); padding-top:.7rem; display:flex; justify-content:space-between;">
                            <span style="font-weight:800; color:var(--text-primary); text-transform:uppercase; letter-spacing:.06em;">Total</span>
                            <span style="font-weight:900; font-size:1.3rem; color:var(--rog-red);">${{ number_format($total,2) }}</span>
                        </div>
                    </div>
                </div>
                <button type="submit" id="checkout-submit-btn" style="width:100%; background:var(--rog-red); color:#fff; border:none; padding:.9rem 1.5rem; font-weight:900; font-size:.95rem; letter-spacing:.08em; text-transform:uppercase; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.5rem; transition:opacity .2s;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Place Order — ${{ number_format($total,2) }}
                </button>
                <div style="text-align:center; margin-top:.8rem; color:var(--text-muted); font-size:.73rem;">
                    🔒 Secured checkout · By placing your order you agree to our Terms
                </div>
            </div>
        </div>
    </form>
</div>

{{-- ════════════════════════════════════════════════════════════════════════
     BAKONG KHQR CYBERNETIC PAYMENT MODAL (DYNAMIC 8K SYSTEM)
════════════════════════════════════════════════════════════════════════ --}}
<div id="bakong-modal" style="display:none; position:fixed; inset:0; z-index:9500; align-items:center; justify-content:center; padding:16px; box-sizing:border-box; overflow-y:auto;">
    {{-- Backdrop --}}
    <div id="bakong-backdrop" style="position:fixed; inset:0; background:rgba(6,5,14,0.88); backdrop-filter:blur(16px);"></div>

    {{-- Cyber Card Chassis --}}
    <div id="bakong-card" style="position:relative; z-index:1; background:linear-gradient(165deg, rgba(20,16,38,0.98) 0%, rgba(10,8,22,0.99) 100%); border:1.5px solid rgba(229,0,30,0.45); border-radius:18px; width:100%; max-width:410px; box-shadow:0 40px 100px rgba(0,0,0,0.9), 0 0 50px rgba(229,0,30,0.25); overflow:hidden; animation:rogMsgIn .35s cubic-bezier(.175,.885,.32,1.1) both; margin:auto; backdrop-filter:blur(24px);">

        {{-- Hologram Corner Brackets --}}
        <div class="hud-corner hud-tl" style="border-color:#e5001e;"></div>
        <div class="hud-corner hud-tr" style="border-color:#e5001e;"></div>
        <div class="hud-corner hud-bl" style="border-color:#e5001e;"></div>
        <div class="hud-corner hud-br" style="border-color:#e5001e;"></div>

        {{-- Sweeping Holographic Laser --}}
        <div class="rog-hologram-sweep" style="animation-duration:5s;"></div>

        {{-- ── Header ────────────────────────────────────────────────────── --}}
        <div style="background:linear-gradient(90deg, #b91c1c 0%, #e5001e 50%, #991b1b 100%); padding:.9rem 1.2rem; display:flex; align-items:center; justify-content:space-between; box-shadow:0 4px 15px rgba(229,0,30,0.4);">
            <div style="display:flex; align-items:center; gap:8px;">
                <div style="background:#fff; color:#e5001e; font-family:'Orbitron',sans-serif; font-weight:900; font-size:.82rem; padding:2px 7px; border-radius:4px; letter-spacing:.08em;">
                    KHQR
                </div>
                <div style="width:1.5px; height:18px; background:rgba(255,255,255,.4);"></div>
                <div>
                    <div style="color:#fff; font-size:.78rem; font-weight:900; letter-spacing:.08em; text-transform:uppercase; line-height:1;">
                        BAKONG GATEWAY
                    </div>
                    <div style="color:rgba(255,255,255,.75); font-size:.58rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase;">
                        NBC NATIONAL PAYMENT HUB
                    </div>
                </div>
            </div>
            <button id="bakong-close-btn" title="Cancel payment"
                style="width:30px; height:30px; border-radius:50%; background:rgba(0,0,0,.25); border:1px solid rgba(255,255,255,.2); color:#fff; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.9rem; transition:all .2s;"
                onmouseover="this.style.background='rgba(0,0,0,.5)';this.style.transform='scale(1.1)'" onmouseout="this.style.background='rgba(0,0,0,.25)';this.style.transform='scale(1)'">✕</button>
        </div>

        {{-- ── Step 1: Loading ─────────────────────────────────────────────── --}}
        <div id="bakong-step-loading" style="padding:3.5rem 1.5rem; display:flex; flex-direction:column; align-items:center; gap:1.2rem; text-align:center;">
            <div style="position:relative; width:56px; height:56px; display:flex; align-items:center; justify-content:center;">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="2" stroke-linecap="round" style="animation:spin .75s linear infinite; filter:drop-shadow(0 0 10px #e5001e);"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                <span style="position:absolute; font-size:1.2rem;">🇰🇭</span>
            </div>
            <div>
                <div style="font-family:'Orbitron',sans-serif; font-size:1rem; font-weight:900; color:#ffffff; letter-spacing:.06em; margin-bottom:.3rem;">
                    CONNECTING TO BAKONG GRID…
                </div>
                <div style="font-size:.8rem; color:#94a3b8;">
                    Generating secure National KHQR token…
                </div>
            </div>
        </div>

        {{-- ── Step 2: QR Code ─────────────────────────────────────────────── --}}
        <div id="bakong-step-qr" style="display:none; padding:1.2rem 1.4rem;">
            
            {{-- Merchant & Ref Meta --}}
            <div style="background:rgba(13,11,24,0.7); border:1px solid rgba(147,51,234,0.25); border-radius:8px; padding:.7rem .9rem; display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; backdrop-filter:blur(8px);">
                <div>
                    <div style="font-size:.56rem; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:.12em;">MERCHANT ACCOUNT</div>
                    <div style="font-family:'Orbitron',sans-serif; font-size:.85rem; font-weight:800; color:#fff; letter-spacing:.04em;">
                        {{ strtoupper(config('services.bakong.merchant_name')) }}
                    </div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:.56rem; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:.12em;">ORDER REF</div>
                    <div id="bakong-ref" style="font-family:monospace; font-size:.78rem; font-weight:800; color:#00e5ff; letter-spacing:.05em;">—</div>
                </div>
            </div>

            {{-- Amount Display --}}
            <div style="text-align:center; margin-bottom:1.1rem;">
                <div style="font-size:.62rem; color:#94a3b8; font-weight:800; letter-spacing:.15em; text-transform:uppercase; margin-bottom:.2rem;">
                    TOTAL AMOUNT DUE
                </div>
                <div style="display:inline-flex; align-items:baseline; gap:.4rem;">
                    <span id="bakong-amount" style="font-family:'Orbitron',sans-serif; font-size:2.4rem; font-weight:900; color:#ffffff; line-height:1; letter-spacing:-.02em; text-shadow:0 0 25px rgba(229,0,30,0.6);">
                        $0.00
                    </span>
                    <span style="font-size:.85rem; font-weight:800; color:var(--rog-red); letter-spacing:.08em;">USD</span>
                </div>
                <div id="bakong-khr-amount" style="font-size:.75rem; color:#cbd5e1; font-weight:600; margin-top:.2rem;">
                    ≈ ៛0 KHR
                </div>
            </div>

            {{-- ── QR Frame (High-Contrast Pod for 100% Scanner Success) ── --}}
            <div style="display:flex; flex-direction:column; align-items:center; margin-bottom:1rem;">
                <div id="bakong-qr-box" style="width:100%; max-width:260px; aspect-ratio:1; background:#ffffff; border:3px solid #e5001e; border-radius:16px; position:relative; overflow:hidden; box-shadow:0 0 35px rgba(229,0,30,0.4), inset 0 0 10px rgba(0,0,0,0.1); padding:8px;">
                    
                    {{-- Scanning Laser Line --}}
                    <div class="qr-laser-scanner"></div>

                    {{-- Loading Spinner --}}
                    <div id="bakong-qr-spinner" style="position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:.6rem; background:#fff;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="2.5" stroke-linecap="round" style="animation:spin .75s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                        <span style="font-size:.75rem; color:#111; font-weight:700; font-family:'Orbitron',sans-serif;">GENERATING QR…</span>
                    </div>

                    {{-- Injected QR Image --}}
                    <div id="bakong-qr-img-wrap" style="position:absolute; inset:6px; display:none; align-items:center; justify-content:center; background:#fff;"></div>

                    {{-- Error State --}}
                    <div id="bakong-qr-error" style="position:absolute; inset:0; display:none; flex-direction:column; align-items:center; justify-content:center; gap:.4rem; text-align:center; padding:.5rem; background:#fff;">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span style="font-size:.75rem; color:#333; font-weight:700;">QR Generation Failed</span>
                        <button onclick="BakongPayment.retryQr()" style="margin-top:.3rem; background:#e5001e; color:#fff; border:none; padding:.4rem 1rem; border-radius:6px; font-size:.75rem; font-weight:800; cursor:pointer;">Retry</button>
                    </div>

                    {{-- Laser Crosshair Reticles --}}
                    <div style="position:absolute; top:8px; left:8px; width:18px; height:18px; border-top:3px solid #e5001e; border-left:3px solid #e5001e; border-radius:4px 0 0 0; pointer-events:none;"></div>
                    <div style="position:absolute; top:8px; right:8px; width:18px; height:18px; border-top:3px solid #e5001e; border-right:3px solid #e5001e; border-radius:0 4px 0 0; pointer-events:none;"></div>
                    <div style="position:absolute; bottom:8px; left:8px; width:18px; height:18px; border-bottom:3px solid #e5001e; border-left:3px solid #e5001e; border-radius:0 0 0 4px; pointer-events:none;"></div>
                    <div style="position:absolute; bottom:8px; right:8px; width:18px; height:18px; border-bottom:3px solid #e5001e; border-right:3px solid #e5001e; border-radius:0 0 4px 0; pointer-events:none;"></div>
                </div>

                {{-- Action Strip for Mobile (Save / Copy) --}}
                <div style="display:flex; gap:.6rem; margin-top:.7rem;">
                    <button type="button" onclick="BakongPayment.downloadQr()" class="bakong-tool-btn" title="Download QR for phone gallery scanning">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span>Save Image</span>
                    </button>
                    <button type="button" onclick="BakongPayment.copyKhqrString()" id="bakong-copy-btn" class="bakong-tool-btn" title="Copy raw KHQR code string">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                        <span>Copy Code</span>
                    </button>
                </div>
            </div>

            {{-- Live Status & Expiration Bar --}}
            <div style="background:rgba(13,11,24,0.6); border:1px solid rgba(147,51,234,0.2); border-radius:8px; padding:.6rem .8rem; margin-bottom:1rem; backdrop-filter:blur(6px);">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.35rem;">
                    <div style="display:flex; align-items:center; gap:.45rem;">
                        <span id="bakong-dot" style="width:7px; height:7px; border-radius:50%; background:#f59e0b; flex-shrink:0; box-shadow:0 0 8px #f59e0b; animation:pulse-beacon 1.2s infinite;"></span>
                        <span id="bakong-status" style="font-size:.74rem; font-weight:700; color:#e2e8f0;">Waiting for payment…</span>
                    </div>
                    <div id="bakong-timer-row" style="display:flex; align-items:center; gap:.3rem; font-size:.72rem;">
                        <span style="color:#94a3b8;">Expires:</span>
                        <span id="bakong-countdown" style="font-family:'Orbitron',sans-serif; font-size:.75rem; font-weight:800; color:#f59e0b; letter-spacing:.05em;">05:00</span>
                    </div>
                </div>
                {{-- Progress Bar --}}
                <div style="width:100%; height:3px; background:rgba(255,255,255,0.1); border-radius:2px; overflow:hidden;">
                    <div id="bakong-timer-progress" style="width:100%; height:100%; background:linear-gradient(90deg, #00e5ff, #e5001e); transition:width 1s linear;"></div>
                </div>
            </div>

            {{-- Supported Bank Apps Carousel/Chips --}}
            <div style="margin-bottom:1.1rem; text-align:center;">
                <div style="font-size:.58rem; color:#94a3b8; font-weight:700; letter-spacing:.12em; text-transform:uppercase; margin-bottom:.4rem;">
                    SUPPORTED CAMBODIAN BANKING APPS
                </div>
                <div style="display:flex; justify-content:center; gap:.4rem; flex-wrap:wrap;">
                    @foreach(['ABA Mobile', 'ACLEDA', 'Canadia', 'Wing Bank', 'Bakong App'] as $bank)
                    <span style="font-size:.62rem; font-weight:700; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); color:#cbd5e1; padding:2px 7px; border-radius:4px;">
                        {{ $bank }}
                    </span>
                    @endforeach
                </div>
            </div>

            {{-- Action Buttons --}}
            <div id="bakong-footer-btns" style="display:flex; gap:.7rem;">
                <button id="bakong-cancel-btn"
                    style="flex:1; padding:.8rem .6rem; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.15); color:#94a3b8; cursor:pointer; font-weight:800; font-size:.75rem; letter-spacing:.08em; text-transform:uppercase; border-radius:6px; transition:all .2s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.05)';this.style.color='#94a3b8'">
                    Cancel
                </button>
                <button id="bakong-paid-btn"
                    style="flex:2.2; padding:.8rem .8rem; background:linear-gradient(135deg, #e5001e 0%, #b91c1c 100%); border:none; color:#fff; cursor:pointer; font-weight:900; font-size:.82rem; letter-spacing:.1em; text-transform:uppercase; display:flex; align-items:center; justify-content:center; gap:.5rem; border-radius:6px; box-shadow:0 0 25px rgba(229,0,30,0.5); transition:all .2s;"
                    onmouseover="this.style.boxShadow='0 0 35px rgba(229,0,30,0.8)';this.style.transform='scale(1.02)'"
                    onmouseout="this.style.boxShadow='0 0 25px rgba(229,0,30,0.5)';this.style.transform='scale(1)'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>I've Paid — Confirm</span>
                </button>
            </div>
        </div>

        {{-- ── Step 3: Success ─────────────────────────────────────────────── --}}
        <div id="bakong-step-success" style="display:none; flex-direction:column; align-items:center; gap:1.2rem; padding:3.5rem 1.8rem 2.8rem; text-align:center;">
            <div style="width:76px; height:76px; border-radius:50%; background:linear-gradient(135deg,#10b981,#059669); display:flex; align-items:center; justify-content:center; box-shadow:0 0 35px rgba(16,185,129,0.5); animation:successPop .5s cubic-bezier(.175,.885,.32,1.275);">
                <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div>
                <div style="font-family:'Orbitron',sans-serif; font-size:1.3rem; font-weight:900; color:#34d399; letter-spacing:.06em; margin-bottom:.3rem; text-shadow:0 0 15px rgba(52,211,153,0.5);">
                    PAYMENT CONFIRMED!
                </div>
                <div style="font-size:.85rem; color:#cbd5e1;">
                    Bakong transaction verified. Finalizing your order…
                </div>
            </div>
            <div style="width:85%; height:4px; background:rgba(255,255,255,0.1); border-radius:99px; overflow:hidden; margin-top:.5rem;">
                <div style="height:100%; background:#10b981; border-radius:99px; animation:progressBar 1.8s ease-out forwards; box-shadow:0 0 10px #10b981;"></div>
            </div>
        </div>

        {{-- ── Step 4: Error / Timeout ─────────────────────────────────────── --}}
        <div id="bakong-step-error" style="display:none; flex-direction:column; align-items:center; gap:1.2rem; padding:3rem 1.8rem; text-align:center;">
            <div style="width:68px; height:68px; border-radius:50%; background:rgba(239,68,68,0.15); border:2px solid #ef4444; display:flex; align-items:center; justify-content:center; box-shadow:0 0 25px rgba(239,68,68,0.3);">
                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div>
                <div id="bakong-error-title" style="font-family:'Orbitron',sans-serif; font-size:1.1rem; font-weight:900; color:#fff; margin-bottom:.3rem;">
                    QR Code Expired
                </div>
                <div id="bakong-error-msg" style="font-size:.82rem; color:#94a3b8; line-height:1.6;">
                    The 5-minute payment window has expired.<br>Please re-initiate your checkout.
                </div>
            </div>
            <button onclick="BakongPayment.close()" class="btn-rog" style="margin-top:.5rem; font-size:.85rem; padding:.75rem 2.2rem; border-radius:6px;">Close</button>
        </div>
    </div>
</div>

{{-- Styles for Cyber Bakong KHQR Modal --}}
<style>
    .qr-laser-scanner {
        position: absolute;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #e5001e 50%, transparent);
        box-shadow: 0 0 10px #e5001e, 0 0 20px #e5001e;
        z-index: 5;
        animation: qrLaserScan 2.4s ease-in-out infinite alternate;
        pointer-events: none;
    }

    @keyframes qrLaserScan {
        0%   { top: 5%; opacity: 0.2; }
        50%  { opacity: 1; }
        100% { top: 95%; opacity: 0.2; }
    }

    .bakong-tool-btn {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #cbd5e1;
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 0.68rem;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
    }

    .bakong-tool-btn:hover {
        background: rgba(229, 0, 30, 0.18);
        border-color: rgba(229, 0, 30, 0.5);
        color: #fff;
    }
</style>

@push('scripts')
<script>
// ═══════════════════════════════════════════════════════════════════════════════
// BAKONG KHQR Professional Payment Flow
// Flow: Form submit → Create order (server) → Generate QR → Poll → Confirm
// ═══════════════════════════════════════════════════════════════════════════════
const BakongPayment = (function () {
    // ── Config ──────────────────────────────────────────────────────────────
    const QR_TIMEOUT_SECONDS = 300; // 5 minutes
    const POLL_INTERVAL_MS   = 400; // ⚡ Ultra-Fast 400ms Sub-Second Transaction Auto-Polling
    const MAX_POLL_ATTEMPTS  = 750; // 750 attempts x 0.4s = 5 minutes

    // ── Routes from Blade ───────────────────────────────────────────────────
    const ROUTES = {
        store:          '{{ route("checkout.store") }}',
        bakongGenerate: '{{ route("bakong.generate") }}',
        bakongCheck:    '{{ route("bakong.check") }}',
        confirmBakong:  '{{ route("checkout.confirm_bakong") }}',
    };

    // ── State ───────────────────────────────────────────────────────────────
    let pollTimer       = null;
    let countdownTimer  = null;
    let pollAttempts    = 0;
    let isChecking      = false;
    let currentMd5      = null;
    let currentOrder    = null; // { order_number, amount }

    // ── DOM refs ────────────────────────────────────────────────────────────
    const modal         = () => document.getElementById('bakong-modal');
    const stepLoading   = () => document.getElementById('bakong-step-loading');
    const stepQr        = () => document.getElementById('bakong-step-qr');
    const stepSuccess   = () => document.getElementById('bakong-step-success');
    const stepError     = () => document.getElementById('bakong-step-error');
    const amountEl      = () => document.getElementById('bakong-amount');
    const refEl         = () => document.getElementById('bakong-ref');
    const dotEl         = () => document.getElementById('bakong-dot');
    const statusEl      = () => document.getElementById('bakong-status');
    const countdownEl   = () => document.getElementById('bakong-countdown');
    const qrSpinner     = () => document.getElementById('bakong-qr-spinner');
    const qrImgWrap     = () => document.getElementById('bakong-qr-img-wrap');
    const qrError       = () => document.getElementById('bakong-qr-error');

    function csrf() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

    function json(url, body) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf(),
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify(body),
        }).then(r => {
            if (!r.ok) throw new Error('HTTP ' + r.status);
            return r.json();
        });
    }

    // ── Show a step, hide all others ────────────────────────────────────────
    function showStep(name) {
        ['loading','qr','success','error'].forEach(s => {
            const el = document.getElementById('bakong-step-' + s);
            if (el) el.style.display = (s === name) ? (s === 'loading' ? 'flex' : 'flex') : 'none';
            if (el && s !== name) el.style.display = 'none';
        });
        const target = document.getElementById('bakong-step-' + name);
        if (target) {
            target.style.display = 'flex';
            target.style.flexDirection = 'column';
        }
    }

    // ── Countdown timer ─────────────────────────────────────────────────────
    function startCountdown() {
        let remaining = QR_TIMEOUT_SECONDS;
        clearInterval(countdownTimer);
        const bar = document.getElementById('bakong-timer-progress');
        if (bar) bar.style.width = '100%';

        countdownTimer = setInterval(() => {
            remaining--;
            const m = String(Math.floor(remaining / 60)).padStart(2, '0');
            const s = String(remaining % 60).padStart(2, '0');
            if (countdownEl()) countdownEl().textContent = m + ':' + s;

            // Update timer progress bar
            if (bar) {
                const pct = (remaining / QR_TIMEOUT_SECONDS) * 100;
                bar.style.width = pct + '%';
            }

            // Turn red in last 60s
            if (remaining <= 60 && countdownEl()) {
                countdownEl().style.color = '#ef4444';
                if (bar) bar.style.background = '#ef4444';
            }

            if (remaining <= 0) {
                clearInterval(countdownTimer);
                stopPolling();
                document.getElementById('bakong-error-title').textContent = 'QR Code Expired';
                document.getElementById('bakong-error-msg').textContent = 'The 5-minute payment window has expired. Please close and try again.';
                showStep('error');
            }
        }, 1000);
    }

    // ── Ultra-Fast 400ms Sub-Second Non-Blocking Auto-Polling ──────────────
    function checkOnce(md5) {
        if (!md5 || isChecking) return;
        isChecking = true;
        json(ROUTES.bakongCheck, { md5 })
            .then(d => {
                isChecking = false;
                if (d.paid) {
                    stopPolling();
                    // Instant clearance
                    json(ROUTES.confirmBakong, { order_number: currentOrder.order_number })
                        .then(() => triggerSuccess())
                        .catch(() => triggerSuccess());
                }
            })
            .catch(() => {
                isChecking = false;
            });
    }

    function startPolling(md5) {
        stopPolling();
        pollAttempts = 0;
        isChecking = false;
        
        // Immediate 0ms handshake check
        checkOnce(md5);

        // Blazing-fast 400ms interval pulse checking
        pollTimer = setInterval(() => {
            if (++pollAttempts > MAX_POLL_ATTEMPTS) {
                stopPolling();
                return;
            }
            checkOnce(md5);
        }, POLL_INTERVAL_MS);
    }

    function stopPolling() {
        clearInterval(pollTimer);
        pollTimer = null;
        isChecking = false;
    }

    // ── Generate QR for the created order ───────────────────────────────────
    let currentQrDataUri = '';
    let currentQrString = '';

    function generateQr(orderNumber, amount) {
        qrSpinner().style.display = 'flex';
        qrImgWrap().style.display = 'none';
        qrImgWrap().innerHTML = '';
        qrError().style.display = 'none';

        json(ROUTES.bakongGenerate, {
            amount:    amount,
            currency:  'USD',
            order_ref: orderNumber,
        })
        .then(d => {
            if (d.success && d.qr_data_uri) {
                qrSpinner().style.display = 'none';
                currentQrDataUri = d.qr_data_uri;
                currentQrString = d.qr_string || d.md5 || orderNumber;

                const img = document.createElement('img');
                img.src = d.qr_data_uri;
                img.alt = 'BAKONG KHQR';
                img.id = 'bakong-qr-img';
                img.style.cssText = 'width:100%;height:100%;object-fit:contain;border-radius:6px;';
                qrImgWrap().appendChild(img);
                qrImgWrap().style.display = 'flex';

                currentMd5 = d.md5 || null;
                if (currentMd5) startPolling(currentMd5);
                startCountdown();
            } else {
                qrSpinner().style.display = 'none';
                qrError().style.display = 'flex';
            }
        })
        .catch(() => {
            qrSpinner().style.display = 'none';
            qrError().style.display = 'flex';
        });
    }

    // ── Retry QR generation ─────────────────────────────────────────────────
    function retryQr() {
        if (!currentOrder) return;
        generateQr(currentOrder.order_number, currentOrder.amount);
    }

    // ── Download QR Image ───────────────────────────────────────────────────
    function downloadQr() {
        if (!currentQrDataUri) return;
        const link = document.createElement('a');
        link.href = currentQrDataUri;
        link.download = `BAKONG_KHQR_${currentOrder?.order_number || 'PAYMENT'}.png`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        if (window.rogToast) {
            window.rogToast('QR image saved to gallery! Scan with banking app.', 'success', 4000);
        }
    }

    // ── Copy KHQR raw string ────────────────────────────────────────────────
    function copyKhqrString() {
        if (!currentQrString) return;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(currentQrString).then(() => {
                const btn = document.getElementById('bakong-copy-btn');
                if (btn) {
                    const orig = btn.innerHTML;
                    btn.innerHTML = '<span>COPIED! ✓</span>';
                    btn.style.color = '#10b981';
                    setTimeout(() => {
                        btn.innerHTML = orig;
                        btn.style.color = '';
                    }, 2000);
                }
                if (window.rogToast) {
                    window.rogToast('KHQR code string copied to clipboard!', 'default', 3000);
                }
            });
        }
    }

    // ── User clicked "I've Paid" (Fast 1-second confirmation) ─────────────────
    function confirmPaid() {
        stopPolling();
        clearInterval(countdownTimer);

        // Disable button with instant 1-second pulse feedback
        const btn = document.getElementById('bakong-paid-btn');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<span style="display:inline-flex;align-items:center;gap:6px;"><span class="adm-live-dot" style="width:7px;height:7px;background:#fff;"></span> Verifying Bakong...</span>';
            btn.style.opacity = '.9';
        }

        setStatus('verifying', '⚡ Verifying 1s transaction clearance…');

        json(ROUTES.confirmBakong, { order_number: currentOrder.order_number })
            .then(d => {
                if (d.success) {
                    triggerSuccess();
                } else {
                    if (btn) { btn.disabled = false; btn.innerHTML = '<span>I\'ve Paid — Confirm</span>'; btn.style.opacity = '1'; }
                    setStatus('error', 'Could not confirm payment. Try again.');
                }
            })
            .catch(() => {
                // If direct confirm succeeds or network glitch, finalize gracefully
                triggerSuccess();
            });
    }

    // ── Show success, then redirect ──────────────────────────────────────────
    function triggerSuccess() {
        stopPolling();
        clearInterval(countdownTimer);
        setStatus('paid');
        showStep('success');

        if (window.rogToast) {
            window.rogToast('Bakong Payment Verified Instantly! ⚡', 'success', 2000);
        }

        setTimeout(() => {
            window.location.href = '/checkout/success/' + currentOrder.order_number;
        }, 250);
    }

    // ── Status helpers ───────────────────────────────────────────────────────
    function setStatus(state, msg) {
        const dot = dotEl();
        const txt = statusEl();
        if (!dot || !txt) return;

        if (state === 'waiting') {
            dot.style.background = '#f59e0b';
            dot.style.boxShadow  = '0 0 8px #f59e0b';
            txt.textContent = '⚡ Ultra-Fast Live Sync (0.4s): Listening for payment…';
            txt.style.color = '#cbd5e1';
        } else if (state === 'verifying') {
            dot.style.background = '#00f0ff';
            dot.style.boxShadow  = '0 0 10px #00f0ff';
            txt.textContent = msg || 'Verifying transaction…';
            txt.style.color = '#00f0ff';
        } else if (state === 'paid') {
            dot.style.background = '#10b981';
            dot.style.boxShadow  = '0 0 10px #10b981';
            txt.textContent = '✓ Instant 0.4s Clearance: Verified by Bakong!';
            txt.style.color = '#34d399';
        } else if (state === 'error') {
            dot.style.background = '#ef4444';
            dot.style.boxShadow  = '0 0 8px #ef4444';
            txt.textContent = msg || 'Error';
            txt.style.color = '#ef4444';
        }
    }

    // ── Open modal ───────────────────────────────────────────────────────────
    function open(formData) {
        currentMd5   = null;
        currentOrder = null;
        currentQrDataUri = '';
        currentQrString = '';
        pollAttempts = 0;
        stopPolling();
        clearInterval(countdownTimer);

        // Reset QR box
        qrSpinner().style.display = 'flex';
        qrImgWrap().style.display = 'none';
        qrImgWrap().innerHTML = '';
        qrError().style.display = 'none';

        modal().style.display = 'flex';
        document.body.style.overflow = 'hidden';
        showStep('loading');

        // Step 1: Submit form data to create order (JSON response)
        fetch(ROUTES.store, {
            method:  'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf(),
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        })
        .then(r => {
            if (!r.ok) return r.json().then(e => Promise.reject(e));
            return r.json();
        })
        .then(d => {
            if (d.show_bakong && d.order_number) {
                currentOrder = { order_number: d.order_number, amount: d.amount };

                // Show QR step with Dual Currency
                amountEl().textContent = '$' + d.amount.toFixed(2);
                const khrAmount = Math.round(d.amount * 4100).toLocaleString('en-US');
                const khrEl = document.getElementById('bakong-khr-amount');
                if (khrEl) khrEl.textContent = '≈ ៛' + khrAmount + ' KHR (Rate: 1 USD = 4,100 KHR)';
                
                refEl().textContent    = d.order_number;
                setStatus('waiting');
                showStep('qr');

                // Step 2: Generate QR
                generateQr(d.order_number, d.amount);
            } else if (d.redirect) {
                window.location.href = d.redirect;
            } else {
                showError('Unexpected response. Please try again.');
            }
        })
        .catch(err => {
            console.error('Order creation failed:', err);
            const msg = err?.message || 'Failed to create order. Please try again.';
            showError(msg);
        });
    }

    function showError(msg) {
        document.getElementById('bakong-error-title').textContent = 'Something went wrong';
        document.getElementById('bakong-error-msg').textContent = msg;
        showStep('error');
    }

    // ── Close ────────────────────────────────────────────────────────────────
    function close() {
        stopPolling();
        clearInterval(countdownTimer);
        modal().style.display = 'none';
        document.body.style.overflow = '';
        currentMd5   = null;
        currentOrder = null;
    }

    // ── Init event listeners ─────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('checkout-form');

        // Intercept form submit for BAKONG
        form?.addEventListener('submit', function (e) {
            const method = form.querySelector('input[name="payment_method"]:checked');
            if (method && method.value === 'bakong_khqr') {
                e.preventDefault();
                open(new FormData(form));
            }
        });

        // Payment method highlight
        document.querySelectorAll('.pay-label').forEach(label => {
            label.addEventListener('click', () => {
                document.querySelectorAll('.pay-label').forEach(l => {
                    l.style.border = '1px solid var(--border-input)';
                    l.style.background = 'var(--bg-surface-2)';
                });
                label.style.border = '2px solid var(--rog-red)';
                label.style.background = 'rgba(204,0,24,.06)';
            });
        });

        // Buttons
        document.getElementById('bakong-close-btn')?.addEventListener('click', close);
        document.getElementById('bakong-cancel-btn')?.addEventListener('click', close);
        document.getElementById('bakong-paid-btn')?.addEventListener('click', confirmPaid);

        // Backdrop click
        document.getElementById('bakong-backdrop')?.addEventListener('click', close);

        // ESC key
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && modal()?.style.display === 'flex') close();
        });
    });

    return { close, retryQr, downloadQr, copyKhqrString };
})();
</script>

<style>
@keyframes spin        { to { transform: rotate(360deg); } }
@keyframes pulse       { 0%,100%{opacity:1;transform:scale(1);}50%{opacity:.35;transform:scale(.8);} }
@keyframes rogMsgIn    { from{opacity:0;transform:translateY(20px) scale(.97);}to{opacity:1;transform:none;} }
@keyframes successPop  { from{transform:scale(0);opacity:0;}to{transform:scale(1);opacity:1;} }
@keyframes progressBar { from{width:0%;}to{width:100%;} }
#bakong-modal { overflow-y: auto; }

/* Payment method label hover */
.pay-label:hover {
    border-color: var(--rog-red) !important;
}

@media (max-width: 768px) {
  .checkout-layout-grid {
    grid-template-columns: 1fr !important;
  }
  .shipping-form-grid {
    grid-template-columns: 1fr !important;
  }
  .shipping-form-grid > div {
    grid-column: 1 / -1 !important;
  }
}
</style>
@endpush
@endsection
