@extends('admin.layout')
@section('title','Order #'.$order->order_number.' — Dispatch Dossier')
@section('page-title','Live Dispatch Dossier')

@section('content')

{{-- ═══ 1. LIVE TELEMETRY HEADER & DISPATCH BAR ════════════════════════════════ --}}
<div class="adm-card" style="margin-bottom:1.4rem; border-color:rgba(229,0,30,0.5); background:linear-gradient(135deg, rgba(229,0,30,0.15) 0%, rgba(14,11,28,0.95) 50%, rgba(147,51,234,0.12) 100%); box-shadow:0 10px 35px rgba(0,0,0,0.6), 0 0 25px rgba(229,0,30,0.18);">
    <div class="hud-corner-tl"></div>
    <div class="hud-corner-br"></div>
    
    {{-- Telemetry Stream Top Bar --}}
    <div style="padding:.6rem 1.4rem; background:rgba(0,0,0,0.45); border-bottom:1px solid rgba(229,0,30,0.25); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.8rem; font-family:'Orbitron',sans-serif; font-size:.68rem;">
        <div style="display:flex; align-items:center; gap:1.2rem; flex-wrap:wrap;">
            <a href="{{ route('admin.orders') }}" style="color:#cbd5e1; text-decoration:none; display:inline-flex; align-items:center; gap:4px; font-weight:800; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#cbd5e1'">
                ‹ BACK TO DISPATCH FEED
            </a>
            <span style="color:rgba(255,255,255,0.2);">|</span>
            <span style="color:#22c55e; display:flex; align-items:center; gap:5px; font-weight:800; text-shadow:0 0 8px rgba(34,197,94,0.5);">
                <span class="adm-live-dot" style="width:6px; height:6px;"></span> LIVE DOSSIER SYNCHRONIZED
            </span>
            <span style="color:#60a5fa; font-weight:700;">⏱️ INGESTED: {{ $order->created_at->diffForHumans() }}</span>
        </div>
        <div style="display:flex; align-items:center; gap:.8rem;">
            <button onclick="window.print()" style="background:rgba(147,51,234,0.2); border:1px solid rgba(147,51,234,0.5); color:#d8b4fe; font-family:'Orbitron',sans-serif; font-size:.68rem; font-weight:800; padding:4px 12px; border-radius:4px; cursor:pointer; display:flex; align-items:center; gap:5px; transition:all .2s; box-shadow:0 0 10px rgba(147,51,234,0.2);" onmouseover="this.style.background='rgba(147,51,234,0.35)'; this.style.boxShadow='0 0 15px rgba(147,51,234,0.4)';" onmouseout="this.style.background='rgba(147,51,234,0.2)'; this.style.boxShadow='0 0 10px rgba(147,51,234,0.2)';">
                🖨️ PRINT HARDWARE MANIFEST
            </button>
            <span style="color:#94a3b8; font-weight:700;">NODE_ID: #ROG-ORD-{{ $order->id }}</span>
        </div>
    </div>

    {{-- Main Order Dossier Header --}}
    <div style="padding:1.4rem 1.6rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1.2rem;">
        <div>
            <div style="font-size:.7rem; color:#e5001e; font-weight:800; letter-spacing:.2em; text-transform:uppercase; margin-bottom:.3rem; display:flex; align-items:center; gap:6px;">
                <span>⚡</span> ORDER SPECIFICATION IDENTIFIER
            </div>
            <div style="font-family:'Orbitron',sans-serif; font-size:1.85rem; font-weight:900; color:#fff; text-shadow:0 0 20px rgba(229,0,30,0.6); display:flex; align-items:center; gap:.8rem; flex-wrap:wrap;">
                {{ $order->order_number }}
                <span class="adm-status adm-status--{{ $order->status }}" style="font-size:.78rem; padding:4px 14px;">
                    {{ strtoupper($order->status) }}
                </span>
                <span class="adm-status adm-status--{{ $order->payment_status === 'paid' ? 'confirmed' : 'pending' }}" style="font-size:.78rem; padding:4px 14px;">
                    SETTLEMENT: {{ strtoupper($order->payment_status) }}
                </span>
            </div>
            <div style="margin-top:.6rem; color:#94a3b8; font-size:.85rem; display:flex; align-items:center; gap:1.2rem; flex-wrap:wrap;">
                <span>📅 Timestamp: <strong style="color:#fff;">{{ $order->created_at->format('l, F j, Y // H:i:s T') }}</strong></span>
                <span>👤 Customer: <strong style="color:#fff;">{{ $order->first_name }} {{ $order->last_name }}</strong></span>
            </div>
        </div>

        {{-- Grand Total Display Pod --}}
        <div style="background:rgba(0,0,0,0.45); border:1.5px solid rgba(34,197,94,0.5); border-radius:10px; padding:1.1rem 1.6rem; text-align:right; box-shadow:0 0 25px rgba(34,197,94,0.2); backdrop-filter:blur(12px);">
            <div style="font-size:.68rem; color:#94a3b8; text-transform:uppercase; letter-spacing:.15em; font-weight:800; font-family:'Orbitron',sans-serif; margin-bottom:.2rem;">
                SETTLEMENT VALUE
            </div>
            <div style="font-family:'Orbitron',sans-serif; font-size:2rem; font-weight:900; color:#34d399; text-shadow:0 0 15px rgba(34,197,94,0.6); line-height:1.1;">
                ${{ number_format($order->total, 2) }}
            </div>
            <div style="font-size:.72rem; color:#94a3b8; margin-top:.3rem; font-family:'Orbitron',sans-serif;">
                via {{ ucwords(str_replace('_',' ',$order->payment_method)) }}
            </div>
        </div>
    </div>
