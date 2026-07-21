@extends('admin.layout')
@section('title','Dashboard')
@section('page-title','Dashboard')

@section('content')

{{-- ── TODAY HERO ────────────────────────────────────────────────────── --}}
<div style="background:linear-gradient(135deg,rgba(229,0,30,.12) 0%,transparent 60%);border:1px solid rgba(229,0,30,.25);border-radius:10px;padding:1.4rem 1.6rem;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
    <div>
        <div style="font-size:.7rem;color:#e5001e;font-weight:700;letter-spacing:.2em;text-transform:uppercase;margin-bottom:.4rem;">📅 {{ now()->format('l, F j Y') }}</div>
        <div style="font-family:'Orbitron',sans-serif;font-size:1.6rem;font-weight:900;color:var(--adm-text);line-height:1;">
            {{ $todayOrders }}
            <span style="font-size:.9rem;font-weight:700;color:var(--adm-muted);margin-left:.3rem;">orders today</span>
        </div>
        <div style="margin-top:.5rem;display:flex;align-items:center;gap:1.2rem;font-size:.82rem;flex-wrap:wrap;">
            <span style="color:#22c55e;font-weight:700;">💰 ${{ number_format($todayRevenue,2) }} revenue</span>
            <span style="color:var(--adm-muted);">👤 {{ $todayNewCustomers }} customers</span>
            @if($ordersChange >= 0)
                <span style="color:#22c55e;">▲ {{ abs($ordersChange) }}% vs yesterday</span>
            @else
                <span style="color:#ef4444;">▼ {{ abs($ordersChange) }}% vs yesterday</span>
            @endif
        </div>
    </div>
    <div style="text-align:right;">
        <div style="font-size:.7rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.1em;margin-bottom:.3rem;">Yesterday</div>
        <div style="font-size:1.1rem;font-weight:800;color:var(--adm-muted);">{{ $yesterdayOrders }} orders</div>
        <div style="font-size:.8rem;color:var(--adm-muted);">${{ number_format($yesterdayRevenue,2) }}</div>
    </div>
</div>

{{-- ── STAT CARDS ────────────────────────────────────────────────────── --}}
<div class="adm-stats">
    {{-- Today Orders --}}
    <div class="adm-stat adm-stat--today">
        <div class="adm-stat-accent" style="background:rgba(229,0,30,.15);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="2" stroke-linecap="round"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/></svg>
        </div>
        <div class="adm-stat-label">Today's Orders</div>
        <div class="adm-stat-value">{{ $todayOrders }}</div>
        <div class="adm-stat-sub {{ $ordersChange >= 0 ? 'adm-stat-up' : 'adm-stat-down' }}">
            {{ $ordersChange >= 0 ? '▲' : '▼' }} {{ abs($ordersChange) }}%
            <span style="color:var(--adm-muted);">vs yesterday</span>
        </div>
    </div>

    {{-- Today Revenue --}}
    <div class="adm-stat adm-stat--today">
        <div class="adm-stat-accent" style="background:rgba(34,197,94,.12);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <div class="adm-stat-label">Today's Revenue</div>
        <div class="adm-stat-value" style="font-size:1.3rem;">${{ number_format($todayRevenue,2) }}</div>
        <div class="adm-stat-sub {{ $revenueChange >= 0 ? 'adm-stat-up' : 'adm-stat-down' }}">
            {{ $revenueChange >= 0 ? '▲' : '▼' }} {{ abs($revenueChange) }}%
            <span style="color:var(--adm-muted);">vs yesterday</span>
        </div>
    </div>

    {{-- Today Customers --}}
    <div class="adm-stat">
        <div class="adm-stat-accent" style="background:rgba(96,165,250,.12);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="adm-stat-label">Today's Customers</div>
        <div class="adm-stat-value">{{ $todayNewCustomers }}</div>
        <div class="adm-stat-sub adm-stat-neutral">unique emails</div>
    </div>

    {{-- This Month --}}
    <div class="adm-stat">
        <div class="adm-stat-accent" style="background:rgba(167,139,250,.12);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        </div>
        <div class="adm-stat-label">This Month Orders</div>
        <div class="adm-stat-value">{{ $monthOrders }}</div>
        <div class="adm-stat-sub adm-stat-neutral">${{ number_format($monthRevenue,2) }} revenue</div>
    </div>

    {{-- Total Orders --}}
    <div class="adm-stat">
        <div class="adm-stat-accent" style="background:rgba(251,191,36,.1);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <div class="adm-stat-label">Total Orders</div>
        <div class="adm-stat-value">{{ $totalOrders }}</div>
        <div class="adm-stat-sub adm-stat-neutral">${{ number_format($totalRevenue,2) }} all-time</div>
    </div>

    {{-- Products --}}
    <div class="adm-stat">
        <div class="adm-stat-accent" style="background:rgba(229,0,30,.1);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#e5001e" stroke-width="2" stroke-linecap="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        </div>
        <div class="adm-stat-label">Total Products</div>
        <div class="adm-stat-value">{{ $totalProducts }}</div>
        <div class="adm-stat-sub adm-stat-neutral">in catalog</div>
    </div>
