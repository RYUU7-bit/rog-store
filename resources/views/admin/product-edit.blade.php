@extends('admin.layout')
@section('title','Edit: '.$product->name)
@section('page-title','Edit Product')

@section('content')

{{-- Breadcrumb --}}
<div style="display:flex;align-items:center;gap:.7rem;margin-bottom:1.2rem;font-size:.82rem;flex-wrap:wrap;">
    <a href="{{ route('admin.products') }}" style="color:var(--adm-muted);text-decoration:none;">← Products</a>
    <span style="color:var(--adm-muted);">/</span>
    <span style="color:#e5001e;font-weight:700;max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $product->name }}</span>
</div>

@if($errors->any())
<div style="background:rgba(239,68,68,.1);border:1px solid #ef4444;color:#ef4444;padding:.8rem 1.2rem;border-radius:6px;margin-bottom:1.2rem;font-size:.85rem;">
    <strong>Please fix the following:</strong>
    <ul style="margin:.4rem 0 0 1.2rem;">
        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.products.update', $product) }}">
    @csrf @method('PUT')

    <div style="display:grid;grid-template-columns:1fr 320px;gap:1.2rem;align-items:start;">

        {{-- ── LEFT COLUMN ─────────────────────────────────────────── --}}
        <div style="display:flex;flex-direction:column;gap:1.2rem;">

            {{-- Basic Info --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">Basic Information</span>
                </div>
                <div style="padding:1.2rem;display:flex;flex-direction:column;gap:1rem;">

                    <div style="display:grid;grid-template-columns:1fr auto;gap:1rem;align-items:start;">
                        <div>
                            <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">Product Name *</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                                   style="width:100%;background:var(--adm-surface2);border:1px solid {{ $errors->has('name') ? '#ef4444' : 'var(--adm-border)' }};color:var(--adm-text);padding:.55rem .9rem;border-radius:6px;font-size:.9rem;outline:none;font-family:'Rajdhani',sans-serif;transition:border-color .15s;"
                                   onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
                        </div>
                        <div>
                            <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">SKU *</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required
                                   style="width:140px;background:var(--adm-surface2);border:1px solid var(--adm-border);color:var(--adm-text);padding:.55rem .9rem;border-radius:6px;font-size:.9rem;outline:none;font-family:monospace;transition:border-color .15s;"
                                   onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
                        </div>
                    </div>

                    <div>
                        <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">Category *</label>
                        <select name="category_id" required
                                style="width:100%;background:var(--adm-surface2);border:1px solid var(--adm-border);color:var(--adm-text);padding:.55rem .9rem;border-radius:6px;font-size:.88rem;outline:none;font-family:'Rajdhani',sans-serif;transition:border-color .15s;"
                                onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">Short Description</label>
                        <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}" maxlength="500"
                               style="width:100%;background:var(--adm-surface2);border:1px solid var(--adm-border);color:var(--adm-text);padding:.55rem .9rem;border-radius:6px;font-size:.88rem;outline:none;font-family:'Rajdhani',sans-serif;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
                    </div>

                    <div>
                        <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">Full Description</label>
                        <textarea name="description" rows="5"
                                  style="width:100%;background:var(--adm-surface2);border:1px solid var(--adm-border);color:var(--adm-text);padding:.55rem .9rem;border-radius:6px;font-size:.88rem;outline:none;font-family:'Rajdhani',sans-serif;resize:vertical;line-height:1.6;transition:border-color .15s;"
                                  onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Pricing ─────────────────────────────────────────────── --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">💰 Pricing</span>
                    <span id="discount-badge" style="font-size:.75rem;color:#e5001e;font-weight:700;display:none;"></span>
                </div>
                <div style="padding:1.2rem;">
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;">
                        {{-- Regular Price --}}
                        <div>
                            <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">Regular Price (USD) *</label>
                            <div style="position:relative;">
                                <span style="position:absolute;left:.7rem;top:50%;transform:translateY(-50%);color:var(--adm-muted);font-weight:700;">$</span>
                                <input type="number" name="price" id="price-input" step="0.01" min="0"
                                       value="{{ old('price', $product->price) }}" required
                                       style="width:100%;background:var(--adm-surface2);border:1px solid {{ $errors->has('price') ? '#ef4444' : 'var(--adm-border)' }};color:var(--adm-text);padding:.55rem .9rem .55rem 1.6rem;border-radius:6px;font-size:1rem;font-weight:800;outline:none;font-family:'Rajdhani',sans-serif;transition:border-color .15s;"
                                       onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)';calcDiscount()">
                            </div>
                        </div>
                        {{-- Sale Price --}}
                        <div>
                            <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">
                                Sale Price (USD)
                                <span style="color:#22c55e;font-size:.68rem;">(optional)</span>
                            </label>
                            <div style="position:relative;">
                                <span style="position:absolute;left:.7rem;top:50%;transform:translateY(-50%);color:#22c55e;font-weight:700;">$</span>
                                <input type="number" name="sale_price" id="sale-price-input" step="0.01" min="0"
                                       value="{{ old('sale_price', $product->sale_price) }}"
                                       placeholder="Leave empty = no sale"
                                       style="width:100%;background:var(--adm-surface2);border:1px solid {{ $errors->has('sale_price') ? '#ef4444' : 'var(--adm-border)' }};color:#22c55e;padding:.55rem .9rem .55rem 1.6rem;border-radius:6px;font-size:1rem;font-weight:800;outline:none;font-family:'Rajdhani',sans-serif;transition:border-color .15s;"
                                       onfocus="this.style.borderColor='#22c55e'" onblur="this.style.borderColor='var(--adm-border)';calcDiscount()">
                            </div>
                            <div style="font-size:.7rem;color:var(--adm-muted);margin-top:.25rem;">Must be less than regular price</div>
                        </div>
                        {{-- Discount preview --}}
                        <div style="display:flex;flex-direction:column;justify-content:flex-end;padding-bottom:.1rem;">
                            <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">Discount</label>
                            <div id="discount-preview"
                                 style="background:var(--adm-surface2);border:1px solid var(--adm-border);border-radius:6px;padding:.55rem .9rem;font-size:1.1rem;font-weight:900;color:var(--adm-muted);text-align:center;">
                                @if($product->sale_price)
                                    <span style="color:#e5001e;">-{{ $product->discount_percent }}%</span>
                                    <div style="font-size:.75rem;font-weight:600;color:var(--adm-muted);">Save ${{ number_format($product->price - $product->sale_price, 2) }}</div>
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="adm-card">
                <div class="adm-card-header"><span class="adm-card-title">🖼 Product Image</span></div>
                <div style="padding:1.2rem;display:flex;gap:1rem;align-items:flex-start;">
                    <img id="img-preview" src="{{ $product->image }}" alt="Preview"
                         style="width:100px;height:84px;object-fit:contain;background:var(--adm-surface2);border:1px solid var(--adm-border);border-radius:6px;padding:6px;flex-shrink:0;"
                         onerror="this.src='https://images.unsplash.com/photo-1593640408182-31c228034c55?w=200&q=60'">
                    <div style="flex:1;">
                        <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">Image URL</label>
                        <input type="url" name="image" id="image-url" value="{{ old('image', $product->image) }}" placeholder="https://…"
                               style="width:100%;background:var(--adm-surface2);border:1px solid var(--adm-border);color:var(--adm-text);padding:.55rem .9rem;border-radius:6px;font-size:.82rem;outline:none;font-family:monospace;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'"
                               oninput="document.getElementById('img-preview').src=this.value||'https://images.unsplash.com/photo-1593640408182-31c228034c55?w=200&q=60'">
                        <div style="font-size:.72rem;color:var(--adm-muted);margin-top:.3rem;">Paste a direct image URL. Preview updates as you type.</div>
                    </div>
                </div>
            </div>

            {{-- Specs --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">⚙ Specifications</span>
                    <span style="font-size:.72rem;color:var(--adm-muted);">key = value per line</span>
                </div>
                <div style="padding:1.2rem;">
                    @php
                        $specsRaw = '';
                        if (old('specs_raw')) {
                            $specsRaw = old('specs_raw');
                        } elseif ($product->specs) {
                            foreach ($product->specs as $k => $v) {
                                $specsRaw .= $k . ' = ' . $v . "\n";
                            }
                            $specsRaw = rtrim($specsRaw);
                        }
                    @endphp
                    <textarea name="specs_raw" rows="8"
                              placeholder="CPU = Intel Core Ultra 9 185H&#10;GPU = NVIDIA RTX 4090&#10;RAM = 32GB DDR5&#10;Storage = 2TB NVMe"
                              style="width:100%;background:var(--adm-surface2);border:1px solid var(--adm-border);color:var(--adm-text);padding:.7rem .9rem;border-radius:6px;font-size:.83rem;font-family:monospace;line-height:1.7;resize:vertical;outline:none;transition:border-color .15s;"
                              onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">{{ $specsRaw }}</textarea>
                    <div style="font-size:.72rem;color:var(--adm-muted);margin-top:.3rem;">Format: <code style="background:var(--adm-surface2);padding:1px 5px;border-radius:3px;">CPU = Intel Core i9</code> — one entry per line.</div>
                </div>
            </div>
        </div>

        {{-- ── RIGHT COLUMN ────────────────────────────────────────── --}}
        <div style="display:flex;flex-direction:column;gap:1.2rem;position:sticky;top:72px;">

            {{-- Save button --}}
            <button type="submit"
                    style="width:100%;background:#e5001e;border:none;color:#fff;padding:.8rem;border-radius:8px;font-family:'Orbitron',sans-serif;font-weight:700;font-size:.9rem;letter-spacing:.06em;cursor:pointer;transition:background .2s;text-transform:uppercase;"
                    onmouseover="this.style.background='#b0001a'" onmouseout="this.style.background='#e5001e'">
                💾 Save Changes
            </button>
            <a href="{{ route('admin.products') }}"
               style="display:block;text-align:center;color:var(--adm-muted);text-decoration:none;font-size:.82rem;padding:.5rem;">
                ← Cancel
            </a>

            {{-- Inventory --}}
            <div class="adm-card">
                <div class="adm-card-header"><span class="adm-card-title">📦 Inventory</span></div>
                <div style="padding:1.2rem;display:flex;flex-direction:column;gap:.8rem;">
                    <div>
                        <label style="display:block;font-size:.72rem;color:var(--adm-muted);text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:.4rem;">Stock Quantity *</label>
                        <input type="number" name="stock" min="0" value="{{ old('stock', $product->stock) }}" required
                               id="stock-input"
                               style="width:100%;background:var(--adm-surface2);border:1px solid {{ $errors->has('stock') ? '#ef4444' : 'var(--adm-border)' }};color:var(--adm-text);padding:.55rem .9rem;border-radius:6px;font-size:1.1rem;font-weight:800;text-align:center;outline:none;font-family:'Orbitron',sans-serif;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)';updateStockLabel()">
                        <div id="stock-label" style="text-align:center;font-size:.75rem;margin-top:.35rem;font-weight:700;">
                            @if($product->stock === 0)
                                <span style="color:#ef4444;">Out of Stock</span>
                            @elseif($product->stock <= 5)
                                <span style="color:#f59e0b;">Low Stock — {{ $product->stock }} left</span>
                            @else
                                <span style="color:#22c55e;">In Stock</span>
                            @endif
                        </div>
                    </div>
                    {{-- Quick stock buttons --}}
                    <div style="display:flex;gap:.4rem;flex-wrap:wrap;">
                        @foreach([0, 5, 10, 20, 50, 100] as $qty)
                        <button type="button" onclick="setStock({{ $qty }})"
                                style="background:var(--adm-surface2);border:1px solid var(--adm-border);color:var(--adm-text);padding:.3rem .6rem;border-radius:4px;font-size:.75rem;cursor:pointer;font-family:'Rajdhani',sans-serif;font-weight:700;transition:border-color .15s;"
                                onmouseover="this.style.borderColor='#e5001e';this.style.color='#e5001e'" onmouseout="this.style.borderColor='var(--adm-border)';this.style.color='var(--adm-text)'">
                            {{ $qty }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Flags --}}
            <div class="adm-card">
                <div class="adm-card-header"><span class="adm-card-title">🏷 Product Flags</span></div>
                <div style="padding:1.2rem;display:flex;flex-direction:column;gap:.8rem;">
                    {{-- Active toggle --}}
                    <label style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;padding:.5rem .7rem;border:1px solid var(--adm-border);border-radius:6px;">
                        <div>
                            <div style="font-weight:700;font-size:.85rem;">Active / Visible</div>
                            <div style="font-size:.72rem;color:var(--adm-muted);">Show in shop</div>
                        </div>
                        <div style="position:relative;width:44px;height:24px;">
                            <input type="checkbox" name="is_active" value="1" id="is_active"
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                   style="opacity:0;width:0;height:0;position:absolute;"
                                   onchange="updateToggle('is_active','active-track')">
                            <span id="active-track"
                                  onclick="document.getElementById('is_active').click()"
                                  style="position:absolute;inset:0;border-radius:12px;cursor:pointer;background:{{ $product->is_active ? '#22c55e' : 'var(--adm-border)' }};transition:background .25s;"></span>
                            <span style="position:absolute;top:3px;width:18px;height:18px;border-radius:50%;background:#fff;transition:transform .25s;transform:{{ $product->is_active ? 'translateX(22px)' : 'translateX(3px)' }};pointer-events:none;box-shadow:0 1px 3px rgba(0,0,0,.4);" id="active-thumb"></span>
                        </div>
                    </label>
                    {{-- Featured toggle --}}
                    <label style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;padding:.5rem .7rem;border:1px solid var(--adm-border);border-radius:6px;">
                        <div>
                            <div style="font-weight:700;font-size:.85rem;">Featured</div>
                            <div style="font-size:.72rem;color:var(--adm-muted);">Show on home page</div>
                        </div>
                        <div style="position:relative;width:44px;height:24px;">
                            <input type="checkbox" name="is_featured" value="1" id="is_featured"
                                   {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                   style="opacity:0;width:0;height:0;position:absolute;"
                                   onchange="updateToggle('is_featured','feat-track')">
                            <span id="feat-track"
                                  onclick="document.getElementById('is_featured').click()"
                                  style="position:absolute;inset:0;border-radius:12px;cursor:pointer;background:{{ $product->is_featured ? '#e5001e' : 'var(--adm-border)' }};transition:background .25s;"></span>
                            <span style="position:absolute;top:3px;width:18px;height:18px;border-radius:50%;background:#fff;transition:transform .25s;transform:{{ $product->is_featured ? 'translateX(22px)' : 'translateX(3px)' }};pointer-events:none;box-shadow:0 1px 3px rgba(0,0,0,.4);" id="feat-thumb"></span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Meta --}}
            <div class="adm-card">
                <div class="adm-card-header"><span class="adm-card-title">ℹ Info</span></div>
                <div style="padding:1rem 1.2rem;font-size:.8rem;color:var(--adm-muted);display:flex;flex-direction:column;gap:.4rem;">
                    <div style="display:flex;justify-content:space-between;"><span>Created</span><span>{{ $product->created_at->format('M j, Y') }}</span></div>
                    <div style="display:flex;justify-content:space-between;"><span>Updated</span><span>{{ $product->updated_at->format('M j, Y H:i') }}</span></div>
                    <div style="display:flex;justify-content:space-between;"><span>Slug</span><span style="font-family:monospace;font-size:.75rem;color:#e5001e;">{{ $product->slug }}</span></div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function calcDiscount() {
    var price    = parseFloat(document.getElementById('price-input').value) || 0;
    var sale     = parseFloat(document.getElementById('sale-price-input').value) || 0;
    var preview  = document.getElementById('discount-preview');
    if (price > 0 && sale > 0 && sale < price) {
        var pct = Math.round((1 - sale / price) * 100);
        var save = (price - sale).toFixed(2);
        preview.innerHTML = '<span style="color:#e5001e;font-size:1.3rem;">-' + pct + '%</span>' +
                            '<div style="font-size:.72rem;font-weight:600;color:var(--adm-muted);">Save $' + save + '</div>';
    } else {
        preview.innerHTML = '<span style="color:var(--adm-muted);">—</span>';
    }
}

function updateStockLabel() {
    var stock = parseInt(document.getElementById('stock-input').value) || 0;
    var el = document.getElementById('stock-label');
    if (stock === 0) {
        el.innerHTML = '<span style="color:#ef4444;">Out of Stock</span>';
    } else if (stock <= 5) {
        el.innerHTML = '<span style="color:#f59e0b;">Low Stock — ' + stock + ' left</span>';
    } else {
        el.innerHTML = '<span style="color:#22c55e;">In Stock</span>';
    }
}

function setStock(qty) {
    document.getElementById('stock-input').value = qty;
    updateStockLabel();
}

function updateToggle(inputId, trackId) {
    var cb    = document.getElementById(inputId);
    var track = document.getElementById(trackId);
    var thumb = document.getElementById(inputId === 'is_active' ? 'active-thumb' : 'feat-thumb');
    var color = inputId === 'is_active' ? '#22c55e' : '#e5001e';
    track.style.background = cb.checked ? color : 'var(--adm-border)';
    thumb.style.transform  = cb.checked ? 'translateX(22px)' : 'translateX(3px)';
}

// Init discount on load
calcDiscount();
</script>
@endsection
