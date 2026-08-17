@extends('admin.layout')
@section('title','Hardware Grid')
@section('page-title','Hardware Inventory Grid')

@section('content')

{{-- Filters & Telemetry Bar --}}
<form method="GET" action="{{ route('admin.products') }}" style="display:flex; gap:.75rem; flex-wrap:wrap; margin-bottom:1.4rem; align-items:center; background:var(--adm-surface); padding:.9rem 1.2rem; border-radius:8px; border:1px solid var(--adm-border); backdrop-filter:blur(16px);">
    <div style="position:relative; flex:1; min-width:200px;">
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
    <button type="submit" style="background:linear-gradient(135deg, #e5001e, #ff0055); border:none; color:#fff; padding:.55rem 1.4rem; border-radius:6px; font-size:.82rem; cursor:pointer; font-family:'Orbitron',sans-serif; font-weight:800; letter-spacing:.06em; box-shadow:0 0 12px rgba(229,0,30,0.4); transition:all .2s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
        FILTER
    </button>
    @if(request()->hasAny(['search','category']))
        <a href="{{ route('admin.products') }}" style="font-family:'Orbitron',sans-serif; font-size:.75rem; color:#94a3b8; text-decoration:none; padding:.55rem .8rem; font-weight:700;">
            ✕ CLEAR
        </a>
    @endif
    <div style="margin-left:auto; font-family:'Orbitron',sans-serif; font-size:.78rem; color:#c084fc; font-weight:800; display:flex; align-items:center; gap:6px;">
        <span style="color:#e5001e;">●</span> {{ $products->total() }} ACTIVE HARDWARE SKUs
    </div>
</form>

<div class="adm-card">
    <div class="hud-corner-tl"></div>
    <div style="overflow-x:auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th style="width:65px;">Preview</th>
                    <th>Hardware Model</th>
                    <th>SKU Identifier</th>
                    <th>Category</th>
                    <th>MSRP</th>
                    <th>Sale Price</th>
                    <th>Discount</th>
                    <th>Stock Reserve</th>
                    <th>Catalog State</th>
                    <th>Featured</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <div style="position:relative; width:48px; height:48px; border-radius:8px; background:rgba(0,0,0,0.6); border:1.5px solid rgba(147,51,234,0.35); overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 0 10px rgba(0,0,0,0.4);">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                 style="width:100%; height:100%; object-fit:contain; padding:3px; transition:transform .2s;"
                                 onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"
                                 onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=80&q=50'">
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:700; font-size:.9rem; color:#fff; max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $product->name }}</div>
                        <div style="font-family:'Orbitron',sans-serif; font-size:.68rem; color:#94a3b8;">ID: #{{ $product->id }}</div>
                    </td>
                    <td style="font-family:'Orbitron',sans-serif; font-size:.76rem; color:#cbd5e1; font-weight:700;">{{ $product->sku }}</td>
                    <td style="font-size:.82rem; font-weight:700; color:#e2e8f0;">{{ $product->category->name ?? '—' }}</td>
                    <td style="font-family:'Orbitron',sans-serif; font-weight:800; color:#fff;">${{ number_format($product->price,2) }}</td>
                    <td>
                        @if($product->sale_price)
                            <span style="font-family:'Orbitron',sans-serif; font-weight:900; color:#34d399; text-shadow:0 0 8px rgba(34,197,94,0.4);">${{ number_format($product->sale_price,2) }}</span>
                        @else
                            <span style="color:#64748b; font-size:.78rem;">—</span>
                        @endif
                    </td>
                    <td>
                        @if($product->sale_price)
                            <span style="background:rgba(229,0,30,.18); border:1px solid rgba(229,0,30,0.5); color:#ff4d6d; font-family:'Orbitron',sans-serif; font-size:.68rem; font-weight:900; padding:2px 8px; border-radius:10px; box-shadow:0 0 6px rgba(229,0,30,0.3);">
                                -{{ $product->discount_percent }}%
                            </span>
                        @else
                            <span style="color:#64748b; font-size:.78rem;">—</span>
                        @endif
                    </td>
                    <td>
                        <span style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:.84rem; color:{{ $product->stock === 0 ? '#ef4444' : ($product->stock <= 5 ? '#fbbf24' : '#86efac') }}; text-shadow:0 0 6px currentColor;">
                            {{ $product->stock }} UNITS
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.products.toggle', $product) }}" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit" title="Toggle Hardware State"
                                    style="background:none; border:none; cursor:pointer; padding:0;">
                                <span class="adm-status {{ $product->is_active ? 'adm-status--confirmed' : 'adm-status--cancelled' }}">
                                    {{ $product->is_active ? 'Active' : 'Offline' }}
                                </span>
                            </button>
                        </form>
                    </td>
                    <td>
                        @if($product->is_featured)
                            <span style="font-family:'Orbitron',sans-serif; color:#fbbf24; font-size:.72rem; font-weight:800; text-shadow:0 0 8px rgba(245,158,11,0.5);">★ FEATURED</span>
                        @else
                            <span style="color:#64748b; font-size:.78rem;">—</span>
                        @endif
                    </td>
                    <td style="text-align:center; white-space:nowrap;">
                        <a href="{{ route('admin.products.edit', $product) }}"
                           style="display:inline-flex; align-items:center; gap:.3rem; background:linear-gradient(135deg, #e5001e, #ff0055); color:#fff; border:none; padding:.35rem .85rem; border-radius:5px; font-family:'Orbitron',sans-serif; font-size:.7rem; font-weight:800; text-decoration:none; letter-spacing:.04em; transition:all .15s; box-shadow:0 0 8px rgba(229,0,30,0.3);"
                           onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            EDIT
                        </a>
                        <a href="{{ route('product.show', $product->slug) }}" target="_blank"
                           style="display:inline-flex; align-items:center; gap:.3rem; background:var(--adm-surface2); color:#cbd5e1; border:1px solid rgba(147,51,234,0.3); padding:.35rem .75rem; border-radius:5px; font-family:'Orbitron',sans-serif; font-size:.7rem; font-weight:700; text-decoration:none; margin-left:.3rem; transition:all .15s;"
                           onmouseover="this.style.borderColor='#e5001e'; this.style.color='#e5001e'; this.style.boxShadow='0 0 8px rgba(229,0,30,0.3)';"
                           onmouseout="this.style.borderColor='rgba(147,51,234,0.3)'; this.style.color='#cbd5e1'; this.style.boxShadow='none';">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            STORE ↗
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" style="text-align:center; padding:3.5rem; color:#94a3b8; font-size:.9rem;">
                        <div style="font-size:2.2rem; margin-bottom:.5rem;">🔍</div>
                        No hardware products found matching specified filter.
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
@endsection
