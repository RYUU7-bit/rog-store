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

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div style="display:grid; grid-template-columns:1fr 380px; gap:2rem; align-items:start;">

            {{-- Left: Forms --}}
            <div>
                {{-- Shipping Info --}}
                <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:1.8rem; margin-bottom:1.5rem;">
                    <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.5rem; padding-bottom:.8rem; border-bottom:1px solid var(--border-divider);">📦 Shipping Information</h2>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem;">
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
                                <option value="US" selected>United States</option>
                                <option value="CA">Canada</option>
                                <option value="GB">United Kingdom</option>
                                <option value="AU">Australia</option>
                                <option value="DE">Germany</option>
                                <option value="FR">France</option>
                                <option value="MY">Malaysia</option>
                                <option value="SG">Singapore</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Payment --}}
                <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:1.8rem; margin-bottom:1.5rem;">
                    <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.5rem; padding-bottom:.8rem; border-bottom:1px solid var(--border-divider);">💳 Payment Method</h2>
                    <div style="display:flex; flex-direction:column; gap:.8rem;">
                        @foreach([
                            ['credit_card', '💳 Credit / Debit Card', ''],
                            ['paypal',      '🔵 PayPal',              ''],
                            ['bank_transfer','🏦 Bank Transfer',      ''],
                            ['bakong_khqr', '', 'bakong'],
                        ] as [$val, $label, $special])
                        <label class="pay-label" style="display:flex; align-items:center; gap:1rem; padding:1rem 1.2rem; border:1px solid var(--border-input); cursor:pointer; transition:border-color .2s; background:var(--bg-surface-2);"
                               onmouseover="this.style.borderColor='var(--rog-red)'"
                               onmouseout="if(!this.querySelector('input').checked)this.style.borderColor='var(--border-input)'">
                            <input type="radio" name="payment_method" value="{{ $val }}" {{ $val==='credit_card' ? 'checked' : '' }}
                                   style="accent-color:var(--rog-red);"
                                   onchange="document.querySelectorAll('.pay-label').forEach(l=>l.style.borderColor='var(--border-input)');this.closest('label').style.borderColor='var(--rog-red)'">
                            @if($special === 'bakong')
                                {{-- BAKONG KHQR option --}}
                                <div style="display:flex; align-items:center; gap:.7rem;">
                                    <div style="background:#e5001e; border-radius:4px; padding:3px 7px; display:flex; align-items:center; gap:4px;">
                                        <span style="color:#fff; font-weight:900; font-size:.75rem; letter-spacing:.08em; font-family:'Orbitron',sans-serif;">KH</span>
                                        <span style="color:#fff; font-size:.75rem; font-weight:900;">QR</span>
                                    </div>
                                    <div>
                                        <div style="color:var(--text-primary); font-weight:700; font-size:.9rem;">BAKONG KHQR</div>
                                        <div style="color:var(--text-muted); font-size:.72rem;">Scan with any Cambodian banking app</div>
                                    </div>
                                </div>
                            @else
                                <span style="color:var(--text-primary); font-weight:600; font-size:.9rem;">{{ $label }}</span>
                            @endif
                        </label>
                        @endforeach
                    </div>
                    @error('payment_method')<span style="color:#ef4444;font-size:.75rem;margin-top:.5rem;display:block;">{{ $message }}</span>@enderror
                </div>

                {{-- Notes --}}
                <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:1.8rem;">
                    <h2 style="font-weight:800; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem;">📝 Order Notes (Optional)</h2>
                    <textarea name="notes" class="rog-input" rows="3" placeholder="Special instructions or delivery notes…" style="resize:vertical;">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Right: Order Summary --}}
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
                        <div style="border-top:1px solid var(--border-input); padding-top:.7rem; display:flex; justify-content:space-between;">
                            <span style="font-weight:800; color:var(--text-primary); text-transform:uppercase; letter-spacing:.06em;">Total</span>
                            <span style="font-weight:900; font-size:1.3rem; color:var(--rog-red);">${{ number_format($total,2) }}</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-rog" id="checkout-submit-btn" style="width:100%; justify-content:center; font-size:.95rem; padding:.9rem;">
                    🔒 Place Order — ${{ number_format($total,2) }}
                </button>
                <div style="text-align:center; margin-top:.8rem; color:var(--text-muted); font-size:.73rem;">By placing your order you agree to our Terms of Service</div>
            </div>
        </div>
    </form>
