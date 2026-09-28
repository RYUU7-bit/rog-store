@extends('admin.layout')
@section('title','Command Deck Dashboard')
@section('page-title','Live Command Deck')

@section('content')

{{-- ═══ 1. COMMAND DECK TELEMETRY HERO BAR ═════════════════════════════════════ --}}
<div class="adm-card" style="margin-bottom:1.6rem; border-color:rgba(229,0,30,0.45); background:linear-gradient(135deg, rgba(229,0,30,0.12) 0%, rgba(14,11,28,0.92) 50%, rgba(147,51,234,0.08) 100%);">
    <div class="hud-corner-tl"></div>
    <div class="hud-corner-br"></div>
    
    {{-- Telemetry Strip --}}
    <div style="background:rgba(0,0,0,0.35); border-bottom:1px solid rgba(229,0,30,0.25); padding:.55rem 1.4rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.8rem; font-family:'Orbitron',sans-serif; font-size:.68rem;">
        <div style="display:flex; align-items:center; gap:1.2rem; flex-wrap:wrap;">
            <span style="color:#22c55e; display:flex; align-items:center; gap:5px; font-weight:800;">
                <span class="adm-live-dot" style="width:6px; height:6px;"></span> CORE: 100% OPERATIONAL
            </span>
            <span style="color:#60a5fa; font-weight:700;">⚡ LATENCY: 8ms</span>
            <span style="color:#c084fc; font-weight:700;">💳 BAKONG KHQR: SYNCHRONIZED</span>
            <span style="color:#fbbf24; font-weight:700;">🛡️ 256-BIT ENCRYPTED</span>
        </div>
        <div style="color:#94a3b8; font-weight:700; letter-spacing:.1em;">
            SESSION: #ROG-CORE-{{ strtoupper(substr(md5(now()->format('Ymd')), 0, 6)) }}
        </div>
    </div>

    {{-- Hero Content --}}
    <div style="padding:1.4rem 1.6rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1.2rem;">
        <div>
            <div style="font-size:.72rem; color:#e5001e; font-weight:800; letter-spacing:.2em; text-transform:uppercase; margin-bottom:.35rem; display:flex; align-items:center; gap:6px;">
                <span>📅</span> {{ now()->format('l, F j, Y') }} // LIVE DISPATCH FEED
            </div>
            <div style="font-family:'Orbitron',sans-serif; font-size:1.85rem; font-weight:900; color:#fff; line-height:1.1; text-shadow:0 0 20px rgba(229,0,30,0.5);">
                {{ $todayOrders }}
                <span style="font-size:.95rem; font-weight:700; color:#94a3b8; margin-left:.35rem; text-shadow:none;">orders processed today</span>
            </div>
            <div style="margin-top:.6rem; display:flex; align-items:center; gap:1.4rem; font-size:.86rem; flex-wrap:wrap; font-weight:700;">
                <span style="color:#22c55e; display:flex; align-items:center; gap:4px; text-shadow:0 0 10px rgba(34,197,94,0.4);">
                    💰 ${{ number_format($todayRevenue,2) }} REVENUE
                </span>
                <span style="color:#60a5fa; display:flex; align-items:center; gap:4px;">
                    👤 {{ $todayNewCustomers }} UNIQUE BUYERS
                </span>
                @if($ordersChange >= 0)
                    <span style="color:#22c55e; background:rgba(34,197,94,0.12); padding:2px 8px; border-radius:4px; border:1px solid rgba(34,197,94,0.3);">
                        ▲ +{{ abs($ordersChange) }}% vs yesterday
                    </span>
                @else
                    <span style="color:#ef4444; background:rgba(239,68,68,0.12); padding:2px 8px; border-radius:4px; border:1px solid rgba(239,68,68,0.3);">
                        ▼ -{{ abs($ordersChange) }}% vs yesterday
                    </span>
                @endif
            </div>
        </div>

        {{-- Yesterday Mini Pod --}}
        <div style="background:rgba(0,0,0,0.3); border:1px solid rgba(147,51,234,0.25); border-radius:8px; padding:.9rem 1.2rem; text-align:right; backdrop-filter:blur(10px);">
            <div style="font-size:.68rem; color:#94a3b8; text-transform:uppercase; letter-spacing:.12em; font-weight:800; margin-bottom:.25rem;">Yesterday Benchmark</div>
            <div style="font-family:'Orbitron',sans-serif; font-size:1.15rem; font-weight:800; color:#fff;">{{ $yesterdayOrders }} orders</div>
            <div style="font-size:.82rem; color:#34d399; font-weight:700;">${{ number_format($yesterdayRevenue,2) }}</div>
        </div>
    </div>
</div>