</div>

{{-- ── 7-DAY CHART + STATUS BREAKDOWN ───────────────────────────────── --}}
<div class="adm-grid-3" style="margin-bottom:1.5rem;">

    {{-- 7-day bar chart --}}
    <div class="adm-card">
        <div class="adm-card-header">
            <span class="adm-card-title">Orders — Last 7 Days</span>
            <span style="font-size:.75rem;color:var(--adm-muted);">{{ now()->subDays(6)->format('M j') }} – {{ now()->format('M j') }}</span>
        </div>
        <div style="padding:1rem 1.2rem 1.2rem;">
            @php $maxOrders = $last7Days->max('orders') ?: 1; @endphp
            <div class="adm-chart">
                @foreach($last7Days as $day)
                <div class="adm-bar-wrap">
                    <div style="font-size:.65rem;color:var(--adm-muted);text-align:center;margin-bottom:2px;">{{ $day['orders'] ?: '' }}</div>
                    <div class="adm-bar" style="height:{{ max(4, ($day['orders'] / $maxOrders) * 72) }}px;background:{{ $loop->last ? '#e5001e' : 'rgba(229,0,30,.4)' }};"></div>
                    <div class="adm-bar-label">{{ $day['date'] }}</div>
                </div>
                @endforeach
            </div>
            <div style="margin-top:.8rem;display:flex;justify-content:space-between;font-size:.75rem;color:var(--adm-muted);">
                <span>Total: {{ $last7Days->sum('orders') }} orders</span>
                <span>${{ number_format($last7Days->sum('revenue'),2) }}</span>
            </div>
        </div>
    </div>

    {{-- Status + Payment breakdown --}}
    <div style="display:flex;flex-direction:column;gap:1rem;">
        <div class="adm-card">
            <div class="adm-card-header"><span class="adm-card-title">Order Status</span></div>
            <div style="padding:.8rem 1.2rem;display:flex;flex-direction:column;gap:.5rem;">
                @php
                $statusColors=['pending'=>'#f59e0b','confirmed'=>'#22c55e','processing'=>'#60a5fa','shipped'=>'#a78bfa','delivered'=>'#10b981','cancelled'=>'#ef4444'];
                $statusTotal = array_sum($statusBreakdown) ?: 1;
                @endphp
                @foreach($statusColors as $s => $color)
                @php $cnt = $statusBreakdown[$s] ?? 0; @endphp
                <div style="display:flex;align-items:center;gap:.6rem;">
                    <div style="width:8px;height:8px;border-radius:50%;background:{{ $color }};flex-shrink:0;"></div>
                    <div style="flex:1;font-size:.78rem;color:var(--adm-text);text-transform:capitalize;">{{ $s }}</div>
                    <div style="font-size:.78rem;font-weight:700;color:var(--adm-text);">{{ $cnt }}</div>
                    <div style="width:60px;background:var(--adm-border);border-radius:2px;height:5px;overflow:hidden;">
                        <div style="height:100%;background:{{ $color }};width:{{ round(($cnt/$statusTotal)*100) }}%;"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="adm-card">
            <div class="adm-card-header"><span class="adm-card-title">Payment Methods</span></div>
            <div style="padding:.8rem 1.2rem;display:flex;flex-direction:column;gap:.5rem;">
                @php
                $pmColors=['credit_card'=>'#60a5fa','paypal'=>'#fbbf24','bank_transfer'=>'#a78bfa','bakong_khqr'=>'#e5001e'];
                $pmLabels=['credit_card'=>'Credit Card','paypal'=>'PayPal','bank_transfer'=>'Bank Transfer','bakong_khqr'=>'BAKONG KHQR'];
                $pmTotal = array_sum($paymentBreakdown) ?: 1;
                @endphp
                @foreach($paymentBreakdown as $pm => $cnt)
                <div style="display:flex;align-items:center;gap:.6rem;">
                    <div style="width:8px;height:8px;border-radius:50%;background:{{ $pmColors[$pm] ?? '#888' }};flex-shrink:0;"></div>
                    <div style="flex:1;font-size:.78rem;color:var(--adm-text);">{{ $pmLabels[$pm] ?? ucwords(str_replace('_',' ',$pm)) }}</div>
                    <div style="font-size:.78rem;font-weight:700;color:var(--adm-text);">{{ $cnt }}</div>
                </div>
                @endforeach
                @if(empty($paymentBreakdown))
                    <div style="font-size:.78rem;color:var(--adm-muted);">No orders yet</div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ── TODAY'S ORDERS TABLE + TOP PRODUCTS ──────────────────────────── --}}
