@extends('layouts.app')
@section('title', $product->name . ' — ROG Store')

@section('content')
<div style="max-width:1280px; margin:0 auto; padding:2rem 1.5rem;">

    {{-- Breadcrumb --}}
    <div style="font-size:.75rem; color:#555; letter-spacing:.08em; text-transform:uppercase; margin-bottom:2rem;">
        <a href="{{ route('home') }}" style="color:#555; text-decoration:none;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#555'">Home</a>
        › <a href="{{ route('shop') }}" style="color:#555; text-decoration:none;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#555'">Shop</a>
        › <a href="{{ route('shop',['category'=>$product->category->slug]) }}" style="color:#555; text-decoration:none;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#555'">{{ $product->category->name }}</a>
        › <span style="color:#aaa;">{{ $product->name }}</span>
    </div>

    {{-- Main Product Section --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; margin-bottom:4rem;">

        {{-- Product Image --}}
        <div>
            <div style="background:#0d0d0d; border:1px solid #1e1e1e; padding:2rem; display:flex; align-items:center; justify-content:center; min-height:420px; position:relative;">
                @if($product->sale_price)
                <div class="badge-sale" style="top:16px; left:16px;">-{{ $product->discount_percent }}%</div>
                @endif
                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                     style="max-width:100%; max-height:380px; object-fit:contain;"
                     onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=600&q=70'">
            </div>
        </div>

        {{-- Product Info --}}
        <div>
            <div style="color:var(--rog-red); font-size:.72rem; font-weight:700; letter-spacing:.2em; text-transform:uppercase; margin-bottom:.7rem;">
                {{ $product->category->name }}
            </div>
            <h1 style="font-family:'Orbitron',sans-serif; font-size:clamp(1.3rem,2.5vw,1.9rem); font-weight:900; color:#fff; line-height:1.2; margin-bottom:1rem;">
                {{ $product->name }}
            </h1>
            <div style="color:#666; font-size:.82rem; margin-bottom:1.2rem;">SKU: <span style="color:#aaa;">{{ $product->sku }}</span></div>

            {{-- Price --}}
            <div style="display:flex; align-items:baseline; gap:1rem; margin-bottom:1.5rem; padding:1.2rem; background:#111; border:1px solid #1e1e1e;">
                @if($product->sale_price)
                <span style="font-size:2rem; font-weight:900; color:var(--rog-red);">${{ number_format($product->sale_price,2) }}</span>
                <span style="font-size:1.1rem; color:#555; text-decoration:line-through;">${{ number_format($product->price,2) }}</span>
                <span style="background:var(--rog-red); color:#fff; font-size:.72rem; font-weight:700; padding:2px 8px; align-self:center;">SAVE ${{ number_format($product->price - $product->sale_price, 2) }}</span>
                @else
                <span style="font-size:2rem; font-weight:900; color:var(--rog-red);">${{ number_format($product->price,2) }}</span>
                @endif
            </div>

            <p style="color:#aaa; line-height:1.8; font-size:.93rem; margin-bottom:1.5rem;">{{ $product->short_description }}</p>

            {{-- Stock --}}
            <div style="display:flex; align-items:center; gap:.6rem; margin-bottom:1.5rem;">
                <div style="width:8px; height:8px; border-radius:50%; background:{{ $product->stock > 5 ? '#22c55e' : ($product->stock > 0 ? '#f59e0b' : '#ef4444') }};"></div>
                <span style="font-size:.85rem; color:{{ $product->stock > 5 ? '#22c55e' : ($product->stock > 0 ? '#f59e0b' : '#ef4444') }}; font-weight:600;">
                    {{ $product->stock > 5 ? 'In Stock' : ($product->stock > 0 ? 'Low Stock — Only '.$product->stock.' left' : 'Out of Stock') }}
                </span>
            </div>

            {{-- Add to Cart --}}
            @if($product->stock > 0)
            <form action="{{ route('cart.add') }}" method="POST" style="display:flex; gap:.8rem; margin-bottom:1rem;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div style="display:flex; align-items:center; border:1px solid #2a2a2a; background:#111;">
                    <button type="button" style="background:none;border:none;color:#aaa;cursor:pointer;padding:.5rem .9rem;font-size:1.1rem;" onclick="const i=this.nextElementSibling;i.value=Math.max(1,+i.value-1)">−</button>
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                           style="background:none;border:none;color:#fff;width:50px;text-align:center;font-weight:700;font-size:.95rem;outline:none;">
                    <button type="button" style="background:none;border:none;color:#aaa;cursor:pointer;padding:.5rem .9rem;font-size:1.1rem;" onclick="const i=this.previousElementSibling;i.value=Math.min({{ $product->stock }},+i.value+1)">+</button>
                </div>
                <button type="submit" class="btn-rog" style="flex:1; justify-content:center; font-size:.9rem;">
                    🛒 Add to Cart
                </button>
            </form>
            @endif
            <a href="{{ route('cart') }}" class="btn-rog-outline" style="text-decoration:none; display:flex; justify-content:center; margin-bottom:1.5rem; font-size:.85rem;">View Cart</a>

            {{-- Features --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:.6rem;">
                @foreach(['🚀 Free Shipping over $500','🔒 Secure Checkout','🏆 Genuine ROG Product','🔧 2-Year Warranty'] as $feat)
                <div style="font-size:.78rem; color:#666; display:flex; align-items:center; gap:.4rem;">{{ $feat }}</div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Tabs: Description / Specs --}}
    <div style="margin-bottom:4rem;">
        <div style="display:flex; border-bottom:1px solid #1e1e1e; margin-bottom:1.5rem;" id="tabs">
            <button class="tab-btn active" data-tab="desc" onclick="switchTab('desc',this)" style="background:none;border:none;border-bottom:2px solid var(--rog-red);color:#fff;font-weight:700;font-size:.85rem;letter-spacing:.1em;text-transform:uppercase;padding:.9rem 1.5rem;cursor:pointer;margin-bottom:-1px;">Description</button>
            <button class="tab-btn" data-tab="specs" onclick="switchTab('specs',this)" style="background:none;border:none;border-bottom:2px solid transparent;color:#666;font-weight:700;font-size:.85rem;letter-spacing:.1em;text-transform:uppercase;padding:.9rem 1.5rem;cursor:pointer;margin-bottom:-1px;transition:color .2s;">Specifications</button>
        </div>
        <div id="tab-desc" style="color:#aaa; line-height:1.9; font-size:.93rem;">{{ $product->description }}</div>
        <div id="tab-specs" style="display:none;">
            @if($product->specs)
            <table class="rog-table" style="max-width:700px;">
                <tbody>
                    @foreach($product->specs as $key => $val)
                    <tr>
                        <td style="color:var(--rog-red); font-weight:700; font-size:.83rem; text-transform:uppercase; letter-spacing:.06em; width:180px;">{{ $key }}</td>
                        <td style="color:#ccc; font-size:.9rem;">{{ $val }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p style="color:#555;">No specifications available.</p>
            @endif
        </div>
    </div>

    {{-- Related Products --}}
    @if($related->count())
    <div>
        <h2 class="section-title" style="margin-bottom:2rem;">Related Products</h2>
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:1.2rem;">
            @foreach($related as $rel)
            <div class="product-card">
                <a href="{{ route('product.show',$rel->slug) }}">
                    <img src="{{ $rel->image }}" alt="{{ $rel->name }}" loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=400&q=60'">
                </a>
                <div style="padding:1rem;">
                    <a href="{{ route('product.show',$rel->slug) }}" style="text-decoration:none;">
                        <h3 style="font-size:.9rem; font-weight:700; color:#ddd; margin-bottom:.6rem; line-height:1.3;" onmouseover="this.style.color='var(--rog-red)'" onmouseout="this.style.color='#ddd'">{{ $rel->name }}</h3>
                    </a>
                    <div style="display:flex; align-items:center; gap:.6rem; margin-bottom:.8rem;">
                        @if($rel->sale_price)
                        <span class="price-original">${{ number_format($rel->price,2) }}</span>
                        <span class="price-current">${{ number_format($rel->sale_price,2) }}</span>
                        @else
                        <span class="price-current">${{ number_format($rel->price,2) }}</span>
                        @endif
                    </div>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $rel->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-rog" style="width:100%; justify-content:center; font-size:.78rem; padding:.5rem;">Add to Cart</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function switchTab(id, btn) {
    document.querySelectorAll('[id^="tab-"]').forEach(t => t.style.display = 'none');
    document.querySelectorAll('.tab-btn').forEach(b => {
        b.style.borderBottomColor = 'transparent';
        b.style.color = '#666';
    });
    document.getElementById('tab-' + id).style.display = 'block';
    btn.style.borderBottomColor = 'var(--rog-red)';
    btn.style.color = '#fff';
}
</script>
@endpush
