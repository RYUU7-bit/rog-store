@extends('layouts.app')
@section('title', 'Shopping Cart — ROG Store')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:1.5rem 1rem 3.5rem;">

    {{-- Header --}}
    <div style="margin-bottom:1.5rem;">
        <div style="font-size:.72rem; color:var(--text-muted); letter-spacing:.08em; text-transform:uppercase; margin-bottom:.3rem;">
            <a href="{{ route('home') }}" style="color:var(--text-muted); text-decoration:none;">Home</a> ›
            <span style="color:var(--rog-red);">Cart</span>
        </div>
        <h1 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.4rem,3vw,1.8rem); color:var(--text-primary);">
            Shopping Cart
            @if($cartItems->count())
            <span style="font-size:1rem; color:var(--rog-red);">({{ $cartItems->sum('quantity') }} items)</span>
            @endif
        </h1>
    </div>

    @if($cartItems->count())
    <div style="display:grid; grid-template-columns:1fr 360px; gap:2rem; align-items:start;" class="cart-layout-grid">

        {{-- ── CART ITEMS CONTAINER ── --}}
        <div>
            {{-- Desktop Cart Table --}}
            <div class="cart-desktop-table hidden-mobile" style="background:var(--bg-card); border:1px solid var(--border-card); border-radius:6px; overflow:hidden;">
                <div style="padding:.8rem 1.2rem; background:var(--bg-elevated); border-bottom:1px solid var(--border-divider); display:grid; grid-template-columns:3fr 1fr 1fr 1fr auto; gap:1rem; align-items:center;">
                    <span style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase;">Product</span>
                    <span style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-align:center;">Price</span>
                    <span style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-align:center;">Qty</span>
                    <span style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-align:right;">Total</span>
                    <span></span>
                </div>

                @foreach($cartItems as $item)
                <div style="padding:1.2rem; border-bottom:1px solid var(--border-divider); display:grid; grid-template-columns:3fr 1fr 1fr 1fr auto; gap:1rem; align-items:center;">
                    <div style="display:flex; gap:1rem; align-items:center;">
                        <a href="{{ route('product.show',$item->product->slug) }}">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                 style="width:80px; height:70px; object-fit:contain; background:var(--bg-surface-2); padding:6px; border:1px solid var(--border-card); border-radius:4px;"
                                 onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=200&q=60'">
                        </a>
                        <div>
                            <div style="font-size:.7rem; color:var(--rog-red); font-weight:600; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.2rem;">{{ $item->product->category->name }}</div>
                            <a href="{{ route('product.show',$item->product->slug) }}" style="text-decoration:none; color:var(--text-primary); font-weight:700; font-size:.9rem; line-height:1.3; display:block;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-primary)'">
                                {{ $item->product->name }}
                            </a>
                            <div style="font-size:.75rem; color:var(--text-muted); margin-top:.2rem;">SKU: {{ $item->product->sku }}</div>
                        </div>
                    </div>
                    <div style="text-align:center; color:var(--text-secondary); font-size:.9rem; font-weight:600;">
                        ${{ number_format($item->product->sale_price ?? $item->product->price, 2) }}
                    </div>
                    <div style="text-align:center;">
                        <form action="{{ route('cart.update',$item) }}" method="POST" style="display:flex; align-items:center; justify-content:center; gap:.3rem;">
                            @csrf @method('PUT')
                            <button type="button" style="background:var(--bg-elevated);border:1px solid var(--border-input);color:var(--text-primary);cursor:pointer;padding:.25rem .65rem;border-radius:3px;" onclick="const i=this.nextElementSibling;i.value=Math.max(1,+i.value-1);this.closest('form').submit()">−</button>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                   style="width:40px; background:var(--bg-input); border:1px solid var(--border-input); color:var(--text-primary); text-align:center; font-weight:700; font-size:.85rem; padding:.25rem 0; outline:none; border-radius:3px;"
                                   onchange="this.form.submit()">
                            <button type="button" style="background:var(--bg-elevated);border:1px solid var(--border-input);color:var(--text-primary);cursor:pointer;padding:.25rem .65rem;border-radius:3px;" onclick="const i=this.previousElementSibling;i.value=Math.min({{ $item->product->stock }},+i.value+1);this.closest('form').submit()">+</button>
                        </form>
                    </div>
                    <div style="text-align:right; color:var(--rog-red); font-weight:800; font-size:1rem;">
                        ${{ number_format(($item->product->sale_price ?? $item->product->price) * $item->quantity, 2) }}
                    </div>
                    <div>
                        <form action="{{ route('cart.remove',$item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#ef4444;cursor:pointer;padding:.45rem .55rem;border-radius:6px;display:flex;align-items:center;justify-content:center;transition:all .2s;" title="Remove item" onmouseover="this.style.background='rgba(239,68,68,.18)';this.style.borderColor='#ef4444'" onmouseout="this.style.background='rgba(239,68,68,.08)';this.style.borderColor='rgba(239,68,68,.2)'">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Mobile Native App Cart Cards --}}
            <div class="cart-mobile-cards show-mobile" style="display:flex; flex-direction:column; gap:0.9rem;">
                @foreach($cartItems as $item)
                <div style="background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px; padding:1rem; display:flex; flex-direction:column; gap:.8rem;">
                    <div style="display:flex; gap:.9rem; align-items:flex-start;">
                        <a href="{{ route('product.show',$item->product->slug) }}" style="flex-shrink:0;">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                 style="width:75px; height:75px; object-fit:contain; background:var(--bg-surface-2); padding:6px; border:1px solid var(--border-card); border-radius:6px;"
                                 onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=200&q=60'">
                        </a>
                        <div style="flex:1; min-width:0;">
                            <div style="font-size:.65rem; color:var(--rog-red); font-weight:700; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.15rem;">{{ $item->product->category->name }}</div>
                            <a href="{{ route('product.show',$item->product->slug) }}" style="text-decoration:none; color:var(--text-primary); font-weight:700; font-size:.85rem; line-height:1.3; display:block;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-primary)'">
                                {{ $item->product->name }}
                            </a>
                            <div style="font-size:.82rem; color:var(--text-muted); margin-top:.3rem;">
                                ${{ number_format($item->product->sale_price ?? $item->product->price, 2) }} / item
                            </div>
                        </div>
                        <form action="{{ route('cart.remove',$item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#ef4444;cursor:pointer;padding:.45rem .55rem;border-radius:6px;display:flex;align-items:center;justify-content:center;transition:all .2s;" title="Remove item" onmouseover="this.style.background='rgba(239,68,68,.18)'" onmouseout="this.style.background='rgba(239,68,68,.08)'">
                                <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            </button>
                        </form>
                    </div>

                    {{-- Stepper & Subtotal row --}}
                    <div style="display:flex; align-items:center; justify-content:space-between; padding-top:.7rem; border-top:1px solid var(--border-divider);">
                        <form action="{{ route('cart.update',$item) }}" method="POST" style="display:flex; align-items:center; gap:.4rem; background:var(--bg-elevated); border:1px solid var(--border-input); border-radius:6px; padding:2px;">
                            @csrf @method('PUT')
                            <button type="button" style="background:none; border:none; color:var(--text-primary); cursor:pointer; padding:.4rem .8rem; font-size:1rem; font-weight:700;" onclick="const i=this.nextElementSibling;i.value=Math.max(1,+i.value-1);this.closest('form').submit()">−</button>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                   style="width:34px; background:none; border:none; color:var(--text-primary); text-align:center; font-weight:800; font-size:.9rem; outline:none;"
                                   onchange="this.form.submit()">
                            <button type="button" style="background:none; border:none; color:var(--text-primary); cursor:pointer; padding:.4rem .8rem; font-size:1rem; font-weight:700;" onclick="const i=this.previousElementSibling;i.value=Math.min({{ $item->product->stock }},+i.value+1);this.closest('form').submit()">+</button>
                        </form>
                        <div style="font-weight:900; color:var(--rog-red); font-size:1.1rem;">
                            ${{ number_format(($item->product->sale_price ?? $item->product->price) * $item->quantity, 2) }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="display:flex; justify-content:space-between; margin-top:1.2rem; flex-wrap:wrap; gap:.8rem;">
                <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none;">← Continue Shopping</a>
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear entire cart?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:none;border:1px solid var(--border-input);color:var(--text-muted);padding:.55rem 1.2rem;cursor:pointer;font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;border-radius:4px;transition:all .2s;" onmouseover="this.style.borderColor='#ef4444';this.style.color='#ef4444'" onmouseout="this.style.borderColor='var(--border-input)';this.style.color='var(--text-muted)'">
                        🗑 Clear Cart
                    </button>
                </form>
            </div>
        </div>

        {{-- ── ORDER SUMMARY ── --}}
        <div style="background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px; padding:1.5rem; position:sticky; top:75px;">
            <h2 style="font-weight:800; font-size:.85rem; letter-spacing:.12em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem; padding-bottom:.7rem; border-bottom:1px solid var(--border-divider);">Order Summary</h2>
            <div style="display:flex; flex-direction:column; gap:.8rem; margin-bottom:1.2rem;">
                <div style="display:flex; justify-content:space-between; font-size:.88rem; color:var(--text-secondary);">
                    <span>Subtotal</span><span style="color:var(--text-primary); font-weight:700;">${{ number_format($subtotal,2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:.88rem; color:var(--text-secondary);">
                    <span>Estimated Tax (8%)</span><span style="color:var(--text-primary); font-weight:700;">${{ number_format($tax,2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:.88rem; color:var(--text-secondary);">
                    <span>Shipping</span><span style="color:#22c55e; font-weight:700;">FREE</span>
                </div>
                <div style="border-top:1px solid var(--border-divider); padding-top:.8rem; display:flex; justify-content:space-between; align-items:baseline;">
                    <span style="font-weight:800; font-size:.95rem; color:var(--text-primary); text-transform:uppercase; letter-spacing:.06em;">Total</span>
                    <span style="font-weight:900; font-size:1.4rem; color:var(--rog-red);">${{ number_format($total,2) }}</span>
                </div>
            </div>
            <a href="{{ route('checkout') }}" class="btn-rog" style="text-decoration:none; width:100%; justify-content:center; display:flex; font-size:.92rem; padding:.85rem; border-radius:6px;">
                Proceed to Checkout →
            </a>
            <div style="text-align:center; margin-top:.9rem; color:var(--text-muted); font-size:.73rem;">🔒 256-Bit SSL Encrypted Checkout</div>
        </div>
    </div>

    @else
    {{-- Empty cart --}}
    <div style="text-align:center; padding:5rem 1.5rem; background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px;">
        <div style="font-size:3.5rem; margin-bottom:1.2rem;">🛒</div>
        <h2 style="font-family:'Orbitron',sans-serif; font-size:1.4rem; color:var(--text-primary); font-weight:900; margin-bottom:.6rem;">Your Cart is Empty</h2>
        <p style="color:var(--text-muted); margin-bottom:1.8rem; font-size:.9rem;">Looks like you haven't added any ROG gear yet. Let's fix that.</p>
        <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:.95rem; padding:.8rem 2rem; border-radius:6px;">Browse ROG Store</a>
    </div>
    @endif
</div>

<style>
@media(max-width:768px) {
  .cart-layout-grid {
    grid-template-columns: 1fr !important;
  }
}
</style>
@endsection
