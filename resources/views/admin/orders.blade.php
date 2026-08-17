@extends('admin.layout')
@section('title','Master Orders Dispatch')
@section('page-title','Orders Dispatch Feed')

@section('content')

{{-- Filters Bar --}}
<form method="GET" action="{{ route('admin.orders') }}" style="display:flex; gap:.75rem; flex-wrap:wrap; margin-bottom:1.4rem; align-items:center; background:var(--adm-surface); padding:.9rem 1.2rem; border-radius:8px; border:1px solid var(--adm-border); backdrop-filter:blur(16px);">
    <div style="position:relative; flex:1; min-width:200px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ref code, customer name, email…"
               style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem 1rem; border-radius:6px; font-size:.85rem; outline:none; width:100%; font-family:'Rajdhani',sans-serif; font-weight:600; transition:border-color .2s;" onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
    </div>
    <div>
        <input type="date" name="date" value="{{ request('date') }}"
               style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem .9rem; border-radius:6px; font-size:.85rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:600;">
    </div>
    <div>
        <select name="status" style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem .9rem; border-radius:6px; font-size:.85rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:700;">
            <option value="">All Telemetry Statuses</option>
            @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" style="background:linear-gradient(135deg, #e5001e, #ff0055); border:none; color:#fff; padding:.55rem 1.4rem; border-radius:6px; font-size:.82rem; cursor:pointer; font-family:'Orbitron',sans-serif; font-weight:800; letter-spacing:.06em; box-shadow:0 0 12px rgba(229,0,30,0.4); transition:all .2s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
        FILTER
    </button>
    @if(request()->hasAny(['search','date','status']))
    <a href="{{ route('admin.orders') }}" style="font-family:'Orbitron',sans-serif; font-size:.75rem; color:#94a3b8; text-decoration:none; padding:.55rem .8rem; font-weight:700;">
        ✕ CLEAR
    </a>
    @endif
    <div style="margin-left:auto; font-family:'Orbitron',sans-serif; font-size:.78rem; color:#c084fc; font-weight:800; display:flex; align-items:center; gap:6px;">
        <span style="color:#e5001e;">●</span> {{ $orders->total() }} TOTAL ORDERS
    </div>
</form>

<div class="adm-card">
    <div class="hud-corner-tl"></div>
    <div style="overflow-x:auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Ref Code</th>
                    <th>Ordered Hardware</th>
                    <th>Customer Name</th>
                    <th>Channel</th>
                    <th>Gross Total</th>
                    <th>Order Status</th>
                    <th>Payment</th>
                    <th>Timestamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td style="font-family:'Orbitron',sans-serif; font-size:.76rem; color:#e5001e; font-weight:800; white-space:nowrap; text-shadow:0 0 8px rgba(229,0,30,0.3);">
                        {{ $order->order_number }}
                    </td>
                    {{-- Customer Ordered Product Images Thumbnail Matrix --}}
                    <td>
                        <div style="display:flex; align-items:center; gap:.45rem; flex-wrap:nowrap;">
                            @foreach($order->items->take(3) as $item)
                            <div style="position:relative; width:44px; height:44px; border-radius:8px; background:rgba(0,0,0,0.6); border:1.5px solid rgba(147,51,234,0.4); overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.5); flex-shrink:0;"
                                 title="{{ $item->product_name }} (Qty: {{ $item->quantity }})">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product_name }}" style="width:100%; height:100%; object-fit:contain; padding:2px; transition:transform .2s;" onmouseover="this.style.transform='scale(1.25)'" onmouseout="this.style.transform='scale(1)'">
                                @else
                                    <div style="font-size:1.1rem;">💻</div>
                                @endif
                                @if($item->quantity > 1)
                                    <span style="position:absolute; bottom:1px; right:1px; background:#e5001e; color:#fff; font-family:'Orbitron',sans-serif; font-size:.55rem; font-weight:900; padding:0 3px; border-radius:3px; line-height:1.2;">
                                        x{{ $item->quantity }}
                                    </span>
                                @endif
                            </div>
                            @endforeach
                            @if($order->items->count() > 3)
                            <span style="font-family:'Orbitron',sans-serif; font-size:.65rem; font-weight:800; color:#c084fc; background:rgba(147,51,234,0.2); border:1px solid rgba(147,51,234,0.45); padding:2px 6px; border-radius:4px; white-space:nowrap;">
                                +{{ $order->items->count() - 3 }}
                            </span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:700; color:#fff; font-size:.88rem;">{{ $order->first_name }} {{ $order->last_name }}</div>
                        <div style="font-size:.72rem; color:#94a3b8;">{{ $order->email }}</div>
                    </td>
                    <td style="font-size:.8rem; color:#cbd5e1; font-weight:700; white-space:nowrap;">
                        {{ ucwords(str_replace('_',' ',$order->payment_method)) }}
                    </td>
                    <td style="font-family:'Orbitron',sans-serif; font-weight:900; color:#34d399; white-space:nowrap; text-shadow:0 0 8px rgba(34,197,94,0.3);">
                        ${{ number_format($order->total,2) }}
                    </td>
                    <td>
                        <span class="adm-status adm-status--{{ $order->status }}">{{ $order->status }}</span>
                    </td>
                    <td>
                        <span class="adm-status adm-status--{{ $order->payment_status === 'paid' ? 'confirmed' : 'pending' }}">
                            {{ $order->payment_status }}
                        </span>
                    </td>
                    <td style="font-family:'Orbitron',sans-serif; font-size:.74rem; color:#94a3b8; white-space:nowrap;">
                        {{ $order->created_at->format('M j Y // H:i') }}
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" style="display:inline-flex; align-items:center; gap:.35rem; background:rgba(229,0,30,0.12); color:#ff4d6d; border:1px solid rgba(229,0,30,0.45); padding:.35rem .8rem; border-radius:5px; font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:800; text-decoration:none; white-space:nowrap; transition:all .2s; box-shadow:0 0 8px rgba(229,0,30,0.15);" onmouseover="this.style.background='rgba(229,0,30,0.25)'; this.style.boxShadow='0 0 15px rgba(229,0,30,0.4)';" onmouseout="this.style.background='rgba(229,0,30,0.12)'; this.style.boxShadow='0 0 8px rgba(229,0,30,0.15)';">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            VIEW
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:3.5rem; color:#94a3b8; font-size:.9rem;">
                        <div style="font-size:2.2rem; margin-bottom:.5rem;">🔍</div>
                        No orders matching the specified filter telemetry.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
    <div style="padding:1rem 1.4rem; border-top:1px solid var(--adm-border); display:flex; align-items:center; justify-content:space-between; font-family:'Orbitron',sans-serif; font-size:.78rem; color:#94a3b8; background:rgba(0,0,0,0.2);">
        <span>SHOWING {{ $orders->firstItem() }}–{{ $orders->lastItem() }} OF {{ $orders->total() }} LOGS</span>
        <div style="display:flex; gap:.5rem;">
            @if($orders->onFirstPage())
                <span style="padding:.35rem .8rem; border:1px solid var(--adm-border); border-radius:4px; opacity:.35; cursor:not-allowed;">‹ PREV</span>
            @else
                <a href="{{ $orders->previousPageUrl() }}" style="padding:.35rem .8rem; border:1px solid var(--adm-border); border-radius:4px; color:#fff; text-decoration:none; background:var(--adm-surface2);">‹ PREV</a>
            @endif
            @if($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" style="padding:.35rem .8rem; border:1px solid #e5001e; border-radius:4px; color:#fff; background:#e5001e; text-decoration:none; box-shadow:0 0 8px rgba(229,0,30,0.4);">NEXT ›</a>
            @else
                <span style="padding:.35rem .8rem; border:1px solid var(--adm-border); border-radius:4px; opacity:.35; cursor:not-allowed;">NEXT ›</span>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection
