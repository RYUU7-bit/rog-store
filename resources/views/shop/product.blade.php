@extends('layouts.app')
@section('title', $product->name . ' — ROG Store')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:1.5rem 1rem 3rem;">

    {{-- Breadcrumb --}}
    <div style="font-size:.72rem; color:var(--text-muted); letter-spacing:.08em; text-transform:uppercase; margin-bottom:1.5rem;">
        <a href="{{ route('home') }}" style="color:var(--text-muted); text-decoration:none;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-muted)'">Home</a>
        › <a href="{{ route('shop') }}" style="color:var(--text-muted); text-decoration:none;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-muted)'">Shop</a>
        › <a href="{{ route('shop',['category'=>$product->category->slug]) }}" style="color:var(--text-muted); text-decoration:none;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-muted)'">{{ $product->category->name }}</a>
        › <span style="color:var(--rog-red);">{{ Str::limit($product->name, 25) }}</span>
    </div>

    {{-- Main Product Section --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:2.5rem; margin-bottom:3.5rem;">

        {{-- Product Image --}}
        <div>
            <div style="background:var(--bg-surface); border:1px solid var(--border-card); padding:1.5rem; display:flex; align-items:center; justify-content:center; min-height:360px; position:relative; border-radius:8px;">
                @if($product->sale_price)
                <div class="badge-sale" style="top:12px; left:12px;">-{{ $product->discount_percent }}%</div>
                @endif
                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                     style="max-width:100%; max-height:340px; object-fit:contain;"
                     onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=600&q=70'">
            </div>
        </div>

        {{-- Product Info --}}
        <div>
            <div style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.2em; text-transform:uppercase; margin-bottom:.5rem;">
                {{ $product->category->name }}
            </div>
            <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.3rem,2.5vw,1.8rem); font-weight:900; color:var(--text-primary); line-height:1.2; margin-bottom:.8rem;">
                {{ $product->name }}
            </h1>
            <div style="color:var(--text-muted); font-size:.8rem; margin-bottom:1rem;">SKU: <span style="color:var(--text-secondary);">{{ $product->sku }}</span></div>

            {{-- Price --}}
            <div style="display:flex; align-items:baseline; gap:1rem; margin-bottom:1.2rem; padding:1rem 1.2rem; background:var(--bg-card); border:1px solid var(--border-card); border-radius:6px; flex-wrap:wrap;">
                @if($product->sale_price)
                <span style="font-size:1.8rem; font-weight:900; color:var(--rog-red);">${{ number_format($product->sale_price,2) }}</span>
                <span style="font-size:1rem; color:var(--text-muted); text-decoration:line-through;">${{ number_format($product->price,2) }}</span>
                <span style="background:var(--rog-red); color:#fff; font-size:.7rem; font-weight:700; padding:2px 8px; border-radius:3px;">SAVE ${{ number_format($product->price - $product->sale_price, 2) }}</span>
                @else
                <span style="font-size:1.8rem; font-weight:900; color:var(--rog-red);">${{ number_format($product->price,2) }}</span>
                @endif
            </div>

            <p style="color:var(--text-secondary); line-height:1.7; font-size:.9rem; margin-bottom:1.2rem;">{{ $product->short_description }}</p>

            {{-- Stock --}}
            <div style="display:flex; align-items:center; gap:.5rem; margin-bottom:1.2rem;">
                <div style="width:8px; height:8px; border-radius:50%; background:{{ $product->stock > 5 ? '#22c55e' : ($product->stock > 0 ? '#f59e0b' : '#ef4444') }};"></div>
                <span style="font-size:.82rem; color:{{ $product->stock > 5 ? '#22c55e' : ($product->stock > 0 ? '#f59e0b' : '#ef4444') }}; font-weight:700;">
                    {{ $product->stock > 5 ? 'In Stock — Ready to Ship' : ($product->stock > 0 ? 'Low Stock — Only '.$product->stock.' left' : 'Out of Stock') }}
                </span>
            </div>

            {{-- Add to Cart --}}
            @if($product->stock > 0)
            <form action="{{ route('cart.add') }}" method="POST" id="main-add-cart-form" style="display:flex; gap:.7rem; margin-bottom:.8rem;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div style="display:flex; align-items:center; border:1px solid var(--border-input); background:var(--bg-elevated); border-radius:4px;">
                    <button type="button" style="background:none;border:none;color:var(--text-primary);cursor:pointer;padding:.5rem .8rem;font-size:1.1rem;" onclick="const i=this.nextElementSibling;i.value=Math.max(1,+i.value-1)">−</button>
                    <input type="number" name="quantity" id="product-qty-input" value="1" min="1" max="{{ $product->stock }}"
                           style="background:none;border:none;color:var(--text-primary);width:44px;text-align:center;font-weight:700;font-size:.92rem;outline:none;">
                    <button type="button" style="background:none;border:none;color:var(--text-primary);cursor:pointer;padding:.5rem .8rem;font-size:1.1rem;" onclick="const i=this.previousElementSibling;i.value=Math.min({{ $product->stock }},+i.value+1)">+</button>
                </div>
                <button type="submit" class="btn-rog" style="flex:1; justify-content:center; font-size:.88rem; border-radius:4px;">
                    🛒 Add to Cart
                </button>
            </form>
            @endif
            <a href="{{ route('cart') }}" class="btn-rog-outline" style="text-decoration:none; display:flex; justify-content:center; margin-bottom:1.5rem; font-size:.82rem; border-radius:4px;">View Cart</a>

            {{-- Features Badges --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:.5rem; background:var(--bg-card); padding:.9rem; border:1px solid var(--border-card); border-radius:6px;">
                @foreach(['🚀 Free Shipping > $500','🔒 100% Secure Checkout','🏆 Genuine ROG Product','🔧 2-Year Warranty'] as $feat)
                <div style="font-size:.74rem; color:var(--text-muted); display:flex; align-items:center; gap:.4rem; font-weight:600;">{{ $feat }}</div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Tabs: Description / Specs --}}
    <div style="margin-bottom:3.5rem;">
        <div style="display:flex; border-bottom:1px solid var(--border-base); margin-bottom:1.2rem;" id="tabs">
            <button class="tab-btn active" data-tab="desc" onclick="switchTab('desc',this)" style="background:none;border:none;border-bottom:2px solid var(--rog-red);color:var(--text-primary);font-weight:700;font-size:.82rem;letter-spacing:.08em;text-transform:uppercase;padding:.8rem 1.2rem;cursor:pointer;margin-bottom:-1px;">Description</button>
            <button class="tab-btn" data-tab="specs" onclick="switchTab('specs',this)" style="background:none;border:none;border-bottom:2px solid transparent;color:var(--text-muted);font-weight:700;font-size:.82rem;letter-spacing:.08em;text-transform:uppercase;padding:.8rem 1.2rem;cursor:pointer;margin-bottom:-1px;transition:color .2s;">Specifications</button>
        </div>
        <div id="tab-desc" style="color:var(--text-secondary); line-height:1.8; font-size:.9rem; background:var(--bg-card); padding:1.2rem; border:1px solid var(--border-card); border-radius:6px;">
            {{ $product->description }}
        </div>
        <div id="tab-specs" style="display:none; background:var(--bg-card); padding:1rem; border:1px solid var(--border-card); border-radius:6px; overflow-x:auto;">
            @if($product->specs)
            <table class="rog-table" style="width:100%;">
                <tbody>
                    @foreach($product->specs as $key => $val)
                    <tr>
                        <td style="color:var(--rog-red); font-weight:700; font-size:.8rem; text-transform:uppercase; letter-spacing:.06em; width:160px;">{{ $key }}</td>
                        <td style="color:var(--text-primary); font-size:.85rem;">{{ $val }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p style="color:var(--text-muted); margin:0;">No specifications available.</p>
            @endif
        </div>
    </div>

    {{-- Related Products --}}
    @if($related->count())
    <div>
        <h2 class="section-title" style="margin-bottom:1.5rem;">Related Products</h2>
        <div class="product-grid-mobile" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:1rem;">
            @foreach($related as $rel)
            <div class="product-card">
                <a href="{{ route('product.show',$rel->slug) }}">
                    <img src="{{ $rel->image }}" alt="{{ $rel->name }}" loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=400&q=60'">
                </a>
                <div class="product-card-body" style="padding:1rem;">
                    <a href="{{ route('product.show',$rel->slug) }}" style="text-decoration:none;">
                        <h3 class="product-card-title" style="font-size:.88rem; font-weight:700; color:var(--text-primary); margin-bottom:.4rem; line-height:1.3;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='var(--text-primary)'">{{ $rel->name }}</h3>
                    </a>
                    <div style="display:flex; align-items:center; gap:.5rem; margin-bottom:.5rem; flex-wrap:wrap;">
                        @if($rel->sale_price)
                        <span class="price-original" style="font-size:.8rem;">${{ number_format($rel->price,2) }}</span>
                        <span class="price-current product-card-price">${{ number_format($rel->sale_price,2) }}</span>
                        @else
                        <span class="price-current product-card-price">${{ number_format($rel->price,2) }}</span>
                        @endif
                    </div>
                    <form action="{{ route('cart.add') }}" method="POST" style="margin-top:auto;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $rel->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-rog product-card-btn" 
                                style="width:100%; justify-content:center; font-size:.75rem; padding:.45rem; {{ $rel->stock == 0 ? 'opacity:.4; cursor:not-allowed;' : '' }}"
                                {{ $rel->stock == 0 ? 'disabled' : '' }}>
                            {{ $rel->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

{{-- ═══ MOBILE STICKY BOTTOM BUY BAR ═════════════════════════════════════════ --}}
@if($product->stock > 0)
<div class="mobile-sticky-action-bar">
    <div>
        <div style="font-size:.65rem; color:var(--text-muted); text-transform:uppercase; font-weight:700;">Price</div>
        <div style="font-size:1.1rem; font-weight:900; color:var(--rog-red); line-height:1;">
            ${{ number_format($product->sale_price ?? $product->price, 2) }}
        </div>
    </div>
    <form action="{{ route('cart.add') }}" method="POST" style="display:flex; gap:.5rem;">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">
        <button type="submit" class="btn-rog" style="padding:.6rem 1.4rem; font-size:.85rem; border-radius:6px;">
            ⚡ Add to Cart
        </button>
    </form>
</div>
@endif

@endsection

@push('scripts')
<script>
function switchTab(id, btn) {
    document.querySelectorAll('[id^="tab-"]').forEach(t => t.style.display = 'none');
    document.querySelectorAll('.tab-btn').forEach(b => {
        b.style.borderBottomColor = 'transparent';
        b.style.color = 'var(--text-muted)';
    });
    document.getElementById('tab-' + id).style.display = 'block';
    btn.style.borderBottomColor = 'var(--rog-red)';
    btn.style.color = 'var(--text-primary)';
}
</script>
@endpush
