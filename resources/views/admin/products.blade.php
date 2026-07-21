@extends('admin.layout')
@section('title','Products')
@section('page-title','Products')

@section('content')

{{-- Filters --}}
<form method="GET" action="{{ route('admin.products') }}" style="display:flex;gap:.6rem;flex-wrap:wrap;margin-bottom:1.2rem;align-items:center;">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, SKU…"
           style="background:var(--adm-surface);border:1px solid var(--adm-border);color:var(--adm-text);padding:.45rem .9rem;border-radius:6px;font-size:.83rem;outline:none;width:200px;font-family:'Rajdhani',sans-serif;">
    <select name="category" style="background:var(--adm-surface);border:1px solid var(--adm-border);color:var(--adm-text);padding:.45rem .9rem;border-radius:6px;font-size:.83rem;outline:none;font-family:'Rajdhani',sans-serif;">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
    <button type="submit" style="background:#e5001e;border:none;color:#fff;padding:.45rem 1rem;border-radius:6px;font-size:.83rem;cursor:pointer;font-family:'Rajdhani',sans-serif;font-weight:700;">Filter</button>
    @if(request()->hasAny(['search','category']))
        <a href="{{ route('admin.products') }}" style="font-size:.82rem;color:var(--adm-muted);text-decoration:none;padding:.45rem .6rem;">✕ Clear</a>
    @endif
    <span style="margin-left:auto;font-size:.78rem;color:var(--adm-muted);">{{ $products->total() }} products</span>
</form>

<div class="adm-card">
    <div style="overflow-x:auto;">
        <table class="adm-table">
            <thead>
                <tr>
                    <th style="width:56px;">Image</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Discount</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td style="padding:.5rem .8rem;">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}"
                             style="width:48px;height:40px;object-fit:contain;background:var(--adm-surface2);border:1px solid var(--adm-border);border-radius:4px;padding:3px;"
                             onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=80&q=50'">
                    </td>
                    <td>
                        <div style="font-weight:700;font-size:.85rem;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $product->name }}</div>
                        <div style="font-size:.72rem;color:var(--adm-muted);">ID #{{ $product->id }}</div>
                    </td>
                    <td style="font-size:.78rem;color:var(--adm-muted);font-family:monospace;">{{ $product->sku }}</td>
                    <td style="font-size:.8rem;">{{ $product->category->name ?? '—' }}</td>
                    <td style="font-weight:700;color:var(--adm-text);">${{ number_format($product->price,2) }}</td>
                    <td>
                        @if($product->sale_price)
                            <span style="font-weight:700;color:#22c55e;">${{ number_format($product->sale_price,2) }}</span>
                        @else
                            <span style="color:var(--adm-muted);font-size:.78rem;">—</span>
                        @endif
                    </td>
                    <td>
                        @if($product->sale_price)
                            <span style="background:rgba(229,0,30,.15);color:#e5001e;font-size:.72rem;font-weight:700;padding:2px 8px;border-radius:10px;">
                                -{{ $product->discount_percent }}%
                            </span>
                        @else
                            <span style="color:var(--adm-muted);font-size:.78rem;">—</span>
                        @endif
                    </td>
                    <td>
                        <span style="font-weight:700;color:{{ $product->stock === 0 ? '#ef4444' : ($product->stock <= 5 ? '#f59e0b' : 'var(--adm-text)') }};">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.products.toggle', $product) }}" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit" title="Click to toggle"
                                    style="background:none;border:none;cursor:pointer;padding:0;">
                                <span class="adm-status {{ $product->is_active ? 'adm-status--confirmed' : 'adm-status--cancelled' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </button>
                        </form>
                    </td>
                    <td style="text-align:center;">
                        @if($product->is_featured)
                            <span style="color:#fbbf24;font-size:.75rem;font-weight:700;">★ Featured</span>
                        @else
                            <span style="color:var(--adm-muted);font-size:.75rem;">—</span>
                        @endif
                    </td>
                    <td style="text-align:center;white-space:nowrap;">
                        <a href="{{ route('admin.products.edit', $product) }}"
                           style="display:inline-flex;align-items:center;gap:.3rem;background:#e5001e;color:#fff;border:none;padding:.3rem .8rem;border-radius:5px;font-size:.75rem;font-weight:700;text-decoration:none;letter-spacing:.04em;transition:background .15s;"
                           onmouseover="this.style.background='#b0001a'" onmouseout="this.style.background='#e5001e'">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Edit
                        </a>
                        <a href="{{ route('product.show', $product->slug) }}" target="_blank"
                           style="display:inline-flex;align-items:center;gap:.3rem;background:var(--adm-surface2);color:var(--adm-muted);border:1px solid var(--adm-border);padding:.3rem .7rem;border-radius:5px;font-size:.75rem;font-weight:600;text-decoration:none;margin-left:.3rem;transition:border-color .15s;"
                           onmouseover="this.style.borderColor='#e5001e';this.style.color='#e5001e'" onmouseout="this.style.borderColor='var(--adm-border)';this.style.color='var(--adm-muted)'">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="11" style="text-align:center;padding:2.5rem;color:var(--adm-muted);">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
    <div style="padding:.8rem 1.2rem;border-top:1px solid var(--adm-border);display:flex;align-items:center;justify-content:space-between;font-size:.78rem;color:var(--adm-muted);">
        <span>Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }}</span>
        <div style="display:flex;gap:.4rem;">
            @if($products->onFirstPage())
                <span style="padding:.3rem .7rem;border:1px solid var(--adm-border);border-radius:4px;opacity:.4;">‹ Prev</span>
            @else
                <a href="{{ $products->previousPageUrl() }}" style="padding:.3rem .7rem;border:1px solid var(--adm-border);border-radius:4px;color:var(--adm-text);text-decoration:none;">‹ Prev</a>
            @endif
            @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" style="padding:.3rem .7rem;border:1px solid #e5001e;border-radius:4px;color:#e5001e;text-decoration:none;">Next ›</a>
            @else
                <span style="padding:.3rem .7rem;border:1px solid var(--adm-border);border-radius:4px;opacity:.4;">Next ›</span>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection
