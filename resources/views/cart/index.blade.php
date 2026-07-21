@extends('layouts.app')
@section('title', 'Shopping Cart — ROG Store')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:2rem 1.5rem;">

    {{-- Header --}}
    <div style="margin-bottom:2rem;">
        <div style="font-size:.75rem; color:#555; letter-spacing:.08em; text-transform:uppercase; margin-bottom:.5rem;">
            <a href="{{ route('home') }}" style="color:#555; text-decoration:none;">Home</a> ›
            <span style="color:var(--rog-red);">Cart</span>
        </div>
        <h1 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.8rem; color:#fff;">Shopping Cart
            @if($cartItems->count())
            <span style="font-size:1rem; color:var(--rog-red);">({{ $cartItems->sum('quantity') }} items)</span>
            @endif
        </h1>
    </div>

    @if($cartItems->count())
    <div style="display:grid; grid-template-columns:1fr 360px; gap:2rem; align-items:start;">

        {{-- Cart Items --}}
        <div>
            <div style="background:#111; border:1px solid #1e1e1e;">
                <div style="padding:.8rem 1.2rem; background:#1a1a1a; border-bottom:1px solid #1e1e1e; display:grid; grid-template-columns:3fr 1fr 1fr 1fr auto; gap:1rem;">
                    <span style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase;">Product</span>
                    <span style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-align:center;">Price</span>
                    <span style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-align:center;">Qty</span>
                    <span style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-align:right;">Total</span>
                    <span></span>
                </div>

                @foreach($cartItems as $item)
                <div style="padding:1.2rem; border-bottom:1px solid #1a1a1a; display:grid; grid-template-columns:3fr 1fr 1fr 1fr auto; gap:1rem; align-items:center;">
                    <div style="display:flex; gap:1rem; align-items:center;">
                        <a href="{{ route('product.show',$item->product->slug) }}">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                 style="width:80px; height:70px; object-fit:contain; background:#0d0d0d; padding:6px; border:1px solid #1e1e1e;"
                                 onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=200&q=60'">
                        </a>
                        <div>
                            <div style="font-size:.7rem; color:var(--rog-red); font-weight:600; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.2rem;">{{ $item->product->category->name }}</div>
                            <a href="{{ route('product.show',$item->product->slug) }}" style="text-decoration:none; color:#ddd; font-weight:700; font-size:.9rem; line-height:1.3; display:block;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#ddd'">
                                {{ $item->product->name }}
                            </a>
                            <div style="font-size:.75rem; color:#555; margin-top:.2rem;">SKU: {{ $item->product->sku }}</div>
                        </div>
                    </div>
                    <div style="text-align:center; color:#ccc; font-size:.9rem; font-weight:600;">
                        ${{ number_format($item->product->sale_price ?? $item->product->price, 2) }}
                    </div>
                    <div style="text-align:center;">
                        <form action="{{ route('cart.update',$item) }}" method="POST" style="display:flex; align-items:center; justify-content:center; gap:.3rem;">
                            @csrf @method('PUT')
                            <button type="button" style="background:#1a1a1a;border:1px solid #2a2a2a;color:#aaa;cursor:pointer;padding:.2rem .6rem;" onclick="const i=this.nextElementSibling;i.value=Math.max(1,+i.value-1);this.closest('form').submit()">−</button>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                   style="width:40px; background:#111; border:1px solid #2a2a2a; color:#fff; text-align:center; font-weight:700; font-size:.85rem; padding:.2rem 0; outline:none;"
                                   onchange="this.form.submit()">
                            <button type="button" style="background:#1a1a1a;border:1px solid #2a2a2a;color:#aaa;cursor:pointer;padding:.2rem .6rem;" onclick="const i=this.previousElementSibling;i.value=Math.min({{ $item->product->stock }},+i.value+1);this.closest('form').submit()">+</button>
                        </form>
                    </div>
                    <div style="text-align:right; color:var(--rog-red); font-weight:800; font-size:1rem;">
                        ${{ number_format(($item->product->sale_price ?? $item->product->price) * $item->quantity, 2) }}
                    </div>
                    <div>
                        <form action="{{ route('cart.remove',$item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none;border:none;color:#555;cursor:pointer;padding:.3rem;" title="Remove" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#555'">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="display:flex; justify-content:space-between; margin-top:1.2rem; flex-wrap:wrap; gap:.8rem;">
                <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none;">← Continue Shopping</a>
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear entire cart?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:none;border:1px solid #444;color:#666;padding:.6rem 1.4rem;cursor:pointer;font-size:.82rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;transition:all .2s;" onmouseover="this.style.borderColor='#ef4444';this.style.color='#ef4444'" onmouseout="this.style.borderColor='#444';this.style.color='#666'">
                        🗑 Clear Cart
                    </button>
                </form>
            </div>
        </div>

        {{-- Order Summary --}}
        <div style="background:#111; border:1px solid #1e1e1e; padding:1.5rem; position:sticky; top:80px;">
            <h2 style="font-weight:800; font-size:.85rem; letter-spacing:.12em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.5rem; padding-bottom:.8rem; border-bottom:1px solid #1e1e1e;">Order Summary</h2>
            <div style="display:flex; flex-direction:column; gap:.8rem; margin-bottom:1.2rem;">
                <div style="display:flex; justify-content:space-between; font-size:.9rem; color:#aaa;">
                    <span>Subtotal</span><span style="color:#ddd; font-weight:600;">${{ number_format($subtotal,2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:.9rem; color:#aaa;">
                    <span>Tax (8%)</span><span style="color:#ddd; font-weight:600;">${{ number_format($tax,2) }}</span>
                </div>
                <div style="border-top:1px solid #1e1e1e; padding-top:.8rem; display:flex; justify-content:space-between;">
                    <span style="font-weight:800; font-size:1rem; color:#fff; text-transform:uppercase; letter-spacing:.06em;">Total</span>
                    <span style="font-weight:900; font-size:1.4rem; color:var(--rog-red);">${{ number_format($total,2) }}</span>
                </div>
            </div>
            <a href="{{ route('checkout') }}" class="btn-rog" style="text-decoration:none; width:100%; justify-content:center; display:flex; font-size:.9rem; padding:.8rem;">
                Proceed to Checkout →
            </a>
            <div style="text-align:center; margin-top:1rem; color:#555; font-size:.75rem;">🔒 Secure SSL Encrypted Checkout</div>
        </div>
    </div>

    @else
    {{-- Empty cart --}}
    <div style="text-align:center; padding:6rem 2rem;">
        <div style="font-size:4rem; margin-bottom:1.5rem;">🛒</div>
        <h2 style="font-family:'Orbitron',sans-serif; font-size:1.5rem; color:#fff; font-weight:900; margin-bottom:.8rem;">Your Cart is Empty</h2>
        <p style="color:#666; margin-bottom:2rem;">Looks like you haven't added any ROG gear yet. Let's fix that.</p>
        <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:1rem; padding:.8rem 2rem;">Browse ROG Store</a>
    </div>
    @endif
</div>
@endsection
