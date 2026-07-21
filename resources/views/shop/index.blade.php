@extends('layouts.app')
@section('title', ($currentCategory ? $currentCategory->name . ' — ' : '') . 'Shop — ROG Store')

@section('content')

{{-- Page Header --}}
<div style="background:#0d0d0d; border-bottom:1px solid #1e1e1e; padding:2rem 0;">
    <div style="max-width:1280px; margin:0 auto; padding:0 1.5rem;">
        <div style="font-size:.75rem; color:#666; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.5rem;">
            <a href="{{ route('home') }}" style="color:#666; text-decoration:none;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#666'">Home</a>
            › <span style="color:var(--rog-red);">{{ $currentCategory ? $currentCategory->name : 'All Products' }}</span>
        </div>
        <h1 style="font-family:'Orbitron',sans-serif; font-weight:900; font-size:clamp(1.5rem,3vw,2rem); color:#fff;">
            {{ $currentCategory ? $currentCategory->name : 'ROG Store' }}
        </h1>
        @if($currentCategory && $currentCategory->description)
        <p style="color:#666; margin-top:.5rem; font-size:.9rem;">{{ $currentCategory->description }}</p>
        @endif
    </div>
</div>

<div style="max-width:1280px; margin:0 auto; padding:2rem 1.5rem; display:grid; grid-template-columns:260px 1fr; gap:2rem; align-items:start;">

    {{-- ── SIDEBAR ── --}}
    <aside>
        {{-- Filter card --}}
        <form action="{{ route('shop') }}" method="GET" id="filter-form">
            <div style="background:#111; border:1px solid #1e1e1e; padding:1.5rem; margin-bottom:1rem;">
                <h3 style="font-weight:700; font-size:.78rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem;">Categories</h3>
                <div style="display:flex; flex-direction:column; gap:.5rem;">
                    <a href="{{ route('shop') }}" style="display:flex; justify-content:space-between; align-items:center; padding:.5rem .7rem; color:{{ !request('category') ? '#e5001e' : '#aaa' }}; text-decoration:none; font-size:.87rem; font-weight:{{ !request('category') ? '700' : '500' }}; border-left:2px solid {{ !request('category') ? '#e5001e' : 'transparent' }}; background:{{ !request('category') ? 'rgba(229,0,30,.08)' : 'none' }}; transition:all .2s;">
                        All Products <span style="color:#555; font-size:.75rem;">{{ $categories->sum('active_products_count') }}</span>
                    </a>
                    @foreach($categories as $cat)
                    <a href="{{ route('shop', array_merge(request()->except('category','page'), ['category'=>$cat->slug])) }}"
                       style="display:flex; justify-content:space-between; align-items:center; padding:.5rem .7rem; color:{{ request('category')==$cat->slug ? '#e5001e' : '#aaa' }}; text-decoration:none; font-size:.87rem; font-weight:{{ request('category')==$cat->slug ? '700' : '500' }}; border-left:2px solid {{ request('category')==$cat->slug ? '#e5001e' : 'transparent' }}; background:{{ request('category')==$cat->slug ? 'rgba(229,0,30,.08)' : 'none' }}; transition:all .2s;"
                       onmouseover="this.style.color='#e5001e'" onmouseout="this.style.color='{{ request('category')==$cat->slug ? '#e5001e' : '#aaa' }}'">
                        {{ $cat->name }}
                        <span style="color:#555; font-size:.75rem;">{{ $cat->active_products_count }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <div style="background:#111; border:1px solid #1e1e1e; padding:1.5rem; margin-bottom:1rem;">
                <h3 style="font-weight:700; font-size:.78rem; letter-spacing:.15em; text-transform:uppercase; color:var(--rog-red); margin-bottom:1.2rem;">Price Range</h3>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:.7rem; margin-bottom:1rem;">
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

    {{-- ── PRODUCT GRID ── --}}
    <div>
        {{-- Toolbar --}}
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem;">
            <div style="color:#666; font-size:.87rem;">
                Showing <strong style="color:#ddd;">{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong> of <strong style="color:#ddd;">{{ $products->total() }}</strong> products
            </div>
            <form action="{{ route('shop') }}" method="GET" style="display:flex; align-items:center; gap:.7rem;">
                @foreach(request()->except('sort') as $key => $val)
                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                @endforeach
                <label style="color:#666; font-size:.82rem; text-transform:uppercase; letter-spacing:.08em;">Sort:</label>
                <select name="sort" onchange="this.form.submit()" class="rog-input" style="width:auto; padding:.4rem .8rem; cursor:pointer;">
                    <option value="latest"     {{ $sort=='latest'     ? 'selected' : '' }}>Latest</option>
                    <option value="price_asc"  {{ $sort=='price_asc'  ? 'selected' : '' }}>Price: Low–High</option>
                    <option value="price_desc" {{ $sort=='price_desc' ? 'selected' : '' }}>Price: High–Low</option>
                    <option value="name_asc"   {{ $sort=='name_asc'   ? 'selected' : '' }}>Name A–Z</option>
                </select>
            </form>
        </div>

        @if($products->count())
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(230px,1fr)); gap:1.2rem;">
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
                <div style="padding:1rem;">
                    <div style="font-size:.7rem; color:var(--rog-red); font-weight:600; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.3rem;">{{ $product->category->name }}</div>
                    <a href="{{ route('product.show',$product->slug) }}" style="text-decoration:none;">
                        <h3 style="font-size:.9rem; font-weight:700; color:#ddd; margin-bottom:.5rem; line-height:1.3; transition:color .2s;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#ddd'">
                            {{ $product->name }}
                        </h3>
                    </a>
                    <div style="font-size:.8rem; color:#666; margin-bottom:.5rem;">SKU: {{ $product->sku }}</div>
                    <div style="display:flex; align-items:center; gap:.6rem; margin-bottom:.8rem;">
                        @if($product->sale_price)
                        <span class="price-original">${{ number_format($product->price,2) }}</span>
                        <span class="price-current">${{ number_format($product->sale_price,2) }}</span>
                        @else
                        <span class="price-current">${{ number_format($product->price,2) }}</span>
                        @endif
                    </div>
                    <div style="font-size:.75rem; color:{{ $product->stock > 5 ? '#22c55e' : ($product->stock > 0 ? '#f59e0b' : '#ef4444') }}; margin-bottom:.8rem;">
                        {{ $product->stock > 5 ? '● In Stock' : ($product->stock > 0 ? '● Low Stock ('.$product->stock.')' : '● Out of Stock') }}
                    </div>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-rog" style="width:100%; justify-content:center; font-size:.78rem; padding:.5rem;" {{ $product->stock == 0 ? 'disabled style=opacity:.4;cursor:not-allowed' : '' }}>
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
        <div style="text-align:center; padding:5rem 2rem; color:#555;">
            <div style="font-size:3rem; margin-bottom:1rem;">🔍</div>
            <h3 style="font-size:1.2rem; color:#888; font-weight:700; margin-bottom:.5rem;">No products found</h3>
            <p style="font-size:.9rem;">Try adjusting your filters or <a href="{{ route('shop') }}" style="color:var(--rog-red);">view all products</a>.</p>
        </div>
        @endif
    </div>
</div>

@endsection