{{-- ═══ 2. 8D ANIMATED HOLOGRAPHIC STAT CARDS ══════════════════════════════════ --}}
<div class="adm-stats">
    
    {{-- Card 1: Today Orders (8D Crimson Quantum Reactor) --}}
    <div class="adm-stat-8d adm-stat-8d--today">
        <div class="hud-corner-tl"></div>
        <div class="adm-stat-header">
            <div class="adm-stat-label">Today's Orders</div>
            <div class="icon-badge-8d" style="color:#e5001e;">
                <div class="icon-badge-8d-inner" style="background:radial-gradient(circle, rgba(229,0,30,0.3) 0%, rgba(14,11,28,0.95) 75%); border-color:rgba(229,0,30,0.6); box-shadow:0 0 15px rgba(229,0,30,0.5);">
                    <div class="laser-sweep"></div>
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ff4d6d" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="filter:drop-shadow(0 0 6px #e5001e);">
                        <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                        <rect x="9" y="3" width="6" height="4" rx="2"/>
                        <path d="M9 12h6M9 16h4"/>
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <div class="adm-stat-value">{{ $todayOrders }}</div>
            <div class="adm-stat-sub {{ $ordersChange >= 0 ? 'adm-stat-up' : 'adm-stat-down' }}">
                <span>{{ $ordersChange >= 0 ? '▲' : '▼' }} {{ abs($ordersChange) }}%</span>
                <span style="color:#94a3b8; font-weight:500;">vs yesterday</span>
            </div>
        </div>
    </div>

    {{-- Card 2: Today Revenue (8D Emerald Cyber Vault) --}}
    <div class="adm-stat-8d adm-stat-8d--today">
        <div class="hud-corner-tl" style="border-top-color:#22c55e; border-left-color:#22c55e;"></div>
        <div class="adm-stat-header">
            <div class="adm-stat-label">Today's Revenue</div>
            <div class="icon-badge-8d" style="color:#22c55e;">
                <div class="icon-badge-8d-inner" style="background:radial-gradient(circle, rgba(34,197,94,0.3) 0%, rgba(14,11,28,0.95) 75%); border-color:rgba(34,197,94,0.6); box-shadow:0 0 15px rgba(34,197,94,0.5);">
                    <div class="laser-sweep" style="background:linear-gradient(90deg, transparent, #22c55e 50%, transparent);"></div>
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="filter:drop-shadow(0 0 6px #22c55e);">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <div class="adm-stat-value" style="font-size:1.45rem; color:#86efac; text-shadow:0 0 15px rgba(34,197,94,0.5);">
                ${{ number_format($todayRevenue,2) }}
            </div>
            <div class="adm-stat-sub {{ $revenueChange >= 0 ? 'adm-stat-up' : 'adm-stat-down' }}">
                <span>{{ $revenueChange >= 0 ? '▲' : '▼' }} {{ abs($revenueChange) }}%</span>
                <span style="color:#94a3b8; font-weight:500;">vs yesterday</span>
            </div>
        </div>
    </div>

    {{-- Card 3: Today Customers (8D Azure Neuro-Link) --}}
    <div class="adm-stat-8d">
        <div class="adm-stat-header">
            <div class="adm-stat-label">Active Buyers</div>
            <div class="icon-badge-8d" style="color:#60a5fa;">
                <div class="icon-badge-8d-inner" style="background:radial-gradient(circle, rgba(59,130,246,0.3) 0%, rgba(14,11,28,0.95) 75%); border-color:rgba(59,130,246,0.6); box-shadow:0 0 15px rgba(59,130,246,0.4);">
                    <div class="laser-sweep" style="background:linear-gradient(90deg, transparent, #60a5fa 50%, transparent);"></div>
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="filter:drop-shadow(0 0 6px #3b82f6);">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <div class="adm-stat-value">{{ $todayNewCustomers }}</div>
            <div class="adm-stat-sub adm-stat-neutral">verified customers</div>
        </div>
    </div>

    {{-- Card 4: Month Orders (8D Neon Amethyst Gyroscope) --}}
    <div class="adm-stat-8d">
        <div class="adm-stat-header">
            <div class="adm-stat-label">This Month</div>
            <div class="icon-badge-8d" style="color:#a78bfa;">
                <div class="icon-badge-8d-inner" style="background:radial-gradient(circle, rgba(168,85,247,0.3) 0%, rgba(14,11,28,0.95) 75%); border-color:rgba(168,85,247,0.6); box-shadow:0 0 15px rgba(168,85,247,0.4);">
                    <div class="laser-sweep" style="background:linear-gradient(90deg, transparent, #c084fc 50%, transparent);"></div>
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c084fc" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="filter:drop-shadow(0 0 6px #a855f7);">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <div class="adm-stat-value">{{ $monthOrders }}</div>
            <div class="adm-stat-sub adm-stat-neutral">${{ number_format($monthRevenue,2) }} monthly</div>
        </div>
    </div>

    {{-- Card 5: Total Orders (8D Core Amber Tachyon) --}}
    <div class="adm-stat-8d">
        <div class="adm-stat-header">
            <div class="adm-stat-label">Total Volume</div>
            <div class="icon-badge-8d" style="color:#fbbf24;">
                <div class="icon-badge-8d-inner" style="background:radial-gradient(circle, rgba(245,158,11,0.3) 0%, rgba(14,11,28,0.95) 75%); border-color:rgba(245,158,11,0.6); box-shadow:0 0 15px rgba(245,158,11,0.4);">
                    <div class="laser-sweep" style="background:linear-gradient(90deg, transparent, #fbbf24 50%, transparent);"></div>
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fcd34d" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="filter:drop-shadow(0 0 6px #f59e0b);">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <div class="adm-stat-value">{{ $totalOrders }}</div>
            <div class="adm-stat-sub adm-stat-neutral">${{ number_format($totalRevenue,2) }} all-time</div>
        </div>
    </div>

    {{-- Card 6: Total Products (8D Titanium Hardware Grid) --}}
    <div class="adm-stat-8d">
        <div class="adm-stat-header">
            <div class="adm-stat-label">Hardware Grid</div>
            <div class="icon-badge-8d" style="color:#f43f5e;">
                <div class="icon-badge-8d-inner" style="background:radial-gradient(circle, rgba(244,63,94,0.3) 0%, rgba(14,11,28,0.95) 75%); border-color:rgba(244,63,94,0.6); box-shadow:0 0 15px rgba(244,63,94,0.4);">
                    <div class="laser-sweep" style="background:linear-gradient(90deg, transparent, #f43f5e 50%, transparent);"></div>
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fb7185" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="filter:drop-shadow(0 0 6px #e11d48);">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                        <line x1="12" y1="22.08" x2="12" y2="12"/>
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <div class="adm-stat-value">{{ $totalProducts }}</div>
            <div class="adm-stat-sub adm-stat-neutral">active SKUs</div>
        </div>
    </div>

</div>

{{-- ═══ 3. 7-DAY VISUAL TELEMETRY CHART + STATUS DISTRIBUTION ═════════════════ --}}
<div class="adm-grid-3" style="margin-bottom:1.6rem;">

    {{-- 7-Day Visual Telemetry Equalizer Chart --}}
    <div class="adm-card">
        <div class="hud-corner-tl"></div>
        <div class="adm-card-header">
            <span class="adm-card-title">
                <span style="color:#e5001e;">⚡</span> 7-Day Order Velocity Spectrum
            </span>
            <span style="font-family:'Orbitron',sans-serif; font-size:.72rem; color:#94a3b8; font-weight:700;">
                {{ now()->subDays(6)->format('M j') }} – {{ now()->format('M j, Y') }}
            </span>
        </div>
        <div style="padding:1.4rem 1.6rem 1.2rem;">
            @php $maxOrders = $last7Days->max('orders') ?: 1; @endphp
            
            {{-- Holographic Equalizer Bars --}}
            <div style="display:flex; align-items:flex-end; gap:.7rem; height:120px; padding:0 .4rem; position:relative; border-bottom:1px dashed rgba(147,51,234,0.3);">
                @foreach($last7Days as $day)
                @php 
                    $pct = max(6, ($day['orders'] / $maxOrders) * 100); 
                    $isPeak = $day['orders'] == $maxOrders && $day['orders'] > 0;
                @endphp
                <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:.4rem; position:relative;" title="{{ $day['full'] }}: {{ $day['orders'] }} orders (${{ number_format($day['revenue'],2) }})">
                    
                    {{-- Order count pill on hover/peak --}}
                    <div style="font-family:'Orbitron',sans-serif; font-size:.68rem; font-weight:800; color:{{ $loop->last ? '#ff4d6d' : '#cbd5e1' }};">
                        {{ $day['orders'] ?: '0' }}
                    </div>

                    {{-- Dynamic Equalizer Bar --}}
                    <div style="width:100%; height:{{ $pct }}px; border-radius:4px 4px 0 0; position:relative; overflow:hidden; transition:height .5s cubic-bezier(0.2, 0.8, 0.2, 1);
                                background:{{ $loop->last ? 'linear-gradient(180deg, #ff0055 0%, #e5001e 50%, #7e22ce 100%)' : 'linear-gradient(180deg, rgba(168,85,247,0.7) 0%, rgba(99,102,241,0.4) 100%)' }};
                                box-shadow:{{ $loop->last ? '0 0 15px rgba(229,0,30,0.6)' : '0 0 8px rgba(168,85,247,0.25)' }};">
                        
                        {{-- Top laser cap --}}
                        <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#fff; box-shadow:0 0 6px #fff;"></div>
                    </div>

                    {{-- Day Label --}}
                    <div style="font-family:'Orbitron',sans-serif; font-size:.68rem; font-weight:700; color:{{ $loop->last ? '#e5001e' : '#94a3b8' }}; margin-top:.2rem;">
                        {{ $day['date'] }}
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Summary Footer --}}
            <div style="margin-top:1.1rem; display:flex; justify-content:space-between; align-items:center; font-family:'Orbitron',sans-serif; font-size:.78rem; color:#cbd5e1; font-weight:700;">
                <span style="display:flex; align-items:center; gap:6px;">
                    <span style="color:#e5001e;">●</span> 7-Day Volume: <strong style="color:#fff;">{{ $last7Days->sum('orders') }} Orders</strong>
                </span>
                <span style="color:#34d399; text-shadow:0 0 10px rgba(34,197,94,0.4);">
                    ${{ number_format($last7Days->sum('revenue'),2) }} Total
                </span>
            </div>
        </div>
    </div>

    {{-- Order Status & Payment Breakdown Deck --}}
    <div style="display:flex; flex-direction:column; gap:1.2rem;">
        
        {{-- Status Breakdown Card --}}
        <div class="adm-card">
            <div class="adm-card-header">
                <span class="adm-card-title">
                    <span style="color:#a855f7;">◈</span> Order Status Matrix
                </span>
            </div>
            <div style="padding:1rem 1.3rem; display:flex; flex-direction:column; gap:.65rem;">
                @php
                $statusColors = [
                    'confirmed'  => ['#22c55e', '#86efac'],
                    'pending'    => ['#f59e0b', '#fbbf24'],
                    'processing' => ['#3b82f6', '#93c5fd'],
                    'shipped'    => ['#a855f7', '#d8b4fe'],
                    'delivered'  => ['#10b981', '#6ee7b7'],
                    'cancelled'  => ['#ef4444', '#fca5a5']
                ];
                $statusTotal = array_sum($statusBreakdown) ?: 1;
                @endphp
                @foreach($statusColors as $s => $palette)
                @php $cnt = $statusBreakdown[$s] ?? 0; @endphp
                <div style="display:flex; align-items:center; gap:.7rem; font-size:.82rem;">
                    <div style="width:8px; height:8px; border-radius:50%; background:{{ $palette[0] }}; box-shadow:0 0 6px {{ $palette[0] }}; flex-shrink:0;"></div>
                    <div style="flex:1; font-weight:700; color:#e2e8f0; text-transform:capitalize;">{{ $s }}</div>
                    <div style="font-family:'Orbitron',sans-serif; font-weight:800; color:{{ $palette[1] }}; font-size:.82rem;">{{ $cnt }}</div>
                    <div style="width:75px; background:rgba(255,255,255,0.06); border-radius:3px; height:6px; overflow:hidden; border:1px solid rgba(255,255,255,0.1);">
                        <div style="height:100%; background:{{ $palette[0] }}; width:{{ round(($cnt/$statusTotal)*100) }}%; box-shadow:0 0 6px {{ $palette[0] }};"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Payment Methods Gateway Card --}}
        <div class="adm-card">
            <div class="adm-card-header">
                <span class="adm-card-title">
                    <span style="color:#e5001e;">💳</span> Payment Channels
                </span>
            </div>
            <div style="padding:1rem 1.3rem; display:flex; flex-direction:column; gap:.65rem;">
                @php
                $pmColors = [
                    'bakong_khqr'   => ['#e5001e', 'BAKONG KHQR (National Hub)'],
                    'credit_card'   => ['#3b82f6', 'Credit / Debit Card'],
                    'paypal'        => ['#fbbf24', 'PayPal Express'],
                    'bank_transfer' => ['#a855f7', 'Direct Bank Wire']
                ];
                $pmTotal = array_sum($paymentBreakdown) ?: 1;
                @endphp
                @foreach($paymentBreakdown as $pm => $cnt)
                <div style="display:flex; align-items:center; gap:.7rem; font-size:.82rem;">
                    <div style="width:8px; height:8px; border-radius:50%; background:{{ $pmColors[$pm][0] ?? '#888' }}; box-shadow:0 0 6px {{ $pmColors[$pm][0] ?? '#888' }}; flex-shrink:0;"></div>
                    <div style="flex:1; font-weight:700; color:#e2e8f0;">{{ $pmColors[$pm][1] ?? ucwords(str_replace('_',' ',$pm)) }}</div>
                    <div style="font-family:'Orbitron',sans-serif; font-weight:800; color:#fff;">{{ $cnt }}</div>
                </div>
                @endforeach
                @if(empty($paymentBreakdown))
                    <div style="font-size:.8rem; color:#94a3b8; text-align:center; padding:.4rem;">No payment transactions recorded</div>
                @endif
            </div>
        </div>

    </div>
</div>

