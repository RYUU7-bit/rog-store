@extends('admin.layout')
@section('title','Deploy New Hardware')
@section('page-title','Deploy New Hardware SKU')

@section('content')

{{-- Breadcrumb & Top Bar --}}
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.4rem; flex-wrap:wrap; gap:.8rem;">
    <div style="display:flex; align-items:center; gap:.7rem; font-size:.82rem;">
        <a href="{{ route('admin.products') }}" style="color:var(--adm-muted); text-decoration:none; font-family:'Orbitron',sans-serif; font-weight:700; display:inline-flex; align-items:center; gap:4px;">
            ‹ BACK TO HARDWARE GRID
        </a>
        <span style="color:var(--adm-muted);">/</span>
        <span style="color:#e5001e; font-weight:800; font-family:'Orbitron',sans-serif;">NEW HARDWARE REGISTRATION</span>
    </div>
    <div style="display:flex; align-items:center; gap:.8rem;">
        <a href="{{ route('admin.products') }}" style="font-family:'Orbitron',sans-serif; font-size:.75rem; color:#cbd5e1; text-decoration:none; padding:.45rem .9rem; background:var(--adm-surface2); border:1px solid var(--adm-border); border-radius:6px; font-weight:700;">
            ✕ CANCEL
        </a>
    </div>
</div>

