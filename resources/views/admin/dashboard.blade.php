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
                <div style="display:flex; align-items:center; justify-content:space-between; padding:.45rem 0; border-bottom:1px solid rgba(245,158,11,0.15);">
                    <div style="font-size:.85rem; font-weight:700; color:#fff; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:180px;">
                        {{ $p->name }}
                    </div>
                    <span style="font-family:'Orbitron',sans-serif; font-size:.76rem; font-weight:900; color:{{ $p->stock === 0 ? '#ef4444' : '#fbbf24' }}; white-space:nowrap; text-shadow:0 0 6px currentColor;">
                        {{ $p->stock === 0 ? 'CRITICAL DEPLETED' : $p->stock.' UNITS REMAINING' }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

{{-- ═══ 5. RECENT TRANSACTIONS TERMINAL ═══════════════════════════════════════ --}}
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

<script>
// Auto-refresh telemetry stream every 45 seconds
setTimeout(function () { window.location.reload(); }, 45000);
</script>
@endsection