{{-- ═══ 4. TODAY'S ORDERS DISPATCH FEED + TOP HARDWARE LEADERBOARD ════════════ --}}
<div class="adm-grid-2" style="margin-bottom:1.6rem;">

    {{-- Today's Live Orders Feed Table with Product Thumbnail Previews --}}
    <div class="adm-card">
        <div class="hud-corner-tl"></div>
        <div class="adm-card-header">
            <span class="adm-card-title">
                <span style="color:#e5001e;">⚡</span> Today's Dispatch Feed
                @if($todayOrders > 0)
                    <span class="adm-badge" style="margin-left:.4rem;">{{ $todayOrders }} LIVE</span>
                @endif
            </span>
            <a href="{{ route('admin.orders', ['date' => now()->format('Y-m-d')]) }}" style="font-family:'Orbitron',sans-serif; font-size:.72rem; color:#e5001e; font-weight:800; text-decoration:none; display:inline-flex; align-items:center; gap:3px;">
                EXPAND FEED →
            </a>
        </div>
        @if($todayOrdersList->isEmpty())
            <div style="padding:3rem 1.5rem; text-align:center; color:#94a3b8; font-size:.9rem;">
                <div style="font-size:2.4rem; margin-bottom:.6rem; filter:drop-shadow(0 0 10px rgba(147,51,234,0.4));">📡</div>
                <div style="font-family:'Orbitron',sans-serif; font-weight:700; color:#cbd5e1;">Awaiting Incoming Orders</div>
                <div style="font-size:.78rem; margin-top:.2rem;">Telemetry node is listening for new customer checkout streams.</div>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>Ref Code</th>
                            <th>Ordered Hardware</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todayOrdersList as $order)
                        <tr>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" style="color:#e5001e; text-decoration:none; font-family:'Orbitron',sans-serif; font-weight:800; font-size:.76rem; text-shadow:0 0 8px rgba(229,0,30,0.4);">
                                    {{ $order->order_number }}
                                </a>
                            </td>
                            {{-- Product Images Preview Pod --}}
                            <td>
                                <div style="display:flex; align-items:center; gap:.45rem; flex-wrap:nowrap;">
                                    @foreach($order->items->take(3) as $item)
                                    <div style="position:relative; width:44px; height:44px; border-radius:8px; background:rgba(0,0,0,0.6); border:1.5px solid rgba(147,51,234,0.4); overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.5); flex-shrink:0;"
                                         title="{{ $item->product_name }} (Qty: {{ $item->quantity }})">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ $item->product->image }}" alt="{{ $item->product_name }}" style="width:100%; height:100%; object-fit:contain; padding:2px; transition:transform .2s;" onmouseover="this.style.transform='scale(1.25)'" onmouseout="this.style.transform='scale(1)'"
                                                 onerror="this.onerror=null; this.src='/images/product-fallback.svg';">
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
                                <div style="font-weight:700; color:#fff;">{{ $order->first_name }} {{ $order->last_name }}</div>
                                <div style="font-size:.72rem; color:#94a3b8;">{{ $order->email }}</div>
                            </td>
                            <td style="font-family:'Orbitron',sans-serif; font-weight:800; color:#34d399; text-shadow:0 0 8px rgba(34,197,94,0.3);">
                                ${{ number_format($order->total,2) }}
                            </td>
                            <td>
                                <span class="adm-status adm-status--{{ $order->status }}">{{ $order->status }}</span>
                            </td>
                            <td style="font-family:'Orbitron',sans-serif; color:#94a3b8; font-size:.75rem;">
                                {{ $order->created_at->format('H:i:s') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Top Hardware Leaderboard & Stock Sentinel --}}
    <div style="display:flex; flex-direction:column; gap:1.2rem;">
        
        {{-- Top Products --}}
        <div class="adm-card">
            <div class="adm-card-header">
                <span class="adm-card-title">
                    <span style="color:#fbbf24;">🏆</span> Top Selling Hardware
                </span>
            </div>
            <div style="overflow-x:auto;">
                @if($topProducts->isEmpty())
                    <div style="padding:1.8rem; font-size:.85rem; color:#94a3b8; text-align:center;">No hardware sales telemetry available</div>
                @else
                    <table class="adm-table">
                        <thead>
                            <tr>
                                <th>Product Model</th>
                                <th>Units</th>
                                <th>Gross Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts as $p)
                            <tr>
                                <td style="font-weight:700; color:#fff; font-size:.84rem; max-width:180px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                    {{ $p->product_name }}
                                </td>
                                <td style="font-family:'Orbitron',sans-serif; font-weight:800; color:#60a5fa;">
                                    {{ $p->units }}
                                </td>
                                <td style="font-family:'Orbitron',sans-serif; font-weight:800; color:#34d399;">
                                    ${{ number_format($p->revenue,2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        {{-- Low Stock Sentinel Alert --}}
        @if($lowStock->count())
        <div class="adm-card" style="border-color:rgba(245,158,11,0.5); background:linear-gradient(135deg, rgba(245,158,11,0.08) 0%, var(--adm-surface) 100%);">
            <div class="adm-card-header" style="border-color:rgba(245,158,11,0.3);">
                <span class="adm-card-title" style="color:#fbbf24;">
                    <span>⚠️</span> Stock Sentinel Warning
                </span>
                <span class="adm-badge" style="background:#f59e0b; color:#000;">{{ $lowStock->count() }} CRITICAL</span>
            </div>
            <div style="padding:.7rem 1.2rem; display:flex; flex-direction:column; gap:.45rem;">
                @foreach($lowStock as $p)
                <div style="display:flex; align-items:center; justify-content:space-between; padding:.45rem 0; border-bottom:1px solid rgba(245,158,11,0.15); gap:.6rem;">
                    <div style="font-size:.85rem; font-weight:700; color:#fff; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:160px;">
                        {{ $p->name }}
                    </div>
                    <div style="display:flex; align-items:center; gap:.5rem; margin-left:auto;">
                        <span style="font-family:'Orbitron',sans-serif; font-size:.74rem; font-weight:900; color:{{ $p->stock === 0 ? '#ef4444' : '#fbbf24' }}; white-space:nowrap; text-shadow:0 0 6px currentColor;">
                            {{ $p->stock === 0 ? 'DEPLETED' : $p->stock.' UNITS' }}
                        </span>
                        <button type="button" onclick="openQuickEdit({{ $p->id }})" class="btn-rog" style="padding:2px 8px; font-size:.65rem; font-family:'Orbitron',sans-serif; border-radius:4px; cursor:pointer;" title="Quick Edit Stock">
                            ⚡ EDIT
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

{{-- ═══ 5. HARDWARE FLEET & LIVE MANAGEMENT CONSOLE ═════════════════════════ --}}
<div class="adm-card" id="hardwareFleetSection" style="margin-bottom:1.6rem; border-color:rgba(229,0,30,0.5); box-shadow:0 10px 40px rgba(0,0,0,0.6), 0 0 25px rgba(229,0,30,0.15);">
    <div class="hud-corner-tl"></div>
    <div class="hud-corner-br"></div>
    
    {{-- Header & Metrics --}}
    <div class="adm-card-header" style="flex-wrap:wrap; gap:1rem; padding:1.1rem 1.4rem; background:rgba(20,16,38,0.95);">
        <div>
            <div style="display:flex; align-items:center; gap:.6rem;">
                <span style="display:inline-flex; width:10px; height:10px; border-radius:50%; background:#e5001e; box-shadow:0 0 10px #e5001e; animation:pulse-beacon 1.2s infinite;"></span>
                <span class="adm-card-title" style="font-size:1.05rem; letter-spacing:.05em;">
                    ⚡ Hardware Fleet & Live Quick-Editor
                </span>
                <span class="adm-badge" id="productCountBadge" style="background:rgba(229,0,30,0.18); border:1px solid rgba(229,0,30,0.4); color:#ff4d6d; font-family:'Orbitron',sans-serif; font-size:.68rem;">
                    {{ $dashboardProducts->count() }} ACTIVE SKUS
                </span>
            </div>
            <div style="font-size:.76rem; color:#94a3b8; margin-top:.25rem; font-weight:600;">
                Live inventory control: Edit specifications, update pricing, tune stock reserves, change imagery, and deploy new hardware directly without leaving dashboard.
            </div>
        </div>

        <div style="display:flex; align-items:center; gap:.8rem; flex-wrap:wrap; margin-left:auto;">
            <button type="button" onclick="openCreateModal()" class="btn-rog" style="display:inline-flex; align-items:center; gap:6px; padding:.55rem 1.2rem; font-size:.8rem; border-radius:6px; font-weight:800; letter-spacing:.06em; cursor:pointer; box-shadow:0 0 16px rgba(229,0,30,0.4); font-family:'Orbitron',sans-serif;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                + DEPLOY NEW HARDWARE
            </button>
            <a href="{{ route('admin.products') }}" style="font-family:'Orbitron',sans-serif; font-size:.74rem; color:#c084fc; font-weight:800; text-decoration:none; display:inline-flex; align-items:center; gap:4px; padding:.55rem .9rem; background:rgba(147,51,234,0.15); border:1px solid rgba(147,51,234,0.4); border-radius:6px; transition:all .2s;" onmouseover="this.style.background='rgba(147,51,234,0.3)'" onmouseout="this.style.background='rgba(147,51,234,0.15)'">
                FULL INVENTORY GRID →
            </a>
        </div>
    </div>

    {{-- Filter Toolbar --}}
    <div style="padding:.8rem 1.4rem; background:rgba(10,8,20,0.8); border-bottom:1px solid var(--adm-border); display:flex; align-items:center; gap:1rem; flex-wrap:wrap;">
        <div style="position:relative; flex:1; min-width:240px;">
            <input type="text" id="productSearchInput" placeholder="Instant search by model name, SKU, or specs…" oninput="filterDashboardProducts()"
                   style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem .9rem .55rem 2.2rem; border-radius:6px; font-size:.85rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:600; transition:all .2s;"
                   onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" style="position:absolute; left:.75rem; top:50%; transform:translateY(-50%); pointer-events:none;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <div>
            <select id="productCatFilter" onchange="filterDashboardProducts()"
                    style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem .9rem; border-radius:6px; font-size:.84rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:700;">
                <option value="">All Categories ({{ $dashboardProducts->count() }})</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <select id="productStatusFilter" onchange="filterDashboardProducts()"
                    style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem .9rem; border-radius:6px; font-size:.84rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:700;">
                <option value="">All States</option>
                <option value="active">Active Only</option>
                <option value="offline">Offline Only</option>
                <option value="sale">On Sale Only</option>
                <option value="lowstock">Low Stock (≤5 Units)</option>
                <option value="featured">Featured Hardware Only</option>
            </select>
        </div>
        <div id="filterResultCount" style="font-family:'Orbitron',sans-serif; font-size:.72rem; color:#94a3b8; font-weight:700; margin-left:auto;">
            Displaying {{ $dashboardProducts->count() }} SKUs
        </div>
    </div>

    {{-- Product Table Grid --}}
    <div style="overflow-x:auto; max-height:580px; overflow-y:auto;" class="adm-custom-scrollbar">
        <table class="adm-table" id="dashboardProductTable">
            <thead style="position:sticky; top:0; z-index:5; background:rgba(18,14,35,0.98); backdrop-filter:blur(10px);">
                <tr>
                    <th style="width:60px;">Asset</th>
                    <th>Hardware Model & SKU</th>
                    <th>Category</th>
                    <th>Price / Sale</th>
                    <th style="min-width:140px;">Stock Reserve Control</th>
                    <th>Catalog State</th>
                    <th>Featured</th>
                    <th style="text-align:right; min-width:200px;">Actions</th>
                </tr>
            </thead>
            <tbody id="dashboardProductTableBody">
                @foreach($dashboardProducts as $p)
                <tr id="product-row-{{ $p->id }}" 
                    data-id="{{ $p->id }}"
                    data-name="{{ strtolower($p->name) }}"
                    data-sku="{{ strtolower($p->sku) }}"
                    data-cat="{{ $p->category_id }}"
                    data-active="{{ $p->is_active ? '1' : '0' }}"
                    data-featured="{{ $p->is_featured ? '1' : '0' }}"
                    data-sale="{{ $p->sale_price ? '1' : '0' }}"
                    data-stock="{{ $p->stock }}">
                    
                    {{-- Asset Thumbnail --}}
                    <td>
                        <div style="position:relative; width:48px; height:48px; border-radius:8px; background:rgba(0,0,0,0.6); border:1.5px solid rgba(147,51,234,0.35); overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 0 10px rgba(0,0,0,0.4); cursor:pointer;" onclick="openQuickEdit({{ $p->id }})" title="Click to Quick Edit">
                            <img id="row-img-{{ $p->id }}" src="{{ $p->image }}" alt="{{ $p->name }}"
                                 style="width:100%; height:100%; object-fit:contain; padding:3px; transition:transform .2s;"
                                 onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"
                                 onerror="this.onerror=null; this.src='/images/product-fallback.svg';">
                        </div>
                    </td>

                    {{-- Name & SKU --}}
                    <td>
                        <div style="display:flex; align-items:center; gap:6px;">
                            <a href="javascript:void(0)" onclick="openQuickEdit({{ $p->id }})" id="row-name-{{ $p->id }}" style="font-weight:700; font-size:.9rem; color:#fff; text-decoration:none; max-width:240px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#fff'">
                                {{ $p->name }}
                            </a>
                            @if($p->sale_price)
                                <span id="row-badge-sale-{{ $p->id }}" style="background:rgba(229,0,30,.18); border:1px solid rgba(229,0,30,0.5); color:#ff4d6d; font-family:'Orbitron',sans-serif; font-size:.62rem; font-weight:900; padding:1px 6px; border-radius:8px;">
                                    -{{ $p->discount_percent }}%
                                </span>
                            @endif
                        </div>
                        <div style="font-family:'Orbitron',sans-serif; font-size:.68rem; color:#94a3b8; margin-top:2px;">
                            SKU: <span id="row-sku-{{ $p->id }}" style="color:#cbd5e1; font-weight:700;">{{ $p->sku }}</span> 
                            &bull; <a href="{{ route('product.show', $p->slug) }}" target="_blank" style="color:#64748b; text-decoration:none;" onmouseover="this.style.color='#60a5fa'" onmouseout="this.style.color='#64748b'">/{{ $p->slug }} ↗</a>
                        </div>
                    </td>

                    {{-- Category --}}
                    <td>
                        <span id="row-cat-{{ $p->id }}" style="font-size:.78rem; font-weight:700; color:#c084fc; background:rgba(147,51,234,0.12); padding:3px 8px; border-radius:4px; border:1px solid rgba(147,51,234,0.3);">
                            {{ $p->category->name ?? 'Hardware' }}
                        </span>
                    </td>

                    {{-- Pricing --}}
                    <td>
                        <div id="row-pricing-{{ $p->id }}">
                            @if($p->sale_price)
                                <div style="font-family:'Orbitron',sans-serif; font-weight:900; color:#34d399; font-size:.9rem; text-shadow:0 0 8px rgba(34,197,94,0.4);">
                                    ${{ number_format($p->sale_price, 2) }}
                                </div>
                                <div style="font-size:.72rem; color:#64748b; text-decoration:line-through; font-family:'Orbitron',sans-serif;">
                                    ${{ number_format($p->price, 2) }}
                                </div>
                            @else
                                <div style="font-family:'Orbitron',sans-serif; font-weight:800; color:#fff; font-size:.9rem;">
                                    ${{ number_format($p->price, 2) }}
                                </div>
                            @endif
                        </div>
                    </td>

                    {{-- Live Stock Quick Control --}}
                    <td>
                        <div style="display:inline-flex; align-items:center; background:rgba(0,0,0,0.55); border:1px solid rgba(147,51,234,0.35); border-radius:6px; padding:2px;">
                            <button type="button" onclick="quickAdjustStock({{ $p->id }}, -1)" style="background:rgba(255,255,255,0.06); border:none; color:#fff; cursor:pointer; width:26px; height:26px; border-radius:4px; font-weight:900; font-size:.95rem; display:flex; align-items:center; justify-content:center; transition:background .15s;" onmouseover="this.style.background='#e5001e'" onmouseout="this.style.background='rgba(255,255,255,0.06)'" title="Decrease Stock by 1">−</button>
                            
                            <input type="number" id="stock-input-{{ $p->id }}" value="{{ $p->stock }}" min="0"
                                   style="width:48px; background:transparent; border:none; color:{{ $p->stock === 0 ? '#ef4444' : ($p->stock <= 5 ? '#fbbf24' : '#86efac') }}; text-align:center; font-family:'Orbitron',sans-serif; font-weight:800; font-size:.85rem; outline:none;"
                                   onchange="submitQuickStock({{ $p->id }}, this.value)">
                            
                            <button type="button" onclick="quickAdjustStock({{ $p->id }}, 1)" style="background:rgba(255,255,255,0.06); border:none; color:#fff; cursor:pointer; width:26px; height:26px; border-radius:4px; font-weight:900; font-size:.95rem; display:flex; align-items:center; justify-content:center; transition:background .15s;" onmouseover="this.style.background='#22c55e'" onmouseout="this.style.background='rgba(255,255,255,0.06)'" title="Increase Stock by 1">+</button>
                        </div>
                    </td>

                    {{-- Active Toggle --}}
                    <td>
                        <button type="button" id="btn-toggle-active-{{ $p->id }}" onclick="toggleProductActive({{ $p->id }})" 
                                style="background:none; border:none; cursor:pointer; padding:0;">
                            <span class="adm-status {{ $p->is_active ? 'adm-status--confirmed' : 'adm-status--cancelled' }}" id="status-badge-{{ $p->id }}">
                                {{ $p->is_active ? 'Active' : 'Offline' }}
                            </span>
                        </button>
                    </td>

                    {{-- Featured Toggle --}}
                    <td>
                        <button type="button" id="btn-toggle-feat-{{ $p->id }}" onclick="toggleProductFeatured({{ $p->id }})"
                                style="background:none; border:none; cursor:pointer; font-size:1.15rem; color:{{ $p->is_featured ? '#fbbf24' : '#475569' }}; transition:all .2s; filter:drop-shadow(0 0 {{ $p->is_featured ? '6px #fbbf24' : '0' }});"
                                title="{{ $p->is_featured ? 'Featured Hardware (Click to toggle)' : 'Not Featured (Click to toggle)' }}">
                            {{ $p->is_featured ? '★' : '☆' }}
                        </button>
                    </td>

                    {{-- Actions Pod --}}
                    <td style="text-align:right;">
                        <div style="display:inline-flex; align-items:center; gap:.4rem; justify-content:flex-end;">
                            {{-- Quick Edit Modal Trigger --}}
                            <button type="button" onclick="openQuickEdit({{ $p->id }})" 
                                    style="background:linear-gradient(135deg, rgba(229,0,30,0.2), rgba(147,51,234,0.2)); border:1.5px solid rgba(229,0,30,0.55); color:#fff; padding:.35rem .75rem; border-radius:6px; font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:800; cursor:pointer; display:inline-flex; align-items:center; gap:4px; box-shadow:0 0 10px rgba(229,0,30,0.25); transition:all .2s;"
                                    onmouseover="this.style.transform='scale(1.05)'; this.style.borderColor='#e5001e'; this.style.boxShadow='0 0 16px rgba(229,0,30,0.5)';"
                                    onmouseout="this.style.transform='scale(1)'; this.style.borderColor='rgba(229,0,30,0.55)'; this.style.boxShadow='0 0 10px rgba(229,0,30,0.25)';"
                                    title="Quick Hologram Editor">
                                ⚡ EDIT
                            </button>

                            {{-- Full Edit Page Link --}}
                            <a href="{{ route('admin.products.edit', $p) }}" 
                               style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.15); color:#cbd5e1; padding:.35rem .55rem; border-radius:6px; font-size:.72rem; text-decoration:none; display:inline-flex; align-items:center;"
                               title="Open in Dedicated Editor Page">
                                ↗
                            </a>

                            {{-- Delete Product --}}
                            <button type="button" onclick="confirmDeleteProduct({{ $p->id }}, '{{ addslashes($p->name) }}')"
                                    style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.3); color:#ef4444; padding:.35rem .55rem; border-radius:6px; font-size:.72rem; cursor:pointer; display:inline-flex; align-items:center;"
                                    title="Delete / Deactivate Hardware">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ═══ 6. RECENT TRANSACTIONS TERMINAL ═══════════════════════════════════════ --}}