</div>

{{-- ═══ BAKONG KHQR PAYMENT MODAL ══════════════════════════════════════════ --}}
<div id="bakong-modal" style="display:none; position:fixed; inset:0; z-index:9500; align-items:center; justify-content:center; padding:16px; box-sizing:border-box;">
    {{-- Backdrop --}}
    <div style="position:absolute; inset:0; background:rgba(0,0,0,.85); backdrop-filter:blur(8px);"></div>

    {{-- Modal Card --}}
    <div style="position:relative; z-index:1; background:#fff; border-radius:24px; width:100%; max-width:380px; box-shadow:0 40px 100px rgba(0,0,0,.7); animation:rogMsgIn .35s cubic-bezier(.175,.885,.32,1.1) both; overflow:hidden;">

        {{-- ── Header ── --}}
        <div style="background:#cc0018; padding:.9rem 1.2rem; display:flex; align-items:center; justify-content:space-between;">
            <div style="display:flex; align-items:center; gap:8px;">
                <span style="color:#fff; font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.1rem; letter-spacing:.1em;">KH</span>
                <div style="width:1.5px; height:18px; background:rgba(255,255,255,.4);"></div>
                <span style="color:#fff; font-weight:900; font-size:1rem; letter-spacing:.1em;">QR</span>
                <span style="color:rgba(255,255,255,.6); font-size:.68rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase;">BAKONG</span>
            </div>
            <button onclick="closeBakongModal()" title="Close"
                style="width:32px; height:32px; border-radius:50%; background:rgba(255,255,255,.15); border:none; color:#fff; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:1.1rem; line-height:1; flex-shrink:0; transition:background .15s;"
                onmouseover="this.style.background='rgba(255,255,255,.3)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">✕</button>
        </div>

        {{-- ── Merchant + Ref row ── --}}
        <div style="padding:.9rem 1.2rem .7rem; display:flex; justify-content:space-between; align-items:flex-start; border-bottom:1.5px dashed #eee;">
            <div>
                <div style="font-size:.6rem; color:#bbb; font-weight:700; text-transform:uppercase; letter-spacing:.12em; margin-bottom:.2rem;">Merchant</div>
                <div style="font-size:.92rem; font-weight:800; color:#111; letter-spacing:.02em;">{{ strtoupper(config('services.bakong.merchant_name')) }}</div>
            </div>
            <div style="text-align:right;">
                <div style="font-size:.6rem; color:#bbb; font-weight:700; text-transform:uppercase; letter-spacing:.12em; margin-bottom:.2rem;">Order Ref</div>
                <div id="bakong-ref-display" style="font-size:.72rem; font-weight:700; color:#555; font-family:'Courier New',monospace; letter-spacing:.04em;">—</div>
            </div>
        </div>

        {{-- ── Amount ── --}}
        <div style="padding:.8rem 1.2rem .4rem; display:flex; align-items:center; gap:.6rem;">
            <div style="font-size:.6rem; color:#bbb; font-weight:700; text-transform:uppercase; letter-spacing:.12em;">Amount</div>
            <div id="bakong-amount-display" style="font-size:2.4rem; font-weight:900; color:#cc0018; line-height:1; letter-spacing:-.02em;">$0.00</div>
            <div style="font-size:.75rem; font-weight:700; color:#ccc; align-self:flex-end; margin-bottom:.3rem; letter-spacing:.08em;">USD</div>
        </div>

        {{-- ── QR Section ── --}}
        <div id="bakong-qr-section" style="padding:.5rem 1.2rem 1rem; display:flex; flex-direction:column; align-items:center; gap:.75rem;">

            {{-- QR Frame --}}
            <div id="bakong-qr-box" style="width:100%; max-width:280px; aspect-ratio:1; background:#fff; border:3px solid #f0f0f0; border-radius:16px; position:relative; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.06);">

                {{-- Spinner --}}
                <div id="bakong-qr-spinner" style="position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:.7rem; background:#fff; z-index:3;">
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#cc0018" stroke-width="2.5" stroke-linecap="round" style="animation:spin .75s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                    <span style="font-size:.74rem; color:#bbb; font-weight:600; letter-spacing:.04em;">Generating QR…</span>
                </div>

                {{-- QR Image --}}
                <img id="bakong-qr-img" src="" alt="BAKONG KHQR"
                     style="position:absolute; inset:0; width:100%; height:100%; object-fit:contain; display:none; padding:6px; box-sizing:border-box;"
                     onload="this.style.display='block'; document.getElementById('bakong-qr-spinner').style.display='none';"
                     onerror="document.getElementById('bakong-qr-spinner').style.display='none'; document.getElementById('bakong-qr-error').style.display='flex';">

                {{-- Error state --}}
                <div id="bakong-qr-error" style="position:absolute; inset:0; display:none; flex-direction:column; align-items:center; justify-content:center; gap:.5rem; background:#fff;">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#cc0018" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span style="font-size:.74rem; color:#999; text-align:center; padding:0 1rem;">Failed to load QR.<br>Please try again.</span>
                </div>

                {{-- Corner decorations --}}
                <div style="position:absolute; top:8px; left:8px; width:18px; height:18px; border-top:3px solid #cc0018; border-left:3px solid #cc0018; border-radius:3px 0 0 0; pointer-events:none;"></div>
                <div style="position:absolute; top:8px; right:8px; width:18px; height:18px; border-top:3px solid #cc0018; border-right:3px solid #cc0018; border-radius:0 3px 0 0; pointer-events:none;"></div>
                <div style="position:absolute; bottom:8px; left:8px; width:18px; height:18px; border-bottom:3px solid #cc0018; border-left:3px solid #cc0018; border-radius:0 0 0 3px; pointer-events:none;"></div>
                <div style="position:absolute; bottom:8px; right:8px; width:18px; height:18px; border-bottom:3px solid #cc0018; border-right:3px solid #cc0018; border-radius:0 0 3px 0; pointer-events:none;"></div>
            </div>

            {{-- Status --}}
            <div style="display:flex; align-items:center; gap:.5rem;">
                <span id="bakong-dot" style="width:8px; height:8px; border-radius:50%; background:#f59e0b; flex-shrink:0; animation:pulse 1.5s ease-in-out infinite;"></span>
                <span id="bakong-status-text" style="font-size:.8rem; font-weight:700; color:#666;">Waiting for payment…</span>
            </div>

            {{-- Hint --}}
            <p style="font-size:.7rem; color:#d0d0d0; text-align:center; margin:0; line-height:1.7; padding:0 .5rem;">
                Open your Cambodian banking app · Scan · Pay · Then tap <strong style="color:#aaa;">"I've Paid"</strong>
            </p>
        </div>

        {{-- ── Success Section (hidden) ── --}}
        <div id="bakong-success-section" style="display:none; flex-direction:column; align-items:center; gap:1rem; padding:2rem 1.2rem 1.5rem; text-align:center;">
            <div style="width:72px; height:72px; border-radius:50%; background:linear-gradient(135deg,#22c55e,#16a34a); display:flex; align-items:center; justify-content:center; box-shadow:0 8px 24px rgba(34,197,94,.35); animation:successPop .5s cubic-bezier(.175,.885,.32,1.275);">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div style="font-size:1.2rem; font-weight:900; color:#111; letter-spacing:-.01em;">Payment Confirmed!</div>
            <div style="font-size:.82rem; color:#aaa;">Placing your order, please wait…</div>
            <div style="width:100%; height:3px; background:#f0f0f0; border-radius:99px; overflow:hidden;">
                <div style="height:100%; width:0%; background:#22c55e; border-radius:99px; animation:progressBar 1.5s ease-out forwards;"></div>
            </div>
        </div>

        {{-- ── Footer ── --}}
        <div id="bakong-footer" style="padding:.85rem 1.2rem 1.1rem; border-top:1px solid #f5f5f5; display:flex; gap:.6rem;">
            <button onclick="closeBakongModal()"
                style="flex:1; padding:.75rem .5rem; background:#f7f7f7; border:1.5px solid #eee; color:#888; border-radius:10px; cursor:pointer; font-weight:700; font-size:.82rem; transition:all .15s;"
                onmouseover="this.style.background='#eee'" onmouseout="this.style.background='#f7f7f7'">
                Cancel
            </button>
            <button id="bakong-paid-btn" onclick="confirmBakongPaid()"
                style="flex:2.5; padding:.75rem .5rem; background:#cc0018; border:none; color:#fff; border-radius:10px; cursor:pointer; font-weight:900; font-size:.88rem; letter-spacing:.06em; text-transform:uppercase; display:flex; align-items:center; justify-content:center; gap:.45rem; box-shadow:0 4px 14px rgba(204,0,24,.35); transition:background .15s;"
                onmouseover="this.style.background='#a8001a'" onmouseout="this.style.background='#cc0018'">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                I've Paid
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    var form      = document.querySelector('form[action="{{ route("checkout.store") }}"]');
    var modal     = document.getElementById('bakong-modal');
    var amountEl  = document.getElementById('bakong-amount-display');
    var refEl     = document.getElementById('bakong-ref-display');
    var dot       = document.getElementById('bakong-dot');
    var statusTxt = document.getElementById('bakong-status-text');
    var qrImg     = document.getElementById('bakong-qr-img');
    var spinner   = document.getElementById('bakong-qr-spinner');
    var qrSection = document.getElementById('bakong-qr-section');
    var successSec= document.getElementById('bakong-success-section');
    var footer    = document.getElementById('bakong-footer');
    var pollTimer = null;
    var currentMd5= null;
    var orderTotal= {{ (float) number_format($total, 2, '.', '') }};

    // Read CSRF token from meta tag — more reliable than inline Blade
    function getCsrf() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
    }

    /* intercept form submit */
    form.addEventListener('submit', function (e) {
        var method = form.querySelector('input[name="payment_method"]:checked');
        if (method && method.value === 'bakong_khqr') {
            e.preventDefault();
            openBakongModal();
        }
    });

    /* open modal */
    window.openBakongModal = function () {
        var orderRef = 'ROG-' + Math.random().toString(36).substr(2,8).toUpperCase();
        var amt = orderTotal.toFixed(2);
        amountEl.textContent = '$' + amt;
        refEl.textContent    = orderRef;

        // Reset all states
        qrImg.src = '';
        qrImg.style.display = 'none';
        var oldSvg = document.getElementById('bakong-qr-svg-wrap');
        if (oldSvg) oldSvg.remove();
        document.getElementById('bakong-qr-error').style.display = 'none';
        spinner.style.display = 'flex';
        qrSection.style.display = 'flex';
        successSec.style.display = 'none';
        footer.style.display = 'flex';
        setStatus('waiting');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        fetch('{{ route("bakong.generate") }}', {
            method:  'POST',
            headers: {
                'Content-Type':  'application/json',
                'Accept':        'application/json',
                'X-CSRF-TOKEN':  getCsrf(),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ amount: parseFloat(amt), currency: 'USD', order_ref: orderRef })
        })
        .then(function(r) {
            if (!r.ok) throw new Error('HTTP ' + r.status);
            return r.json();
        })
        .then(function(d) {
            if (d.success && d.qr_data_uri) {
                // Render SVG directly in the DOM — avoids img onerror issues with data URIs
                var box = document.getElementById('bakong-qr-box');
                var existing = document.getElementById('bakong-qr-svg-wrap');
                if (existing) existing.remove();

                var wrap = document.createElement('div');
                wrap.id = 'bakong-qr-svg-wrap';
                wrap.style.cssText = 'position:absolute;inset:6px;display:flex;align-items:center;justify-content:center;';

                var img = document.createElement('img');
                img.src = d.qr_data_uri;
                img.style.cssText = 'width:100%;height:100%;object-fit:contain;';
                img.alt = 'BAKONG KHQR';

                wrap.appendChild(img);
                box.appendChild(wrap);

                spinner.style.display = 'none';
                currentMd5 = d.md5 || null;
                if (currentMd5) startPolling(currentMd5);
            } else {
                spinner.style.display = 'none';
                document.getElementById('bakong-qr-error').style.display = 'flex';
            }
        })
        .catch(function(err) {
            console.error('QR fetch failed:', err);
            spinner.style.display = 'none';
            document.getElementById('bakong-qr-error').style.display = 'flex';
        });
    };

    /* poll payment status */
    function startPolling(md5) {
        clearInterval(pollTimer);
        pollTimer = setInterval(function(){
            fetch('{{ route("bakong.check") }}', {
                method:'POST',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                body: JSON.stringify({md5: md5})
            })
            .then(function(r){return r.json();})
            .then(function(d){if(d.paid){clearInterval(pollTimer);triggerSuccess();}})
            .catch(function(){});
        }, 3000);
    }

    /* user clicked I've Paid */
    window.confirmBakongPaid = function () {
        clearInterval(pollTimer);
        triggerSuccess();
    };

    /* show success state then submit */
    function triggerSuccess() {
        setStatus('paid');
        qrSection.style.display  = 'none';
        footer.style.display     = 'none';
        successSec.style.display = 'flex';
        successSec.style.flexDirection = 'column';
        setTimeout(function(){
            form.querySelectorAll('input[name="payment_method"][type="hidden"]').forEach(function(el){el.remove();});
            var inp = document.createElement('input');
            inp.type='hidden'; inp.name='payment_method'; inp.value='bakong_khqr';
            form.appendChild(inp);
            form.querySelectorAll('input[name="payment_method"][type="radio"]').forEach(function(el){el.disabled=true;});
            form.submit();
        }, 1600);
    }

    /* status helpers */
    function setStatus(state) {
        if (state==='waiting') {
            dot.style.background='#f59e0b'; dot.style.animation='pulse 1.4s infinite';
            statusTxt.textContent='Waiting for payment…'; statusTxt.style.color='#777';
        } else if (state==='paid') {
            dot.style.background='#22c55e'; dot.style.animation='none';
            statusTxt.textContent='✓ Payment received!'; statusTxt.style.color='#16a34a';
        }
    }

    /* close modal */
    window.closeBakongModal = function () {
        clearInterval(pollTimer);
        modal.style.display='none';
        document.body.style.overflow='';
        currentMd5=null;
    };

    document.addEventListener('keydown', function(e){
        if(e.key==='Escape' && modal.style.display==='flex') closeBakongModal();
    });
})();
</script>
<style>
@keyframes spin        { to { transform:rotate(360deg); } }
@keyframes pulse       { 0%,100%{opacity:1;transform:scale(1);}50%{opacity:.35;transform:scale(.8);} }
@keyframes rogMsgIn    { from{opacity:0;transform:translateY(24px) scale(.96);}to{opacity:1;transform:none;} }
@keyframes successPop  { from{transform:scale(0);opacity:0;}to{transform:scale(1);opacity:1;} }
@keyframes progressBar { from{width:0%;}to{width:100%;} }
#bakong-modal { overflow-y:auto; }
</style>
@endpush
