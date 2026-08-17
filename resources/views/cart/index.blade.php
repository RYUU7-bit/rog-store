@extends('layouts.app')
@section('title', 'Shopping Cart — ROG Store')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:2rem 1.2rem 4.5rem; position:relative; z-index:2;">

    {{-- Breadcrumb & Dynamic Header --}}
    <div style="margin-bottom:2rem; display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1rem;">
        <div>
            <div style="display:inline-flex; align-items:center; gap:.5rem; font-size:.74rem; font-family:'Orbitron',sans-serif; color:#94a3b8; letter-spacing:.12em; text-transform:uppercase; margin-bottom:.5rem;">
                <a href="{{ route('home') }}" style="color:#94a3b8; text-decoration:none; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#94a3b8'">Home</a>
                <span style="color:#e5001e;">//</span>
                <span style="color:#fff;">Hardware Cart</span>
            </div>
            <h1 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.6rem,3.2vw,2.4rem); color:#fff; text-transform:uppercase; letter-spacing:.05em; margin:0; line-height:1.1;">
                Shopping <span style="color:#e5001e;">Cart</span>
                @if($cartItems->count())
                <span style="font-size:1.1rem; color:#ff4d6d; font-weight:700; margin-left:.5rem; vertical-align:middle; background:rgba(229,0,30,0.12); padding:2px 10px; border-radius:12px; border:1px solid rgba(229,0,30,0.3);">
                    {{ $cartItems->sum('quantity') }} HARDWARE SKU{{ $cartItems->sum('quantity') > 1 ? 'S' : '' }}
                </span>
                @endif
            </h1>
        </div>

        @if($cartItems->count())
        <div style="display:flex; align-items:center; gap:.8rem;">
            <div style="display:flex; align-items:center; gap:6px; background:rgba(34,197,94,0.1); border:1px solid rgba(34,197,94,0.3); padding:6px 14px; border-radius:20px; font-size:.72rem; font-family:'Orbitron',sans-serif; color:#22c55e; font-weight:700;">
                <span style="width:6px; height:6px; border-radius:50%; background:#22c55e; box-shadow:0 0 8px #22c55e; animation:pulse-beacon 1.2s infinite;"></span>
                LIVE HARDWARE RESERVED
            </div>
        </div>
        @endif
    </div>

    @if($cartItems->count())
    <div style="display:grid; grid-template-columns:1fr 380px; gap:2.2rem; align-items:start;" class="cart-layout-grid">

        {{-- ── CART ITEMS CONTAINER ── --}}
        <div>
            {{-- Desktop Cart Mecha Table --}}
            <div class="cart-desktop-table hidden-mobile" style="background:rgba(13, 11, 24, 0.85); border:1px solid rgba(147, 51, 234, 0.3); border-radius:10px; overflow:hidden; backdrop-filter:blur(16px); box-shadow:0 15px 40px rgba(0,0,0,0.6); position:relative;">
                <div class="hud-corner-tl"></div>
                <div class="hud-corner-br"></div>

                {{-- Table Head --}}
                <div style="padding:1rem 1.4rem; background:rgba(20, 16, 38, 0.95); border-bottom:1px solid rgba(147, 51, 234, 0.25); display:grid; grid-template-columns:3.2fr 1.1fr 1.2fr 1.1fr auto; gap:1.2rem; align-items:center; font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:#94a3b8;">
                    <span style="color:#e5001e;">Hardware Component</span>
                    <span style="text-align:center;">Unit Price</span>
                    <span style="text-align:center;">Quantity</span>
                    <span style="text-align:right; color:#e5001e;">Subtotal</span>
                    <span></span>
                </div>

                {{-- Table Rows --}}
                @foreach($cartItems as $item)
                @php
                    $unitPrice = $item->product->sale_price ?? $item->product->price;
                    $rowTotal  = $unitPrice * $item->quantity;
                    $khrTotal  = $rowTotal * 4050;
                @endphp
                <div style="padding:1.3rem 1.4rem; border-bottom:1px solid rgba(147, 51, 234, 0.15); display:grid; grid-template-columns:3.2fr 1.1fr 1.2fr 1.1fr auto; gap:1.2rem; align-items:center; transition:background .2s;" onmouseover="this.style.background='rgba(229,0,30,0.03)'" onmouseout="this.style.background='transparent'">
                    
                    {{-- Product Info --}}
                    <div style="display:flex; gap:1.2rem; align-items:center;">
                        <a href="{{ route('product.show',$item->product->slug) }}" style="position:relative; flex-shrink:0; display:block; width:88px; height:78px; background:rgba(8,7,16,0.9); border:1.5px solid rgba(147,51,234,0.3); border-radius:8px; padding:6px; overflow:hidden; transition:border-color .2s, transform .2s;" onmouseover="this.style.borderColor='#e5001e'; this.style.transform='scale(1.04)'" onmouseout="this.style.borderColor='rgba(147,51,234,0.3)'; this.style.transform='scale(1)'">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                 style="width:100%; height:100%; object-fit:contain;"
                                 onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=200&q=60'">
                        </a>
                        <div style="min-width:0;">
                            <div style="font-family:'Orbitron',sans-serif; font-size:.65rem; color:#ff4d6d; font-weight:800; text-transform:uppercase; letter-spacing:.1em; margin-bottom:.3rem; display:flex; align-items:center; gap:5px;">
                                <span style="width:4px; height:4px; border-radius:50%; background:#e5001e;"></span>
                                {{ $item->product->category->name }}
                            </div>
                            <a href="{{ route('product.show',$item->product->slug) }}" style="text-decoration:none; color:#fff; font-weight:700; font-size:.94rem; line-height:1.35; display:block; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#fff'">
                                {{ $item->product->name }}
                            </a>
                            <div style="font-family:'Rajdhani',sans-serif; font-size:.76rem; color:#64748b; margin-top:.25rem; font-weight:600;">
                                SKU: <span style="color:#94a3b8;">{{ $item->product->sku }}</span> &bull; Stock: <span style="color:#22c55e;">{{ $item->product->stock }} Units Available</span>
                            </div>
                        </div>
                    </div>

                    {{-- Unit Price --}}
                    <div style="text-align:center;">
                        <div style="font-family:'Orbitron',sans-serif; font-weight:800; color:#e2e8f0; font-size:.95rem;">
                            ${{ number_format($unitPrice, 2) }}
                        </div>
                        @if($item->product->sale_price)
                        <div style="font-size:.72rem; color:#64748b; text-decoration:line-through;">
                            ${{ number_format($item->product->price, 2) }}
                        </div>
                        @endif
                    </div>

                    {{-- Quantity Stepper --}}
                    <div style="display:flex; justify-content:center;">
                        <form action="{{ route('cart.update',$item) }}" method="POST" style="display:inline-flex; align-items:center; background:rgba(0,0,0,0.6); border:1px solid rgba(147,51,234,0.4); border-radius:6px; padding:2px; box-shadow:inset 0 0 10px rgba(0,0,0,0.5);">
                            @csrf @method('PUT')
                            <button type="button" style="background:rgba(255,255,255,0.06); border:none; color:#fff; cursor:pointer; width:30px; height:30px; border-radius:4px; font-weight:900; font-size:1.1rem; display:flex; align-items:center; justify-content:center; transition:all .15s;" onmouseover="this.style.background='#e5001e'" onmouseout="this.style.background='rgba(255,255,255,0.06)'" onclick="const i=this.nextElementSibling; i.value=Math.max(1,+i.value-1); this.closest('form').submit()">−</button>
                            
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                   style="width:44px; background:transparent; border:none; color:#fff; text-align:center; font-family:'Orbitron',sans-serif; font-weight:800; font-size:.92rem; outline:none;"
                                   onchange="this.form.submit()">

                            <button type="button" style="background:rgba(255,255,255,0.06); border:none; color:#fff; cursor:pointer; width:30px; height:30px; border-radius:4px; font-weight:900; font-size:1.1rem; display:flex; align-items:center; justify-content:center; transition:all .15s;" onmouseover="this.style.background='#e5001e'" onmouseout="this.style.background='rgba(255,255,255,0.06)'" onclick="const i=this.previousElementSibling; i.value=Math.min({{ $item->product->stock }},+i.value+1); this.closest('form').submit()">+</button>
                        </form>
                    </div>

                    {{-- Row Subtotal --}}
                    <div style="text-align:right;">
                        <div style="font-family:'Orbitron',sans-serif; font-weight:900; color:#ff0055; font-size:1.05rem; text-shadow:0 0 10px rgba(229,0,30,0.4);">
                            ${{ number_format($rowTotal, 2) }}
                        </div>
                        <div style="font-family:'Battambang',sans-serif; font-size:.68rem; color:#64748b; margin-top:2px;">
                            ≈ ៛{{ number_format($khrTotal) }}
                        </div>
                    </div>

                    {{-- Delete Button --}}
                    <div>
                        <form action="{{ route('cart.remove',$item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.25); color:#ef4444; cursor:pointer; width:34px; height:34px; border-radius:6px; display:flex; align-items:center; justify-content:center; transition:all .2s;" title="Remove Item" onmouseover="this.style.background='#ef4444'; this.style.color='#fff'; this.style.boxShadow='0 0 12px rgba(239,68,68,0.5)'" onmouseout="this.style.background='rgba(239,68,68,0.08)'; this.style.color='#ef4444'; this.style.boxShadow='none'">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Mobile Native Cart Cards --}}
            <div class="cart-mobile-cards show-mobile" style="display:flex; flex-direction:column; gap:1rem;">
                @foreach($cartItems as $item)
                @php
                    $unitPrice = $item->product->sale_price ?? $item->product->price;
                    $rowTotal  = $unitPrice * $item->quantity;
                    $khrTotal  = $rowTotal * 4050;
                @endphp
                <div style="background:rgba(13, 11, 24, 0.9); border:1px solid rgba(147, 51, 234, 0.3); border-radius:10px; padding:1.2rem; display:flex; flex-direction:column; gap:1rem; position:relative;">
                    <div class="hud-corner-tl"></div>
                    <div style="display:flex; gap:1rem; align-items:flex-start;">
                        <a href="{{ route('product.show',$item->product->slug) }}" style="flex-shrink:0; width:80px; height:80px; background:rgba(8,7,16,0.9); border:1px solid rgba(147,51,234,0.3); border-radius:8px; padding:6px; display:block;">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                 style="width:100%; height:100%; object-fit:contain;"
                                 onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=200&q=60'">
                        </a>
                        <div style="flex:1; min-width:0;">
                            <div style="font-family:'Orbitron',sans-serif; font-size:.65rem; color:#ff4d6d; font-weight:800; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.2rem;">{{ $item->product->category->name }}</div>
                            <a href="{{ route('product.show',$item->product->slug) }}" style="text-decoration:none; color:#fff; font-weight:700; font-size:.88rem; line-height:1.3; display:block;">
                                {{ $item->product->name }}
                            </a>
                            <div style="font-family:'Orbitron',sans-serif; font-weight:800; font-size:.86rem; color:#e2e8f0; margin-top:.4rem;">
                                ${{ number_format($unitPrice, 2) }} / unit
                            </div>
                        </div>
                        <form action="{{ route('cart.remove',$item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.25); color:#ef4444; cursor:pointer; padding:.45rem; border-radius:6px;">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                            </button>
                        </form>
                    </div>

                    {{-- Stepper & Subtotal row --}}
                    <div style="display:flex; align-items:center; justify-content:space-between; padding-top:.8rem; border-top:1px solid rgba(147,51,234,0.2);">
                        <form action="{{ route('cart.update',$item) }}" method="POST" style="display:flex; align-items:center; gap:.3rem; background:rgba(0,0,0,0.6); border:1px solid rgba(147,51,234,0.4); border-radius:6px; padding:2px;">
                            @csrf @method('PUT')
                            <button type="button" style="background:none; border:none; color:#fff; cursor:pointer; padding:.35rem .75rem; font-size:1rem; font-weight:800;" onclick="const i=this.nextElementSibling; i.value=Math.max(1,+i.value-1); this.closest('form').submit()">−</button>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                   style="width:36px; background:none; border:none; color:#fff; text-align:center; font-family:'Orbitron',sans-serif; font-weight:800; font-size:.9rem; outline:none;"
                                   onchange="this.form.submit()">
                            <button type="button" style="background:none; border:none; color:#fff; cursor:pointer; padding:.35rem .75rem; font-size:1rem; font-weight:800;" onclick="const i=this.previousElementSibling; i.value=Math.min({{ $item->product->stock }},+i.value+1); this.closest('form').submit()">+</button>
                        </form>
                        <div style="text-align:right;">
                            <div style="font-family:'Orbitron',sans-serif; font-weight:900; color:#ff0055; font-size:1.1rem;">
                                ${{ number_format($rowTotal, 2) }}
                            </div>
                            <div style="font-family:'Battambang',sans-serif; font-size:.68rem; color:#64748b;">
                                ≈ ៛{{ number_format($khrTotal) }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Action Bottom Bar --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:1.5rem; flex-wrap:wrap; gap:1rem;">
                <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none; font-family:'Orbitron',sans-serif; font-size:.8rem; padding:.65rem 1.4rem; display:inline-flex; align-items:center; gap:8px;">
                    &larr; Back to Hardware Store
                </a>
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Purge entire hardware cart cache?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:rgba(239,68,68,0.06); border:1px solid rgba(239,68,68,0.3); color:#ef4444; padding:.65rem 1.4rem; cursor:pointer; font-family:'Orbitron',sans-serif; font-size:.78rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; border-radius:6px; transition:all .2s; display:inline-flex; align-items:center; gap:6px;" onmouseover="this.style.background='#ef4444'; this.style.color='#fff'; this.style.boxShadow='0 0 15px rgba(239,68,68,0.5)'" onmouseout="this.style.background='rgba(239,68,68,0.06)'; this.style.color='#ef4444'; this.style.boxShadow='none'">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                        Clear Cart
                    </button>
                </form>
            </div>
        </div>

        {{-- ── 3D CYBER MECHA ORDER SUMMARY ── --}}
        <div style="background:rgba(13, 11, 24, 0.92); border:1px solid rgba(147, 51, 234, 0.35); border-top:3px solid #e5001e; border-radius:10px; padding:1.8rem; position:sticky; top:85px; backdrop-filter:blur(20px); box-shadow:0 20px 50px rgba(0,0,0,0.7), 0 0 30px rgba(229,0,30,0.15);">
            <div class="hud-corner-tl"></div>
            <div class="hud-corner-br"></div>

            {{-- Title --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.4rem; padding-bottom:.8rem; border-bottom:1px solid rgba(147,51,234,0.25);">
                <h2 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:.92rem; letter-spacing:.12em; text-transform:uppercase; color:#fff; margin:0; display:flex; align-items:center; gap:8px;">
                    <span style="width:7px; height:7px; border-radius:50%; background:#e5001e; box-shadow:0 0 8px #e5001e;"></span>
                    Order Summary
                </h2>
                <span style="font-family:'Orbitron',sans-serif; font-size:.65rem; color:#00f0ff; background:rgba(0,240,255,0.1); padding:2px 7px; border-radius:4px; border:1px solid rgba(0,240,255,0.3);">
                    SECURE HUB
                </span>
            </div>

            {{-- Calculation Breakdown --}}
            <div style="display:flex; flex-direction:column; gap:.9rem; margin-bottom:1.5rem;">
                <div style="display:flex; justify-content:space-between; font-size:.88rem; color:#94a3b8; font-family:'Rajdhani',sans-serif; font-weight:600;">
                    <span>Hardware Subtotal</span>
                    <span style="color:#fff; font-family:'Orbitron',sans-serif; font-weight:800;">${{ number_format($subtotal, 2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:.88rem; color:#94a3b8; font-family:'Rajdhani',sans-serif; font-weight:600;">
                    <span>Estimated Tax (8%)</span>
                    <span style="color:#fff; font-family:'Orbitron',sans-serif; font-weight:800;">${{ number_format($tax, 2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:.88rem; color:#94a3b8; font-family:'Rajdhani',sans-serif; font-weight:600;">
                    <span>Nationwide Delivery</span>
                    <span style="color:#22c55e; font-family:'Orbitron',sans-serif; font-weight:800; text-shadow:0 0 8px rgba(34,197,94,0.5);">FREE</span>
                </div>

                {{-- Total Highlight Box --}}
                <div style="margin-top:.4rem; padding:1rem 1.2rem; background:rgba(229,0,30,0.08); border:1px solid rgba(229,0,30,0.3); border-radius:8px;">
                    <div style="display:flex; justify-content:space-between; align-items:baseline;">
                        <span style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:.9rem; color:#fff; text-transform:uppercase; letter-spacing:.08em;">Total Due</span>
                        <div style="text-align:right;">
                            <span style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.6rem; color:#ff0055; text-shadow:0 0 18px rgba(229,0,30,0.7);">${{ number_format($total, 2) }}</span>
                            <div style="font-family:'Battambang',sans-serif; font-size:.76rem; color:#94a3b8; margin-top:2px;">
                                ≈ ៛{{ number_format($total * 4050) }} KHR
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Proceed to Checkout Button --}}
            <a href="{{ route('checkout') }}" class="btn-rog" style="text-decoration:none; width:100%; justify-content:center; display:flex; align-items:center; gap:10px; font-family:'Orbitron',sans-serif; font-size:.94rem; font-weight:900; padding:1rem; border-radius:6px; letter-spacing:.08em; box-shadow:0 0 25px rgba(229,0,30,0.6); transition:all .25s;">
                <span>PROCEED TO CHECKOUT</span>
                <span style="font-size:1.2rem;">&rarr;</span>
            </a>

            {{-- Trust & Payment Badges --}}
            <div style="display:flex; flex-direction:column; gap:.7rem; margin-top:1.4rem; padding-top:1.2rem; border-top:1px solid rgba(147,51,234,0.2);">
                <div style="display:flex; align-items:center; gap:8px; font-size:.75rem; color:#94a3b8; font-family:'Rajdhani',sans-serif; font-weight:600;">
                    <span style="color:#00f0ff;">⚡</span>
                    <span><strong>Bakong KHQR 1s Instant Verification</strong> Supported</span>
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:.75rem; color:#94a3b8; font-family:'Rajdhani',sans-serif; font-weight:600;">
                    <span style="color:#22c55e;">🛡️</span>
                    <span><strong>2-Year Official ASUS Cambodia</strong> Warranty Included</span>
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:.72rem; color:#64748b; font-family:'Orbitron',sans-serif; margin-top:.4rem; justify-content:center;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    256-BIT QUANTUM ENCRYPTED CHECKOUT
                </div>
            </div>

        </div>
    </div>

    @else
    {{-- Empty Cart Holographic Pod --}}
    <div style="text-align:center; padding:5.5rem 1.5rem; background:rgba(13, 11, 24, 0.85); border:1px solid rgba(147, 51, 234, 0.3); border-radius:12px; backdrop-filter:blur(16px); position:relative; overflow:hidden; max-width:680px; margin:2rem auto;">
        <div class="hud-corner-tl"></div>
        <div class="hud-corner-br"></div>
        <div class="qr-laser-scanner" style="opacity:.3;"></div>

        <div style="width:80px; height:80px; border-radius:50%; background:rgba(229,0,30,0.12); border:1.5px solid rgba(229,0,30,0.4); display:flex; align-items:center; justify-content:center; margin:0 auto 1.5rem; box-shadow:0 0 25px rgba(229,0,30,0.3);">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
        </div>

        <div style="font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:800; letter-spacing:.2em; color:#ff4d6d; text-transform:uppercase; margin-bottom:.5rem;">HARDWARE BUFFER EMPTY</div>
        <h2 style="font-family:'Orbitron',sans-serif; font-size:1.6rem; color:#fff; font-weight:900; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.8rem;">Your Cart is Empty</h2>
        <p style="color:#94a3b8; font-size:.9rem; max-width:440px; margin:0 auto 2rem; line-height:1.6;">No ROG combat hardware is currently loaded in your deployment buffer. Explore our flagship rigs and gaming peripherals to equip your setup.</p>
        
        <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-family:'Orbitron',sans-serif; font-size:.9rem; font-weight:800; padding:.9rem 2.4rem; border-radius:6px; display:inline-flex; align-items:center; gap:8px;">
            <span>BROWSE ROG STORE</span>
            <span>&rarr;</span>
        </a>
    </div>
    @endif
</div>

<style>
@media(max-width:900px) {
  .cart-layout-grid {
    grid-template-columns: 1fr !important;
  }
}
</style>
@endsection