<div class="adm-card">
    <div class="hud-corner-tl"></div>
    <div class="adm-card-header">
        <span class="adm-card-title">
            <span style="color:#a855f7;">🌐</span> Master Transactions Stream
        </span>
        <a href="{{ route('admin.orders') }}" style="font-family:'Orbitron',sans-serif; font-size:.72rem; color:#c084fc; font-weight:800; text-decoration:none; display:inline-flex; align-items:center; gap:3px;">
            FULL ARCHIVE →
        </a>
    </div>
    @if($recentOrders->isEmpty())
        <div style="padding:3rem; text-align:center; color:#94a3b8; font-size:.9rem;">No transaction logs recorded.</div>
    @else
    <div style="overflow-x:auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Order Identifier</th>
                    <th>Ordered Hardware</th>
                    <th>Customer Name & Contact</th>
                    <th>Payment Channel</th>
                    <th>Total Value</th>
                    <th>Status</th>
                    <th>Timestamp</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr>
                    <td style="font-family:'Orbitron',sans-serif; font-size:.76rem; color:#e5001e; font-weight:800; text-shadow:0 0 8px rgba(229,0,30,0.3);">
                        {{ $order->order_number }}
                    </td>
                    {{-- Product Images Preview Pod --}}
                    <td>
                        <div style="display:flex; align-items:center; gap:.45rem; flex-wrap:nowrap;">
                            @foreach($order->items->take(3) as $item)
                            <div style="position:relative; width:44px; height:44px; border-radius:8px; background:rgba(0,0,0,0.6); border:1.5px solid rgba(147,51,234,0.4); overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.5); flex-shrink:0;"
                                 title="{{ $item->product_name }} (Qty: {{ $item->quantity }})">
                                @if($item->product && $item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product_name }}" style="width:100%; height:100%; object-fit:contain; padding:2px; transition:transform .2s;" onmouseover="this.style.transform='scale(1.25)'" onmouseout="this.style.transform='scale(1)'"
                                         onerror="this.onerror=null; this.src='/images/product-fallback.svg';">
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
                        <div style="font-weight:700; color:#fff;">{{ $order->first_name }} {{ $order->last_name }}</div>
                        <div style="font-size:.72rem; color:#94a3b8;">{{ $order->email }}</div>
                    </td>
                    <td style="font-size:.8rem; color:#cbd5e1; font-weight:700;">
                        {{ ucwords(str_replace('_',' ',$order->payment_method)) }}
                    </td>
                    <td style="font-family:'Orbitron',sans-serif; font-weight:900; color:#34d399; text-shadow:0 0 8px rgba(34,197,94,0.3);">
                        ${{ number_format($order->total,2) }}
                    </td>
                    <td>
                        <span class="adm-status adm-status--{{ $order->status }}">{{ $order->status }}</span>
                    </td>
                    <td style="font-family:'Orbitron',sans-serif; font-size:.74rem; color:#94a3b8; white-space:nowrap;">
                        {{ $order->created_at->format('M j // H:i:s') }}
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" style="display:inline-flex; align-items:center; gap:.35rem; background:rgba(229,0,30,0.12); color:#ff4d6d; border:1px solid rgba(229,0,30,0.45); padding:.35rem .75rem; border-radius:5px; font-family:'Orbitron',sans-serif; font-size:.7rem; font-weight:800; text-decoration:none; white-space:nowrap; transition:all .2s; box-shadow:0 0 8px rgba(229,0,30,0.15);" onmouseover="this.style.background='rgba(229,0,30,0.25)'; this.style.boxShadow='0 0 15px rgba(229,0,30,0.4)';" onmouseout="this.style.background='rgba(229,0,30,0.12)'; this.style.boxShadow='0 0 8px rgba(229,0,30,0.15)';">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            VIEW
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════ --}}
{{-- ═══ CYBERPUNK QUICK-EDIT PRODUCT MODAL ══════════════════════════════════ --}}
{{-- ═══════════════════════════════════════════════════════════════════════════ --}}
<div id="quickEditModal" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(4,3,10,0.85); backdrop-filter:blur(14px); align-items:center; justify-content:center; padding:1.2rem; overflow-y:auto;">
    <div style="background:linear-gradient(135deg, rgba(16,13,32,0.98) 0%, rgba(8,6,18,0.98) 100%); border:1.5px solid rgba(229,0,30,0.6); border-radius:12px; max-width:840px; width:100%; max-height:90vh; overflow-y:auto; box-shadow:0 25px 80px rgba(0,0,0,0.8), 0 0 40px rgba(229,0,30,0.25); position:relative;" class="adm-custom-scrollbar">
        <div class="hud-corner-tl"></div>
        <div class="hud-corner-br"></div>

        {{-- Modal Topbar --}}
        <div style="padding:1.2rem 1.6rem; border-bottom:1px solid rgba(147,51,234,0.3); background:rgba(22,18,44,0.9); display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:10;">
            <div style="display:flex; align-items:center; gap:.8rem;">
                <div style="width:34px; height:34px; border-radius:8px; background:radial-gradient(circle, #e5001e 0%, rgba(229,0,30,0.3) 70%); display:flex; align-items:center; justify-content:center; font-size:1.1rem; box-shadow:0 0 12px #e5001e;">
                    ⚡
                </div>
                <div>
                    <h2 style="font-family:'Orbitron',sans-serif; font-size:1.1rem; font-weight:900; color:#fff; margin:0; line-height:1.2;">
                        Edit Hardware SKU: <span id="modal-title-name" style="color:#e5001e;">Loading…</span>
                    </h2>
                    <div style="font-size:.74rem; color:#94a3b8; font-family:'Rajdhani',sans-serif; font-weight:600;">
                        ID: #<span id="modal-title-id">—</span> &bull; SKU: <span id="modal-title-sku" style="color:#c084fc;">—</span>
                    </div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:.6rem;">
                <a id="modal-full-edit-link" href="#" target="_blank" style="font-family:'Orbitron',sans-serif; font-size:.72rem; color:#c084fc; text-decoration:none; background:rgba(147,51,234,0.15); border:1px solid rgba(147,51,234,0.4); padding:.4rem .75rem; border-radius:6px; font-weight:800;" title="Open in Full Dedicated Page">
                    FULL PAGE ↗
                </a>
                <button type="button" onclick="closeQuickEditModal()" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:#fff; width:34px; height:34px; border-radius:6px; cursor:pointer; font-size:1.2rem; display:flex; align-items:center; justify-content:center; transition:all .15s;" onmouseover="this.style.background='#ef4444'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                    ✕
                </button>
            </div>
        </div>

        {{-- Modal Loading Spinner --}}
        <div id="modalLoadingSpinner" style="display:none; padding:4rem; text-align:center;">
            <div style="display:inline-block; width:48px; height:48px; border:4px solid rgba(229,0,30,0.2); border-top-color:#e5001e; border-radius:50%; animation:spin 0.8s linear infinite;"></div>
            <div style="margin-top:1rem; font-family:'Orbitron',sans-serif; font-size:.85rem; color:#94a3b8; font-weight:800;">
                SYNCHRONIZING TELEMETRY NODE…
            </div>
        </div>

        {{-- Modal Form --}}
        <form id="quickEditForm" onsubmit="submitQuickEditForm(event)" enctype="multipart/form-data" style="padding:1.6rem;">
            <input type="hidden" id="edit-product-id" name="product_id">

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; margin-bottom:1.2rem;">
                {{-- Product Name --}}
                <div style="grid-column:1/-1;">
                    <label class="adm-form-label">Hardware Model Name *</label>
                    <input type="text" id="edit-name" name="name" required class="adm-form-input" placeholder="e.g. ROG Zephyrus G16 (2024)">
                </div>

                {{-- Category --}}
                <div>
                    <label class="adm-form-label">Hardware Category *</label>
                    <select id="edit-category_id" name="category_id" required class="adm-form-input">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- SKU Identifier --}}
                <div>
                    <label class="adm-form-label">SKU Identifier *</label>
                    <input type="text" id="edit-sku" name="sku" required class="adm-form-input" style="font-family:monospace;">
                </div>
            </div>

            {{-- Pricing & Stock Deck --}}
            <div style="background:rgba(20,16,40,0.6); border:1px solid rgba(147,51,234,0.3); border-radius:8px; padding:1.2rem; margin-bottom:1.2rem;">
                <div style="font-family:'Orbitron',sans-serif; font-size:.74rem; font-weight:800; color:#e5001e; letter-spacing:.1em; text-transform:uppercase; margin-bottom:1rem; display:flex; align-items:center; justify-content:space-between;">
                    <span>💰 Pricing & Inventory Configuration</span>
                    <span id="edit-discount-pill" style="display:none; background:rgba(229,0,30,0.2); color:#ff4d6d; border:1px solid rgba(229,0,30,0.5); padding:2px 8px; border-radius:10px; font-size:.68rem;">-0%</span>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr 1.2fr; gap:1.2rem; align-items:start;">
                    {{-- Regular Price --}}
                    <div>
                        <label class="adm-form-label">Regular Price ($ USD) *</label>
                        <input type="number" id="edit-price" name="price" step="0.01" min="0" required class="adm-form-input" style="font-weight:800; font-size:1.05rem;" oninput="updateEditDiscountCalc()">
                    </div>

                    {{-- Sale Price --}}
                    <div>
                        <label class="adm-form-label">Sale Price ($ USD) <span style="color:#34d399;">(Optional)</span></label>
                        <input type="number" id="edit-sale_price" name="sale_price" step="0.01" min="0" class="adm-form-input" style="font-weight:800; font-size:1.05rem; color:#34d399;" placeholder="Empty = No Sale" oninput="updateEditDiscountCalc()">
                    </div>

                    {{-- Stock Reserve --}}
                    <div>
                        <label class="adm-form-label">Stock Units in Reserve *</label>
                        <div style="display:flex; gap:.4rem; align-items:center;">
                            <input type="number" id="edit-stock" name="stock" min="0" required class="adm-form-input" style="font-weight:800; font-size:1.05rem; width:90px;">
                            <div style="display:flex; gap:3px; flex-wrap:wrap;">
                                <button type="button" onclick="addEditStock(5)" class="adm-pill-btn">+5</button>
                                <button type="button" onclick="addEditStock(10)" class="adm-pill-btn">+10</button>
                                <button type="button" onclick="addEditStock(50)" class="adm-pill-btn">+50</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image Management Pod --}}
            <div style="background:rgba(20,16,40,0.6); border:1px solid rgba(147,51,234,0.3); border-radius:8px; padding:1.2rem; margin-bottom:1.2rem;">
                <div style="font-family:'Orbitron',sans-serif; font-size:.74rem; font-weight:800; color:#c084fc; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.8rem;">
                    🖼 Visual Hardware Asset
                </div>
                <div style="display:flex; gap:1.2rem; align-items:flex-start; flex-wrap:wrap;">
                    <div style="width:110px; height:90px; background:rgba(0,0,0,0.7); border:1.5px solid rgba(147,51,234,0.4); border-radius:8px; padding:6px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <img id="edit-img-preview" src="{{ asset('images/product-fallback.svg') }}" alt="Preview" style="max-width:100%; max-height:100%; object-fit:contain;" onerror="this.onerror=null; this.src='/images/product-fallback.svg';">
                    </div>
                    <div style="flex:1; min-width:240px; display:flex; flex-direction:column; gap:.7rem;">
                        <div>
                            <label class="adm-form-label">Asset Path / Direct URL</label>
                            <input type="text" id="edit-image" name="image" class="adm-form-input" style="font-family:monospace; font-size:.82rem;" placeholder="images/products/... or https://…" oninput="previewModalImageUrl(this.value)">
                        </div>
                        <div>
                            <label class="adm-form-label">Or Upload New Image File</label>
                            <input type="file" id="edit-image_file" name="image_file" accept="image/*" class="adm-form-input" style="padding:.4rem .6rem;" onchange="previewModalImageFile(this)">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description & Specifications --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; margin-bottom:1.2rem;">
                <div>
                    <label class="adm-form-label">Short Summary</label>
                    <input type="text" id="edit-short_description" name="short_description" class="adm-form-input" placeholder="Punchy one-liner specification summary…">
                    
                    <label class="adm-form-label" style="margin-top:.8rem;">Full Description</label>
                    <textarea id="edit-description" name="description" rows="4" class="adm-form-input" style="resize:vertical; line-height:1.5;" placeholder="Detailed product marketing description…"></textarea>
                </div>
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <label class="adm-form-label">Hardware Specifications</label>
                        <span style="font-size:.68rem; color:#94a3b8;">key = value per line</span>
                    </div>
                    <textarea id="edit-specs_raw" name="specs_raw" rows="7" class="adm-form-input" style="font-family:monospace; font-size:.8rem; resize:vertical; line-height:1.5;" placeholder="Processor = Intel Core Ultra 9&#10;GPU = RTX 4090 16GB&#10;RAM = 32GB LPDDR5X&#10;Display = 16&quot; 240Hz OLED"></textarea>
                </div>
            </div>

            {{-- Flags & Toggles --}}
            <div style="display:flex; gap:2rem; padding:.8rem 1rem; background:rgba(0,0,0,0.4); border:1px solid rgba(147,51,234,0.25); border-radius:8px; margin-bottom:1.4rem; align-items:center;">
                <label style="display:inline-flex; align-items:center; gap:.6rem; cursor:pointer; font-weight:700; font-size:.88rem; color:#fff;">
                    <input type="checkbox" id="edit-is_active" name="is_active" value="1" style="accent-color:#22c55e; width:18px; height:18px;">
                    <span>Active in Storefront Catalog</span>
                </label>
                <label style="display:inline-flex; align-items:center; gap:.6rem; cursor:pointer; font-weight:700; font-size:.88rem; color:#fff;">
                    <input type="checkbox" id="edit-is_featured" name="is_featured" value="1" style="accent-color:#e5001e; width:18px; height:18px;">
                    <span>Featured on Home Page Hero Grids</span>
                </label>
            </div>

            {{-- Modal Actions --}}
            <div style="display:flex; align-items:center; justify-content:flex-end; gap:1rem;">
                <button type="button" onclick="closeQuickEditModal()" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); color:#fff; padding:.65rem 1.4rem; border-radius:6px; font-weight:700; font-size:.85rem; cursor:pointer;">
                    Cancel
                </button>
                <button type="submit" id="btn-save-quick-edit" class="btn-rog" style="padding:.65rem 2rem; font-size:.88rem; border-radius:6px; font-weight:900; font-family:'Orbitron',sans-serif; letter-spacing:.08em; display:inline-flex; align-items:center; gap:8px; box-shadow:0 0 20px rgba(229,0,30,0.5);">
                    <span id="save-btn-spinner" style="display:none; width:14px; height:14px; border:2px solid #fff; border-top-color:transparent; border-radius:50%; animation:spin .6s linear infinite;"></span>
                    <span id="save-btn-text">💾 SAVE HARDWARE CHANGES</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════ --}}
{{-- ═══ CYBERPUNK CREATE HARDWARE MODAL ══════════════════════════════════════ --}}
{{-- ═══════════════════════════════════════════════════════════════════════════ --}}
<div id="createHardwareModal" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(4,3,10,0.85); backdrop-filter:blur(14px); align-items:center; justify-content:center; padding:1.2rem; overflow-y:auto;">
    <div style="background:linear-gradient(135deg, rgba(16,13,32,0.98) 0%, rgba(8,6,18,0.98) 100%); border:1.5px solid rgba(34,197,94,0.6); border-radius:12px; max-width:800px; width:100%; max-height:90vh; overflow-y:auto; box-shadow:0 25px 80px rgba(0,0,0,0.8), 0 0 40px rgba(34,197,94,0.2); position:relative;" class="adm-custom-scrollbar">
        <div class="hud-corner-tl" style="border-top-color:#22c55e; border-left-color:#22c55e;"></div>
        <div class="hud-corner-br" style="border-bottom-color:#22c55e; border-right-color:#22c55e;"></div>

        {{-- Modal Topbar --}}
        <div style="padding:1.2rem 1.6rem; border-bottom:1px solid rgba(34,197,94,0.3); background:rgba(22,18,44,0.9); display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:10;">
            <div style="display:flex; align-items:center; gap:.8rem;">
                <div style="width:34px; height:34px; border-radius:8px; background:radial-gradient(circle, #22c55e 0%, rgba(34,197,94,0.3) 70%); display:flex; align-items:center; justify-content:center; font-size:1.1rem; box-shadow:0 0 12px #22c55e;">
                    🚀
                </div>
                <div>
                    <h2 style="font-family:'Orbitron',sans-serif; font-size:1.1rem; font-weight:900; color:#fff; margin:0;">
                        Deploy New Hardware to Store Catalog
                    </h2>
                    <div style="font-size:.74rem; color:#94a3b8; font-weight:600;">
                        Register SKU, set specifications, upload product photography, and activate immediately.
                    </div>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:#fff; width:34px; height:34px; border-radius:6px; cursor:pointer; font-size:1.2rem; display:flex; align-items:center; justify-content:center;">
                ✕
            </button>
        </div>

        {{-- Create Form --}}
        <form id="createHardwareForm" onsubmit="submitCreateHardwareForm(event)" enctype="multipart/form-data" style="padding:1.6rem;">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; margin-bottom:1.2rem;">
                <div style="grid-column:1/-1;">
                    <label class="adm-form-label">Product Name *</label>
                    <input type="text" name="name" required class="adm-form-input" placeholder="e.g. ROG Strix Scar 16 (2025)">
                </div>
                <div>
                    <label class="adm-form-label">Category *</label>
                    <select name="category_id" required class="adm-form-input">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="adm-form-label">SKU Identifier *</label>
                    <input type="text" name="sku" required class="adm-form-input" placeholder="ROG-LAP-2025-01" style="font-family:monospace;">
                </div>
                <div>
                    <label class="adm-form-label">Regular Price ($ USD) *</label>
                    <input type="number" name="price" step="0.01" min="0" required class="adm-form-input" placeholder="1999.99">
                </div>
                <div>
                    <label class="adm-form-label">Sale Price ($ USD)</label>
                    <input type="number" name="sale_price" step="0.01" min="0" class="adm-form-input" placeholder="Optional discounted price">
                </div>
                <div>
                    <label class="adm-form-label">Stock Units *</label>
                    <input type="number" name="stock" min="0" value="10" required class="adm-form-input">
                </div>
                <div>
                    <label class="adm-form-label">Product Image File</label>
                    <input type="file" name="image_file" accept="image/*" class="adm-form-input" style="padding:.4rem .6rem;">
                </div>
                <div style="grid-column:1/-1;">
                    <label class="adm-form-label">Or Image URL / Path</label>
                    <input type="text" name="image" class="adm-form-input" placeholder="images/products/... or https://…">
                </div>
                <div style="grid-column:1/-1;">
                    <label class="adm-form-label">Short Description</label>
                    <input type="text" name="short_description" class="adm-form-input" placeholder="Brief marketing specs highlight">
                </div>
                <div style="grid-column:1/-1;">
                    <label class="adm-form-label">Specifications (key = value)</label>
                    <textarea name="specs_raw" rows="4" class="adm-form-input" style="font-family:monospace; font-size:.8rem;" placeholder="Processor = Intel Core Ultra 9&#10;GPU = RTX 4080 12GB&#10;Display = 16&quot; QHD+ 240Hz"></textarea>
                </div>
            </div>

            <div style="display:flex; gap:2rem; padding:.8rem 1rem; background:rgba(0,0,0,0.4); border:1px solid rgba(34,197,94,0.25); border-radius:8px; margin-bottom:1.4rem;">
                <label style="display:inline-flex; align-items:center; gap:.6rem; cursor:pointer; font-weight:700; color:#fff;">
                    <input type="checkbox" name="is_active" value="1" checked style="accent-color:#22c55e; width:18px; height:18px;">
                    <span>Active in Storefront Catalog</span>
                </label>
                <label style="display:inline-flex; align-items:center; gap:.6rem; cursor:pointer; font-weight:700; color:#fff;">
                    <input type="checkbox" name="is_featured" value="1" checked style="accent-color:#e5001e; width:18px; height:18px;">
                    <span>Featured on Home Page</span>
                </label>
            </div>

            <div style="display:flex; align-items:center; justify-content:flex-end; gap:1rem;">
                <button type="button" onclick="closeCreateModal()" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); color:#fff; padding:.65rem 1.4rem; border-radius:6px; font-weight:700; font-size:.85rem; cursor:pointer;">
                    Cancel
                </button>
                <button type="submit" id="btn-create-submit" class="btn-rog" style="background:linear-gradient(135deg, #10b981, #059669); border-color:#34d399; padding:.65rem 2rem; font-size:.88rem; border-radius:6px; font-weight:900; font-family:'Orbitron',sans-serif;">
                    🚀 DEPLOY TO STORE
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ═══ LIVE ROG TOAST NOTIFICATION CONTAINER ═══════════════════════════════ --}}
<div id="rogToastContainer" style="position:fixed; bottom:24px; right:24px; z-index:999999; display:flex; flex-direction:column; gap:10px; pointer-events:none;"></div>