<div class="adm-grid-2" style="margin-bottom:1.5rem;">

    {{-- Today orders --}}
    <div class="adm-card">
        <div class="adm-card-header">
            <span class="adm-card-title">
                Today's Orders
                @if($todayOrders > 0)
                    <span class="adm-badge" style="margin-left:.5rem;">{{ $todayOrders }}</span>
                @endif
            </span>
            <a href="{{ route('admin.orders', ['date' => now()->format('Y-m-d')]) }}" style="font-size:.75rem;color:#e5001e;text-decoration:none;">View all →</a>
        </div>
        @if($todayOrdersList->isEmpty())
            <div style="padding:2rem;text-align:center;color:var(--adm-muted);font-size:.85rem;">
                <div style="font-size:2rem;margin-bottom:.5rem;">📦</div>
                No orders yet today
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todayOrdersList as $order)
                        <tr>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" style="color:#e5001e;text-decoration:none;font-weight:700;font-size:.78rem;">
                                    {{ $order->order_number }}
                                </a>
                            </td>
                            <td>
                                <div style="font-weight:600;">{{ $order->first_name }} {{ $order->last_name }}</div>
                                <div style="font-size:.72rem;color:var(--adm-muted);">{{ $order->email }}</div>
                            </td>
                            <td style="font-weight:700;color:#22c55e;">${{ number_format($order->total,2) }}</td>
                            <td><span class="adm-status adm-status--{{ $order->status }}">{{ $order->status }}</span></td>
                            <td style="color:var(--adm-muted);font-size:.75rem;">{{ $order->created_at->format('H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Top Products + Low Stock --}}
    <div style="display:flex;flex-direction:column;gap:1rem;">
        <div class="adm-card">
            <div class="adm-card-header"><span class="adm-card-title">🏆 Top Products</span></div>
            <div style="overflow-x:auto;">
                @if($topProducts->isEmpty())
                    <div style="padding:1.2rem;font-size:.82rem;color:var(--adm-muted);text-align:center;">No sales data yet</div>
                @else
                    <table class="adm-table">
                        <thead><tr><th>Product</th><th>Units</th><th>Revenue</th></tr></thead>
                        <tbody>
                            @foreach($topProducts as $p)
                            <tr>
                                <td style="font-size:.8rem;max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $p->product_name }}</td>
                                <td style="font-weight:700;color:#60a5fa;">{{ $p->units }}</td>
                                <td style="font-weight:700;color:#22c55e;">${{ number_format($p->revenue,2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        @if($lowStock->count())
        <div class="adm-card" style="border-color:rgba(245,158,11,.4);">
            <div class="adm-card-header" style="border-color:rgba(245,158,11,.2);">
                <span class="adm-card-title" style="color:#f59e0b;">⚠ Low Stock Alert</span>
                <span class="adm-badge" style="background:#f59e0b;">{{ $lowStock->count() }}</span>
            </div>
            <div style="padding:.6rem 1rem;display:flex;flex-direction:column;gap:.4rem;">
                @foreach($lowStock as $p)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:.4rem .2rem;border-bottom:1px solid var(--adm-border);">
                    <div style="font-size:.8rem;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:160px;">{{ $p->name }}</div>
                    <span style="font-size:.75rem;font-weight:700;color:{{ $p->stock === 0 ? '#ef4444' : '#f59e0b' }};white-space:nowrap;">
                        {{ $p->stock === 0 ? 'OUT' : $p->stock.' left' }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

{{-- ── RECENT ORDERS ─────────────────────────────────────────────────── --}}
<div class="adm-card">
    <div class="adm-card-header">
        <span class="adm-card-title">Recent Orders</span>
        <a href="{{ route('admin.orders') }}" style="font-size:.75rem;color:#e5001e;text-decoration:none;">View all orders →</a>
    </div>
    @if($recentOrders->isEmpty())
        <div style="padding:2.5rem;text-align:center;color:var(--adm-muted);font-size:.88rem;">No orders yet.</div>
    @else
    <div style="overflow-x:auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Payment</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr>
                    <td style="font-family:'Orbitron',sans-serif;font-size:.72rem;color:#e5001e;font-weight:700;">{{ $order->order_number }}</td>
                    <td>
                        <div style="font-weight:600;font-size:.83rem;">{{ $order->first_name }} {{ $order->last_name }}</div>
                        <div style="font-size:.72rem;color:var(--adm-muted);">{{ $order->email }}</div>
                    </td>
                    <td style="color:var(--adm-muted);font-size:.8rem;">{{ $order->items->count() }} item(s)</td>
                    <td style="font-size:.78rem;color:var(--adm-muted);">{{ ucwords(str_replace('_',' ',$order->payment_method)) }}</td>
                    <td style="font-weight:700;color:#22c55e;">${{ number_format($order->total,2) }}</td>
                    <td><span class="adm-status adm-status--{{ $order->status }}">{{ $order->status }}</span></td>
                    <td style="font-size:.75rem;color:var(--adm-muted);white-space:nowrap;">{{ $order->created_at->format('M j, H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" style="font-size:.75rem;color:#e5001e;text-decoration:none;white-space:nowrap;">View →</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<script>
// Auto-refresh stats every 60 seconds
setTimeout(function () { window.location.reload(); }, 60000);
</script>
@endsection