@if($errors->any())
<div style="background:rgba(239,68,68,.12); border:1px solid #ef4444; color:#fca5a5; padding:1rem 1.4rem; border-radius:8px; margin-bottom:1.4rem; font-size:.88rem; box-shadow:0 0 15px rgba(239,68,68,0.2);">
    <div style="font-family:'Orbitron',sans-serif; font-weight:800; display:flex; align-items:center; gap:6px; margin-bottom:.4rem; color:#ef4444;">
        <span>⚠️</span> TELEMETRY VALIDATION FAILED
    </div>
    <ul style="margin:0 0 0 1.2rem; font-weight:600;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="deployHardwareForm">
    @csrf

    <div style="display:grid; grid-template-columns:1fr 340px; gap:1.4rem; align-items:start;">

        {{-- ── LEFT COLUMN ─────────────────────────────────────────── --}}
        <div style="display:flex; flex-direction:column; gap:1.4rem;">

            {{-- Basic Information --}}
            <div class="adm-card">
                <div class="hud-corner-tl"></div>
                <div class="adm-card-header">
                    <span class="adm-card-title">
                        <span style="color:#e5001e;">⚡</span> 1. Hardware Specifications & Identity
                    </span>
                    <span style="font-family:'Orbitron',sans-serif; font-size:.7rem; color:#94a3b8;">REQUIRED FIELDS *</span>
                </div>
                <div style="padding:1.4rem; display:flex; flex-direction:column; gap:1.2rem;">

                    {{-- Product Name & SKU --}}
                    <div style="display:grid; grid-template-columns:1.5fr 1fr; gap:1rem;">
                        <div>
                            <label style="display:block; font-size:.75rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.4rem; font-family:'Orbitron',sans-serif;">
                                Hardware Model Name *
                            </label>
                            <input type="text" name="name" id="hardware-name" value="{{ old('name') }}" required
                                   placeholder="e.g. ROG Swift OLED PG49WCD"
                                   style="width:100%; background:var(--adm-surface2); border:1px solid {{ $errors->has('name') ? '#ef4444' : 'var(--adm-border)' }}; color:#fff; padding:.65rem 1rem; border-radius:6px; font-size:.95rem; font-weight:700; outline:none; font-family:'Rajdhani',sans-serif; transition:all .2s;"
                                   onfocus="this.style.borderColor='#e5001e'; this.style.boxShadow='0 0 10px rgba(229,0,30,0.3)';"
                                   onblur="this.style.borderColor='var(--adm-border)'; this.style.boxShadow='none';"
                                   oninput="handleNameInput(this.value)">
                        </div>
                        <div>
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.4rem;">
                                <label style="font-size:.75rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; font-family:'Orbitron',sans-serif;">
                                    SKU Identifier *
                                </label>
                                <button type="button" onclick="autoGenerateSku()" style="background:none; border:none; color:#c084fc; font-size:.68rem; font-family:'Orbitron',sans-serif; font-weight:800; cursor:pointer; text-decoration:underline;">
                                    ⚡ AUTO SKU
                                </button>
                            </div>
                            <input type="text" name="sku" id="hardware-sku" value="{{ old('sku') }}" required
                                   placeholder="ROG-MODEL-2026"
                                   style="width:100%; background:var(--adm-surface2); border:1px solid {{ $errors->has('sku') ? '#ef4444' : 'var(--adm-border)' }}; color:#38bdf8; padding:.65rem 1rem; border-radius:6px; font-size:.9rem; font-weight:800; outline:none; font-family:'Orbitron',sans-serif; transition:all .2s;"
                                   onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
                        </div>
                    </div>

                    {{-- Category & Custom Slug --}}
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                        <div>
                            <label style="display:block; font-size:.75rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.4rem; font-family:'Orbitron',sans-serif;">
                                Primary Category *
                            </label>
                            <select name="category_id" required
                                    style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.65rem 1rem; border-radius:6px; font-size:.9rem; font-weight:700; outline:none; font-family:'Rajdhani',sans-serif; transition:border-color .15s;"
                                    onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
                                <option value="">-- Select ROG Hardware Category --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="display:block; font-size:.75rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.4rem; font-family:'Orbitron',sans-serif;">
                                URL Slug (Auto-Generated)
                            </label>
                            <input type="text" name="slug" id="hardware-slug" value="{{ old('slug') }}" placeholder="auto-generated-from-name"
                                   style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#94a3b8; padding:.65rem 1rem; border-radius:6px; font-size:.85rem; outline:none; font-family:monospace; transition:border-color .15s;"
                                   onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
                        </div>
                    </div>

                    {{-- Short Description --}}
                    <div>
                        <label style="display:block; font-size:.75rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.4rem; font-family:'Orbitron',sans-serif;">
                            Highlight Tagline / Short Description
                        </label>
                        <input type="text" name="short_description" value="{{ old('short_description') }}" maxlength="500"
                               placeholder="e.g. 49-inch curved QD-OLED gaming monitor with 144Hz refresh rate and 0.03ms response"
                               style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.65rem 1rem; border-radius:6px; font-size:.9rem; font-weight:600; outline:none; font-family:'Rajdhani',sans-serif; transition:border-color .15s;"
                               onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">
                    </div>

                    {{-- Full Description --}}
                    <div>
                        <label style="display:block; font-size:.75rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.4rem; font-family:'Orbitron',sans-serif;">
                            Full Overview & Product Narrative
                        </label>
                        <textarea name="description" rows="4"
                                  placeholder="Detailed architectural features, thermal cooling solutions, display panel tech, RGB Aura Sync integration, and pro-gamer features…"
                                  style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.75rem 1rem; border-radius:6px; font-size:.9rem; outline:none; font-family:'Rajdhani',sans-serif; resize:vertical; line-height:1.6; transition:border-color .15s;"
                                  onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">{{ old('description') }}</textarea>
                    </div>

                </div>
            </div>

            {{-- Pricing & Economics --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">
                        <span style="color:#22c55e;">💰</span> 2. MSRP & Sale Pricing Matrix
                    </span>
                    <span id="discountPill" style="display:none; font-family:'Orbitron',sans-serif; font-size:.75rem; font-weight:900; background:rgba(229,0,30,0.2); border:1px solid #e5001e; color:#ff4d6d; padding:2px 10px; border-radius:12px; box-shadow:0 0 10px rgba(229,0,30,0.4);"></span>
                </div>
                <div style="padding:1.4rem;">
                    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1.2rem; align-items:end;">
                        {{-- Regular MSRP --}}
                        <div>
                            <label style="display:block; font-size:.75rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.4rem; font-family:'Orbitron',sans-serif;">
                                MSRP Price (USD) *
                            </label>
                            <div style="position:relative;">
                                <span style="position:absolute; left:.9rem; top:50%; transform:translateY(-50%); color:var(--adm-muted); font-weight:900; font-family:'Orbitron',sans-serif;">$</span>
                                <input type="number" name="price" id="create-price" step="0.01" min="0" value="{{ old('price') }}" required
                                       placeholder="1299.99"
                                       style="width:100%; background:var(--adm-surface2); border:1px solid {{ $errors->has('price') ? '#ef4444' : 'var(--adm-border)' }}; color:#fff; padding:.65rem 1rem .65rem 2.2rem; border-radius:6px; font-size:1.15rem; font-weight:900; outline:none; font-family:'Orbitron',sans-serif; transition:all .2s;"
                                       onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'; updateDiscountPreview();" oninput="updateDiscountPreview();">
                            </div>
                        </div>

                        {{-- Sale Price --}}
                        <div>
                            <label style="display:block; font-size:.75rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.1em; font-weight:800; margin-bottom:.4rem; font-family:'Orbitron',sans-serif;">
                                Sale Price (USD) <span style="color:#22c55e; font-size:.68rem;">(OPTIONAL)</span>
                            </label>
                            <div style="position:relative;">
                                <span style="position:absolute; left:.9rem; top:50%; transform:translateY(-50%); color:#22c55e; font-weight:900; font-family:'Orbitron',sans-serif;">$</span>
                                <input type="number" name="sale_price" id="create-sale-price" step="0.01" min="0" value="{{ old('sale_price') }}"
                                       placeholder="1099.99"
                                       style="width:100%; background:var(--adm-surface2); border:1px solid {{ $errors->has('sale_price') ? '#ef4444' : 'var(--adm-border)' }}; color:#34d399; padding:.65rem 1rem .65rem 2.2rem; border-radius:6px; font-size:1.15rem; font-weight:900; outline:none; font-family:'Orbitron',sans-serif; transition:all .2s;"
                                       onfocus="this.style.borderColor='#22c55e'" onblur="this.style.borderColor='var(--adm-border)'; updateDiscountPreview();" oninput="updateDiscountPreview();">
                            </div>
                        </div>

                        {{-- Real-Time Savings Display --}}
                        <div style="background:rgba(0,0,0,0.4); border:1px dashed rgba(147,51,234,0.3); border-radius:8px; padding:.75rem 1rem; text-align:center;">
                            <div style="font-size:.68rem; color:#94a3b8; font-family:'Orbitron',sans-serif; text-transform:uppercase; font-weight:800; margin-bottom:.2rem;">Effective Savings</div>
                            <div id="savingsAmount" style="font-family:'Orbitron',sans-serif; font-size:1.1rem; font-weight:900; color:#34d399;">
                                No Discount
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Technical Specifications Key-Value Generator --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">
                        <span style="color:#c084fc;">⚙</span> 3. Technical Specifications Matrix
                    </span>
                    <span style="font-size:.72rem; color:#94a3b8; font-family:monospace;">Format: Key = Value</span>
                </div>
                <div style="padding:1.4rem;">
                    {{-- Quick Preset Generator Pills --}}
                    <div style="margin-bottom:.8rem; display:flex; gap:.45rem; flex-wrap:wrap; align-items:center;">
                        <span style="font-size:.7rem; color:#94a3b8; font-family:'Orbitron',sans-serif; font-weight:800; margin-right:.3rem;">PRESET INSERTS:</span>
                        <button type="button" onclick="insertSpecPreset('Display', '16-inch 2.5K OLED 240Hz 0.2ms')" style="background:var(--adm-surface2); border:1px solid rgba(147,51,234,0.4); color:#c084fc; padding:2px 8px; border-radius:4px; font-size:.72rem; font-weight:700; cursor:pointer;">+ Display</button>
                        <button type="button" onclick="insertSpecPreset('CPU', 'Intel Core Ultra 9 / AMD Ryzen 9')" style="background:var(--adm-surface2); border:1px solid rgba(147,51,234,0.4); color:#c084fc; padding:2px 8px; border-radius:4px; font-size:.72rem; font-weight:700; cursor:pointer;">+ CPU</button>
                        <button type="button" onclick="insertSpecPreset('GPU', 'NVIDIA GeForce RTX 4090 16GB')" style="background:var(--adm-surface2); border:1px solid rgba(147,51,234,0.4); color:#c084fc; padding:2px 8px; border-radius:4px; font-size:.72rem; font-weight:700; cursor:pointer;">+ GPU</button>
                        <button type="button" onclick="insertSpecPreset('RAM', '32GB DDR5 5600MHz')" style="background:var(--adm-surface2); border:1px solid rgba(147,51,234,0.4); color:#c084fc; padding:2px 8px; border-radius:4px; font-size:.72rem; font-weight:700; cursor:pointer;">+ RAM</button>
                        <button type="button" onclick="insertSpecPreset('Storage', '2TB NVMe PCIe 4.0 SSD')" style="background:var(--adm-surface2); border:1px solid rgba(147,51,234,0.4); color:#c084fc; padding:2px 8px; border-radius:4px; font-size:.72rem; font-weight:700; cursor:pointer;">+ Storage</button>
                        <button type="button" onclick="insertSpecPreset('Connectivity', 'Wi-Fi 7 + Bluetooth 5.4 + USB4')" style="background:var(--adm-surface2); border:1px solid rgba(147,51,234,0.4); color:#c084fc; padding:2px 8px; border-radius:4px; font-size:.72rem; font-weight:700; cursor:pointer;">+ Wireless</button>
                        <button type="button" onclick="insertSpecPreset('Battery', '90Wh Quad-Cell Fast Charge')" style="background:var(--adm-surface2); border:1px solid rgba(147,51,234,0.4); color:#c084fc; padding:2px 8px; border-radius:4px; font-size:.72rem; font-weight:700; cursor:pointer;">+ Battery</button>
                    </div>

                    <textarea name="specs_raw" id="hardware-specs" rows="6"
                              placeholder="Display = 32&quot; 4K QD-OLED 240Hz 0.03ms&#10;Panel = 3rd Gen Samsung QD-OLED&#10;HDR = DisplayHDR True Black 400&#10;Connectivity = HDMI 2.1, DP 1.4, USB-C 90W PD&#10;Cooling = Custom Heatsink + Graphene Film"
                              style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#34d399; padding:.8rem 1rem; border-radius:6px; font-size:.85rem; font-family:monospace; line-height:1.7; resize:vertical; outline:none; transition:border-color .15s;"
                              onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'">{{ old('specs_raw') }}</textarea>
                </div>
            </div>

        </div>

        {{-- ── RIGHT COLUMN: SIDEBAR CONTROLS ───────────────────────── --}}
        <div style="display:flex; flex-direction:column; gap:1.4rem; position:sticky; top:72px;">

            {{-- Deploy Submit Action Button --}}
            <button type="submit" id="btn-deploy-main"
                    style="width:100%; background:linear-gradient(135deg, #e5001e 0%, #ff0055 100%); border:none; color:#fff; padding:1rem; border-radius:8px; font-family:'Orbitron',sans-serif; font-weight:900; font-size:.95rem; letter-spacing:.08em; cursor:pointer; box-shadow:0 0 20px rgba(229,0,30,0.5); transition:all .2s; display:flex; align-items:center; justify-content:center; gap:8px;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 0 30px rgba(229,0,30,0.7)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0 20px rgba(229,0,30,0.5)';">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                🚀 DEPLOY TO STOREFRONT
            </button>

            {{-- Image Asset Picker & Live Preview --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">
                        <span>🖼</span> Visual Asset
                    </span>
                </div>
                <div style="padding:1.2rem; display:flex; flex-direction:column; gap:1rem;">
                    
                    {{-- Live Visual Preview Box --}}
                    <div style="width:100%; height:160px; background:rgba(0,0,0,0.6); border:1.5px dashed rgba(147,51,234,0.4); border-radius:8px; display:flex; align-items:center; justify-content:center; overflow:hidden; position:relative; box-shadow:inset 0 0 20px rgba(0,0,0,0.5);">
                        <img id="imagePreview" src="{{ asset('images/product-fallback.svg') }}" alt="Preview"
                             style="max-width:90%; max-height:90%; object-fit:contain; transition:transform .3s;"
                             onerror="this.onerror=null; this.src='/images/product-fallback.svg';">
                    </div>

                    {{-- Image File Upload --}}
                    <div>
                        <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.08em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">
                            Upload Image File
                        </label>
                        <input type="file" name="image_file" id="image-file-input" accept="image/*"
                               style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.45rem .8rem; border-radius:6px; font-size:.8rem; outline:none;"
                               onchange="previewUploadedImage(this)">
                    </div>

                    {{-- Image URL / Path input --}}
                    <div>
                        <label style="display:block; font-size:.72rem; color:var(--adm-muted); text-transform:uppercase; letter-spacing:.08em; font-weight:800; margin-bottom:.35rem; font-family:'Orbitron',sans-serif;">
                            Or Image URL / Path
                        </label>
                        <input type="text" name="image" id="image-url-input" value="{{ old('image') }}"
                               placeholder="images/products/... or https://…"
                               style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:var(--adm-text); padding:.55rem .9rem; border-radius:6px; font-size:.82rem; outline:none; font-family:monospace; transition:border-color .15s;"
                               onfocus="this.style.borderColor='#e5001e'" onblur="this.style.borderColor='var(--adm-border)'"
                               oninput="previewImageUrl(this.value)">
                    </div>

                </div>
            </div>

            {{-- Inventory Reserve Management --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">
                        <span>📦</span> Initial Stock Units *
                    </span>
                </div>
                <div style="padding:1.2rem; display:flex; flex-direction:column; gap:.9rem;">
                    <div>
                        <input type="number" name="stock" id="hardware-stock" min="0" value="{{ old('stock', 25) }}" required
                               style="width:100%; background:var(--adm-surface2); border:1px solid var(--adm-border); color:#86efac; padding:.65rem 1rem; border-radius:6px; font-size:1.4rem; font-weight:900; text-align:center; outline:none; font-family:'Orbitron',sans-serif; text-shadow:0 0 10px rgba(34,197,94,0.4);">
                    </div>
                    
                    {{-- Quick Preset Buttons --}}
                    <div style="display:flex; gap:.4rem; flex-wrap:wrap; justify-content:center;">
                        @foreach([5, 10, 20, 35, 50, 100] as $q)
                        <button type="button" onclick="document.getElementById('hardware-stock').value={{ $q }};"
                                style="background:var(--adm-surface2); border:1px solid var(--adm-border); color:#fff; padding:.35rem .65rem; border-radius:4px; font-size:.78rem; cursor:pointer; font-family:'Orbitron',sans-serif; font-weight:700; transition:all .15s;"
                                onmouseover="this.style.borderColor='#e5001e'; this.style.color='#e5001e';"
                                onmouseout="this.style.borderColor='var(--adm-border)'; this.style.color='#fff';">
                            {{ $q }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Catalog Status & Visibility Toggles --}}
            <div class="adm-card">
                <div class="adm-card-header">
                    <span class="adm-card-title">
                        <span>🛡️</span> Catalog State
                    </span>
                </div>
                <div style="padding:1.2rem; display:flex; flex-direction:column; gap:.9rem;">
                    
                    {{-- Active in Storefront Toggle --}}
                    <label style="display:flex; align-items:center; justify-content:space-between; cursor:pointer; padding:.6rem .8rem; border:1px solid rgba(147,51,234,0.3); border-radius:6px; background:var(--adm-surface2);">
                        <div>
                            <div style="font-weight:800; font-size:.88rem; color:#fff;">Active in Catalog</div>
                            <div style="font-size:.72rem; color:var(--adm-muted);">Instantly visible to customers</div>
                        </div>
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                               style="width:18px; height:18px; accent-color:#22c55e; cursor:pointer;">
                    </label>

                    {{-- Featured on Home Page Toggle --}}
                    <label style="display:flex; align-items:center; justify-content:space-between; cursor:pointer; padding:.6rem .8rem; border:1px solid rgba(147,51,234,0.3); border-radius:6px; background:var(--adm-surface2);">
                        <div>
                            <div style="font-weight:800; font-size:.88rem; color:#fbbf24;">★ Featured Hardware</div>
                            <div style="font-size:.72rem; color:var(--adm-muted);">Highlight on homepage showcase</div>
                        </div>
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', '1') == '1' ? 'checked' : '' }}
                               style="width:18px; height:18px; accent-color:#e5001e; cursor:pointer;">
                    </label>

                </div>
            </div>

        </div>

    </div>
</form>

<script>
function handleNameInput(name) {
    const slugEl = document.getElementById('hardware-slug');
    if (slugEl) {
        slugEl.value = name.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-');
    }
}

function autoGenerateSku() {
    const name = document.getElementById('hardware-name').value;
    if (!name) {
        alert('Please enter a Hardware Model Name first.');
        return;
    }
    const words = name.toUpperCase().replace(/[^A-Z0-9\s]/g, '').trim().split(/\s+/);
    let sku = 'ROG-';
    words.slice(0, 3).forEach(w => {
        sku += w.substring(0, 4) + '-';
    });
    sku += '2026';
    document.getElementById('hardware-sku').value = sku;
}

function updateDiscountPreview() {
    const price = parseFloat(document.getElementById('create-price').value) || 0;
    const sale = parseFloat(document.getElementById('create-sale-price').value) || 0;
    const pill = document.getElementById('discountPill');
    const savingsEl = document.getElementById('savingsAmount');

    if (price > 0 && sale > 0 && sale < price) {
        const pct = Math.round((1 - (sale / price)) * 100);
        const save = (price - sale).toFixed(2);
        pill.textContent = `-${pct}% DISCOUNT`;
        pill.style.display = 'inline-block';
        savingsEl.innerHTML = `<span style="color:#e5001e;">-$${save}</span> <span style="font-size:.75rem; color:#94a3b8;">(${pct}% off)</span>`;
    } else {
        pill.style.display = 'none';
        savingsEl.textContent = 'No Discount';
    }
}

function insertSpecPreset(key, val) {
    const ta = document.getElementById('hardware-specs');
    const current = ta.value.trim();
    const line = `${key} = ${val}`;
    ta.value = current ? current + '\n' + line : line;
    ta.focus();
}

function previewImageUrl(val) {
    const preview = document.getElementById('imagePreview');
    if (!val) {
        preview.src = '{{ asset("images/product-fallback.svg") }}';
        return;
    }
    if (val.startsWith('http://') || val.startsWith('https://') || val.startsWith('/')) {
        preview.src = val;
    } else {
        preview.src = '{{ asset("") }}' + val.replace(/^\/+/, '');
    }
}

function previewUploadedImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Initial calculation
updateDiscountPreview();
</script>
@endsection
