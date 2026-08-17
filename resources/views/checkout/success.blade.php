@extends('layouts.app')
@section('title', 'Payment Success & Order Confirmed — ROG Store')

@section('content')
<div style="max-width:880px; margin:0 auto; padding:2.5rem 1.2rem 5rem; position:relative; z-index:2;">

    {{-- ═══ 8K 3D CELEBRATION POD ═════════════════════════════════════════════ --}}
    <div style="text-align:center; margin-bottom:2.5rem; position:relative;">

        {{-- 3D Rotating Emerald Pod --}}
        <div style="position:relative; width:100px; height:100px; margin:0 auto 1.5rem; display:flex; align-items:center; justify-content:center; perspective:800px;">
            <div class="rog-8k-ring" style="--pod-color:#22c55e; inset:-8px;"></div>
            <div class="rog-8k-ring-rev" style="--pod-color-2:#00f0ff; inset:-14px;"></div>
            
            <div style="width:84px; height:84px; border-radius:50%; background:radial-gradient(circle at 35% 30%, rgba(34,197,94,0.3) 0%, rgba(10,8,20,0.95) 75%); border:2px solid #22c55e; display:flex; align-items:center; justify-content:center; box-shadow:0 0 35px rgba(34,197,94,0.6), inset 0 0 20px rgba(34,197,94,0.4); z-index:2;">
                <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" style="filter:drop-shadow(0 0 10px #22c55e);">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
        </div>

        {{-- Status Badges --}}
        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(34,197,94,0.12); border:1px solid rgba(34,197,94,0.4); padding:.35rem 1.2rem; border-radius:20px; font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:800; letter-spacing:.2em; color:#22c55e; text-transform:uppercase; margin-bottom:.9rem; box-shadow:0 0 20px rgba(34,197,94,0.25);">
            <span style="width:7px; height:7px; border-radius:50%; background:#22c55e; box-shadow:0 0 8px #22c55e; animation:pulse-beacon 1.1s infinite;"></span>
            PAYMENT 100% CLEARED // ORDER SECURED
        </div>

        <h1 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.8rem,4vw,2.8rem); color:#fff; text-transform:uppercase; letter-spacing:.05em; margin:0 0 .6rem; text-shadow:0 0 25px rgba(34,197,94,0.3);">
            Thank You, <span style="color:#22c55e;">{{ $order->first_name }}!</span>
        </h1>
        
        <p style="color:#94a3b8; font-size:.96rem; max-width:540px; margin:0 auto 1.4rem; line-height:1.6; font-family:'Rajdhani',sans-serif; font-weight:600;">
            Your ROG battle order has been verified with instantaneous clearance. Hardware serial numbers are being reserved from the vault.
        </p>

        {{-- Order ID Pill with Copy Action --}}
        <div style="display:inline-flex; align-items:center; gap:.8rem; background:rgba(13,11,24,0.95); border:1.5px solid rgba(229,0,30,0.5); padding:.6rem 1.4rem; border-radius:8px; box-shadow:0 0 20px rgba(229,0,30,0.25);">
            <span style="color:#94a3b8; font-family:'Orbitron',sans-serif; font-size:.75rem; text-transform:uppercase; letter-spacing:.12em;">Order Number:</span>
            <span id="orderNumberVal" style="color:#ff0055; font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.1rem; letter-spacing:.08em;">{{ $order->order_number }}</span>
            <button type="button" onclick="navigator.clipboard.writeText('{{ $order->order_number }}'); if(window.rogToast) window.rogToast('Order Number Copied! 📋', 'success', 2000);" style="background:rgba(255,255,255,0.08); border:none; color:#cbd5e1; cursor:pointer; padding:4px 8px; border-radius:4px; font-size:.7rem; font-family:'Orbitron',sans-serif; font-weight:700; transition:all .2s;" onmouseover="this.style.background='#e5001e'; this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.08)'; this.style.color='#cbd5e1'">
                COPY 📋
            </button>
        </div>

    </div>

    {{-- ═══ DYNAMIC DELIVERY TELEMETRY PIPELINE ════════════════════════════════ --}}
    <div style="background:rgba(13, 11, 24, 0.9); border:1px solid rgba(147, 51, 234, 0.3); border-radius:12px; padding:1.8rem; margin-bottom:2.2rem; backdrop-filter:blur(16px); position:relative; overflow:hidden; box-shadow:0 15px 40px rgba(0,0,0,0.6);">
        <div class="hud-corner-tl"></div>
        <div class="hud-corner-br"></div>
        <div class="rog-why-laser" style="--pod-color:#00f0ff; opacity:.7;"></div>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:.8rem;">
            <div style="display:flex; align-items:center; gap:8px;">
                <span style="font-size:1.1rem;">🚀</span>
                <span style="font-family:'Orbitron',sans-serif; font-size:.85rem; font-weight:800; color:#fff; text-transform:uppercase; letter-spacing:.1em;">Live Fulfillment Telemetry</span>
            </div>
            <div style="font-family:'Orbitron',sans-serif; font-size:.72rem; color:#22c55e; font-weight:700; background:rgba(34,197,94,0.1); padding:3px 10px; border-radius:12px; border:1px solid rgba(34,197,94,0.3);">
                ESTIMATED ARRIVAL: WITHIN 24 HOURS
            </div>
        </div>

        {{-- 4-Stage Stepper Track --}}
        <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:.8rem; position:relative;" class="delivery-steps-grid">
            
            {{-- Step 1: Cleared --}}
            <div style="text-align:center; position:relative;">
                <div style="width:40px; height:40px; border-radius:50%; background:#22c55e; color:#000; font-weight:900; font-size:1.1rem; display:flex; align-items:center; justify-content:center; margin:0 auto .6rem; box-shadow:0 0 16px rgba(34,197,94,0.7);">
                    ✓
                </div>
                <div style="font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:800; color:#22c55e; text-transform:uppercase;">Payment Paid</div>
                <div style="font-family:'Rajdhani',sans-serif; font-size:.74rem; color:#94a3b8; margin-top:2px;">Instant 1s Clearance</div>
            </div>

            {{-- Step 2: Vault Packing --}}
            <div style="text-align:center; position:relative;">
                <div style="width:40px; height:40px; border-radius:50%; background:rgba(0,240,255,0.15); border:2px solid #00f0ff; color:#00f0ff; font-weight:900; font-size:1.1rem; display:flex; align-items:center; justify-content:center; margin:0 auto .6rem; box-shadow:0 0 16px rgba(0,240,255,0.5); animation:pulse-beacon 1.5s infinite;">
                    📦
                </div>
                <div style="font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:800; color:#00f0ff; text-transform:uppercase;">Vault Packing</div>
                <div style="font-family:'Rajdhani',sans-serif; font-size:.74rem; color:#94a3b8; margin-top:2px;">Serial Allocation</div>
            </div>

            {{-- Step 3: High-Speed Dispatch --}}
            <div style="text-align:center; opacity:.55;">
                <div style="width:40px; height:40px; border-radius:50%; background:rgba(255,255,255,0.05); border:1.5px dashed rgba(255,255,255,0.2); color:#94a3b8; font-weight:800; font-size:.95rem; display:flex; align-items:center; justify-content:center; margin:0 auto .6rem;">
                    🚀
                </div>
                <div style="font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:700; color:#94a3b8; text-transform:uppercase;">Dispatch</div>
                <div style="font-family:'Rajdhani',sans-serif; font-size:.74rem; color:#64748b; margin-top:2px;">Phnom Penh Transit</div>
            </div>

            {{-- Step 4: Final Handover --}}
            <div style="text-align:center; opacity:.55;">
                <div style="width:40px; height:40px; border-radius:50%; background:rgba(255,255,255,0.05); border:1.5px dashed rgba(255,255,255,0.2); color:#94a3b8; font-weight:800; font-size:.95rem; display:flex; align-items:center; justify-content:center; margin:0 auto .6rem;">
                    📍
                </div>
                <div style="font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:700; color:#94a3b8; text-transform:uppercase;">Handover</div>
                <div style="font-family:'Rajdhani',sans-serif; font-size:.74rem; color:#64748b; margin-top:2px;">To Doorstep</div>
            </div>

        </div>
    </div>

    {{-- ═══ 3D CYBER HARDWARE INVOICE DOSSIER ═══════════════════════════════════ --}}
    <div id="rogPrintableReceipt" style="background:rgba(13, 11, 24, 0.95); border:1px solid rgba(147, 51, 234, 0.35); border-top:3px solid #22c55e; border-radius:12px; overflow:hidden; backdrop-filter:blur(20px); box-shadow:0 20px 60px rgba(0,0,0,0.7), 0 0 35px rgba(34,197,94,0.15); margin-bottom:2.5rem; position:relative;">
        <div class="hud-corner-tl"></div>
        <div class="hud-corner-br"></div>

        {{-- Dossier Header --}}
        <div style="padding:1.4rem 1.8rem; background:rgba(20, 16, 38, 0.95); border-bottom:1px solid rgba(147, 51, 234, 0.25); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
            <div>
                <div style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.1rem; color:#fff; letter-spacing:.08em; display:flex; align-items:center; gap:10px;">
                    <span style="color:#e5001e;">ROG</span> HARDWARE DOSSIER
                    <span style="font-size:.65rem; color:#22c55e; background:rgba(34,197,94,0.12); padding:2px 8px; border-radius:4px; border:1px solid rgba(34,197,94,0.3);">
                        VERIFIED TRANSACTION
                    </span>
                </div>
                <div style="font-family:'Rajdhani',sans-serif; font-size:.82rem; color:#94a3b8; margin-top:.2rem;">
                    Timestamp: {{ $order->created_at->format('F j, Y — g:i:s A T') }}
                </div>
            </div>
            <div style="text-align:right;">
                <div style="font-family:'Orbitron',sans-serif; font-size:.72rem; color:#94a3b8; text-transform:uppercase;">Payment Method:</div>
                <div style="font-family:'Orbitron',sans-serif; font-weight:800; font-size:.9rem; color:#ff4d6d; text-transform:uppercase;">
                    {{ ucwords(str_replace('_',' ',$order->payment_method)) }}
                </div>
            </div>
        </div>

        {{-- Line Items Table --}}
        <div style="padding:1rem 1.8rem;">
            @foreach($order->items as $item)
            @php
                $itemKHR = $item->total * 4050;
            @endphp
            <div style="display:flex; gap:1.2rem; padding:1.2rem 0; border-bottom:1px solid rgba(147,51,234,0.15); align-items:center;">
                <div style="width:78px; height:68px; background:rgba(8,7,16,0.9); border:1px solid rgba(147,51,234,0.3); border-radius:8px; padding:6px; flex-shrink:0; display:flex; align-items:center; justify-content:center;">
                    <img src="{{ $item->product->image ?? '' }}" alt="{{ $item->product_name }}"
                         style="width:100%; height:100%; object-fit:contain;"
                         onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=150&q=60'">
                </div>
                <div style="flex:1; min-width:0;">
                    <div style="font-weight:700; color:#fff; font-size:.94rem; margin-bottom:.25rem; font-family:'Rajdhani',sans-serif;">
                        {{ $item->product_name }}
                    </div>
                    <div style="color:#94a3b8; font-size:.8rem; font-family:'Rajdhani',sans-serif; font-weight:600;">
                        Quantity: <strong style="color:#fff;">{{ $item->quantity }}</strong> &times; ${{ number_format($item->price, 2) }}
                    </div>
                </div>
                <div style="text-align:right;">
                    <div style="font-family:'Orbitron',sans-serif; font-weight:900; color:#ff0055; font-size:1.05rem;">
                        ${{ number_format($item->total, 2) }}
                    </div>
                    <div style="font-family:'Battambang',sans-serif; font-size:.72rem; color:#64748b;">
                        ≈ ៛{{ number_format($itemKHR) }}
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Summary Totals --}}
            <div style="padding:1.4rem 0 .5rem;">
                <div style="display:flex; justify-content:space-between; font-size:.88rem; color:#94a3b8; margin-bottom:.6rem; font-family:'Rajdhani',sans-serif; font-weight:600;">
                    <span>Hardware Subtotal</span>
                    <span style="color:#fff; font-family:'Orbitron',sans-serif; font-weight:700;">${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:.88rem; color:#94a3b8; margin-bottom:.6rem; font-family:'Rajdhani',sans-serif; font-weight:600;">
                    <span>Estimated Tax (8%)</span>
                    <span style="color:#fff; font-family:'Orbitron',sans-serif; font-weight:700;">${{ number_format($order->tax, 2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:.88rem; color:#94a3b8; margin-bottom:1rem; font-family:'Rajdhani',sans-serif; font-weight:600;">
                    <span>Nationwide Express Delivery</span>
                    <span style="color:#22c55e; font-family:'Orbitron',sans-serif; font-weight:800;">
                        {{ $order->shipping == 0 ? 'FREE DELIVERY' : '$'.number_format($order->shipping, 2) }}
                    </span>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:baseline; border-top:1.5px solid rgba(147,51,234,0.3); padding-top:1.1rem; margin-top:.4rem;">
                    <span style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.05rem; color:#fff; text-transform:uppercase; letter-spacing:.08em;">Total Paid</span>
                    <div style="text-align:right;">
                        <span style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1.7rem; color:#22c55e; text-shadow:0 0 20px rgba(34,197,94,0.6);">${{ number_format($order->total, 2) }}</span>
                        <div style="font-family:'Battambang',sans-serif; font-size:.82rem; color:#94a3b8; margin-top:2px;">
                            ≈ ៛{{ number_format($order->total * 4050) }} KHR
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Shipping & Contact Info Grid --}}
        <div style="background:rgba(8, 7, 16, 0.9); border-top:1px solid rgba(147, 51, 234, 0.25); padding:1.5rem 1.8rem; display:grid; grid-template-columns:1fr 1fr; gap:1.8rem;" class="receipt-dossier-grid">
            <div>
                <div style="font-family:'Orbitron',sans-serif; font-size:.74rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:#ff4d6d; margin-bottom:.7rem; display:flex; align-items:center; gap:6px;">
                    <span>📍</span> Destination Dossier
                </div>
                <div style="color:#cbd5e1; font-family:'Rajdhani',sans-serif; font-size:.92rem; line-height:1.7; font-weight:600;">
                    <strong style="color:#fff; font-size:.98rem;">{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                    {{ $order->address }}<br>
                    {{ $order->city }}{{ $order->state ? ', '.$order->state : '' }} {{ $order->zip_code }}<br>
                    {{ $order->country }}<br>
                    <span style="color:#94a3b8;">Phone: {{ $order->phone ?? '+855 (Contact Registered)' }}</span>
                </div>
            </div>
            <div>
                <div style="font-family:'Orbitron',sans-serif; font-size:.74rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:#00f0ff; margin-bottom:.7rem; display:flex; align-items:center; gap:6px;">
                    <span>🛡️</span> Warranty & Security Clearance
                </div>
                <div style="color:#cbd5e1; font-family:'Rajdhani',sans-serif; font-size:.92rem; line-height:1.7; font-weight:600;">
                    <strong>ASUS Official Warranty:</strong> <span style="color:#22c55e;">2-Year Global Protection</span><br>
                    <strong>Clearance Hash:</strong> <span style="font-family:'Orbitron',sans-serif; font-size:.75rem; color:#94a3b8;">{{ strtoupper(substr(md5($order->order_number . $order->total), 0, 16)) }}</span><br>
                    <strong>Confirmation Email:</strong> <span style="color:#fff;">{{ $order->email }}</span><br>
                    <strong>Status:</strong> <span style="color:#22c55e; font-weight:800;">● CLEARED & PAID</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ═══ DYNAMIC ACTION HUB ═════════════════════════════════════════════════ --}}
    <div style="display:flex; gap:1.2rem; justify-content:center; flex-wrap:wrap;">
        <button type="button" onclick="window.print()" class="btn-rog" style="padding:.85rem 1.8rem; font-family:'Orbitron',sans-serif; font-size:.86rem; font-weight:800; display:inline-flex; align-items:center; gap:8px; cursor:pointer;">
            <span>🖨️ PRINT RECEIPT</span>
        </button>

        <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none; padding:.85rem 1.8rem; font-family:'Orbitron',sans-serif; font-size:.86rem; font-weight:800; display:inline-flex; align-items:center; gap:8px;">
            <span>🛒 BROWSE MORE GEAR</span>
        </a>

        <a href="{{ route('home') }}" class="btn-rog-outline" style="text-decoration:none; padding:.85rem 1.8rem; font-family:'Orbitron',sans-serif; font-size:.86rem; font-weight:800; display:inline-flex; align-items:center; gap:8px;">
            <span>🏠 RETURN HOME</span>
        </a>
    </div>

</div>

{{-- AI Personalized Audio Voice Thank You Trigger --}}
<script>
var currentSuccessAudio = null;

function playThankYouVoice(lang) {
    if (currentSuccessAudio) {
        currentSuccessAudio.pause();
        currentSuccessAudio = null;
    }

    var avatar = document.getElementById('rogAiVoiceAvatar');

    var text = '';
    if (lang === 'kh') {
        text = 'សូមអរគុណច្រើនបង {{ addslashes($order->first_name) }}! ការទូទាត់ប្រាក់សម្រាប់កុម្ម៉ង់លេខ {{ $order->order_number }} ត្រូវបានជោគជ័យ ១០០% ហើយ។ ក្រុមការងារ ROG Store នឹងរៀបចំផ្ញើទំនិញជូនបងក្នុងរយៈពេល ២៤ ម៉ោង។ សូមអរគុណបង {{ addslashes($order->first_name) }}!';
    } else {
        text = 'Thank you {{ addslashes($order->first_name) }}! Your payment for ROG Order {{ $order->order_number }} has been confirmed with instant clearance. Your gaming gear is now being packed and dispatched. Thank you for choosing Republic of Gamers!';
    }

    var ttsUrl = '/api/ai/tts?lang=' + encodeURIComponent(lang === 'kh' ? 'km' : 'en') + '&text=' + encodeURIComponent(text);
    var audio = new Audio(ttsUrl);
    currentSuccessAudio = audio;
    audio.volume = 0.95;

    if (avatar) {
        avatar.style.transform = 'scale(1.15)';
        avatar.style.boxShadow = '0 0 20px #00f0ff';
        avatar.style.borderColor = '#22c55e';
    }

    audio.onended = function () {
        if (avatar) {
            avatar.style.transform = 'scale(1)';
            avatar.style.boxShadow = '0 0 12px rgba(0,240,255,0.5)';
            avatar.style.borderColor = '#00f0ff';
        }
        currentSuccessAudio = null;
    };

    audio.onerror = function () {
        if (avatar) {
            avatar.style.transform = 'scale(1)';
            avatar.style.boxShadow = '0 0 12px rgba(0,240,255,0.5)';
            avatar.style.borderColor = '#00f0ff';
        }
        currentSuccessAudio = null;
    };

    var p = audio.play();
    if (p !== undefined) {
        p.catch(function (e) {
            console.log('Autoplay restriction, user can click button:', e);
        });
    }

    if (window.rogToast) {
        var msg = lang === 'kh' ? '🔊 AI កំពុងថ្លែងអំណរគុណបង {{ addslashes($order->first_name) }}...' : '🔊 AI Speaking: Thank you {{ addslashes($order->first_name) }}!';
        window.rogToast(msg, 'success', 3000);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Automatically play personalized Khmer voice thank you on load after 400ms
    setTimeout(function () {
        playThankYouVoice('kh');
    }, 400);
});
</script>

<style>
@media print {
  body * { visibility: hidden; }
  #rogPrintableReceipt, #rogPrintableReceipt * { visibility: visible; }
  #rogPrintableReceipt {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    background: #fff !important;
    color: #000 !important;
    border: 1px solid #ccc !important;
  }
}

@media(max-width:768px) {
  .delivery-steps-grid {
    grid-template-columns: repeat(2, 1fr) !important;
  }
  .receipt-dossier-grid {
    grid-template-columns: 1fr !important;
  }
}
</style>
@endsection
