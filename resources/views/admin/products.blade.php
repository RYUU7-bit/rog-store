@extends('admin.layout')
@section('title','Hardware Inventory Grid')
@section('page-title','Hardware Inventory Grid')

@section('content')

{{-- ═══ 1. COMMAND & FILTER ACTION BAR ═══════════════════════════════════════ --}}
<div style="background:var(--adm-surface); padding:.9rem 1.2rem; border-radius:8px; border:1px solid var(--adm-border); backdrop-filter:blur(16px); margin-bottom:1.4rem; display:flex; gap:.75rem; flex-wrap:wrap; align-items:center; box-shadow:0 6px 20px rgba(0,0,0,0.4);">
    <form method="GET" action="{{ route('admin.products') }}" style="display:flex; gap:.75rem; flex-wrap:wrap; align-items:center; flex:1; min-width:280px;">
        <div style="position:relative; flex:1; min-width:180px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search hardware model, SKU…"
                   style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem 1rem; border-radius:6px; font-size:.85rem; outline:none; width:100%; font-family:'Rajdhani',sans-serif; font-weight:600; transition:border-color .2s;" onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
        </div>
        <div>
            <select name="category" style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem .9rem; border-radius:6px; font-size:.85rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:700;">
                <option value="">All Hardware Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" style="background:linear-gradient(135deg, #e5001e, #ff0055); border:none; color:#fff; padding:.55rem 1.3rem; border-radius:6px; font-size:.82rem; cursor:pointer; font-family:'Orbitron',sans-serif; font-weight:800; letter-spacing:.06em; box-shadow:0 0 12px rgba(229,0,30,0.4); transition:all .2s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
            FILTER
        </button>
        @if(request()->hasAny(['search','category']))
            <a href="{{ route('admin.products') }}" style="font-family:'Orbitron',sans-serif; font-size:.75rem; color:#94a3b8; text-decoration:none; padding:.55rem .7rem; font-weight:700;">
                ✕ CLEAR
            </a>
        @endif
    </form>

    {{-- Prominent Add Product Buttons --}}
    <div style="display:flex; align-items:center; gap:.65rem; margin-left:auto; flex-wrap:wrap;">
        <button type="button" onclick="openCreateModal()" class="btn-rog"
                style="display:inline-flex; align-items:center; gap:6px; background:linear-gradient(135deg, #e5001e 0%, #ff0055 100%); color:#fff; border:none; padding:.58rem 1.3rem; border-radius:6px; font-family:'Orbitron',sans-serif; font-weight:900; font-size:.82rem; letter-spacing:.06em; cursor:pointer; box-shadow:0 0 18px rgba(229,0,30,0.55); transition:all .2s;"
                onmouseover="this.style.transform='scale(1.04)'; this.style.boxShadow='0 0 24px rgba(229,0,30,0.8)';"
                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0 18px rgba(229,0,30,0.55)';">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            + DEPLOY NEW HARDWARE
        </button>

        <a href="{{ route('admin.products.create') }}"
           style="display:inline-flex; align-items:center; gap:4px; background:rgba(147,51,234,0.18); border:1px solid rgba(147,51,234,0.5); color:#c084fc; padding:.55rem .9rem; border-radius:6px; font-family:'Orbitron',sans-serif; font-size:.76rem; font-weight:800; text-decoration:none; transition:all .2s;"
           onmouseover="this.style.background='rgba(147,51,234,0.35)'; this.style.color='#fff';"
           onmouseout="this.style.background='rgba(147,51,234,0.18)'; this.style.color='#c084fc';">
            FULL CREATOR ↗
        </a>

        <div style="font-family:'Orbitron',sans-serif; font-size:.78rem; color:#c084fc; font-weight:800; display:flex; align-items:center; gap:6px; padding-left:.5rem; border-left:1px solid rgba(147,51,234,0.3);">
            <span style="color:#e5001e;">●</span> {{ $products->total() }} ACTIVE SKUs
        </div>
    </div>
</div>

{{-- ═══ 2. HARDWARE INVENTORY TABLE ═════════════════════════════════════════ --}}
<div class="adm-card">
    <div class="hud-corner-tl"></div>
    <div class="hud-corner-br"></div>
    <div style="overflow-x:auto;">
        <table class="adm-table" id="hardwareInventoryTable">
            <thead>
                <tr>
                    <th style="width:65px;">Preview</th>
                    <th>Hardware Model</th>
                    <th>SKU Identifier</th>
                    <th>Category</th>
                    <th>MSRP</th>
                    <th>Sale Price</th>
                    <th>Discount</th>
                    <th style="min-width:140px;">Stock Reserve</th>
                    <th>Catalog State</th>
                    <th>Featured</th>
                    <th style="text-align:right; min-width:190px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr id="product-row-{{ $product->id }}"
                    data-id="{{ $product->id }}"
                    data-name="{{ strtolower($product->name) }}"
                    data-sku="{{ strtolower($product->sku) }}"
                    data-cat="{{ $product->category_id }}"
                    data-active="{{ $product->is_active ? '1' : '0' }}"
                    data-featured="{{ $product->is_featured ? '1' : '0' }}"
                    data-sale="{{ $product->sale_price ? '1' : '0' }}"
                    data-stock="{{ $product->stock }}">
                    
                    {{-- Asset Thumbnail Preview --}}
                    <td>
                        <div style="position:relative; width:48px; height:48px; border-radius:8px; background:rgba(0,0,0,0.6); border:1.5px solid rgba(147,51,234,0.35); overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 0 10px rgba(0,0,0,0.4); cursor:pointer;" onclick="openQuickEdit({{ $product->id }})" title="Click to Quick Edit">
                            <img id="row-img-{{ $product->id }}" src="{{ $product->image }}" alt="{{ $product->name }}"
                                 style="width:100%; height:100%; object-fit:contain; padding:3px; transition:transform .2s;"
                                 onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"
                                 onerror="this.src='{{ asset('images/product-fallback.svg') }}'">
                        </div>
                    </td>

                    {{-- Name & ID --}}
                    <td>
                        <div style="display:flex; align-items:center; gap:6px;">
                            <a href="javascript:void(0)" onclick="openQuickEdit({{ $product->id }})" id="row-name-{{ $product->id }}" style="font-weight:700; font-size:.9rem; color:#fff; text-decoration:none; max-width:210px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; transition:color .2s;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#fff'">
                                {{ $product->name }}
                            </a>
                        </div>
                        <div style="font-family:'Orbitron',sans-serif; font-size:.68rem; color:#94a3b8; margin-top:2px;">
                            ID: #{{ $product->id }} &bull; <a href="{{ route('product.show', $product->slug) }}" target="_blank" style="color:#64748b; text-decoration:none;" onmouseover="this.style.color='#60a5fa'" onmouseout="this.style.color='#64748b'">/{{ $product->slug }} ↗</a>
                        </div>
                    </td>

                    {{-- SKU --}}
                    <td style="font-family:'Orbitron',sans-serif; font-size:.76rem; color:#cbd5e1; font-weight:700;">
                        <span id="row-sku-{{ $product->id }}">{{ $product->sku }}</span>
                    </td>

                    {{-- Category --}}
                    <td>
                        <span id="row-cat-{{ $product->id }}" style="font-size:.78rem; font-weight:700; color:#c084fc; background:rgba(147,51,234,0.12); padding:3px 8px; border-radius:4px; border:1px solid rgba(147,51,234,0.3);">
                            {{ $product->category->name ?? '—' }}
                        </span>
                    </td>

                    {{-- MSRP --}}
                    <td style="font-family:'Orbitron',sans-serif; font-weight:800; color:#fff;">
                        <span id="row-msrp-{{ $product->id }}">${{ number_format($product->price,2) }}</span>
                    </td>

                    {{-- Sale Price --}}
                    <td>
                        <div id="row-saleprice-{{ $product->id }}">
                            @if($product->sale_price)
                                <span style="font-family:'Orbitron',sans-serif; font-weight:900; color:#34d399; text-shadow:0 0 8px rgba(34,197,94,0.4);">${{ number_format($product->sale_price,2) }}</span>
                            @else
                                <span style="color:#64748b; font-size:.78rem;">—</span>
                            @endif
                        </div>
                    </td>

                    {{-- Discount --}}
                    <td>
                        <div id="row-discount-{{ $product->id }}">
                            @if($product->sale_price)
                                <span style="background:rgba(229,0,30,.18); border:1px solid rgba(229,0,30,0.5); color:#ff4d6d; font-family:'Orbitron',sans-serif; font-size:.68rem; font-weight:900; padding:2px 8px; border-radius:10px; box-shadow:0 0 6px rgba(229,0,30,0.3);">
                                    -{{ $product->discount_percent }}%
                                </span>
                            @else
                                <span style="color:#64748b; font-size:.78rem;">—</span>
                            @endif
                        </div>
                    </td>

                    {{-- Inline Interactive Stock Controls --}}
                    <td>
                        <div style="display:inline-flex; align-items:center; background:rgba(0,0,0,0.55); border:1px solid rgba(147,51,234,0.35); border-radius:6px; padding:2px;">
                            <button type="button" onclick="quickAdjustStock({{ $product->id }}, -1)" style="background:rgba(255,255,255,0.06); border:none; color:#fff; cursor:pointer; width:24px; height:24px; border-radius:4px; font-weight:900; font-size:.9rem; display:flex; align-items:center; justify-content:center; transition:background .15s;" onmouseover="this.style.background='#e5001e'" onmouseout="this.style.background='rgba(255,255,255,0.06)'" title="Decrease Stock by 1">−</button>
                            
                            <input type="number" id="stock-input-{{ $product->id }}" value="{{ $product->stock }}" min="0"
                                   style="width:48px; background:transparent; border:none; color:{{ $product->stock === 0 ? '#ef4444' : ($product->stock <= 5 ? '#fbbf24' : '#86efac') }}; text-align:center; font-family:'Orbitron',sans-serif; font-weight:800; font-size:.82rem; outline:none;"
                                   onchange="submitQuickStock({{ $product->id }}, this.value)">
                            
                            <button type="button" onclick="quickAdjustStock({{ $product->id }}, 1)" style="background:rgba(255,255,255,0.06); border:none; color:#fff; cursor:pointer; width:24px; height:24px; border-radius:4px; font-weight:900; font-size:.9rem; display:flex; align-items:center; justify-content:center; transition:background .15s;" onmouseover="this.style.background='#22c55e'" onmouseout="this.style.background='rgba(255,255,255,0.06)'" title="Increase Stock by 1">+</button>
                        </div>
                    </td>

                    {{-- Catalog State Toggle --}}
                    <td>
                        <button type="button" id="btn-toggle-active-{{ $product->id }}" onclick="toggleProductActive({{ $product->id }})"
                                style="background:none; border:none; cursor:pointer; padding:0;" title="Click to Toggle State">
                            <span class="adm-status {{ $product->is_active ? 'adm-status--confirmed' : 'adm-status--cancelled' }}" id="status-badge-{{ $product->id }}">
                                {{ $product->is_active ? 'Active' : 'Offline' }}
                            </span>
                        </button>
                    </td>

                    {{-- Featured Toggle --}}
                    <td>
                        <button type="button" id="btn-toggle-feat-{{ $product->id }}" onclick="toggleProductFeatured({{ $product->id }})"
                                style="background:none; border:none; cursor:pointer; font-size:1.15rem; color:{{ $product->is_featured ? '#fbbf24' : '#475569' }}; transition:all .2s; filter:drop-shadow(0 0 {{ $product->is_featured ? '6px #fbbf24' : '0' }});"
                                title="{{ $product->is_featured ? 'Featured Hardware (Click to toggle)' : 'Not Featured (Click to toggle)' }}">
                            {{ $product->is_featured ? '★' : '☆' }}
                        </button>
                    </td>

                    {{-- Actions Pod --}}
                    <td style="text-align:right; white-space:nowrap;">
                        <div style="display:inline-flex; align-items:center; gap:.35rem; justify-content:flex-end;">
                            {{-- Quick Edit Modal Trigger --}}
                            <button type="button" onclick="openQuickEdit({{ $product->id }})"
                                    style="display:inline-flex; align-items:center; gap:.25rem; background:rgba(147,51,234,0.18); color:#c084fc; border:1px solid rgba(147,51,234,0.4); padding:.32rem .65rem; border-radius:5px; font-family:'Orbitron',sans-serif; font-size:.68rem; font-weight:800; cursor:pointer; transition:all .15s;"
                                    onmouseover="this.style.background='#9333ea'; this.style.color='#fff';"
                                    onmouseout="this.style.background='rgba(147,51,234,0.18)'; this.style.color='#c084fc';">
                                ⚡ QUICK
                            </button>

                            {{-- Full Edit Page --}}
                            <a href="{{ route('admin.products.edit', $product) }}"
                               style="display:inline-flex; align-items:center; gap:.25rem; background:linear-gradient(135deg, #e5001e, #ff0055); color:#fff; border:none; padding:.32rem .75rem; border-radius:5px; font-family:'Orbitron',sans-serif; font-size:.68rem; font-weight:800; text-decoration:none; letter-spacing:.04em; transition:all .15s; box-shadow:0 0 8px rgba(229,0,30,0.3);"
                               onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                EDIT
                            </a>

                            {{-- Storefront Link --}}
                            <a href="{{ route('product.show', $product->slug) }}" target="_blank"
                               style="display:inline-flex; align-items:center; gap:.25rem; background:var(--adm-surface2); color:#cbd5e1; border:1px solid rgba(147,51,234,0.3); padding:.32rem .65rem; border-radius:5px; font-family:'Orbitron',sans-serif; font-size:.68rem; font-weight:700; text-decoration:none; transition:all .15s;"
                               onmouseover="this.style.borderColor='#e5001e'; this.style.color='#e5001e'; this.style.boxShadow='0 0 8px rgba(229,0,30,0.3)';"
                               onmouseout="this.style.borderColor='rgba(147,51,234,0.3)'; this.style.color='#cbd5e1'; this.style.boxShadow='none';"
                               title="View Live in Storefront">
                                ↗
                            </a>

                            {{-- Delete Button --}}
                            <button type="button" onclick="confirmDeleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                    style="background:rgba(239,68,68,0.12); color:#fca5a5; border:1px solid rgba(239,68,68,0.3); padding:.32rem .55rem; border-radius:5px; font-family:'Orbitron',sans-serif; font-size:.68rem; cursor:pointer; font-weight:800; transition:all .15s;"
                                    onmouseover="this.style.background='#ef4444'; this.style.color='#fff';"
                                    onmouseout="this.style.background='rgba(239,68,68,0.12)'; this.style.color='#fca5a5';"
                                    title="Deactivate / Delete">
                                ✕
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" style="text-align:center; padding:3.5rem; color:#94a3b8; font-size:.9rem;">
                        <div style="font-size:2.2rem; margin-bottom:.5rem;">🔍</div>
                        <div style="font-family:'Orbitron',sans-serif; font-weight:700; color:#fff;">No hardware products found</div>
                        <div style="margin-top:.4rem;">Click <strong>"+ DEPLOY NEW HARDWARE"</strong> above to register a product.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
    <div style="padding:1rem 1.4rem; border-top:1px solid var(--adm-border); display:flex; align-items:center; justify-content:space-between; font-family:'Orbitron',sans-serif; font-size:.78rem; color:#94a3b8; background:rgba(0,0,0,0.2);">
        <span>SHOWING {{ $products->firstItem() }}–{{ $products->lastItem() }} OF {{ $products->total() }} HARDWARE SKUs</span>
        <div style="display:flex; gap:.5rem;">
            @if($products->onFirstPage())
                <span style="padding:.35rem .8rem; border:1px solid var(--adm-border); border-radius:4px; opacity:.35; cursor:not-allowed;">‹ PREV</span>
            @else
                <a href="{{ $products->previousPageUrl() }}" style="padding:.35rem .8rem; border:1px solid var(--adm-border); border-radius:4px; color:#fff; text-decoration:none; background:var(--adm-surface2);">‹ PREV</a>
            @endif
            @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" style="padding:.35rem .8rem; border:1px solid #e5001e; border-radius:4px; color:#fff; background:#e5001e; text-decoration:none; box-shadow:0 0 8px rgba(229,0,30,0.4);">NEXT ›</a>
            @else
                <span style="padding:.35rem .8rem; border:1px solid var(--adm-border); border-radius:4px; opacity:.35; cursor:not-allowed;">NEXT ›</span>
            @endif
        </div>
    </div>
    @endif
</div>

{{-- ═══ 3. HOLOGRAPHIC MODAL: DEPLOY NEW HARDWARE ════════════════════════════ --}}
<div id="createHardwareModal" style="display:none; position:fixed; inset:0; background:rgba(5,3,15,0.88); backdrop-filter:blur(20px); z-index:99999; align-items:center; justify-content:center; padding:1.2rem;">
    <div class="adm-card" style="width:100%; max-width:820px; max-height:92vh; overflow-y:auto; border-color:rgba(229,0,30,0.6); box-shadow:0 0 50px rgba(229,0,30,0.35); position:relative;">
        <div class="hud-corner-tl"></div>
        <div class="hud-corner-br"></div>

        <div class="adm-card-header" style="background:rgba(20,16,38,0.95); position:sticky; top:0; z-index:10;">
            <span class="adm-card-title" style="font-size:.98rem; display:flex; align-items:center; gap:8px;">
                <span style="color:#e5001e;">🚀</span> Deploy New Hardware to ROG Catalog
            </span>
            <button type="button" onclick="closeCreateModal()" style="background:none; border:none; color:#94a3b8; font-size:1.4rem; cursor:pointer; line-height:1; font-weight:700;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#94a3b8'">×</button>
        </div>

        <form id="createHardwareForm" onsubmit="submitCreateHardwareForm(event)" enctype="multipart/form-data" style="padding:1.4rem; display:flex; flex-direction:column; gap:1.2rem;">
            @csrf

            <div style="display:grid; grid-template-columns:1.4fr 1fr; gap:1rem;">
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Hardware Model Name *</label>
                    <input type="text" name="name" id="c-name" required placeholder="e.g. ROG Swift OLED PG49WCD"
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.6rem .9rem; border-radius:6px; font-size:.9rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:700;"
                           onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'"
                           oninput="autoGenerateCreateSku(this.value)">
                </div>
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.35rem;">
                        <label style="font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; font-family:'Orbitron',sans-serif;">SKU Code *</label>
                        <button type="button" onclick="manualGenerateCreateSku()" style="background:none; border:none; color:#c084fc; font-size:.65rem; font-family:'Orbitron',sans-serif; font-weight:800; cursor:pointer; text-decoration:underline;">⚡ AUTO SKU</button>
                    </div>
                    <input type="text" name="sku" id="c-sku" required placeholder="ROG-PG49WCD"
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#38bdf8; padding:.6rem .9rem; border-radius:6px; font-size:.85rem; outline:none; font-family:'Orbitron',sans-serif; font-weight:800;"
                           onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem;">
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Category *</label>
                    <select name="category_id" id="c-cat" required style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.6rem .9rem; border-radius:6px; font-size:.85rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:700;">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">MSRP Price ($) *</label>
                    <input type="number" name="price" id="c-price" step="0.01" min="0" required placeholder="1299.99"
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.6rem .9rem; border-radius:6px; font-size:.95rem; font-weight:800; outline:none; font-family:'Orbitron',sans-serif;"
                           onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'" oninput="updateCreateDiscountCalc()">
                </div>
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Sale Price ($) <span style="color:#22c55e; font-size:.62rem;">(OPT)</span></label>
                    <input type="number" name="sale_price" id="c-sale-price" step="0.01" min="0" placeholder="1099.99"
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#34d399; padding:.6rem .9rem; border-radius:6px; font-size:.95rem; font-weight:800; outline:none; font-family:'Orbitron',sans-serif;"
                           onfocus="this.style.borderColor='#22c55e'" onblur="this.style.borderColor='var(--adm-border)'" oninput="updateCreateDiscountCalc()">
                </div>
            </div>

            {{-- Live Discount & Savings Badge --}}
            <div id="c-discount-pill" style="display:none; padding:.4rem .8rem; border-radius:6px; background:rgba(229,0,30,0.15); border:1px solid rgba(229,0,30,0.4); color:#ff4d6d; font-family:'Orbitron',sans-serif; font-size:.75rem; font-weight:900;"></div>

            {{-- Stock & Image Pickers --}}
            <div style="display:grid; grid-template-columns:1fr 1.6fr; gap:1rem; align-items:start;">
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Stock Reserve (Units) *</label>
                    <input type="number" name="stock" id="c-stock" min="0" value="25" required
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#86efac; padding:.6rem .9rem; border-radius:6px; font-size:1.1rem; font-weight:800; text-align:center; outline:none; font-family:'Orbitron',sans-serif;">
                    
                    <div style="display:flex; gap:.3rem; margin-top:.4rem; justify-content:center;">
                        @foreach([10, 25, 50, 100] as $sq)
                        <button type="button" onclick="document.getElementById('c-stock').value={{ $sq }}" style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:2px 6px; border-radius:3px; font-size:.68rem; font-family:'Orbitron',sans-serif; cursor:pointer;">+{{ $sq }}</button>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Image Asset (File Upload or Path/URL)</label>
                    <div style="display:flex; gap:.6rem; align-items:center;">
                        <div style="width:48px; height:48px; border-radius:6px; background:#000; border:1px solid rgba(147,51,234,0.4); display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0;">
                            <img id="c-img-preview" src="{{ asset('images/product-fallback.svg') }}" alt="Preview" style="max-width:100%; max-height:100%; object-fit:contain;">
                        </div>
                        <div style="flex:1; display:flex; flex-direction:column; gap:.3rem;">
                            <input type="file" name="image_file" accept="image/*" style="font-size:.75rem; color:#94a3b8;" onchange="previewModalCreateFile(this)">
                            <input type="text" name="image" id="c-image-url" placeholder="images/products/... or https://…" style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.35rem .6rem; border-radius:4px; font-size:.75rem; outline:none; font-family:monospace;" oninput="previewModalCreateUrl(this.value)">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Short Description --}}
            <div>
                <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Short Description</label>
                <input type="text" name="short_description" id="c-short-desc" placeholder="Brief power tagline…" maxlength="500"
                       style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem .9rem; border-radius:6px; font-size:.85rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:600;">
            </div>

            {{-- Specs Textarea & Preset Pills --}}
            <div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.35rem;">
                    <label style="font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; font-family:'Orbitron',sans-serif;">Technical Specs (Key = Value)</label>
                    <div style="display:flex; gap:.3rem;">
                        <button type="button" onclick="insertCreateSpec('CPU', 'Intel Core Ultra 9 / AMD Ryzen 9')" style="background:none; border:1px solid rgba(147,51,234,0.4); color:#c084fc; font-size:.65rem; border-radius:3px; padding:1px 5px; cursor:pointer;">+ CPU</button>
                        <button type="button" onclick="insertCreateSpec('GPU', 'NVIDIA RTX 4090 16GB')" style="background:none; border:1px solid rgba(147,51,234,0.4); color:#c084fc; font-size:.65rem; border-radius:3px; padding:1px 5px; cursor:pointer;">+ GPU</button>
                        <button type="button" onclick="insertCreateSpec('Display', '32-inch 4K QD-OLED 240Hz')" style="background:none; border:1px solid rgba(147,51,234,0.4); color:#c084fc; font-size:.65rem; border-radius:3px; padding:1px 5px; cursor:pointer;">+ Display</button>
                        <button type="button" onclick="insertCreateSpec('RAM', '32GB DDR5 5600MHz')" style="background:none; border:1px solid rgba(147,51,234,0.4); color:#c084fc; font-size:.65rem; border-radius:3px; padding:1px 5px; cursor:pointer;">+ RAM</button>
                    </div>
                </div>
                <textarea name="specs_raw" id="c-specs-raw" rows="3" placeholder="Display = 32&quot; 4K QD-OLED 240Hz&#10;Connectivity = HDMI 2.1, DP 1.4, USB-C"
                          style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#34d399; padding:.55rem .9rem; border-radius:6px; font-size:.8rem; font-family:monospace; outline:none;"></textarea>
            </div>

            {{-- Flags & Submit Button --}}
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; padding-top:.5rem; border-top:1px solid var(--adm-border);">
                <div style="display:flex; align-items:center; gap:1.2rem;">
                    <label style="display:flex; align-items:center; gap:.4rem; cursor:pointer; font-size:.82rem; font-weight:700; color:#fff;">
                        <input type="checkbox" name="is_active" value="1" checked style="accent-color:#22c55e;"> Active in Store
                    </label>
                    <label style="display:flex; align-items:center; gap:.4rem; cursor:pointer; font-size:.82rem; font-weight:700; color:#fbbf24;">
                        <input type="checkbox" name="is_featured" value="1" checked style="accent-color:#e5001e;"> ★ Featured on Home
                    </label>
                </div>

                <div style="display:flex; gap:.6rem;">
                    <button type="button" onclick="closeCreateModal()" style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:#cbd5e1; padding:.6rem 1.1rem; border-radius:6px; font-family:'Orbitron',sans-serif; font-size:.78rem; font-weight:700; cursor:pointer;">CANCEL</button>
                    <button type="submit" id="btn-create-submit" style="background:linear-gradient(135deg, #e5001e, #ff0055); border:none; color:#fff; padding:.6rem 1.4rem; border-radius:6px; font-family:'Orbitron',sans-serif; font-size:.82rem; font-weight:900; letter-spacing:.06em; cursor:pointer; box-shadow:0 0 15px rgba(229,0,30,0.5);">
                        🚀 DEPLOY TO STORE
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

{{-- ═══ 4. HOLOGRAPHIC MODAL: QUICK EDIT PRODUCT ═════════════════════════════ --}}
<div id="quickEditModal" style="display:none; position:fixed; inset:0; background:rgba(5,3,15,0.88); backdrop-filter:blur(20px); z-index:99999; align-items:center; justify-content:center; padding:1.2rem;">
    <div class="adm-card" style="width:100%; max-width:780px; max-height:90vh; overflow-y:auto; border-color:rgba(147,51,234,0.5); box-shadow:0 0 50px rgba(147,51,234,0.3); position:relative;">
        <div class="hud-corner-tl"></div>
        <div class="hud-corner-br"></div>

        <div class="adm-card-header" style="background:rgba(20,16,38,0.95); position:sticky; top:0; z-index:10;">
            <div>
                <span class="adm-card-title" style="font-size:.95rem; color:#fff;">
                    ⚡ Quick Edit: <span id="modal-title-name" style="color:#e5001e;">Hardware Model</span>
                </span>
                <div style="font-family:'Orbitron',sans-serif; font-size:.68rem; color:#94a3b8; margin-top:2px;">
                    ID: #<span id="modal-title-id"></span> &bull; SKU: <span id="modal-title-sku" style="color:#cbd5e1;"></span>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:.8rem;">
                <a id="modal-full-edit-link" href="#" target="_blank" style="font-family:'Orbitron',sans-serif; font-size:.7rem; color:#c084fc; text-decoration:none; font-weight:800;">
                    FULL EDITOR ↗
                </a>
                <button type="button" onclick="closeQuickEditModal()" style="background:none; border:none; color:#94a3b8; font-size:1.4rem; cursor:pointer; line-height:1;" onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='#94a3b8'">×</button>
            </div>
        </div>

        <div id="modalLoadingSpinner" style="padding:4rem; text-align:center; font-family:'Orbitron',sans-serif; color:#c084fc;">
            <div style="font-size:2rem; margin-bottom:.5rem;">⚡</div>
            <div>SYNCHRONIZING TELEMETRY…</div>
        </div>

        <form id="quickEditForm" onsubmit="submitQuickEditForm(event)" enctype="multipart/form-data" style="display:none; padding:1.4rem; flex-direction:column; gap:1.2rem;">
            @csrf
            <input type="hidden" id="edit-product-id" name="product_id">

            <div style="display:grid; grid-template-columns:1.5fr 1fr; gap:1rem;">
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Hardware Name *</label>
                    <input type="text" name="name" id="edit-name" required
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.55rem .85rem; border-radius:6px; font-size:.9rem; outline:none; font-family:'Rajdhani',sans-serif; font-weight:700;">
                </div>
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">SKU Code *</label>
                    <input type="text" name="sku" id="edit-sku" required
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#38bdf8; padding:.55rem .85rem; border-radius:6px; font-size:.85rem; outline:none; font-family:'Orbitron',sans-serif; font-weight:800;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem;">
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Category *</label>
                    <select name="category_id" id="edit-category_id" required style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.55rem .85rem; border-radius:6px; font-size:.85rem; outline:none;">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Price ($) *</label>
                    <input type="number" name="price" id="edit-price" step="0.01" min="0" required
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.55rem .85rem; border-radius:6px; font-size:.9rem; font-weight:800; outline:none; font-family:'Orbitron',sans-serif;" oninput="updateEditDiscountCalc()">
                </div>
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Sale Price ($)</label>
                    <input type="number" name="sale_price" id="edit-sale_price" step="0.01" min="0"
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#34d399; padding:.55rem .85rem; border-radius:6px; font-size:.9rem; font-weight:800; outline:none; font-family:'Orbitron',sans-serif;" oninput="updateEditDiscountCalc()">
                </div>
            </div>

            <div id="edit-discount-pill" style="display:none; padding:.35rem .75rem; border-radius:6px; background:rgba(229,0,30,0.15); border:1px solid rgba(229,0,30,0.4); color:#ff4d6d; font-family:'Orbitron',sans-serif; font-size:.72rem; font-weight:900;"></div>

            <div style="display:grid; grid-template-columns:1fr 1.5fr; gap:1rem; align-items:start;">
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Stock Reserve Units *</label>
                    <input type="number" name="stock" id="edit-stock" min="0" required
                           style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#86efac; padding:.55rem .85rem; border-radius:6px; font-size:1.1rem; font-weight:900; text-align:center; outline:none; font-family:'Orbitron',sans-serif;">
                </div>
                <div>
                    <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Hardware Image</label>
                    <div style="display:flex; gap:.5rem; align-items:center;">
                        <div style="width:40px; height:40px; border-radius:4px; background:#000; border:1px solid rgba(147,51,234,0.4); display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0;">
                            <img id="edit-img-preview" src="{{ asset('images/product-fallback.svg') }}" alt="Preview" style="max-width:100%; max-height:100%; object-fit:contain;">
                        </div>
                        <div style="flex:1; display:flex; flex-direction:column; gap:.25rem;">
                            <input type="file" name="image_file" accept="image/*" style="font-size:.7rem; color:#94a3b8;" onchange="previewModalImageFile(this)">
                            <input type="text" name="image" id="edit-image" placeholder="images/products/..." style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.3rem .5rem; border-radius:4px; font-size:.72rem; outline:none; font-family:monospace;" oninput="previewModalImageUrl(this.value)">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">Specs (Key = Value)</label>
                <textarea name="specs_raw" id="edit-specs_raw" rows="3"
                          style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#34d399; padding:.55rem .85rem; border-radius:6px; font-size:.8rem; font-family:monospace; outline:none;"></textarea>
            </div>

            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; padding-top:.5rem; border-top:1px solid var(--adm-border);">
                <div style="display:flex; align-items:center; gap:1.2rem;">
                    <label style="display:flex; align-items:center; gap:.4rem; cursor:pointer; font-size:.82rem; font-weight:700; color:#fff;">
                        <input type="checkbox" name="is_active" id="edit-is_active" value="1" style="accent-color:#22c55e;"> Active
                    </label>
                    <label style="display:flex; align-items:center; gap:.4rem; cursor:pointer; font-size:.82rem; font-weight:700; color:#fbbf24;">
                        <input type="checkbox" name="is_featured" id="edit-is_featured" value="1" style="accent-color:#e5001e;"> ★ Featured
                    </label>
                </div>

                <div style="display:flex; gap:.6rem;">
                    <button type="button" onclick="closeQuickEditModal()" style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:#cbd5e1; padding:.55rem 1rem; border-radius:6px; font-family:'Orbitron',sans-serif; font-size:.75rem; font-weight:700; cursor:pointer;">CANCEL</button>
                    <button type="submit" id="btn-save-quick-edit" style="background:linear-gradient(135deg, #e5001e, #ff0055); border:none; color:#fff; padding:.55rem 1.3rem; border-radius:6px; font-family:'Orbitron',sans-serif; font-size:.8rem; font-weight:900; cursor:pointer; box-shadow:0 0 15px rgba(229,0,30,0.4);">
                        <span id="save-btn-spinner" style="display:none;">⚡</span>
                        <span id="save-btn-text">💾 SAVE CHANGES</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ═══ 5. FLOATING TELEMETRY TOAST ═════════════════════════════════════════ --}}
