<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class RogSeeder extends Seeder
{
    // ─── Real ASUS CDN base URL ────────────────────────────────────────────────
    // Format: https://dlcdnwebimgs.asus.com/files/media/{GUID}/v1/img/...
    // Each GUID is scraped from the live ROG product page

    public function run(): void
    {
        $categories = [
            ['name' => 'Gaming Laptops',   'slug' => 'gaming-laptops',   'description' => 'High-performance ROG gaming laptops built for victory.'],
            ['name' => 'Gaming Monitors',  'slug' => 'gaming-monitors',  'description' => 'Ultra-fast ROG monitors with stunning visuals.'],
            ['name' => 'Gaming Keyboards', 'slug' => 'gaming-keyboards', 'description' => 'Mechanical keyboards engineered for speed and precision.'],
            ['name' => 'Gaming Mice',      'slug' => 'gaming-mice',      'description' => 'Precision gaming mice for pro-level performance.'],
            ['name' => 'Gaming Headsets',  'slug' => 'gaming-headsets',  'description' => 'Immersive audio headsets for competitive gaming.'],
            ['name' => 'Graphics Cards',   'slug' => 'graphics-cards',   'description' => 'ROG STRIX and TUF Gaming GPUs for maximum performance.'],
            ['name' => 'Motherboards',     'slug' => 'motherboards',     'description' => 'ROG and TUF Gaming motherboards for every build.'],
            ['name' => 'Gaming Chairs',    'slug' => 'gaming-chairs',    'description' => 'Ergonomic gaming chairs for long sessions.'],
        ];

        foreach ($categories as $cat) {
            Category::create(array_merge($cat, ['is_active' => true]));
        }

        $products = [

            // ── GAMING LAPTOPS ────────────────────────────────────────────────
            [
                'category_id' => 1,
                'name'        => 'ROG Zephyrus G16 (2024)',
                'slug'        => 'rog-zephyrus-g16-2024',
                'sku'         => 'ROG-ZG16-2024',
                'price'       => 2499.99,
                'sale_price'  => 2199.99,
                'stock'       => 15,
                'is_featured' => true,
                'short_description' => 'Ultra-slim powerhouse with Intel Core Ultra 9 & RTX 4090',
                'description' => 'The ROG Zephyrus G16 redefines what a thin gaming laptop can do. Powered by Intel Core Ultra 9 processor and NVIDIA GeForce RTX 4090, featuring a stunning 2.5K OLED 240Hz Nebula Display with G-SYNC. The MUX Switch with NVIDIA Advanced Optimus delivers maximum GPU performance. CNC-machined aluminum chassis, 0.59" thin, 4.30 lbs.',
                'specs' => ['CPU' => 'Intel Core Ultra 9 185H', 'GPU' => 'NVIDIA RTX 4090 Laptop GPU', 'RAM' => '32GB DDR5', 'Storage' => '2TB NVMe SSD', 'Display' => '16" 2.5K OLED 240Hz', 'Battery' => '90Wh'],
                // Official ASUS gallery CDN (ROG Zephyrus G16 2024 — front lid-open shot)
                'image' => 'https://dlcdnwebimgs.asus.com/gain/9E8B3BDF-4BB7-45CC-B7BE-F38810969B9A/w1000/h732',
            ],
            [
                'category_id' => 1,
                'name'        => 'ROG Strix SCAR 18 (2024)',
                'slug'        => 'rog-strix-scar-18-2024',
                'sku'         => 'ROG-SS18-2024',
                'price'       => 3499.99,
                'sale_price'  => null,
                'stock'       => 8,
                'is_featured' => true,
                'short_description' => 'Ultimate esports laptop with Intel Core i9 & RTX 4090 175W',
                'description' => 'ROG Strix SCAR 18 is the ultimate gaming weapon. Powered by Intel Core i9-14900HX and NVIDIA RTX 4090 with max 175W TGP, this 18-inch gaming laptop features an 18" 2.5K Nebula HDR Display with Mini LED, over 2000 dimming zones, Tri-Fan Technology, and Conductonaut Extreme liquid metal on CPU and GPU.',
                'specs' => ['CPU' => 'Intel Core i9-14900HX', 'GPU' => 'NVIDIA RTX 4090 175W', 'RAM' => '64GB DDR5', 'Storage' => '2x2TB NVMe SSD RAID 0', 'Display' => '18" 2.5K Mini LED 240Hz', 'Battery' => '90Wh'],
                // GUID: 621ECFA4-AFC8-4B9C-AC50-C7D8A292D62D (rog-strix-scar-18-2024 global page)
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/621ECFA4-AFC8-4B9C-AC50-C7D8A292D62D/v1/img-webp/performance/rog-strix-scar-16.webp',
            ],
            [
                'category_id' => 1,
                'name'        => 'ROG Flow X13 (2024)',
                'slug'        => 'rog-flow-x13-2024',
                'sku'         => 'ROG-FX13-2024',
                'price'       => 1799.99,
                'sale_price'  => 1599.99,
                'stock'       => 20,
                'is_featured' => false,
                'short_description' => 'Versatile 2-in-1 gaming laptop with RTX 4070',
                'description' => 'The ROG Flow X13 is a compact, versatile gaming laptop that converts into a tablet. With AMD Ryzen 9 and RTX 4070, it handles everything from work to play in a thin 13.4-inch 165Hz touch display form factor.',
                'specs' => ['CPU' => 'AMD Ryzen 9 8945HS', 'GPU' => 'NVIDIA RTX 4070 8GB', 'RAM' => '32GB LPDDR5', 'Storage' => '1TB NVMe SSD', 'Display' => '13.4" FHD 165Hz Touch', 'Battery' => '75Wh'],
                // Using SCAR 18 GUID for laptop image — different angle
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/621ECFA4-AFC8-4B9C-AC50-C7D8A292D62D/v1/img-webp/design/design-1.webp',
            ],

            // ── GAMING MONITORS ───────────────────────────────────────────────
            [
                'category_id' => 2,
                'name'        => 'ROG Swift OLED PG32UCDM',
                'slug'        => 'rog-swift-oled-pg32ucdm',
                'sku'         => 'ROG-PG32UCDM',
                'price'       => 1299.99,
                'sale_price'  => 1099.99,
                'stock'       => 25,
                'is_featured' => true,
                'short_description' => '32" 4K QD-OLED 240Hz Gaming Monitor',
                'description' => 'Experience gaming like never before with the ROG Swift OLED PG32UCDM. The 32-inch 4K QD-OLED panel delivers perfect blacks, 1,500,000:1 contrast ratio, and blazing fast 240Hz refresh rate with 0.03ms response time. Custom heatsink, graphene film, and ASUS OLED Care protect panel longevity.',
                'specs' => ['Panel' => 'QD-OLED', 'Resolution' => '3840x2160 (4K)', 'Refresh Rate' => '240Hz', 'Response Time' => '0.03ms GTG', 'HDR' => 'DisplayHDR True Black 400', 'Connectivity' => 'HDMI 2.1, DP 1.4, USB-C 90W'],
                // GUID: E185B23B-4B03-43EE-BFF1-2881D2338BB1 (pg32ucdm global page)
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/E185B23B-4B03-43EE-BFF1-2881D2338BB1/v1/img/kv/kv_cover.png',
            ],
            [
                'category_id' => 2,
                'name'        => 'ROG Swift 360Hz PG259QNR',
                'slug'        => 'rog-swift-360hz-pg259qnr',
                'sku'         => 'ROG-PG259QNR',
                'price'       => 799.99,
                'sale_price'  => 699.99,
                'stock'       => 30,
                'is_featured' => false,
                'short_description' => '24.5" FHD 360Hz Esports Monitor with G-SYNC',
                'description' => 'Dominate the competition with the ROG Swift 360Hz — the ultimate esports monitor. With 360Hz refresh rate and NVIDIA G-SYNC, this is the weapon of choice for pro players seeking the lowest possible latency.',
                'specs' => ['Panel' => 'IPS', 'Resolution' => '1920x1080 (FHD)', 'Refresh Rate' => '360Hz', 'Response Time' => '1ms GTG', 'G-Sync' => 'NVIDIA G-SYNC', 'Connectivity' => 'HDMI 2.0, DP 1.4'],
                // Using PG32UCDM product image — front view
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/E185B23B-4B03-43EE-BFF1-2881D2338BB1/v1/img/design/aesthetic.jpg',
            ],

            // ── GAMING KEYBOARDS ──────────────────────────────────────────────
            [
                'category_id' => 3,
                'name'        => 'ROG Falchion RX Low Profile',
                'slug'        => 'rog-falchion-rx-low-profile',
                'sku'         => 'ROG-FALCHION-RX',
                'price'       => 169.99,
                'sale_price'  => 149.99,
                'stock'       => 50,
                'is_featured' => true,
                'short_description' => 'Wireless 65% optical mechanical keyboard with ROG SpeedNova',
                'description' => 'The ROG Falchion RX Low Profile is a compact wireless 65% keyboard with ROG RX Low-Profile Optical switches and two dampening foams for unprecedented typing feel. Tri-mode connectivity via SpeedNova 2.4GHz, Bluetooth, or USB. ROG Omni Receiver. Interactive touch panel. 430+ hour battery life.',
                'specs' => ['Switch' => 'ROG RX Low-Profile Optical Red/Blue', 'Layout' => '65%', 'Connection' => '2.4GHz SpeedNova + Bluetooth + USB', 'Battery' => '430+ hrs (RGB off)', 'RGB' => 'Per-key Aura Sync', 'Polling Rate' => '1000Hz'],
                // GUID: A5D4599D-B512-4384-8A0B-AB3F6FBF5654 (falchion rx us page)
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/A5D4599D-B512-4384-8A0B-AB3F6FBF5654/v1/img/kv/main.jpg',
            ],
            [
                'category_id' => 3,
                'name'        => 'ROG Strix Scope II 96 Wireless',
                'slug'        => 'rog-strix-scope-ii-96-wireless',
                'sku'         => 'ROG-SCOPE2-96W',
                'price'       => 199.99,
                'sale_price'  => null,
                'stock'       => 35,
                'is_featured' => false,
                'short_description' => '96% wireless mechanical keyboard with ROG NX Snow switches',
                'description' => 'The ROG Strix Scope II 96 Wireless keeps the numpad while reducing footprint. Features ROG NX Snow switches with tactile feedback, tri-mode wireless connectivity, long battery life, streaming hotkeys, and a wrist rest.',
                'specs' => ['Switch' => 'ROG NX Snow', 'Layout' => '96%', 'Connection' => '2.4GHz + Bluetooth + USB', 'Battery' => 'Up to 2000hrs', 'RGB' => 'Aura Sync RGB', 'Polling Rate' => '1000Hz'],
                // Using Falchion RX GUID - aura sync image showing keyboard
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/A5D4599D-B512-4384-8A0B-AB3F6FBF5654/v1/img/armoury-crate/aura-sync.jpg',
            ],

            // ── GAMING MICE ───────────────────────────────────────────────────
            [
                'category_id' => 4,
                'name'        => 'ROG Harpe Ace Aim Lab Edition',
                'slug'        => 'rog-harpe-ace-aim-lab',
                'sku'         => 'ROG-HARPE-ACE',
                'price'       => 109.99,
                'sale_price'  => 0.10,
                'stock'       => 60,
                'is_featured' => true,
                'short_description' => '54g ultra-lightweight wireless esports mouse',
                'description' => 'The ROG Harpe Ace Aim Lab Edition is purpose-built for precision gaming. At just 54g, this ultra-lightweight mouse features the 36,000-dpi ROG AimPoint optical sensor, ROG SpeedNova wireless, Aim Lab Settings Optimizer for personalized settings, ROG Micro Switches, and tri-mode connectivity.',
                'specs' => ['Sensor' => 'ROG AimPoint Optical', 'DPI' => '100–36,000', 'Weight' => '54g', 'Connection' => '2.4GHz SpeedNova + Bluetooth + USB', 'Battery' => 'Up to 90hrs (2.4GHz)', 'Switches' => 'ROG Micro Switch 70M'],
                // GUID: E15AA0D3-A88E-4B0C-808E-480AF705AA2B (harpe ace us page)
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/E15AA0D3-A88E-4B0C-808E-480AF705AA2B/v1/img/customization/pd-front.png',
            ],
            [
                'category_id' => 4,
                'name'        => 'ROG Keris II Ace Wireless',
                'slug'        => 'rog-keris-ii-ace-wireless',
                'sku'         => 'ROG-KERIS2-ACE',
                'price'       => 149.99,
                'sale_price'  => null,
                'stock'       => 45,
                'is_featured' => false,
                'short_description' => 'Ergonomic wireless gaming mouse with ROG AimPoint Pro',
                'description' => 'The ROG Keris II Ace Wireless delivers elite precision with the 42,000-dpi ROG AimPoint Pro sensor. Its ergonomic shape fits perfectly in hand for extended gaming sessions, with ROG Optical Micro Switches and SpeedNova wireless at up to 8000Hz polling rate with Polling Rate Booster.',
                'specs' => ['Sensor' => 'ROG AimPoint Pro', 'DPI' => 'Up to 42,000', 'Weight' => '54g', 'Connection' => '2.4GHz + Bluetooth + USB', 'Battery' => 'Up to 150hrs', 'Switches' => 'ROG Optical Micro Switch'],
                // Using Harpe Ace GUID - different view
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/E15AA0D3-A88E-4B0C-808E-480AF705AA2B/v1/img/customization/pd-back.png',
            ],

            // ── GAMING HEADSETS ───────────────────────────────────────────────
            [
                'category_id' => 5,
                'name'        => 'ROG Delta S Wireless',
                'slug'        => 'rog-delta-s-wireless',
                'sku'         => 'ROG-DELTA-S-W',
                'price'       => 199.99,
                'sale_price'  => 169.99,
                'stock'       => 40,
                'is_featured' => true,
                'short_description' => 'Wireless gaming headset with AI Beamforming mic',
                'description' => 'The ROG Delta S Wireless delivers exceptional audio with AI-powered noise cancellation microphone. Its 50mm drivers deliver cinematic sound and the lightweight design ensures comfort during marathon sessions. USB-C 2.4GHz wireless with up to 25 hours battery life.',
                'specs' => ['Driver' => '50mm Neodymium', 'Frequency' => '20Hz-40,000Hz', 'Mic' => 'AI Beamforming + Cardioid', 'Connection' => '2.4GHz USB-C Wireless', 'Battery' => 'Up to 25hrs', 'Weight' => '347g'],
                // Using SCAR 18 audio section image
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/621ECFA4-AFC8-4B9C-AC50-C7D8A292D62D/v1/img-webp/audio/feature-2.webp',
            ],
            [
                'category_id' => 5,
                'name'        => 'ROG Cetra True Wireless Pro',
                'slug'        => 'rog-cetra-true-wireless-pro',
                'sku'         => 'ROG-CETRA-TWP',
                'price'       => 149.99,
                'sale_price'  => null,
                'stock'       => 55,
                'is_featured' => false,
                'short_description' => 'True wireless earbuds with ANC and gaming low-latency mode',
                'description' => 'ROG Cetra True Wireless Pro earbuds feature Active Noise Cancellation and a dedicated gaming mode with ultra-low 27ms latency. IPX5 water resistance keeps them safe during intense gameplay. Up to 27 hours total battery.',
                'specs' => ['Driver' => '10mm Dynamic', 'ANC' => 'Hybrid ANC', 'Latency' => '27ms Gaming Mode', 'Battery' => '27hrs total', 'Connection' => 'Bluetooth 5.2', 'Water Resistance' => 'IPX5'],
                // Using Harpe Ace grip tape image as placeholder for earbuds
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/E15AA0D3-A88E-4B0C-808E-480AF705AA2B/v1/img/features/rog-patterned-grip-tape.jpg',
            ],

            // ── GRAPHICS CARDS ────────────────────────────────────────────────
            [
                'category_id' => 6,
                'name'        => 'ROG STRIX GeForce RTX 4090 OC',
                'slug'        => 'rog-strix-rtx-4090-oc',
                'sku'         => 'ROG-RTX4090-OC',
                'price'       => 1999.99,
                'sale_price'  => null,
                'stock'       => 10,
                'is_featured' => true,
                'short_description' => '24GB GDDR6X — Ultimate 4K Gaming Performance',
                'description' => 'The ROG Strix GeForce RTX 4090 OC Edition is the pinnacle of gaming GPU technology. With 24GB of GDDR6X memory, NVIDIA Ada Lovelace architecture, 2640MHz boost clock, and Axial-tech fans with 23% more airflow, it delivers unmatched 4K gaming with ray tracing and DLSS 3.',
                'specs' => ['GPU' => 'NVIDIA RTX 4090', 'VRAM' => '24GB GDDR6X', 'Boost Clock' => '2640MHz OC / 2610MHz Gaming', 'TDP' => '450W', 'Outputs' => '3x DP 1.4a, 2x HDMI 2.1a', 'Cooling' => 'Triple Axial-tech 3.5-slot'],
                // GUID: 015AF38A-127E-4FA8-9700-6D92BB2760C1 (rog strix rtx 4090 us page)
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/015AF38A-127E-4FA8-9700-6D92BB2760C1/v2/img/kv/pd.png',
            ],
            [
                'category_id' => 6,
                'name'        => 'TUF Gaming GeForce RTX 4070 Ti SUPER',
                'slug'        => 'tuf-gaming-rtx-4070-ti-super',
                'sku'         => 'TUF-RTX4070TIS',
                'price'       => 799.99,
                'sale_price'  => 749.99,
                'stock'       => 18,
                'is_featured' => false,
                'short_description' => '16GB GDDR6X — Best 1440p Gaming GPU',
                'description' => 'The TUF Gaming RTX 4070 Ti SUPER offers incredible 1440p and 4K performance with 16GB of GDDR6X memory. Military-grade components ensure long-term reliability and its triple-fan design keeps temperatures low under sustained load.',
                'specs' => ['GPU' => 'NVIDIA RTX 4070 Ti SUPER', 'VRAM' => '16GB GDDR6X', 'Boost Clock' => '2670MHz', 'TDP' => '285W', 'Outputs' => '3x DP 1.4a, 1x HDMI 2.1', 'Cooling' => 'Triple-fan 2.7-slot'],
                // Using RTX 4090 GUID - back view
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/015AF38A-127E-4FA8-9700-6D92BB2760C1/v2/img/back/pd.png',
            ],

            // ── MOTHERBOARDS ──────────────────────────────────────────────────
            [
                'category_id' => 7,
                'name'        => 'ROG MAXIMUS Z790 APEX ENCORE',
                'slug'        => 'rog-maximus-z790-apex-encore',
                'sku'         => 'ROG-Z790-APEX',
                'price'       => 799.99,
                'sale_price'  => null,
                'stock'       => 12,
                'is_featured' => true,
                'short_description' => 'LGA1700 Z790 flagship overclocker motherboard',
                'description' => 'The ROG MAXIMUS Z790 APEX ENCORE is built for extreme overclocking. With a robust VRM design, DDR5 memory support, AI-powered overclocking features, and five M.2 NVMe slots, it pushes Intel 13th/14th Gen CPUs beyond their limits.',
                'specs' => ['Socket' => 'LGA1700', 'Chipset' => 'Intel Z790', 'Memory' => '2x DDR5 up to 192GB', 'PCIe' => 'PCIe 5.0 x16', 'Storage' => '5x M.2 NVMe', 'USB' => 'USB 3.2 Gen 2x2 20Gbps'],
                // Using SCAR 18 motherboard image as a stand-in for mobo
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/621ECFA4-AFC8-4B9C-AC50-C7D8A292D62D/v1/img-webp/performance/feature-2.webp',
            ],
            [
                'category_id' => 7,
                'name'        => 'ROG CROSSHAIR X670E HERO',
                'slug'        => 'rog-crosshair-x670e-hero',
                'sku'         => 'ROG-X670E-HERO',
                'price'       => 499.99,
                'sale_price'  => 449.99,
                'stock'       => 20,
                'is_featured' => false,
                'short_description' => 'AM5 X670E ATX motherboard for AMD Ryzen 7000',
                'description' => 'The ROG Crosshair X670E Hero provides the perfect foundation for AMD Ryzen 7000 Series processors with PCIe 5.0 support, DDR5 memory, four M.2 NVMe slots, USB 3.2 Gen 2x2, and comprehensive connectivity including 10G LAN and Wi-Fi 6E.',
                'specs' => ['Socket' => 'AM5', 'Chipset' => 'AMD X670E', 'Memory' => '4x DDR5 up to 192GB', 'PCIe' => 'PCIe 5.0 x16', 'Storage' => '4x M.2 NVMe', 'USB' => 'USB 3.2 Gen 2x2 20Gbps'],
                // Using RTX 4090 GUID - PCB component shot
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/015AF38A-127E-4FA8-9700-6D92BB2760C1/v2/img/fanconnect-ii.png',
            ],

            // ── GAMING CHAIRS ─────────────────────────────────────────────────
            [
                'category_id' => 8,
                'name'        => 'ROG Destrier Ergo Gaming Chair',
                'slug'        => 'rog-destrier-ergo-gaming-chair',
                'sku'         => 'ROG-DESTRIER-ERGO',
                'price'       => 699.99,
                'sale_price'  => 599.99,
                'stock'       => 22,
                'is_featured' => true,
                'short_description' => 'Aerospace-inspired exoskeleton ergonomic gaming chair',
                'description' => 'The ROG Destrier Ergo Gaming Chair features an aerospace-inspired exoskeleton design with adjustable armrests, lumbar support, and premium PU leather upholstery. Its unique open-back design improves ventilation for ultimate gaming comfort during marathon sessions.',
                'specs' => ['Max Weight' => '150kg', 'Material' => 'Premium PU Leather', 'Armrests' => '4D Adjustable', 'Tilt' => '-5° to +20°', 'Height Adjustment' => '5cm pneumatic', 'Base' => 'Aluminum Alloy 5-star'],
                // Using Zephyrus G16 bundle image which shows a chair/lifestyle
                'image' => 'https://dlcdnwebimgs.asus.com/files/media/AE97C70A-B57E-40F8-9FBA-87CE7F99428F/v1/images/medium/2x/bundle.webp',
            ],
        ];

        foreach ($products as $product) {
            $product['gallery']    = null;
            $product['is_active']  = true;
            if (!isset($product['is_featured'])) {
                $product['is_featured'] = false;
            }
            Product::create($product);
        }
    }
}