</div>

{{-- ═══ 2. LIVE FULFILLMENT RADAR PIPELINE (DYNAMIC STEPPER) ═══════════════════ --}}
@php
    $stages = [
        'pending'    => ['step' => 1, 'label' => 'Order Ingestion', 'desc' => 'Order received & logged'],
        'confirmed'  => ['step' => 2, 'label' => 'Payment Clearance', 'desc' => 'Transaction settled & verified'],
        'processing' => ['step' => 3, 'label' => 'Hardware Staging', 'desc' => 'Components QA & packaged'],
        'shipped'    => ['step' => 4, 'label' => 'In Sub-Orbital Transit', 'desc' => 'Dispatched with carrier'],
        'delivered'  => ['step' => 5, 'label' => 'Destination Secured', 'desc' => 'Handed over to customer'],
        'cancelled'  => ['step' => 0, 'label' => 'Order Terminated', 'desc' => 'Order voided / refunded']
    ];
    $currentStep = $stages[$order->status]['step'] ?? 1;
@endphp

<div class="adm-card" style="margin-bottom:1.6rem; padding:1.4rem 1.6rem; background:linear-gradient(90deg, rgba(14,11,28,0.95) 0%, rgba(22,17,44,0.85) 100%);">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.2rem;">
        <span class="adm-card-title">
            <span style="color:#00f0ff; text-shadow:0 0 8px #00f0ff;">◈</span> REAL-TIME FULFILLMENT PIPELINE
        </span>
        <span style="font-family:'Orbitron',sans-serif; font-size:.72rem; color:#a855f7; font-weight:800;">
            STAGE {{ $currentStep }} OF 5 // {{ strtoupper($order->status) }}
        </span>
    </div>

    {{-- Progress Steps Bar --}}
    <div style="display:grid; grid-template-columns:repeat(5, 1fr); gap:.8rem; position:relative;">
        @foreach(['pending' => '1. INGESTION', 'confirmed' => '2. CLEARANCE', 'processing' => '3. STAGING', 'shipped' => '4. DISPATCH', 'delivered' => '5. DELIVERED'] as $key => $title)
        @php 
            $stepNum = $stages[$key]['step'];
            $isActive = $currentStep >= $stepNum && $order->status !== 'cancelled';
            $isCurrent = $order->status === $key;
        @endphp
        <div style="background:{{ $isCurrent ? 'linear-gradient(135deg, rgba(229,0,30,0.22) 0%, rgba(147,51,234,0.18) 100%)' : ($isActive ? 'rgba(34,197,94,0.1)' : 'rgba(0,0,0,0.3)') }};
                    border:1.5px solid {{ $isCurrent ? '#e5001e' : ($isActive ? 'rgba(34,197,94,0.5)' : 'rgba(147,51,234,0.2)') }};
                    border-radius:8px; padding:.9rem .8rem; position:relative; overflow:hidden;
                    box-shadow:{{ $isCurrent ? '0 0 18px rgba(229,0,30,0.4), inset 0 0 12px rgba(229,0,30,0.15)' : ($isActive ? '0 0 12px rgba(34,197,94,0.2)' : 'none') }};">
            
            {{-- Top Accent Cap --}}
            <div style="position:absolute; top:0; left:0; right:0; height:3px; background:{{ $isCurrent ? '#e5001e' : ($isActive ? '#22c55e' : 'transparent') }}; box-shadow:0 0 6px currentColor;"></div>
            
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:.35rem;">
                <span style="font-family:'Orbitron',sans-serif; font-size:.65rem; font-weight:900; color:{{ $isCurrent ? '#ff4d6d' : ($isActive ? '#86efac' : '#64748b') }}; text-shadow:{{ $isCurrent ? '0 0 8px #ff4d6d' : 'none' }};">
                    {{ $title }}
                </span>
                @if($isActive)
                    <span style="color:#22c55e; font-size:.75rem; font-weight:900; text-shadow:0 0 6px #22c55e;">✓</span>
                @else
                    <span style="color:#475569; font-size:.7rem;">○</span>
                @endif
            </div>
            <div style="font-size:.72rem; color:{{ $isCurrent ? '#fff' : ($isActive ? '#cbd5e1' : '#64748b') }}; font-weight:700; line-height:1.2;">
                {{ $stages[$key]['desc'] }}
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ═══ 3. MAIN WORKSPACE: ORDERED HARDWARE & CONTROLS ════════════════════════ --}}
<div style="display:grid; grid-template-columns:1fr 350px; gap:1.4rem; align-items:start;">

    {{-- Left Column: Hardware Manifest & Telemetry --}}
    <div style="display:flex; flex-direction:column; gap:1.4rem;">

        {{-- 3D Hardware Manifest Unit Cards --}}
        <div class="adm-card">
            <div class="hud-corner-tl"></div>
            <div class="hud-corner-br"></div>
            <div class="adm-card-header">
                <span class="adm-card-title">
                    <span style="color:#e5001e;">⚡</span> ORDERED HARDWARE MANIFEST ({{ $order->items->count() }} UNITS)
                </span>
                <span style="font-family:'Orbitron',sans-serif; font-size:.72rem; color:#34d399; font-weight:800; display:flex; align-items:center; gap:4px;">
                    <span>✓</span> SKU VERIFIED
                </span>
            </div>

            <div style="padding:1.4rem; display:flex; flex-direction:column; gap:1.1rem;">
                @foreach($order->items as $item)
                <div style="display:flex; align-items:center; justify-content:space-between; gap:1.2rem; padding:1.2rem 1.4rem; background:rgba(18,14,35,0.7); border:1.5px solid rgba(147,51,234,0.35); border-radius:12px; transition:all .25s cubic-bezier(0.2, 0.8, 0.2, 1); position:relative; overflow:hidden;"
                     onmouseover="this.style.borderColor='rgba(229,0,30,0.7)'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 30px rgba(0,0,0,0.6), 0 0 20px rgba(229,0,30,0.25)';"
                     onmouseout="this.style.borderColor='rgba(147,51,234,0.35)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    
                    {{-- Left: Big 3D Hardware Hologram Pod --}}
                    <div style="display:flex; align-items:center; gap:1.3rem;">
                        <div style="position:relative; width:88px; height:88px; border-radius:14px; background:radial-gradient(circle, rgba(229,0,30,0.25) 0%, rgba(20,16,40,0.95) 75%); border:2px solid rgba(229,0,30,0.6); overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 0 20px rgba(229,0,30,0.3), inset 0 0 15px rgba(229,0,30,0.2); flex-shrink:0;">
                            @if($item->product && $item->product->image)
                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product_name }}"
                                     style="width:100%; height:100%; object-fit:contain; padding:6px; filter:drop-shadow(0 0 12px rgba(255,255,255,0.3)); transition:transform .3s;"
                                     onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                            @else
                                <div style="font-size:2.2rem; filter:drop-shadow(0 0 10px rgba(147,51,234,0.6));">💻</div>
                            @endif
                            <div style="position:absolute; bottom:0; left:0; right:0; height:3px; background:linear-gradient(90deg, transparent, #e5001e, transparent); box-shadow:0 0 8px #e5001e;"></div>
                        </div>

                        {{-- Product Metadata --}}
                        <div>
                            <div style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.05rem; color:#fff; line-height:1.2; text-shadow:0 0 12px rgba(255,255,255,0.2);">
                                {{ $item->product_name }}
                            </div>
                            <div style="display:flex; align-items:center; gap:.8rem; margin-top:.45rem; flex-wrap:wrap;">
                                @if($item->product && $item->product->sku)
                                    <span style="font-family:'Orbitron',sans-serif; font-size:.68rem; color:#d8b4fe; background:rgba(147,51,234,0.18); border:1px solid rgba(147,51,234,0.4); padding:2px 8px; border-radius:4px; font-weight:800;">
                                        SKU: {{ $item->product->sku }}
                                    </span>
                                @endif
                                <span style="font-size:.82rem; color:#94a3b8; font-weight:700;">
                                    Unit Price: <strong style="color:#fff; font-family:'Orbitron',sans-serif;">${{ number_format($item->price, 2) }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Quantity & Extended Total --}}
                    <div style="text-align:right; flex-shrink:0;">
                        <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(96,165,250,0.15); border:1px solid rgba(96,165,250,0.45); padding:4px 12px; border-radius:6px; margin-bottom:.4rem; box-shadow:0 0 10px rgba(96,165,250,0.2);">
                            <span style="font-size:.65rem; color:#94a3b8; font-weight:800; text-transform:uppercase; font-family:'Orbitron',sans-serif;">QTY</span>
                            <span style="font-family:'Orbitron',sans-serif; font-size:1rem; font-weight:900; color:#60a5fa;">{{ $item->quantity }}</span>
                        </div>
                        <div style="font-family:'Orbitron',sans-serif; font-size:1.25rem; font-weight:900; color:#34d399; text-shadow:0 0 12px rgba(34,197,94,0.5);">
                            ${{ number_format($item->total, 2) }}
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

            {{-- Financial Clearance Ledger --}}
            <div style="padding:1.4rem 1.8rem; border-top:1px solid var(--adm-border); background:rgba(0,0,0,0.3); display:flex; flex-direction:column; gap:.6rem; align-items:flex-end;">
                <div style="display:flex; justify-content:space-between; width:290px; font-size:.88rem; color:#94a3b8; font-weight:700;">
                    <span>SUBTOTAL:</span>
                    <span style="color:#fff; font-family:'Orbitron',sans-serif;">${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; width:290px; font-size:.88rem; color:#94a3b8; font-weight:700;">
                    <span>TAX (8% VAT):</span>
                    <span style="color:#fff; font-family:'Orbitron',sans-serif;">${{ number_format($order->tax, 2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; width:290px; font-size:.88rem; color:#94a3b8; font-weight:700;">
                    <span>SHIPPING DISPATCH:</span>
                    <span style="color:{{ $order->shipping == 0 ? '#34d399' : '#fff' }}; font-family:'Orbitron',sans-serif; font-weight:800;">
                        {{ $order->shipping == 0 ? 'COMPLIMENTARY' : '$'.number_format($order->shipping,2) }}
                    </span>
                </div>
                <div style="display:flex; justify-content:space-between; width:290px; font-size:1.3rem; font-weight:900; border-top:1.5px dashed rgba(147,51,234,0.5); padding-top:.8rem; margin-top:.4rem;">
                    <span style="color:#e5001e; font-family:'Orbitron',sans-serif; text-shadow:0 0 10px rgba(229,0,30,0.5);">GRAND TOTAL:</span>
                    <span style="color:#34d399; font-family:'Orbitron',sans-serif; text-shadow:0 0 15px rgba(34,197,94,0.6);">
                        ${{ number_format($order->total, 2) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Destination & Payment Dual Gateway Deck --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem;">
            
            {{-- Delivery Radar Destination Card --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">
                        <span style="color:#60a5fa;">📍</span> DISPATCH DESTINATION
                    </span>
                    <span style="font-family:'Orbitron',sans-serif; font-size:.65rem; color:#34d399; font-weight:800;">
                        GEO-LOCKED
                    </span>
                </div>
                <div style="padding:1.3rem 1.5rem; font-size:.88rem; color:#cbd5e1; line-height:1.85;">
                    <div style="display:flex; align-items:center; gap:.75rem; margin-bottom:.6rem;">
                        <div style="width:38px; height:38px; border-radius:50%; background:linear-gradient(135deg, #e5001e, #7e22ce); display:flex; align-items:center; justify-content:center; font-family:'Orbitron',sans-serif; font-weight:900; font-size:.95rem; color:#fff; box-shadow:0 0 12px rgba(229,0,30,0.5);">
                            {{ strtoupper(substr($order->first_name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="color:#fff; font-weight:800; font-size:1.02rem;">{{ $order->first_name }} {{ $order->last_name }}</div>
                            <div style="font-size:.72rem; color:#94a3b8;">Verified Buyer Account</div>
                        </div>
                    </div>
                    <div>📞 Phone: <strong style="color:#fff;">{{ $order->phone }}</strong></div>
                    <div>🏢 Address: <strong style="color:#fff;">{{ $order->address }}</strong></div>
                    <div>🏙️ Region: {{ $order->city }}{{ $order->state ? ', '.$order->state : '' }} (Postal: {{ $order->zip_code ?: '12000' }})</div>
                    <div>🌐 Country: <strong style="color:#e5001e;">{{ $order->country ?: 'Cambodia' }}</strong></div>
                </div>
            </div>

            {{-- Financial Gateway Pod --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">
                        <span style="color:#fbbf24;">💳</span> FINANCIAL GATEWAY
                    </span>
                    <span style="font-family:'Orbitron',sans-serif; font-size:.65rem; color:#fbbf24; font-weight:800;">
                        ENCRYPTED
                    </span>
                </div>
                <div style="padding:1.3rem 1.5rem; font-size:.88rem; color:#cbd5e1; line-height:1.85;">
                    <div><span style="color:#94a3b8; font-weight:700;">CHANNEL:</span> <strong style="color:#fff; font-family:'Orbitron',sans-serif;">{{ ucwords(str_replace('_',' ',$order->payment_method)) }}</strong></div>
                    <div><span style="color:#94a3b8; font-weight:700;">SETTLEMENT:</span> 
                        <span class="adm-status adm-status--{{ $order->payment_status === 'paid' ? 'confirmed' : 'pending' }}" style="margin-left:.3rem;">
                            {{ strtoupper($order->payment_status) }}
                        </span>
                    </div>
                    <div><span style="color:#94a3b8; font-weight:700;">ENCRYPTION HASH:</span> <span style="font-family:'Orbitron',sans-serif; font-size:.75rem; color:#c084fc;">SHA256-KHQR-{{ strtoupper(substr(md5($order->order_number), 0, 8)) }}</span></div>
                    <div><span style="color:#94a3b8; font-weight:700;">EMAIL CONFIRM:</span> <strong style="color:#fff;">{{ $order->email }}</strong></div>
                    @if($order->notes)
                    <div style="margin-top:.7rem; padding:.6rem .8rem; background:rgba(0,0,0,0.35); border:1px solid rgba(147,51,234,0.3); border-radius:6px; font-size:.82rem;">
                        <span style="color:#e5001e; font-weight:800;">Customer Note:</span> {{ $order->notes }}
                    </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

    {{-- Right Column: Live Status Dispatcher Control Panel --}}
    <div style="display:flex; flex-direction:column; gap:1.4rem;">
        
        {{-- Status Dispatcher Control Deck --}}
        <div class="adm-card">
            <div class="hud-corner-tl"></div>
            <div class="hud-corner-br"></div>
            <div class="adm-card-header">
                <span class="adm-card-title">
                    <span style="color:#e5001e;">⚙️</span> DISPATCH CONTROLLER
                </span>
            </div>
            <div style="padding:1.4rem;">
                <form action="{{ route('admin.orders.status', $order) }}" method="POST" style="display:flex; flex-direction:column; gap:.75rem;">
                    @csrf @method('PATCH')
                    @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $s)
                    <label style="display:flex; align-items:center; justify-content:space-between; cursor:pointer; padding:.65rem .85rem; border:1.5px solid {{ $order->status === $s ? '#e5001e' : 'rgba(147,51,234,0.25)' }}; border-radius:8px; background:{{ $order->status === $s ? 'linear-gradient(90deg, rgba(229,0,30,0.22) 0%, rgba(14,11,28,0.85) 100%)' : 'rgba(0,0,0,0.3)' }}; transition:all .2s; box-shadow:{{ $order->status === $s ? '0 0 15px rgba(229,0,30,0.3)' : 'none' }};"
                           onmouseover="this.style.borderColor='#e5001e'" onmouseout="if(!this.querySelector('input').checked) this.style.borderColor='rgba(147,51,234,0.25)'">
                        <div style="display:flex; align-items:center; gap:.75rem;">
                            <input type="radio" name="status" value="{{ $s }}" {{ $order->status === $s ? 'checked' : '' }} style="accent-color:#e5001e; width:16px; height:16px;">
                            <span style="font-family:'Orbitron',sans-serif; font-size:.82rem; font-weight:800; color:#fff; text-transform:capitalize;">
                                {{ $s }}
                            </span>
                        </div>
                        <span class="adm-status adm-status--{{ $s }}" style="font-size:.68rem;">{{ $s }}</span>
                    </label>
                    @endforeach

                    <button type="submit" style="background:linear-gradient(135deg, #e5001e 0%, #ff0055 100%); border:none; color:#fff; padding:.85rem; border-radius:6px; font-weight:900; font-size:.88rem; cursor:pointer; font-family:'Orbitron',sans-serif; margin-top:.5rem; letter-spacing:.08em; text-transform:uppercase; box-shadow:0 0 20px rgba(229,0,30,0.5); transition:all .2s;" onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 0 30px rgba(229,0,30,0.8)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0 20px rgba(229,0,30,0.5)';">
                        ⚡ COMMIT STATUS UPDATE
                    </button>
                </form>
            </div>
        </div>

        {{-- System Telemetry Node Card --}}
        <div class="adm-card">
            <div class="adm-card-header">
                <span class="adm-card-title">
                    <span style="color:#a855f7;">📋</span> SYSTEM TELEMETRY
                </span>
            </div>
            <div style="padding:1.3rem 1.5rem; display:flex; flex-direction:column; gap:.75rem; font-family:'Orbitron',sans-serif; font-size:.76rem;">
                <div style="display:flex; justify-content:space-between;"><span style="color:#94a3b8;">ORDER PLACED:</span><span style="color:#fff;">{{ $order->created_at->format('M j Y // H:i:s') }}</span></div>
                <div style="display:flex; justify-content:space-between;"><span style="color:#94a3b8;">LAST MODIFIED:</span><span style="color:#fff;">{{ $order->updated_at->format('M j Y // H:i:s') }}</span></div>
                <div style="display:flex; justify-content:space-between;"><span style="color:#94a3b8;">DATABASE ID:</span><span style="color:#c084fc;">#{{ $order->id }}</span></div>
                <div style="display:flex; justify-content:space-between;"><span style="color:#94a3b8;">DISPATCH OPERATOR:</span><span style="color:#22c55e;">SYS_ADMIN_ACTIVE</span></div>
            </div>
        </div>

    </div>
</div>

@endsection
