@extends('layouts.app')
@section('title', ($currentCategory ? $currentCategory->name . ' — ' : '') . 'Shop — ROG Store')

@section('content')

{{-- Page Header --}}
<div style="background:var(--bg-surface-2); border-bottom:1px solid var(--border-base); padding:1.5rem 0 1rem;">
    <div style="max-width:1280px; margin:0 auto; padding:0 1rem;">
        <div style="font-size:.72rem; color:var(--text-muted); letter-spacing:.08em; text-transform:uppercase; margin-bottom:.3rem;">
            <a href="{{ route('home') }}" style="color:var(--text-muted); text-decoration:none;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-muted)'">Home</a>
            › <span style="color:var(--rog-red);">{{ $currentCategory ? $currentCategory->name : 'All Products' }}</span>
        </div>
        <h1 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.4rem,3vw,1.8rem); color:var(--text-primary);">
            {{ $currentCategory ? $currentCategory->name : 'ROG Store' }}
        </h1>
        @if($currentCategory && $currentCategory->description)
        <p style="color:var(--text-muted); margin-top:.3rem; font-size:.85rem;">{{ $currentCategory->description }}</p>
        @endif
    </div>
</div>

{{-- ═══ MOBILE CATEGORY QUICK-PILLS ═══════════════════════════════════════════ --}}
<div style="background:var(--bg-surface); border-bottom:1px solid var(--border-base); padding:0.6rem 1rem;">
    <div style="max-width:1280px; margin:0 auto;">
        <div class="cat-pill-scroll">
            <a href="{{ route('shop') }}" class="cat-pill {{ !request('category') ? 'active' : '' }}">
                <span>🔥</span>
                <span>All Gear</span>
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('shop', array_merge(request()->except('category','page'), ['category'=>$cat->slug])) }}" 
               class="cat-pill {{ request('category')==$cat->slug ? 'active' : '' }}">
                <span>⚡</span>
                <span>{{ $cat->name }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

<div style="max-width:1280px; margin:0 auto; padding:1.5rem 1rem 3rem;">
    <div style="display:grid; grid-template-columns:260px 1fr; gap:2rem; align-items:start;" class="shop-layout-grid">

        {{-- ── DESKTOP SIDEBAR ── --}}
        <aside class="shop-desktop-sidebar hidden-mobile">
            <form action="{{ route('shop') }}" method="GET" id="filter-form">
                <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:1.4rem; margin-bottom:1rem; border-radius:6px;">
                    <h3 style="font-weight:700; font-size:.78rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1rem;">Categories</h3>
                    <div style="display:flex; flex-direction:column; gap:.4rem;">
                        <a href="{{ route('shop') }}" style="display:flex; justify-content:space-between; align-items:center; padding:.45rem .65rem; color:{{ !request('category') ? 'var(--rog-red)' : 'var(--text-secondary)' }}; text-decoration:none; font-size:.85rem; font-weight:{{ !request('category') ? '700' : '500' }}; border-left:2px solid {{ !request('category') ? 'var(--rog-red)' : 'transparent' }}; background:{{ !request('category') ? 'rgba(229,0,30,.08)' : 'none' }}; border-radius:0 4px 4px 0;">
                            All Products <span style="color:var(--text-muted); font-size:.72rem;">{{ $categories->sum('active_products_count') }}</span>
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('shop', array_merge(request()->except('category','page'), ['category'=>$cat->slug])) }}"
                           style="display:flex; justify-content:space-between; align-items:center; padding:.45rem .65rem; color:{{ request('category')==$cat->slug ? 'var(--rog-red)' : 'var(--text-secondary)' }}; text-decoration:none; font-size:.85rem; font-weight:{{ request('category')==$cat->slug ? '700' : '500' }}; border-left:2px solid {{ request('category')==$cat->slug ? 'var(--rog-red)' : 'transparent' }}; background:{{ request('category')==$cat->slug ? 'rgba(229,0,30,.08)' : 'none' }}; border-radius:0 4px 4px 0;">
                            {{ $cat->name }}
                            <span style="color:var(--text-muted); font-size:.72rem;">{{ $cat->active_products_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div style="background:var(--bg-card); border:1px solid var(--border-card); padding:1.4rem; margin-bottom:1rem; border-radius:6px;">
                    <h3 style="font-weight:700; font-size:.78rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1rem;">Price Range</h3>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:.6rem; margin-bottom:1rem;">
                        <div>
                            <label class="rog-label">Min $</label>
                            <input type="number" name="min_price" class="rog-input" value="{{ request('min_price') }}" placeholder="0">
                        </div>
                        <div>
                            <label class="rog-label">Max $</label>
                            <input type="number" name="max_price" class="rog-input" value="{{ request('max_price') }}" placeholder="5000">
                        </div>
                    </div>
                    @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                    @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                    @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
                    <button type="submit" class="btn-rog" style="width:100%; justify-content:center; font-size:.8rem;">Apply Filter</button>
                </div>

                @if(request()->hasAny(['category','search','min_price','max_price']))
                <a href="{{ route('shop') }}" class="btn-rog-outline" style="text-decoration:none; width:100%; justify-content:center; display:flex; font-size:.78rem;">Clear Filters</a>
                @endif
            </form>
        </aside>

        {{-- ── PRODUCT GRID AREA ── --}}
        <div>
            {{-- Toolbar with Mobile Filter Trigger --}}
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.2rem; flex-wrap:wrap; gap:.6rem; background:var(--bg-card); border:1px solid var(--border-card); padding:.7rem 1rem; border-radius:6px;">
                <div style="display:flex; align-items:center; gap:.8rem;">
                    {{-- Mobile Filter Button Trigger --}}
                    <button type="button" id="mobile-filter-open-btn" class="show-mobile"
                            style="background:var(--bg-elevated); border:1px solid var(--border-input); color:var(--text-primary); padding:.4rem .8rem; border-radius:4px; font-size:.8rem; font-weight:700; display:flex; align-items:center; gap:.4rem; cursor:pointer;">
                        <span>⚙️</span>
                        <span>Filter</span>
                        @if(request()->hasAny(['category','min_price','max_price']))
                        <span style="width:6px; height:6px; background:var(--rog-red); border-radius:50%;"></span>
                        @endif
                    </button>
                    <div style="color:var(--text-muted); font-size:.82rem;">
                        <strong style="color:var(--text-primary);">{{ $products->total() }}</strong> items
                    </div>
                </div>

                <form action="{{ route('shop') }}" method="GET" style="display:flex; align-items:center; gap:.5rem;">
                    @foreach(request()->except('sort') as $key => $val)
                    <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                    @endforeach
                    <label style="color:var(--text-muted); font-size:.78rem; text-transform:uppercase; letter-spacing:.08em;">Sort:</label>
                    <select name="sort" onchange="this.form.submit()" class="rog-input" style="width:auto; padding:.35rem .7rem; font-size:.82rem; cursor:pointer; min-height:36px;">
                        <option value="latest"     {{ $sort=='latest'     ? 'selected' : '' }}>Latest</option>
                        <option value="price_asc"  {{ $sort=='price_asc'  ? 'selected' : '' }}>Price: Low–High</option>
                        <option value="price_desc" {{ $sort=='price_desc' ? 'selected' : '' }}>Price: High–Low</option>
                        <option value="name_asc"   {{ $sort=='name_asc'   ? 'selected' : '' }}>Name A–Z</option>
                    </select>
                </form>
            </div>

            @if($products->count())
            <div class="product-grid-mobile" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(230px,1fr)); gap:1rem;">
                @foreach($products as $product)
                <div class="product-card">
                    @if($product->sale_price)
                    <div class="badge-sale">-{{ $product->discount_percent }}%</div>
                    @endif
                    @if($product->is_featured)
                    <div class="badge-featured">Featured</div>
                    @endif
                    <a href="{{ route('product.show',$product->slug) }}">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy"
                             onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=400&q=60'">
                    </a>
                    <div class="product-card-body" style="padding:1rem;">
                        <div style="font-size:.68rem; color:var(--rog-red); font-weight:600; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.25rem;">{{ $product->category->name }}</div>
                        <a href="{{ route('product.show',$product->slug) }}" style="text-decoration:none;">
                            <h3 class="product-card-title" style="font-size:.88rem; font-weight:700; color:var(--text-primary); margin-bottom:.4rem; line-height:1.3; transition:color .2s;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-primary)'">
                                {{ $product->name }}
                            </h3>
                        </a>
                        <div style="display:flex; align-items:center; gap:.5rem; margin-bottom:.5rem; flex-wrap:wrap;">
                            @if($product->sale_price)
                            <span class="price-original" style="font-size:.8rem;">${{ number_format($product->price,2) }}</span>
                            <span class="price-current product-card-price">${{ number_format($product->sale_price,2) }}</span>
                            @else
                            <span class="price-current product-card-price">${{ number_format($product->price,2) }}</span>
                            @endif
                        </div>
                        <div style="font-size:.7rem; color:{{ $product->stock > 5 ? '#22c55e' : ($product->stock > 0 ? '#f59e0b' : '#ef4444') }}; margin-bottom:.7rem;">
                            {{ $product->stock > 5 ? '● In Stock' : ($product->stock > 0 ? '● Low Stock ('.$product->stock.')' : '● Out of Stock') }}
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST" style="margin-top:auto;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-rog product-card-btn" 
                                    style="width:100%; justify-content:center; font-size:.75rem; padding:.45rem; {{ $product->stock == 0 ? 'opacity:.4; cursor:not-allowed;' : '' }}"
                                    {{ $product->stock == 0 ? 'disabled' : '' }}>
                                {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div style="margin-top:2.5rem; display:flex; justify-content:center; gap:.5rem; flex-wrap:wrap;">
                {{ $products->onEachSide(1)->links('vendor.pagination.rog') }}
            </div>

            @else
            <div style="text-align:center; padding:5rem 2rem; color:var(--text-muted); background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px;">
                <div style="font-size:3rem; margin-bottom:1rem;">🔍</div>
                <h3 style="font-size:1.2rem; color:var(--text-primary); font-weight:700; margin-bottom:.5rem;">No products found</h3>
                <p style="font-size:.9rem;">Try adjusting your filters or <a href="{{ route('shop') }}" style="color:var(--rog-red);">view all products</a>.</p>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- ═══ MOBILE FILTER MODAL SHEET ════════════════════════════════════════════ --}}
