@extends('admin.layout')
@section('title','All Orders')
@section('page-title','All Orders')

@section('content')

{{-- Filters --}}
<form method="GET" action="{{ route('admin.orders') }}" style="display:flex;gap:.6rem;flex-wrap:wrap;margin-bottom:1.2rem;align-items:center;">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search order, name, email…"
           style="background:var(--adm-surface);border:1px solid var(--adm-border);color:var(--adm-text);padding:.45rem .9rem;border-radius:6px;font-size:.83rem;outline:none;width:220px;font-family:'Rajdhani',sans-serif;">
    <input type="date" name="date" value="{{ request('date') }}"
           style="background:var(--adm-surface);border:1px solid var(--adm-border);color:var(--adm-text);padding:.45rem .9rem;border-radius:6px;font-size:.83rem;outline:none;font-family:'Rajdhani',sans-serif;">
    <select name="status" style="background:var(--adm-surface);border:1px solid var(--adm-border);color:var(--adm-text);padding:.45rem .9rem;border-radius:6px;font-size:.83rem;outline:none;font-family:'Rajdhani',sans-serif;">
        <option value="">All statuses</option>
        @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <button type="submit" style="background:#e5001e;border:none;color:#fff;padding:.45rem 1rem;border-radius:6px;font-size:.83rem;cursor:pointer;font-family:'Rajdhani',sans-serif;font-weight:700;">Filter</button>
    @if(request()->hasAny(['search','date','status']))
    <a href="{{ route('admin.orders') }}" style="font-size:.82rem;color:var(--adm-muted);text-decoration:none;padding:.45rem .6rem;">✕ Clear</a>
    @endif
    <span style="margin-left:auto;font-size:.78rem;color:var(--adm-muted);">{{ $orders->total() }} orders</span>
</form>

<div class="adm-card">
    <div style="overflow-x:auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Items</th>
                    <th>Payment</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Pay Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td style="font-family:'Orbitron',sans-serif;font-size:.72rem;color:#e5001e;font-weight:700;white-space:nowrap;">{{ $order->order_number }}</td>
                    <td>
                        <div style="font-weight:600;font-size:.85rem;">{{ $order->first_name }} {{ $order->last_name }}</div>
                        <div style="font-size:.72rem;color:var(--adm-muted);">{{ $order->email }}</div>
                    </td>
                    <td style="font-size:.8rem;color:var(--adm-muted);">{{ $order->phone }}</td>
                    <td style="font-size:.8rem;color:var(--adm-muted);text-align:center;">{{ $order->items->count() }}</td>
                    <td style="font-size:.78rem;color:var(--adm-muted);white-space:nowrap;">{{ ucwords(str_replace('_',' ',$order->payment_method)) }}</td>
                    <td style="font-weight:700;color:#22c55e;white-space:nowrap;">${{ number_format($order->total,2) }}</td>
                    <td><span class="adm-status adm-status--{{ $order->status }}">{{ $order->status }}</span></td>
                    <td><span class="adm-status adm-status--{{ $order->payment_status === 'paid' ? 'confirmed' : 'pending' }}">{{ $order->payment_status }}</span></td>
                    <td style="font-size:.75rem;color:var(--adm-muted);white-space:nowrap;">{{ $order->created_at->format('M j Y, H:i') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}" style="font-size:.75rem;color:#e5001e;text-decoration:none;">View →</a></td>
                </tr>
                @empty
                <tr><td colspan="10" style="text-align:center;padding:2.5rem;color:var(--adm-muted);">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div style="padding:.8rem 1.2rem;border-top:1px solid var(--adm-border);display:flex;align-items:center;justify-content:space-between;font-size:.78rem;color:var(--adm-muted);">
        <span>Showing {{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ $orders->total() }}</span>
        <div style="display:flex;gap:.4rem;">
            @if($orders->onFirstPage())
                <span style="padding:.3rem .7rem;border:1px solid var(--adm-border);border-radius:4px;opacity:.4;">‹ Prev</span>
            @else
                <a href="{{ $orders->previousPageUrl() }}" style="padding:.3rem .7rem;border:1px solid var(--adm-border);border-radius:4px;color:var(--adm-text);text-decoration:none;">‹ Prev</a>
            @endif
            @if($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" style="padding:.3rem .7rem;border:1px solid #e5001e;border-radius:4px;color:#e5001e;text-decoration:none;">Next ›</a>
            @else
                <span style="padding:.3rem .7rem;border:1px solid var(--adm-border);border-radius:4px;opacity:.4;">Next ›</span>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection
