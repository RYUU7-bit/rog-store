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
     BAKONG KHQR PAYMENT MODAL
════════════════════════════════════════════════════════════════════════ --}}
<div id="bakong-modal" style="display:none; position:fixed; inset:0; z-index:9500; align-items:center; justify-content:center; padding:16px; box-sizing:border-box; overflow-y:auto;">
    {{-- Backdrop --}}
    <div id="bakong-backdrop" style="position:fixed; inset:0; background:rgba(0,0,0,.82); backdrop-filter:blur(6px);"></div>

    {{-- Card --}}
    <div id="bakong-card" style="position:relative; z-index:1; background:#fff; border-radius:20px; width:100%; max-width:360px; box-shadow:0 40px 100px rgba(0,0,0,.7); overflow:hidden; animation:rogMsgIn .3s cubic-bezier(.175,.885,.32,1.1) both; margin:auto;">

        {{-- ── Header ────────────────────────────────────────────────────── --}}
        <div style="background:#cc0018; padding:.9rem 1.1rem; display:flex; align-items:center; justify-content:space-between;">
            <div style="display:flex; align-items:center; gap:8px;">
                <span style="color:#fff; font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.05rem; letter-spacing:.1em;">KH</span>
                <div style="width:1.5px; height:18px; background:rgba(255,255,255,.35);"></div>
                <span style="color:#fff; font-weight:900; font-size:.95rem; letter-spacing:.1em;">QR</span>
                <span style="color:rgba(255,255,255,.65); font-size:.65rem; font-weight:700; letter-spacing:.15em; text-transform:uppercase; margin-left:2px;">BAKONG</span>
            </div>
            <button id="bakong-close-btn" title="Cancel payment"
                style="width:30px; height:30px; border-radius:50%; background:rgba(255,255,255,.15); border:none; color:#fff; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:1rem; transition:background .15s;"
                onmouseover="this.style.background='rgba(255,255,255,.28)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">✕</button>
        </div>

        {{-- ── Step 1: Loading ─────────────────────────────────────────────── --}}
        <div id="bakong-step-loading" style="padding:2.5rem 1.2rem; display:flex; flex-direction:column; align-items:center; gap:1rem; text-align:center;">
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#cc0018" stroke-width="2.5" stroke-linecap="round" style="animation:spin .75s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
            <div style="font-size:.9rem; font-weight:700; color:#333;">Creating your order…</div>
            <div style="font-size:.78rem; color:#aaa;">Please wait a moment</div>
        </div>

        {{-- ── Step 2: QR Code ─────────────────────────────────────────────── --}}
        <div id="bakong-step-qr" style="display:none;">
            {{-- Merchant / Ref --}}
            <div style="padding:.85rem 1.1rem .7rem; display:flex; justify-content:space-between; align-items:flex-start; border-bottom:1.5px dashed #eee;">
                <div>
                    <div style="font-size:.58rem; color:#bbb; font-weight:700; text-transform:uppercase; letter-spacing:.12em; margin-bottom:.2rem;">Merchant</div>
                    <div style="font-size:.9rem; font-weight:800; color:#111; letter-spacing:.02em;">{{ strtoupper(config('services.bakong.merchant_name')) }}</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:.58rem; color:#bbb; font-weight:700; text-transform:uppercase; letter-spacing:.12em; margin-bottom:.2rem;">Order Ref</div>
                    <div id="bakong-ref" style="font-size:.7rem; font-weight:700; color:#555; font-family:'Courier New',monospace; letter-spacing:.04em;">—</div>
                </div>
            </div>

            {{-- Amount --}}
            <div style="padding:.75rem 1.1rem .3rem; display:flex; align-items:baseline; gap:.5rem;">
                <span style="font-size:.58rem; color:#bbb; font-weight:700; text-transform:uppercase; letter-spacing:.12em;">Amount</span>
                <span id="bakong-amount" style="font-size:2.3rem; font-weight:900; color:#cc0018; line-height:1; letter-spacing:-.02em;">$0.00</span>
                <span style="font-size:.72rem; font-weight:700; color:#ccc; letter-spacing:.08em;">USD</span>
            </div>

            {{-- QR Frame --}}
            <div style="padding:.4rem 1.1rem .8rem; display:flex; flex-direction:column; align-items:center; gap:.7rem;">
                <div id="bakong-qr-box" style="width:100%; max-width:260px; aspect-ratio:1; background:#fff; border:2.5px solid #f0f0f0; border-radius:14px; position:relative; overflow:hidden; box-shadow:0 4px 18px rgba(0,0,0,.07);">
                    {{-- Loading spinner --}}
                    <div id="bakong-qr-spinner" style="position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:.6rem;">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#cc0018" stroke-width="2.5" stroke-linecap="round" style="animation:spin .75s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                        <span style="font-size:.72rem; color:#bbb; font-weight:600;">Generating QR…</span>
                    </div>
                    {{-- QR image (injected by JS) --}}
                    <div id="bakong-qr-img-wrap" style="position:absolute; inset:5px; display:none; align-items:center; justify-content:center;"></div>
                    {{-- Error --}}
                    <div id="bakong-qr-error" style="position:absolute; inset:0; display:none; flex-direction:column; align-items:center; justify-content:center; gap:.4rem; text-align:center; padding:.5rem;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#cc0018" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span style="font-size:.72rem; color:#999;">QR generation failed.<br>Please try again.</span>
                        <button onclick="BakongPayment.retryQr()" style="margin-top:.3rem; background:#cc0018; color:#fff; border:none; padding:.3rem .8rem; border-radius:6px; font-size:.72rem; font-weight:700; cursor:pointer;">Retry</button>
                    </div>
                    {{-- Corner accents --}}
                    <div style="position:absolute; top:7px; left:7px; width:16px; height:16px; border-top:2.5px solid #cc0018; border-left:2.5px solid #cc0018; border-radius:3px 0 0 0; pointer-events:none;"></div>
                    <div style="position:absolute; top:7px; right:7px; width:16px; height:16px; border-top:2.5px solid #cc0018; border-right:2.5px solid #cc0018; border-radius:0 3px 0 0; pointer-events:none;"></div>
                    <div style="position:absolute; bottom:7px; left:7px; width:16px; height:16px; border-bottom:2.5px solid #cc0018; border-left:2.5px solid #cc0018; border-radius:0 0 0 3px; pointer-events:none;"></div>
                    <div style="position:absolute; bottom:7px; right:7px; width:16px; height:16px; border-bottom:2.5px solid #cc0018; border-right:2.5px solid #cc0018; border-radius:0 0 3px 0; pointer-events:none;"></div>
                </div>

                {{-- Status row --}}
                <div style="display:flex; align-items:center; gap:.45rem;">
                    <span id="bakong-dot" style="width:8px; height:8px; border-radius:50%; background:#f59e0b; flex-shrink:0; animation:pulse 1.4s ease-in-out infinite;"></span>
                    <span id="bakong-status" style="font-size:.78rem; font-weight:700; color:#666;">Waiting for payment…</span>
                </div>

                {{-- Countdown --}}
                <div id="bakong-timer-row" style="display:flex; align-items:center; gap:.3rem;">
                    <span style="font-size:.68rem; color:#ccc;">QR expires in</span>
                    <span id="bakong-countdown" style="font-size:.72rem; font-weight:700; color:#f59e0b; font-family:monospace;">05:00</span>
                </div>

                <p style="font-size:.68rem; color:#ccc; text-align:center; margin:0; line-height:1.7; padding:0 .3rem;">
                    Open your Cambodian banking app · Scan · Pay<br>Then tap <strong style="color:#aaa;">"I've Paid"</strong>
                </p>
            </div>

            {{-- Footer buttons --}}
            <div id="bakong-footer-btns" style="padding:.8rem 1.1rem 1rem; border-top:1px solid #f5f5f5; display:flex; gap:.6rem;">
                <button id="bakong-cancel-btn"
                    style="flex:1; padding:.78rem .5rem; background:transparent; border:1.5px solid #ddd; color:#888; cursor:pointer; font-weight:700; font-size:.8rem; letter-spacing:.06em; text-transform:uppercase; transition:all .15s;"
                    onmouseover="this.style.borderColor='#bbb';this.style.color='#555'" onmouseout="this.style.borderColor='#ddd';this.style.color='#888'">
                    Cancel
                </button>
                <button id="bakong-paid-btn"
                    style="flex:2.5; padding:.78rem .5rem; background:#cc0018; border:none; color:#fff; cursor:pointer; font-weight:900; font-size:.85rem; letter-spacing:.1em; text-transform:uppercase; display:flex; align-items:center; justify-content:center; gap:.45rem; clip-path:polygon(0 0,calc(100% - 10px) 0,100% 10px,100% 100%,10px 100%,0 calc(100% - 10px)); box-shadow:0 4px 18px rgba(204,0,24,.35); transition:background .2s, box-shadow .2s;"
                    onmouseover="this.style.background='#a8001a';this.style.boxShadow='0 6px 24px rgba(204,0,24,.55)'"
                    onmouseout="this.style.background='#cc0018';this.style.boxShadow='0 4px 18px rgba(204,0,24,.35)'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    I've Paid
                </button>
            </div>
        </div>

        {{-- ── Step 3: Success ─────────────────────────────────────────────── --}}
        <div id="bakong-step-success" style="display:none; flex-direction:column; align-items:center; gap:1rem; padding:2.2rem 1.2rem 1.8rem; text-align:center;">
            <div style="width:68px; height:68px; border-radius:50%; background:linear-gradient(135deg,#22c55e,#16a34a); display:flex; align-items:center; justify-content:center; box-shadow:0 8px 24px rgba(34,197,94,.35); animation:successPop .5s cubic-bezier(.175,.885,.32,1.275);">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div style="font-size:1.15rem; font-weight:900; color:#111;">Payment Confirmed!</div>
            <div style="font-size:.8rem; color:#aaa;">Finalising your order…</div>
            <div style="width:80%; height:3px; background:#f0f0f0; border-radius:99px; overflow:hidden;">
                <div style="height:100%; background:#22c55e; border-radius:99px; animation:progressBar 1.8s ease-out forwards;"></div>
            </div>
        </div>

        {{-- ── Step 4: Error / Timeout ─────────────────────────────────────── --}}
        <div id="bakong-step-error" style="display:none; flex-direction:column; align-items:center; gap:1rem; padding:2rem 1.5rem; text-align:center;">
            <div style="width:62px; height:62px; border-radius:50%; background:#fff0f0; border:2px solid #ffcdd2; display:flex; align-items:center; justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#cc0018" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div id="bakong-error-title" style="font-size:1rem; font-weight:800; color:#111;">QR Code Expired</div>
            <div id="bakong-error-msg" style="font-size:.8rem; color:#aaa; line-height:1.6;">The payment window has expired.<br>Please place your order again.</div>
            <button onclick="BakongPayment.close()" style="margin-top:.5rem; background:#cc0018; color:#fff; border:none; padding:.7rem 2rem; border-radius:10px; font-weight:800; font-size:.85rem; cursor:pointer;">Close</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
// ═══════════════════════════════════════════════════════════════════════════════
// BAKONG KHQR Professional Payment Flow
// Flow: Form submit → Create order (server) → Generate QR → Poll → Confirm
// ═══════════════════════════════════════════════════════════════════════════════
const BakongPayment = (function () {
    // ── Config ──────────────────────────────────────────────────────────────
    const QR_TIMEOUT_SECONDS = 300; // 5 minutes
    const POLL_INTERVAL_MS   = 3000;
    const MAX_POLL_ATTEMPTS  = 100;

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
        countdownTimer = setInterval(() => {
            remaining--;
            const m = String(Math.floor(remaining / 60)).padStart(2, '0');
            const s = String(remaining % 60).padStart(2, '0');
            if (countdownEl()) countdownEl().textContent = m + ':' + s;

            // Turn red in last 60s
            if (remaining <= 60 && countdownEl()) {
                countdownEl().style.color = '#ef4444';
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

    // ── Polling ─────────────────────────────────────────────────────────────
    function startPolling(md5) {
        stopPolling();
        pollAttempts = 0;
        pollTimer = setInterval(() => {
            if (++pollAttempts > MAX_POLL_ATTEMPTS) {
                stopPolling();
                return;
            }
            json(ROUTES.bakongCheck, { md5 })
                .then(d => {
                    if (d.paid) {
                        stopPolling();
                        // ── Auto-detected payment: confirm on server first ──
                        // This marks order paid, clears cart, fires Telegram
                        json(ROUTES.confirmBakong, { order_number: currentOrder.order_number })
                            .then(() => triggerSuccess())
                            .catch(() => triggerSuccess()); // redirect even on network error
                    }
                })
                .catch(() => {});
        }, POLL_INTERVAL_MS);
    }

    function stopPolling() {
        clearInterval(pollTimer);
        pollTimer = null;
    }

    // ── Generate QR for the created order ───────────────────────────────────
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
                const img = document.createElement('img');
                img.src = d.qr_data_uri;
                img.alt = 'BAKONG KHQR';
                img.style.cssText = 'width:100%;height:100%;object-fit:contain;';
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

    // ── User clicked "I've Paid" ─────────────────────────────────────────────
    function confirmPaid() {
        stopPolling();
        clearInterval(countdownTimer);

        // Disable button to prevent double-click
        const btn = document.getElementById('bakong-paid-btn');
        if (btn) { btn.disabled = true; btn.style.opacity = '.6'; }

        json(ROUTES.confirmBakong, { order_number: currentOrder.order_number })
            .then(d => {
                if (d.success) {
                    triggerSuccess();
                } else {
                    if (btn) { btn.disabled = false; btn.style.opacity = '1'; }
                    setStatus('error', 'Could not confirm payment. Try again.');
                }
            })
            .catch(() => {
                if (btn) { btn.disabled = false; btn.style.opacity = '1'; }
                setStatus('error', 'Network error. Please try again.');
            });
    }

    // ── Show success, then redirect ──────────────────────────────────────────
    function triggerSuccess() {
        stopPolling();
        clearInterval(countdownTimer);
        setStatus('paid');
        showStep('success');

        setTimeout(() => {
            window.location.href = '/checkout/success/' + currentOrder.order_number;
        }, 2000);
    }

    // ── Status helpers ───────────────────────────────────────────────────────
    function setStatus(state, msg) {
        const dot = dotEl();
        const txt = statusEl();
        if (!dot || !txt) return;

        if (state === 'waiting') {
            dot.style.background = '#f59e0b';
            dot.style.animation  = 'pulse 1.4s ease-in-out infinite';
            txt.textContent = 'Waiting for payment…';
            txt.style.color = '#777';
        } else if (state === 'paid') {
            dot.style.background = '#22c55e';
            dot.style.animation  = 'none';
            txt.textContent = '✓ Payment received!';
            txt.style.color = '#16a34a';
        } else if (state === 'error') {
            dot.style.background = '#ef4444';
            dot.style.animation  = 'none';
            txt.textContent = msg || 'Error';
            txt.style.color = '#ef4444';
        }
    }

    // ── Open modal ───────────────────────────────────────────────────────────
    function open(formData) {
        currentMd5   = null;
        currentOrder = null;
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

                // Show QR step
                amountEl().textContent = '$' + d.amount.toFixed(2);
                refEl().textContent    = d.order_number;
                setStatus('waiting');
                showStep('qr');

                // Step 2: Generate QR
                generateQr(d.order_number, d.amount);
            } else if (d.redirect) {
                // Non-bakong method redirected to success
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
        form.addEventListener('submit', function (e) {
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
                label.style.background = 'rgba(204,0,24,.04)';
            });
        });

        // Buttons
        document.getElementById('bakong-close-btn').addEventListener('click', close);
        document.getElementById('bakong-cancel-btn').addEventListener('click', close);
        document.getElementById('bakong-paid-btn').addEventListener('click', confirmPaid);

        // Backdrop click
        document.getElementById('bakong-backdrop').addEventListener('click', close);

        // ESC key
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && modal().style.display === 'flex') close();
        });
    });

    return { close, retryQr };
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
