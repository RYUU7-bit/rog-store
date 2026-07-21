@extends('layouts.app')
@section('title', 'Order Confirmed — ROG Store')

@section('content')
<div style="max-width:760px; margin:0 auto; padding:3rem 1.5rem; text-align:center;">

    {{-- Success animation --}}
    <div style="width:90px; height:90px; border-radius:50%; background:rgba(34,197,94,.15); border:2px solid #22c55e; display:flex; align-items:center; justify-content:center; margin:0 auto 1.5rem; font-size:2.5rem;">
        ✓
    </div>
    <div style="color:var(--rog-red); font-size:.75rem; font-weight:700; letter-spacing:.2em; text-transform:uppercase; margin-bottom:.5rem;">Order Confirmed</div>
    <h1 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.6rem,3vw,2.2rem); color:#fff; margin-bottom:.8rem;">Thank You, {{ $order->first_name }}!</h1>
    <p style="color:#888; font-size:.95rem; margin-bottom:.5rem;">Your order has been placed and is being processed.</p>
    <div style="display:inline-block; background:#1a1a1a; border:1px solid var(--rog-red); padding:.5rem 1.5rem; margin-bottom:2.5rem;">
        <span style="color:#666; font-size:.8rem; text-transform:uppercase; letter-spacing:.1em;">Order Number: </span>
        <span style="color:var(--rog-red); font-family:'Orbitron',sans-serif; font-weight:700; font-size:.95rem;">{{ $order->order_number }}</span>
    </div>

    {{-- Order Details --}}
    <div style="background:#111; border:1px solid #1e1e1e; text-align:left; margin-bottom:2rem;">
        <div style="padding:1rem 1.5rem; background:#1a1a1a; border-bottom:1px solid #1e1e1e; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:.5rem;">
            <span style="font-weight:700; font-size:.8rem; letter-spacing:.12em; text-transform:uppercase; color:var(--rog-red);">Order Items</span>
            <span style="font-size:.8rem; color:#666;">{{ $order->created_at->format('F j, Y g:i A') }}</span>
        </div>
        @foreach($order->items as $item)
        <div style="display:flex; gap:1rem; padding:1rem 1.5rem; border-bottom:1px solid #1a1a1a; align-items:center;">
            <img src="{{ $item->product->image ?? '' }}" alt="{{ $item->product_name }}"
                 style="width:72px; height:60px; object-fit:contain; background:#0d0d0d; padding:6px; border:1px solid #1e1e1e; flex-shrink:0;"
                 onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=150&q=60'">
            <div style="flex:1;">
                <div style="font-weight:700; color:#ddd; font-size:.9rem; margin-bottom:.2rem;">{{ $item->product_name }}</div>
                <div style="color:#666; font-size:.8rem;">Qty: {{ $item->quantity }} × ${{ number_format($item->price,2) }}</div>
            </div>
            <div style="font-weight:800; color:var(--rog-red); font-size:.95rem;">${{ number_format($item->total,2) }}</div>
        </div>
        @endforeach
        <div style="padding:1rem 1.5rem;">
            <div style="display:flex; justify-content:space-between; font-size:.85rem; color:#666; margin-bottom:.5rem;"><span>Subtotal</span><span style="color:#aaa;">${{ number_format($order->subtotal,2) }}</span></div>
            <div style="display:flex; justify-content:space-between; font-size:.85rem; color:#666; margin-bottom:.5rem;"><span>Tax</span><span style="color:#aaa;">${{ number_format($order->tax,2) }}</span></div>
            <div style="display:flex; justify-content:space-between; font-size:.85rem; color:#666; margin-bottom:.8rem;"><span>Shipping</span><span style="color:{{ $order->shipping == 0 ? '#22c55e' : '#aaa' }};">{{ $order->shipping == 0 ? 'FREE' : '$'.number_format($order->shipping,2) }}</span></div>
            <div style="display:flex; justify-content:space-between; border-top:1px solid #2a2a2a; padding-top:.8rem;">
                <span style="font-weight:800; color:#fff; text-transform:uppercase; letter-spacing:.06em;">Total</span>
                <span style="font-weight:900; font-size:1.3rem; color:var(--rog-red);">${{ number_format($order->total,2) }}</span>
            </div>
        </div>
    </div>

    {{-- Shipping Address --}}
    <div style="background:#111; border:1px solid #1e1e1e; padding:1.4rem 1.5rem; text-align:left; margin-bottom:2.5rem; display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
        <div>
            <div style="font-size:.75rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--rog-red); margin-bottom:.7rem;">Shipping Address</div>
            <div style="color:#aaa; font-size:.88rem; line-height:1.8;">
                {{ $order->first_name }} {{ $order->last_name }}<br>
                {{ $order->address }}<br>
                {{ $order->city }}{{ $order->state ? ', '.$order->state : '' }} {{ $order->zip_code }}<br>
                {{ $order->country }}
            </div>
        </div>
        <div>
            <div style="font-size:.75rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--rog-red); margin-bottom:.7rem;">Payment Info</div>
            <div style="color:#aaa; font-size:.88rem; line-height:1.8;">
                Method: {{ ucwords(str_replace('_',' ',$order->payment_method)) }}<br>
                Status: <span style="color:#22c55e; font-weight:600;">{{ ucfirst($order->payment_status) }}</span><br>
                Email: {{ $order->email }}
            </div>
        </div>
    </div>

    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
        <a href="{{ route('shop') }}" class="btn-rog" style="text-decoration:none; font-size:.9rem;">Continue Shopping</a>
        <a href="{{ route('home') }}" class="btn-rog-outline" style="text-decoration:none; font-size:.9rem;">Back to Home</a>
    </div>
</div>
@endsection