<div id="rogToastContainer" style="position:fixed; bottom:2rem; right:2rem; z-index:999999; display:flex; flex-direction:column; gap:.6rem; pointer-events:none;"></div>

<script>
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

function showRogToast(msg, type = 'success') {
    const container = document.getElementById('rogToastContainer');
    if (!container) return;

    const toast = document.createElement('div');
    const isErr = type === 'error';
    toast.style.cssText = `
        background: ${isErr ? 'rgba(239,68,68,0.92)' : 'rgba(14,11,28,0.95)'};
        color: #fff;
        border: 1.5px solid ${isErr ? '#ef4444' : '#e5001e'};
        padding: .75rem 1.2rem;
        border-radius: 8px;
        font-family: 'Rajdhani', sans-serif;
        font-size: .92rem;
        font-weight: 700;
        box-shadow: 0 8px 30px rgba(0,0,0,0.7), 0 0 20px ${isErr ? 'rgba(239,68,68,0.4)' : 'rgba(229,0,30,0.5)'};
        display: flex;
        align-items: center;
        gap: .6rem;
        backdrop-filter: blur(12px);
        transform: translateY(20px);
        opacity: 0;
        transition: all .25s cubic-bezier(0.2, 0.8, 0.2, 1);
        pointer-events: auto;
    `;
    toast.innerHTML = `<span>${isErr ? '⚠️' : '⚡'}</span> <span>${msg}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
        toast.style.transform = 'translateY(0)';
        toast.style.opacity = '1';
    }, 10);

    setTimeout(() => {
        toast.style.transform = 'translateY(20px)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 250);
    }, 4000);
}

// ── Deploy Modal Controls ───────────────────────────────────────────────────
function openCreateModal() {
    document.getElementById('createHardwareModal').style.display = 'flex';
    document.getElementById('c-name')?.focus();
}
function closeCreateModal() {
    document.getElementById('createHardwareModal').style.display = 'none';
}

function autoGenerateCreateSku(name) {
    if (!document.getElementById('c-sku').value || document.getElementById('c-sku').dataset.auto !== 'false') {
        const words = name.toUpperCase().replace(/[^A-Z0-9\s]/g, '').trim().split(/\s+/);
        let sku = 'ROG-';
        words.slice(0, 3).forEach(w => {
            if (w) sku += w.substring(0, 4) + '-';
        });
        sku += '2026';
        document.getElementById('c-sku').value = sku;
    }
}

function manualGenerateCreateSku() {
    const name = document.getElementById('c-name').value;
    if (!name) {
        showRogToast('Enter a hardware name first', 'error');
        return;
    }
    const words = name.toUpperCase().replace(/[^A-Z0-9\s]/g, '').trim().split(/\s+/);
    let sku = 'ROG-';
    words.slice(0, 3).forEach(w => {
        if (w) sku += w.substring(0, 4) + '-';
    });
    sku += Math.floor(1000 + Math.random() * 9000);
    document.getElementById('c-sku').value = sku;
}

function updateCreateDiscountCalc() {
    const price = parseFloat(document.getElementById('c-price').value) || 0;
    const sale = parseFloat(document.getElementById('c-sale-price').value) || 0;
    const pill = document.getElementById('c-discount-pill');

    if (price > 0 && sale > 0 && sale < price) {
        const pct = Math.round((1 - sale / price) * 100);
        pill.textContent = `-${pct}% DISCOUNT (Save $${(price - sale).toFixed(2)})`;
        pill.style.display = 'inline-block';
    } else {
        pill.style.display = 'none';
    }
}

function insertCreateSpec(key, val) {
    const el = document.getElementById('c-specs-raw');
    const cur = el.value.trim();
    el.value = cur ? cur + '\n' + `${key} = ${val}` : `${key} = ${val}`;
}

function previewModalCreateUrl(val) {
    const p = document.getElementById('c-img-preview');
    if (!val) { p.src = '{{ asset("images/product-fallback.svg") }}'; return; }
    if (val.startsWith('http://') || val.startsWith('https://') || val.startsWith('/')) {
        p.src = val;
    } else {
        p.src = '{{ asset("") }}' + val.replace(/^\/+/, '');
    }
}

function previewModalCreateFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('c-img-preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

async function submitCreateHardwareForm(e) {
    e.preventDefault();
    const form = document.getElementById('createHardwareForm');
    const formData = new FormData(form);
    const btn = document.getElementById('btn-create-submit');

    btn.disabled = true;
    btn.textContent = 'DEPLOYING…';

    try {
        const res = await fetch('{{ route("admin.products.store") }}', {
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

        setTimeout(() => window.location.reload(), 800);
    } catch (err) {
        showRogToast(err.message, 'error');
    } finally {
        btn.disabled = false;
        btn.textContent = '🚀 DEPLOY TO STORE';
    }
}

// ── Quick Edit Modal Controls ───────────────────────────────────────────────
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

        document.getElementById('modal-title-name').textContent = data.name;
        document.getElementById('modal-title-id').textContent = data.id;
        document.getElementById('modal-title-sku').textContent = data.sku;
        document.getElementById('modal-full-edit-link').href = data.edit_url;

        document.getElementById('edit-product-id').value = data.id;
        document.getElementById('edit-name').value = data.name;
        document.getElementById('edit-sku').value = data.sku;
        document.getElementById('edit-category_id').value = data.category_id;
        document.getElementById('edit-price').value = data.price;
        document.getElementById('edit-sale_price').value = data.sale_price || '';
        document.getElementById('edit-stock').value = data.stock;
        document.getElementById('edit-image').value = data.raw_image;
        document.getElementById('edit-img-preview').src = data.image;
        document.getElementById('edit-specs_raw').value = data.specs_raw;
        document.getElementById('edit-is_active').checked = data.is_active;
        document.getElementById('edit-is_featured').checked = data.is_featured;

        updateEditDiscountCalc();

        spinner.style.display = 'none';
        form.style.display = 'flex';
    } catch (err) {
        showRogToast(err.message, 'error');
        closeQuickEditModal();
    }
}

function closeQuickEditModal() {
    document.getElementById('quickEditModal').style.display = 'none';
}

function updateEditDiscountCalc() {
    const price = parseFloat(document.getElementById('edit-price').value) || 0;
    const sale = parseFloat(document.getElementById('edit-sale_price').value) || 0;
    const pill = document.getElementById('edit-discount-pill');

    if (price > 0 && sale > 0 && sale < price) {
        const pct = Math.round((1 - sale / price) * 100);
        pill.textContent = `-${pct}% DISCOUNT (Save $${(price - sale).toFixed(2)})`;
        pill.style.display = 'inline-block';
    } else {
        pill.style.display = 'none';
    }
}

function previewModalImageUrl(val) {
    const preview = document.getElementById('edit-img-preview');
    if (!val) { preview.src = '{{ asset("images/product-fallback.svg") }}'; return; }
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

        const p = data.product;
        const row = document.getElementById(`product-row-${p.id}`);
        if (row) {
            const nameEl = document.getElementById(`row-name-${p.id}`);
            if (nameEl) nameEl.textContent = p.name;
            const skuEl = document.getElementById(`row-sku-${p.id}`);
            if (skuEl) skuEl.textContent = p.sku;
            const catEl = document.getElementById(`row-cat-${p.id}`);
            if (catEl) catEl.textContent = p.category_name;
            const imgEl = document.getElementById(`row-img-${p.id}`);
            if (imgEl) imgEl.src = p.image;
            const msrpEl = document.getElementById(`row-msrp-${p.id}`);
            if (msrpEl) msrpEl.textContent = `$${parseFloat(p.price).toFixed(2)}`;

            const saleEl = document.getElementById(`row-saleprice-${p.id}`);
            if (saleEl) {
                saleEl.innerHTML = p.sale_price ? `<span style="font-family:'Orbitron',sans-serif; font-weight:900; color:#34d399; text-shadow:0 0 8px rgba(34,197,94,0.4);">$${parseFloat(p.sale_price).toFixed(2)}</span>` : '<span style="color:#64748b; font-size:.78rem;">—</span>';
            }

            const discEl = document.getElementById(`row-discount-${p.id}`);
            if (discEl) {
                discEl.innerHTML = p.sale_price ? `<span style="background:rgba(229,0,30,.18); border:1px solid rgba(229,0,30,0.5); color:#ff4d6d; font-family:'Orbitron',sans-serif; font-size:.68rem; font-weight:900; padding:2px 8px; border-radius:10px;">-${p.discount_percent}%</span>` : '<span style="color:#64748b; font-size:.78rem;">—</span>';
            }

            const stockInput = document.getElementById(`stock-input-${p.id}`);
            if (stockInput) stockInput.value = p.stock;

            const statusBadge = document.getElementById(`status-badge-${p.id}`);
            if (statusBadge) {
                statusBadge.className = `adm-status ${p.is_active ? 'adm-status--confirmed' : 'adm-status--cancelled'}`;
                statusBadge.textContent = p.is_active ? 'Active' : 'Offline';
            }

            const featBtn = document.getElementById(`btn-toggle-feat-${p.id}`);
            if (featBtn) {
                featBtn.textContent = p.is_featured ? '★' : '☆';
                featBtn.style.color = p.is_featured ? '#fbbf24' : '#475569';
                featBtn.style.filter = p.is_featured ? 'drop-shadow(0 0 6px #fbbf24)' : 'none';
            }

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
        btnText.textContent = '💾 SAVE CHANGES';
    }
}

// ── Quick Stock Controls ────────────────────────────────────────────────────
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
        showRogToast(data.message);
    } catch (err) {
        showRogToast(err.message, 'error');
    }
}

// ── Toggle Active / Featured ────────────────────────────────────────────────
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
        showRogToast(data.message);
    } catch (err) {
        showRogToast(err.message, 'error');
    }
}

// ── Delete / Deactivate ─────────────────────────────────────────────────────
async function confirmDeleteProduct(productId, name) {
    if (!confirm(`Are you sure you want to remove "${name}" from the active hardware catalog?`)) return;

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

// Keyboard shortcuts & backdrop clicks
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeCreateModal();
        closeQuickEditModal();
    }
});
document.getElementById('createHardwareModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'createHardwareModal') closeCreateModal();
});
document.getElementById('quickEditModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'quickEditModal') closeQuickEditModal();
});
</script>

@endsection
