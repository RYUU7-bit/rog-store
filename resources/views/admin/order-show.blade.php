@extends('admin.layout')
@section('title','Order '.$order->order_number)
@section('page-title','Order Detail')

@section('content')
<div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.2rem;flex-wrap:wrap;">
    <a href="{{ route('admin.orders') }}" style="font-size:.82rem;color:var(--adm-muted);text-decoration:none;">← Back to orders</a>
    <span style="font-family:'Orbitron',sans-serif;font-weight:900;font-size:1rem;color:#e5001e;">{{ $order->order_number }}</span>
    <span class="adm-status adm-status--{{ $order->status }}">{{ $order->status }}</span>
    <span style="font-size:.75rem;color:var(--adm-muted);">{{ $order->created_at->format('F j, Y  H:i') }}</span>
</div>

<div style="display:grid;grid-template-columns:1fr 320px;gap:1rem;align-items:start;">

    {{-- Left --}}
    <div style="display:flex;flex-direction:column;gap:1rem;">

        {{-- Items --}}
        <div class="adm-card">
            <div class="adm-card-header"><span class="adm-card-title">Order Items ({{ $order->items->count() }})</span></div>
            <table class="adm-table">
                <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:.7rem;">
                                @if($item->product)
                                <img src="{{ $item->product->image }}" alt="{{ $item->product_name }}"
                                     style="width:44px;height:38px;object-fit:contain;background:var(--adm-surface2);border:1px solid var(--adm-border);padding:3px;border-radius:4px;"
                                     onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=80&q=50'">
                                @endif
                                <span style="font-weight:600;font-size:.85rem;">{{ $item->product_name }}</span>
                            </div>
                        </td>
                        <td>${{ number_format($item->price,2) }}</td>
                        <td style="text-align:center;">{{ $item->quantity }}</td>
                        <td style="font-weight:700;color:#22c55e;">${{ number_format($item->total,2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding:1rem 1.2rem;border-top:1px solid var(--adm-border);display:flex;flex-direction:column;gap:.4rem;align-items:flex-end;">
                <div style="display:flex;gap:2rem;font-size:.83rem;color:var(--adm-muted);"><span>Subtotal</span><span style="color:var(--adm-text);">${{ number_format($order->subtotal,2) }}</span></div>
                <div style="display:flex;gap:2rem;font-size:.83rem;color:var(--adm-muted);"><span>Tax (8%)</span><span style="color:var(--adm-text);">${{ number_format($order->tax,2) }}</span></div>
                <div style="display:flex;gap:2rem;font-size:.83rem;color:var(--adm-muted);"><span>Shipping</span><span style="color:{{ $order->shipping == 0 ? '#22c55e' : 'var(--adm-text)' }};">{{ $order->shipping == 0 ? 'FREE' : '$'.number_format($order->shipping,2) }}</span></div>
                <div style="display:flex;gap:2rem;font-size:1rem;font-weight:800;border-top:1px solid var(--adm-border);padding-top:.5rem;"><span style="color:var(--adm-muted);">TOTAL</span><span style="color:#e5001e;">${{ number_format($order->total,2) }}</span></div>
            </div>
        </div>

        {{-- Shipping & Payment --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            <div class="adm-card">
                <div class="adm-card-header"><span class="adm-card-title">Shipping Address</span></div>
                <div style="padding:1rem 1.2rem;font-size:.85rem;color:var(--adm-muted);line-height:1.9;">
                    <div style="color:var(--adm-text);font-weight:700;">{{ $order->first_name }} {{ $order->last_name }}</div>
                    <div>{{ $order->phone }}</div>
                    <div>{{ $order->address }}</div>
                    <div>{{ $order->city }}{{ $order->state ? ', '.$order->state : '' }} {{ $order->zip_code }}</div>
                    <div>{{ $order->country }}</div>
                </div>
            </div>
            <div class="adm-card">
                <div class="adm-card-header"><span class="adm-card-title">Payment Info</span></div>
                <div style="padding:1rem 1.2rem;font-size:.85rem;color:var(--adm-muted);line-height:1.9;">
                    <div><span style="color:var(--adm-text);font-weight:600;">Method:</span> {{ ucwords(str_replace('_',' ',$order->payment_method)) }}</div>
                    <div><span style="color:var(--adm-text);font-weight:600;">Status:</span> <span style="color:#22c55e;font-weight:700;">{{ ucfirst($order->payment_status) }}</span></div>
                    <div><span style="color:var(--adm-text);font-weight:600;">Email:</span> {{ $order->email }}</div>
                    @if($order->notes)
                    <div style="margin-top:.5rem;padding:.5rem .7rem;background:var(--adm-surface2);border:1px solid var(--adm-border);border-radius:4px;font-size:.8rem;">{{ $order->notes }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Right: Update status --}}
    <div style="display:flex;flex-direction:column;gap:1rem;">
        <div class="adm-card">
            <div class="adm-card-header"><span class="adm-card-title">Update Status</span></div>
            <div style="padding:1.2rem;">
                <form action="{{ route('admin.orders.status', $order) }}" method="POST" style="display:flex;flex-direction:column;gap:.7rem;">
                    @csrf @method('PATCH')
                    @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $s)
                    <label style="display:flex;align-items:center;gap:.7rem;cursor:pointer;padding:.5rem .7rem;border:1px solid {{ $order->status === $s ? '#e5001e' : 'var(--adm-border)' }};border-radius:5px;background:{{ $order->status === $s ? 'rgba(229,0,30,.08)' : 'transparent' }};transition:border-color .15s;">
                        <input type="radio" name="status" value="{{ $s }}" {{ $order->status === $s ? 'checked' : '' }} style="accent-color:#e5001e;">
                        <span class="adm-status adm-status--{{ $s }}">{{ $s }}</span>
                    </label>
                    @endforeach
                    <button type="submit" style="background:#e5001e;border:none;color:#fff;padding:.55rem;border-radius:6px;font-weight:700;font-size:.85rem;cursor:pointer;font-family:'Rajdhani',sans-serif;margin-top:.2rem;letter-spacing:.05em;text-transform:uppercase;transition:background .2s;" onmouseover="this.style.background='#b0001a'" onmouseout="this.style.background='#e5001e'">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="adm-card">
            <div class="adm-card-header"><span class="adm-card-title">Order Info</span></div>
            <div style="padding:1rem 1.2rem;display:flex;flex-direction:column;gap:.5rem;font-size:.82rem;">
                <div style="display:flex;justify-content:space-between;"><span style="color:var(--adm-muted);">Placed</span><span>{{ $order->created_at->format('M j, Y H:i') }}</span></div>
                <div style="display:flex;justify-content:space-between;"><span style="color:var(--adm-muted);">Updated</span><span>{{ $order->updated_at->format('M j, Y H:i') }}</span></div>
                <div style="display:flex;justify-content:space-between;"><span style="color:var(--adm-muted);">Order ID</span><span style="color:var(--adm-muted);">#{{ $order->id }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