<div id="mobile-filter-modal" class="search-modal-overlay">
    <div class="search-modal-content" style="max-height:85vh; display:flex; flex-direction:column;">
        <div style="padding:1rem 1.2rem; border-bottom:1px solid var(--border-base); display:flex; align-items:center; justify-content:space-between;">
            <div style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:1rem; color:var(--text-primary);">Filter Products</div>
            <button id="mobile-filter-close-btn" style="background:none; border:none; color:var(--text-primary); font-size:1.2rem; cursor:pointer;">✕</button>
        </div>
        <div style="padding:1.2rem; overflow-y:auto; flex:1;">
            <form action="{{ route('shop') }}" method="GET">
                <div style="margin-bottom:1.5rem;">
                    <div class="rog-label" style="margin-bottom:.7rem;">Categories</div>
                    <div style="display:flex; flex-direction:column; gap:.4rem;">
                        <label style="display:flex; align-items:center; gap:.6rem; padding:.5rem .8rem; background:var(--bg-elevated); border-radius:6px; cursor:pointer;">
                            <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} style="accent-color:var(--rog-red);">
                            <span style="font-size:.85rem; font-weight:700;">All Categories</span>
                        </label>
                        @foreach($categories as $cat)
                        <label style="display:flex; align-items:center; gap:.6rem; padding:.5rem .8rem; background:var(--bg-elevated); border-radius:6px; cursor:pointer;">
                            <input type="radio" name="category" value="{{ $cat->slug }}" {{ request('category')==$cat->slug ? 'checked' : '' }} style="accent-color:var(--rog-red);">
                            <span style="font-size:.85rem; font-weight:600;">{{ $cat->name }}</span>
                            <span style="margin-left:auto; color:var(--text-muted); font-size:.75rem;">({{ $cat->active_products_count }})</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div style="margin-bottom:1.5rem;">
                    <div class="rog-label" style="margin-bottom:.7rem;">Price Range ($)</div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:.8rem;">
                        <div>
                            <label style="font-size:.7rem; color:var(--text-muted);">Min Price</label>
                            <input type="number" name="min_price" class="rog-input" value="{{ request('min_price') }}" placeholder="0">
                        </div>
                        <div>
                            <label style="font-size:.7rem; color:var(--text-muted);">Max Price</label>
                            <input type="number" name="max_price" class="rog-input" value="{{ request('max_price') }}" placeholder="5000">
                        </div>
                    </div>
                </div>

                @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif

                <div style="display:flex; gap:.8rem; margin-top:1.5rem;">
                    <a href="{{ route('shop') }}" class="btn-rog-outline" style="flex:1; justify-content:center; text-decoration:none; text-align:center;">Reset</a>
                    <button type="submit" class="btn-rog" style="flex:2; justify-content:center;">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@media(max-width:768px) {
  .shop-layout-grid {
    grid-template-columns: 1fr !important;
  }
}
</style>

<script>
(function() {
    const modal    = document.getElementById('mobile-filter-modal');
    const openBtn  = document.getElementById('mobile-filter-open-btn');
    const closeBtn = document.getElementById('mobile-filter-close-btn');

    openBtn?.addEventListener('click', () => {
        modal.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    });
    closeBtn?.addEventListener('click', () => {
        modal.classList.remove('is-open');
        document.body.style.overflow = '';
    });
    modal?.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('is-open');
            document.body.style.overflow = '';
        }
    });
})();
</script>
@endsection