<style>
.adm-form-label {
    display: block;
    font-size: .74rem;
    color: var(--adm-muted);
    text-transform: uppercase;
    letter-spacing: .08em;
    font-weight: 700;
    margin-bottom: .35rem;
}
.adm-form-input {
    width: 100%;
    background: var(--adm-surface2);
    border: 1px solid var(--adm-border);
    color: var(--adm-text);
    padding: .55rem .9rem;
    border-radius: 6px;
    font-size: .88rem;
    outline: none;
    font-family: 'Rajdhani', sans-serif;
    transition: border-color .15s, box-shadow .15s;
}
.adm-form-input:focus {
    border-color: #e5001e;
    box-shadow: 0 0 10px rgba(229,0,30,0.3);
}
.adm-pill-btn {
    background: rgba(147,51,234,0.2);
    border: 1px solid rgba(147,51,234,0.45);
    color: #c084fc;
    font-family: 'Orbitron', sans-serif;
    font-size: .68rem;
    font-weight: 800;
    padding: 3px 7px;
    border-radius: 4px;
    cursor: pointer;
    transition: all .15s;
}
.adm-pill-btn:hover {
    background: #e5001e;
    border-color: #e5001e;
    color: #fff;
}
.adm-toast-item {
    pointer-events: auto;
    background: rgba(16, 13, 30, 0.96);
    border: 1.5px solid rgba(229,0,30,0.7);
    color: #fff;
    padding: .9rem 1.4rem;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.8), 0 0 20px rgba(229,0,30,0.35);
    font-family: 'Rajdhani', sans-serif;
    font-weight: 700;
    font-size: .92rem;
    display: flex;
    align-items: center;
    gap: .8rem;
    backdrop-filter: blur(12px);
    animation: toastSlideIn .3s ease-out forwards;
    max-width: 420px;
}
.adm-toast-item.success {
    border-color: rgba(34,197,94,0.8);
    box-shadow: 0 10px 30px rgba(0,0,0,0.8), 0 0 20px rgba(34,197,94,0.35);
}
@keyframes toastSlideIn {
    from { transform: translateX(100%); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
}
@keyframes spin { to { transform: rotate(360deg); } }
</style>

<script>
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

// ── Toast Notification System ────────────────────────────────────────────────
function showRogToast(msg, type = 'success') {
    const container = document.getElementById('rogToastContainer');
    const toast = document.createElement('div');
    toast.className = `adm-toast-item ${type}`;
    const icon = type === 'success' ? '⚡' : '⚠️';
    toast.innerHTML = `<span>${icon}</span><span>${msg}</span>`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(10px)';
        toast.style.transition = 'all .3s';
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}

// ── Live Filtering of Dashboard Hardware Table ───────────────────────────────
function filterDashboardProducts() {
    const q = document.getElementById('productSearchInput').value.toLowerCase().trim();
    const cat = document.getElementById('productCatFilter').value;
    const status = document.getElementById('productStatusFilter').value;
    const rows = document.querySelectorAll('#dashboardProductTableBody tr');
    let visibleCount = 0;

    rows.forEach(row => {
        const name = row.getAttribute('data-name') || '';
        const sku = row.getAttribute('data-sku') || '';
        const rowCat = row.getAttribute('data-cat') || '';
        const isActive = row.getAttribute('data-active') === '1';
        const isFeat = row.getAttribute('data-featured') === '1';
        const isSale = row.getAttribute('data-sale') === '1';
        const stock = parseInt(row.getAttribute('data-stock') || '0');

        let matchSearch = !q || name.includes(q) || sku.includes(q);
        let matchCat = !cat || rowCat === cat;
        let matchStatus = true;

        if (status === 'active') matchStatus = isActive;
        else if (status === 'offline') matchStatus = !isActive;
        else if (status === 'sale') matchStatus = isSale;
        else if (status === 'lowstock') matchStatus = stock <= 5;
        else if (status === 'featured') matchStatus = isFeat;

        if (matchSearch && matchCat && matchStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    const countLabel = document.getElementById('filterResultCount');
    if (countLabel) countLabel.textContent = `Displaying ${visibleCount} SKUs`;
}

// ── Open & Populate Quick-Edit Modal ────────────────────────────────────────
async function openQuickEdit(productId) {
    const modal = document.getElementById('quickEditModal');
    const spinner = document.getElementById('modalLoadingSpinner');
    const form = document.getElementById('quickEditForm');

    modal.style.display = 'flex';
    spinner.style.display = 'block';
    form.style.display = 'none';

    try {
        const res = await fetch(`/admin/products/${productId}/json`, {
            headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) throw new Error('Failed to load product data');
        const data = await res.json();

        // Populate header
        document.getElementById('modal-title-name').textContent = data.name;
        document.getElementById('modal-title-id').textContent = data.id;
        document.getElementById('modal-title-sku').textContent = data.sku;
        document.getElementById('modal-full-edit-link').href = data.edit_url;

        // Populate fields
        document.getElementById('edit-product-id').value = data.id;
        document.getElementById('edit-name').value = data.name;
        document.getElementById('edit-sku').value = data.sku;
        document.getElementById('edit-category_id').value = data.category_id;
        document.getElementById('edit-price').value = data.price;
        document.getElementById('edit-sale_price').value = data.sale_price || '';
        document.getElementById('edit-stock').value = data.stock;
        document.getElementById('edit-image').value = data.raw_image;
        document.getElementById('edit-img-preview').src = data.image;
        document.getElementById('edit-short_description').value = data.short_description;
        document.getElementById('edit-description').value = data.description;
        document.getElementById('edit-specs_raw').value = data.specs_raw;
        document.getElementById('edit-is_active').checked = data.is_active;
        document.getElementById('edit-is_featured').checked = data.is_featured;

        updateEditDiscountCalc();

        spinner.style.display = 'none';
        form.style.display = 'block';
    } catch (err) {
        showRogToast(err.message, 'error');
        closeQuickEditModal();
    }
}

function closeQuickEditModal() {
    document.getElementById('quickEditModal').style.display = 'none';
}

function addEditStock(qty) {
    const el = document.getElementById('edit-stock');
    el.value = (parseInt(el.value) || 0) + qty;
}

function updateEditDiscountCalc() {
    const price = parseFloat(document.getElementById('edit-price').value) || 0;
    const sale = parseFloat(document.getElementById('edit-sale_price').value) || 0;
    const pill = document.getElementById('edit-discount-pill');

    if (price > 0 && sale > 0 && sale < price) {
        const pct = Math.round((1 - sale / price) * 100);
        pill.textContent = `-${pct}% (Save $${(price - sale).toFixed(2)})`;
        pill.style.display = 'inline-block';
    } else {
        pill.style.display = 'none';
    }
}

function previewModalImageUrl(val) {
    const preview = document.getElementById('edit-img-preview');
    if (!val) {
        preview.src = '{{ asset("images/product-fallback.svg") }}';
        return;
    }
    if (val.startsWith('http://') || val.startsWith('https://') || val.startsWith('/')) {
        preview.src = val;
    } else {
        preview.src = '{{ asset("") }}' + val.replace(/^\/+/, '');
    }
}

function previewModalImageFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('edit-img-preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// ── Save Quick-Edit Form via AJAX ───────────────────────────────────────────
async function submitQuickEditForm(e) {
    e.preventDefault();
    const id = document.getElementById('edit-product-id').value;
    const form = document.getElementById('quickEditForm');
    const formData = new FormData(form);
    formData.append('_method', 'PUT');

    const saveBtn = document.getElementById('btn-save-quick-edit');
    const spinner = document.getElementById('save-btn-spinner');
    const btnText = document.getElementById('save-btn-text');

    saveBtn.disabled = true;
    spinner.style.display = 'inline-block';
    btnText.textContent = 'SYNCHRONIZING…';

    try {
        const res = await fetch(`/admin/products/${id}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': CSRF_TOKEN
            }
        });

        const data = await res.json();
        if (!res.ok || !data.success) throw new Error(data.message || 'Update failed');

        // Update table row dynamically
        const p = data.product;
        const row = document.getElementById(`product-row-${p.id}`);
        if (row) {
            row.setAttribute('data-name', p.name.toLowerCase());
            row.setAttribute('data-sku', p.sku.toLowerCase());
            row.setAttribute('data-cat', p.category_id);
            row.setAttribute('data-active', p.is_active ? '1' : '0');
            row.setAttribute('data-featured', p.is_featured ? '1' : '0');
            row.setAttribute('data-sale', p.sale_price ? '1' : '0');
            row.setAttribute('data-stock', p.stock);

            const nameEl = document.getElementById(`row-name-${p.id}`);
            if (nameEl) nameEl.textContent = p.name;

            const skuEl = document.getElementById(`row-sku-${p.id}`);
            if (skuEl) skuEl.textContent = p.sku;

            const catEl = document.getElementById(`row-cat-${p.id}`);
            if (catEl) catEl.textContent = p.category_name;

            const imgEl = document.getElementById(`row-img-${p.id}`);
            if (imgEl) imgEl.src = p.image;

            const stockInput = document.getElementById(`stock-input-${p.id}`);
            if (stockInput) {
                stockInput.value = p.stock;
                stockInput.style.color = p.stock === 0 ? '#ef4444' : (p.stock <= 5 ? '#fbbf24' : '#86efac');
            }

            // Update pricing cell
            const priceCell = document.getElementById(`row-pricing-${p.id}`);
            if (priceCell) {
                if (p.sale_price) {
                    priceCell.innerHTML = `
                        <div style="font-family:'Orbitron',sans-serif; font-weight:900; color:#34d399; font-size:.9rem; text-shadow:0 0 8px rgba(34,197,94,0.4);">$${parseFloat(p.sale_price).toFixed(2)}</div>
                        <div style="font-size:.72rem; color:#64748b; text-decoration:line-through; font-family:'Orbitron',sans-serif;">$${parseFloat(p.price).toFixed(2)}</div>
                    `;
                } else {
                    priceCell.innerHTML = `<div style="font-family:'Orbitron',sans-serif; font-weight:800; color:#fff; font-size:.9rem;">$${parseFloat(p.price).toFixed(2)}</div>`;
                }
            }

            // Update Status Badge
            const statusBadge = document.getElementById(`status-badge-${p.id}`);
            if (statusBadge) {
                statusBadge.className = `adm-status ${p.is_active ? 'adm-status--confirmed' : 'adm-status--cancelled'}`;
                statusBadge.textContent = p.is_active ? 'Active' : 'Offline';
            }

            // Update Featured Star
            const featBtn = document.getElementById(`btn-toggle-feat-${p.id}`);
            if (featBtn) {
                featBtn.textContent = p.is_featured ? '★' : '☆';
                featBtn.style.color = p.is_featured ? '#fbbf24' : '#475569';
                featBtn.style.filter = p.is_featured ? 'drop-shadow(0 0 6px #fbbf24)' : 'none';
            }

            // Highlight flash animation
            row.style.background = 'rgba(229,0,30,0.18)';
            setTimeout(() => { row.style.background = ''; }, 1200);
        }

        showRogToast(data.message || 'Hardware updated successfully!');
        closeQuickEditModal();
    } catch (err) {
        showRogToast(err.message, 'error');
    } finally {
        saveBtn.disabled = false;
        spinner.style.display = 'none';
        btnText.textContent = '💾 SAVE HARDWARE CHANGES';
    }
}

// ── Quick Stock Step Controls ────────────────────────────────────────────────
async function quickAdjustStock(productId, delta) {
    const input = document.getElementById(`stock-input-${productId}`);
    const newQty = Math.max(0, (parseInt(input.value) || 0) + delta);
    input.value = newQty;
    await submitQuickStock(productId, newQty);
}

async function submitQuickStock(productId, stockVal) {
    const input = document.getElementById(`stock-input-${productId}`);
    try {
        const res = await fetch(`/admin/products/${productId}/quick-stock`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            body: JSON.stringify({ stock: parseInt(stockVal) })
        });
        const data = await res.json();
        if (!res.ok || !data.success) throw new Error(data.message || 'Stock update failed');

        input.value = data.stock;
        input.style.color = data.stock === 0 ? '#ef4444' : (data.stock <= 5 ? '#fbbf24' : '#86efac');
        
        const row = document.getElementById(`product-row-${productId}`);
        if (row) row.setAttribute('data-stock', data.stock);

        showRogToast(data.message);
    } catch (err) {
        showRogToast(err.message, 'error');
    }
}

// ── Toggle Active & Featured Status ─────────────────────────────────────────
async function toggleProductActive(productId) {
    try {
        const res = await fetch(`/admin/products/${productId}/toggle`, {
            method: 'PATCH',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': CSRF_TOKEN
            }
        });
        const data = await res.json();
        if (!res.ok || !data.success) throw new Error(data.message || 'Status toggle failed');

        const badge = document.getElementById(`status-badge-${productId}`);
        if (badge) {
            badge.className = `adm-status ${data.is_active ? 'adm-status--confirmed' : 'adm-status--cancelled'}`;
            badge.textContent = data.is_active ? 'Active' : 'Offline';
        }
        const row = document.getElementById(`product-row-${productId}`);
        if (row) row.setAttribute('data-active', data.is_active ? '1' : '0');

        showRogToast(data.message);
    } catch (err) {
        showRogToast(err.message, 'error');
    }
}

async function toggleProductFeatured(productId) {
    try {
        const res = await fetch(`/admin/products/${productId}/toggle-featured`, {
            method: 'PATCH',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': CSRF_TOKEN
            }
        });
        const data = await res.json();
        if (!res.ok || !data.success) throw new Error(data.message || 'Featured toggle failed');

        const btn = document.getElementById(`btn-toggle-feat-${productId}`);
        if (btn) {
            btn.textContent = data.is_featured ? '★' : '☆';
            btn.style.color = data.is_featured ? '#fbbf24' : '#475569';
            btn.style.filter = data.is_featured ? 'drop-shadow(0 0 6px #fbbf24)' : 'none';
        }
        const row = document.getElementById(`product-row-${productId}`);
        if (row) row.setAttribute('data-featured', data.is_featured ? '1' : '0');

        showRogToast(data.message);
    } catch (err) {
        showRogToast(err.message, 'error');
    }
}

// ── Delete / Deactivate Product ─────────────────────────────────────────────
async function confirmDeleteProduct(productId, name) {
    if (!confirm(`Are you sure you want to remove "${name}" from hardware catalog?`)) return;

    try {
        const res = await fetch(`/admin/products/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': CSRF_TOKEN
            }
        });
        const data = await res.json();
        if (!res.ok || !data.success) throw new Error(data.message || 'Delete failed');

        const row = document.getElementById(`product-row-${productId}`);
        if (row) {
            if (data.deactivated_only) {
                row.setAttribute('data-active', '0');
                const badge = document.getElementById(`status-badge-${productId}`);
                if (badge) {
                    badge.className = 'adm-status adm-status--cancelled';
                    badge.textContent = 'Offline';
                }
            } else {
                row.remove();
            }
        }
        showRogToast(data.message);
    } catch (err) {
        showRogToast(err.message, 'error');
    }
}

// ── Deploy New Hardware Modal ───────────────────────────────────────────────
function openCreateModal() {
    document.getElementById('createHardwareModal').style.display = 'flex';
}
function closeCreateModal() {
    document.getElementById('createHardwareModal').style.display = 'none';
}

async function submitCreateHardwareForm(e) {
    e.preventDefault();
    const form = document.getElementById('createHardwareForm');
    const formData = new FormData(form);
    const btn = document.getElementById('btn-create-submit');

    btn.disabled = true;
    btn.textContent = 'DEPLOYING…';

    try {
        const res = await fetch('/admin/products', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': CSRF_TOKEN
            }
        });
        const data = await res.json();
        if (!res.ok || !data.success) throw new Error(data.message || 'Deployment failed');

        showRogToast(data.message);
        closeCreateModal();
        form.reset();

        // Dynamically append to table or reload table
        setTimeout(() => window.location.reload(), 1000);
    } catch (err) {
        showRogToast(err.message, 'error');
    } finally {
        btn.disabled = false;
        btn.textContent = '🚀 DEPLOY TO STORE';
    }
}

// Close modals on Escape key or backdrop click
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeQuickEditModal();
        closeCreateModal();
    }
});
document.getElementById('quickEditModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'quickEditModal') closeQuickEditModal();
});
document.getElementById('createHardwareModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'createHardwareModal') closeCreateModal();
});
</script>
@endsection
