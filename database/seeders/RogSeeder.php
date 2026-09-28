<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Carbon\Carbon;

class RogSeeder extends Seeder
{
    public function run(): void
    {
        // ── Disable foreign key checks to allow clean re-seeding ───────────
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        OrderItem::truncate();
        Order::truncate();
        Cart::truncate();
        Product::truncate();
        Category::truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ════════════════════════════════════════════════════════════════════
        // 1. USERS (Admin & Customers)
        // ════════════════════════════════════════════════════════════════════
        $adminUser = User::create([
            'name'              => 'ROG Administrator',
            'email'             => 'admin@rogstore.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ]);

        $users = [
            [
                'name'              => 'Kimhong Ngoun',
                'email'             => 'kimhong.ngoun@rogstore.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
            ],
            [
                'name'              => 'Dara Sok',
                'email'             => 'dara.sok@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
            ],
            [
                'name'              => 'Sarah Connor',
                'email'             => 'sarah.connor@gaming.io',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
            ],
            [
                'name'              => 'Alex Rivera',
                'email'             => 'alex.rivera@esports.net',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
            ],
            [
                'name'              => 'Sophea Meas',
                'email'             => 'sophea.meas@tech.kh',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
            ],
        ];

        $createdUsers = [$adminUser];
        foreach ($users as $u) {
            $createdUsers[] = User::create($u);
        }

        // ════════════════════════════════════════════════════════════════════
        // 2. CATEGORIES
        // ════════════════════════════════════════════════════════════════════
        $categoriesData = [
            ['name' => 'Gaming Laptops',   'slug' => 'gaming-laptops',   'description' => 'High-performance ROG gaming laptops built for victory with cutting-edge OLED displays and RTX 40-Series GPUs.'],
            ['name' => 'Gaming Monitors',  'slug' => 'gaming-monitors',  'description' => 'Ultra-fast ROG QD-OLED and high refresh rate gaming monitors with stunning color and near-instant response.'],
            ['name' => 'Gaming Keyboards', 'slug' => 'gaming-keyboards', 'description' => 'Mechanical and optical gaming keyboards engineered with ROG RX switches, hot-swap sockets, and OLED dashboards.'],
            ['name' => 'Gaming Mice',      'slug' => 'gaming-mice',      'description' => 'Ultra-lightweight esports gaming mice equipped with high-precision ROG AimPoint sensors.'],
            ['name' => 'Gaming Headsets',  'slug' => 'gaming-headsets',  'description' => 'High-fidelity audio headsets and true wireless earbuds with AI beamforming noise cancellation.'],
            ['name' => 'Graphics Cards',   'slug' => 'graphics-cards',   'description' => 'ROG STRIX and TUF Gaming graphics cards engineered for maximum overclocking and thermal mastery.'],
            ['name' => 'Motherboards',     'slug' => 'motherboards',     'description' => 'Flagship ROG MAXIMUS and CROSSHAIR motherboards with robust power stages and DDR5 memory support.'],
            ['name' => 'Gaming Chairs',    'slug' => 'gaming-chairs',    'description' => 'Ergonomic exoskeleton gaming chairs crafted for ultimate lumbar support and endurance.'],
            ['name' => 'Gaming Handhelds', 'slug' => 'gaming-handhelds', 'description' => 'Next-generation portable handheld gaming PCs powered by AMD Ryzen Z1 Extreme and Windows 11.'],
        ];

        $categoryMap = [];
        foreach ($categoriesData as $cat) {
            $created = Category::create(array_merge($cat, ['is_active' => true]));
            $categoryMap[$created->slug] = $created->id;
        }

        // ════════════════════════════════════════════════════════════════════
        // 3. PRODUCTS (Full ROG Lineup)
        // ════════════════════════════════════════════════════════════════════
        $productsData = [
            // ── Gaming Laptops ───────────────────────────────────────────────
            [
                'category_id'       => $categoryMap['gaming-laptops'],
                'name'              => 'ROG Zephyrus G16 (2024)',
                'slug'              => 'rog-zephyrus-g16-2024',
                'sku'               => 'ROG-ZG16-2024',
                'price'             => 2499.99,
                'sale_price'        => 2199.99,
                'stock'             => 15,
                'is_featured'       => true,
                'short_description' => 'Ultra-slim powerhouse with Intel Core Ultra 9 & RTX 4090',
                'description'       => 'The ROG Zephyrus G16 redefines what a thin gaming laptop can do. Powered by Intel Core Ultra 9 processor and NVIDIA GeForce RTX 4090, featuring a stunning 2.5K OLED 240Hz Nebula Display with G-SYNC. The MUX Switch with NVIDIA Advanced Optimus delivers maximum GPU performance. CNC-machined aluminum chassis, 0.59" thin, 4.30 lbs.',
                'specs'             => ['CPU' => 'Intel Core Ultra 9 185H', 'GPU' => 'NVIDIA RTX 4090 Laptop GPU 16GB', 'RAM' => '32GB DDR5', 'Storage' => '2TB NVMe PCIe 4.0 SSD', 'Display' => '16" 2.5K OLED 240Hz 0.2ms', 'Battery' => '90Wh Quad-Cell'],
                'image'             => 'images/products/rog-zephyrus-g16-2024.png',
            ],
            [
                'category_id'       => $categoryMap['gaming-laptops'],
                'name'              => 'ROG Strix SCAR 18 (2024)',
                'slug'              => 'rog-strix-scar-18-2024',
                'sku'               => 'ROG-SS18-2024',
                'price'             => 3499.99,
                'sale_price'        => null,
                'stock'             => 8,
                'is_featured'       => true,
                'short_description' => 'Ultimate esports laptop with Intel Core i9 & RTX 4090 175W',
                'description'       => 'ROG Strix SCAR 18 is the ultimate gaming weapon. Powered by Intel Core i9-14900HX and NVIDIA RTX 4090 with max 175W TGP, this 18-inch gaming laptop features an 18" 2.5K Nebula HDR Display with Mini LED, over 2000 dimming zones, Tri-Fan Technology, and Conductonaut Extreme liquid metal on CPU and GPU.',
                'specs'             => ['CPU' => 'Intel Core i9-14900HX 24-Core', 'GPU' => 'NVIDIA RTX 4090 175W TGP', 'RAM' => '64GB DDR5 5600MHz', 'Storage' => '2x 2TB NVMe SSD RAID 0', 'Display' => '18" 2.5K Mini LED 240Hz HDR 1100', 'Battery' => '90Wh'],
                'image'             => 'images/products/rog-strix-scar-18-2024.webp',
            ],
            [
                'category_id'       => $categoryMap['gaming-laptops'],
                'name'              => 'ROG Flow X13 (2024)',
                'slug'              => 'rog-flow-x13-2024',
                'sku'               => 'ROG-FX13-2024',
                'price'             => 1799.99,
                'sale_price'        => 1599.99,
                'stock'             => 20,
                'is_featured'       => false,
                'short_description' => 'Versatile 2-in-1 gaming convertible with AMD Ryzen 9 & RTX 4070',
                'description'       => 'The ROG Flow X13 is a compact, versatile gaming laptop that converts seamlessly into a tablet or tent mode. With AMD Ryzen 9 8945HS and RTX 4070, it handles everything from creative studio workflows to triple-A gaming in a featherweight 13.4-inch 165Hz touch chassis.',
                'specs'             => ['CPU' => 'AMD Ryzen 9 8945HS', 'GPU' => 'NVIDIA RTX 4070 8GB GDDR6', 'RAM' => '32GB LPDDR5X', 'Storage' => '1TB NVMe SSD', 'Display' => '13.4" QHD+ 165Hz Touchscreen', 'Battery' => '75Wh Fast Charge'],
                'image'             => 'images/products/rog-flow-x13-2024.jpg',
            ],
            [
                'category_id'       => $categoryMap['gaming-laptops'],
                'name'              => 'ROG Zephyrus G14 (2024)',
                'slug'              => 'rog-zephyrus-g14-2024',
                'sku'               => 'ROG-ZG14-2024',
                'price'             => 1999.99,
                'sale_price'        => 1799.99,
                'stock'             => 12,
                'is_featured'       => true,
                'short_description' => 'Compact 14" OLED gaming marvel with Slash Lighting',
                'description'       => 'Precision CNC aluminum chassis with gorgeous Slash Lighting. Equipped with AMD Ryzen 9 AI processor and RTX 4070 GPU, paired with a breathtaking 3K 120Hz OLED ROG Nebula Display.',
                'specs'             => ['CPU' => 'AMD Ryzen 9 8945HS AI', 'GPU' => 'NVIDIA RTX 4070 8GB', 'RAM' => '32GB LPDDR5X', 'Storage' => '1TB PCIe 4.0 SSD', 'Display' => '14" 3K (2880x1800) OLED 120Hz', 'Weight' => '1.50 kg'],
                'image'             => 'images/products/rog-zephyrus-g14-2024.png',
            ],
            [
                'category_id'       => $categoryMap['gaming-laptops'],
                'name'              => 'ROG Strix G16 (2024)',
                'slug'              => 'rog-strix-g16-2024',
                'sku'               => 'ROG-SG16-2024',
                'price'             => 1399.99,
                'sale_price'        => 1249.99,
                'stock'             => 25,
                'is_featured'       => false,
                'short_description' => 'High-octane esports performance with Intel Core i7 & RTX 4060',
                'description'       => 'Dominate the battlefield with the ROG Strix G16. Armed with a 14th Gen Intel Core i7 processor and NVIDIA GeForce RTX 4060 Laptop GPU, 165Hz ROG Nebula display, and Aura Sync ambient light bar.',
                'specs'             => ['CPU' => 'Intel Core i7-14650HX', 'GPU' => 'NVIDIA RTX 4060 8GB', 'RAM' => '16GB DDR5', 'Storage' => '1TB NVMe SSD', 'Display' => '16" FHD+ 165Hz 100% sRGB', 'Cooling' => 'Tri-Fan + Liquid Metal'],
                'image'             => 'images/products/rog-strix-g16-2024.jpg',
            ],

            // ── Gaming Monitors ──────────────────────────────────────────────
            [
                'category_id'       => $categoryMap['gaming-monitors'],
                'name'              => 'ROG Swift OLED PG32UCDM',
                'slug'              => 'rog-swift-oled-pg32ucdm',
                'sku'               => 'ROG-PG32UCDM',
                'price'             => 1299.99,
                'sale_price'        => 1099.99,
                'stock'             => 25,
                'is_featured'       => true,
                'short_description' => '32" 4K QD-OLED 240Hz Gaming Monitor with 0.03ms response',
                'description'       => 'Experience gaming like never before with the ROG Swift OLED PG32UCDM. The 32-inch 4K QD-OLED panel delivers perfect blacks, 1,500,000:1 contrast ratio, and blazing fast 240Hz refresh rate with 0.03ms response time. Custom heatsink, graphene film, and ASUS OLED Care protect panel longevity.',
                'specs'             => ['Panel' => '3rd Gen QD-OLED', 'Resolution' => '3840x2160 (4K UHD)', 'Refresh Rate' => '240Hz', 'Response Time' => '0.03ms GTG', 'HDR' => 'DisplayHDR True Black 400', 'Connectivity' => 'HDMI 2.1, DP 1.4, USB-C 90W PD'],
                'image'             => 'images/products/rog-swift-oled-pg32ucdm.png',
            ],
            [
                'category_id'       => $categoryMap['gaming-monitors'],
                'name'              => 'ROG Swift 360Hz PG259QNR',
                'slug'              => 'rog-swift-360hz-pg259qnr',
                'sku'               => 'ROG-PG259QNR',
                'price'             => 799.99,
                'sale_price'        => 699.99,
                'stock'             => 30,
                'is_featured'       => false,
                'short_description' => '24.5" FHD 360Hz Esports Monitor with NVIDIA Reflex Analyzer',
                'description'       => 'Dominate the competition with the ROG Swift 360Hz — the ultimate esports monitor. With 360Hz refresh rate and NVIDIA G-SYNC, this is the weapon of choice for pro players seeking the lowest possible latency and maximum motion clarity.',
                'specs'             => ['Panel' => 'Fast IPS', 'Resolution' => '1920x1080 (FHD)', 'Refresh Rate' => '360Hz', 'Response Time' => '1ms GTG', 'G-Sync' => 'NVIDIA G-SYNC + Reflex Analyzer', 'Connectivity' => 'HDMI 2.0, DP 1.4, USB 3.0'],
                'image'             => 'images/products/rog-swift-360hz-pg259qnr.jpg',
            ],
            [
                'category_id'       => $categoryMap['gaming-monitors'],
                'name'              => 'ROG Swift OLED PG27AQDM',
                'slug'              => 'rog-swift-oled-pg27aqdm',
                'sku'               => 'ROG-PG27AQDM',
                'price'             => 899.99,
                'sale_price'        => 799.99,
                'stock'             => 18,
                'is_featured'       => true,
                'short_description' => '27" 1440p OLED 240Hz 0.03ms Competitive Monitor',
                'description'       => 'The ROG Swift OLED PG27AQDM features a 27-inch 1440p OLED panel with 240Hz refresh rate and 0.03ms gray-to-gray response time, intelligent cooling heatsink, and anti-glare micro-texture coating.',
                'specs'             => ['Panel' => 'OLED', 'Resolution' => '2560x1440 (QHD)', 'Refresh Rate' => '240Hz', 'Response Time' => '0.03ms GTG', 'Color Gamut' => 'DCI-P3 99%', 'HDR' => 'HDR10 1000 nits peak'],
                'image'             => 'images/products/rog-swift-oled-pg27aqdm.jpg',
            ],

            // ── Gaming Keyboards ─────────────────────────────────────────────
            [
                'category_id'       => $categoryMap['gaming-keyboards'],
                'name'              => 'ROG Falchion RX Low Profile',
                'slug'              => 'rog-falchion-rx-low-profile',
                'sku'               => 'ROG-FALCHION-RX',
                'price'             => 169.99,
                'sale_price'        => 149.99,
                'stock'             => 50,
                'is_featured'       => true,
                'short_description' => 'Wireless 65% optical mechanical keyboard with ROG SpeedNova',
                'description'       => 'The ROG Falchion RX Low Profile is a compact wireless 65% keyboard with ROG RX Low-Profile Optical switches and two dampening foams for unprecedented typing feel. Tri-mode connectivity via SpeedNova 2.4GHz, Bluetooth, or USB. ROG Omni Receiver. Interactive touch panel. 430+ hour battery life.',
                'specs'             => ['Switch' => 'ROG RX Low-Profile Optical Red/Blue', 'Layout' => '65% Compact', 'Connection' => '2.4GHz SpeedNova + Bluetooth 5.1 + USB', 'Battery' => '430+ hrs (RGB off)', 'RGB' => 'Per-key Aura Sync', 'Polling Rate' => '1000Hz'],
                'image'             => 'images/products/rog-falchion-rx-low-profile.jpg',
            ],
            [
                'category_id'       => $categoryMap['gaming-keyboards'],
                'name'              => 'ROG Strix Scope II 96 Wireless',
                'slug'              => 'rog-strix-scope-ii-96-wireless',
                'sku'               => 'ROG-SCOPE2-96W',
                'price'             => 199.99,
                'sale_price'        => 179.99,
                'stock'             => 35,
                'is_featured'       => false,
                'short_description' => '96% wireless mechanical keyboard with ROG NX Snow switches',
                'description'       => 'The ROG Strix Scope II 96 Wireless keeps the numpad while reducing desktop footprint. Features pre-lubed ROG NX Snow linear switches, sound-dampening foam, multi-function wheel, and tri-mode wireless connectivity.',
                'specs'             => ['Switch' => 'ROG NX Snow Linear (Pre-lubed)', 'Layout' => '96% Full-Numpad', 'Connection' => '2.4GHz + Bluetooth + Type-C', 'Battery' => 'Up to 1500 hrs', 'RGB' => 'Aura Sync RGB', 'Accessories' => 'Magnetic Wrist Rest included'],
                'image'             => 'images/products/rog-strix-scope-ii-96-wireless.jpg',
            ],
            [
                'category_id'       => $categoryMap['gaming-keyboards'],
                'name'              => 'ROG Azoth Custom Gaming Keyboard',
                'slug'              => 'rog-azoth-wireless-custom',
                'sku'               => 'ROG-AZOTH-75',
                'price'             => 249.99,
                'sale_price'        => null,
                'stock'             => 20,
                'is_featured'       => true,
                'short_description' => '75% Gasket-mount wireless keyboard with OLED display & switch lube kit',
                'description'       => 'A custom mechanical keyboard disguised as a gaming keyboard. Gasket mount with three layers of dampening foams, hot-swappable ROG NX pre-lubed mechanical switches, built-in OLED display with 3-way control knob.',
                'specs'             => ['Mount' => 'Silicone Gasket Mount (3 Foam Layers)', 'Layout' => '75%', 'Display' => '2" Monochrome OLED Screen', 'Hot-Swap' => '5-Pin PCB Compatible', 'Connection' => 'Tri-Mode (2.4G/BT/USB)', 'Included' => 'Krytox GPL-205-GD0 Lube Kit'],
                'image'             => 'images/products/rog-azoth-wireless-custom.jpg',
            ],

            // ── Gaming Mice ──────────────────────────────────────────────────
            [
                'category_id'       => $categoryMap['gaming-mice'],
                'name'              => 'ROG Harpe Ace Aim Lab Edition',
                'slug'              => 'rog-harpe-ace-aim-lab',
                'sku'               => 'ROG-HARPE-ACE',
                'price'             => 109.99,
                'sale_price'        => 0.10,
                'stock'             => 60,
                'is_featured'       => true,
                'short_description' => '54g ultra-lightweight wireless esports mouse with 36,000 DPI',
                'description'       => 'The ROG Harpe Ace Aim Lab Edition is purpose-built for precision gaming. At just 54g, this ultra-lightweight mouse features the 36,000-dpi ROG AimPoint optical sensor, ROG SpeedNova wireless, Aim Lab Settings Optimizer for personalized settings, ROG Micro Switches, and tri-mode connectivity.',
                'specs'             => ['Sensor' => 'ROG AimPoint Optical', 'DPI' => '100–36,000 (1% CPI dev)', 'Weight' => '54 grams', 'Connection' => '2.4GHz SpeedNova + Bluetooth + USB', 'Battery' => 'Up to 90hrs (2.4GHz)', 'Switches' => 'ROG Micro Switch 70M Clicks'],
                'image'             => 'images/products/rog-harpe-ace-aim-lab.png',
            ],
            [
                'category_id'       => $categoryMap['gaming-mice'],
                'name'              => 'ROG Keris II Ace Wireless',
                'slug'              => 'rog-keris-ii-ace-wireless',
                'sku'               => 'ROG-KERIS2-ACE',
                'price'             => 149.99,
                'sale_price'        => 129.99,
                'stock'             => 45,
                'is_featured'       => false,
                'short_description' => '54g Ergonomic esports mouse with 42,000 DPI & 8000Hz polling rate',
                'description'       => 'The ROG Keris II Ace Wireless delivers elite precision with the 42,000-dpi ROG AimPoint Pro optical sensor. Ergonomic shape co-developed with pro esports athletes, ROG Optical Micro Switches, and up to 8000Hz wireless polling rate with ROG Polling Rate Booster.',
                'specs'             => ['Sensor' => 'ROG AimPoint Pro Optical', 'DPI' => 'Up to 42,000 DPI', 'Polling Rate' => 'Up to 8,000Hz Wireless', 'Weight' => '54g Ultra-Lightweight', 'Switches' => 'ROG Optical Micro Switches 100M', 'Battery' => 'Up to 107 hours'],
                'image'             => 'images/products/rog-keris-ii-ace-wireless.png',
            ],
            [
                'category_id'       => $categoryMap['gaming-mice'],
                'name'              => 'ROG Chakram X Origin',
                'slug'              => 'rog-chakram-x-origin',
                'sku'               => 'ROG-CHAKRAM-X',
                'price'             => 159.99,
                'sale_price'        => null,
                'stock'             => 28,
                'is_featured'       => false,
                'short_description' => 'Wireless gaming mouse with programmable joystick & 36K DPI',
                'description'       => 'The ROG Chakram X Origin is equipped with a 36,000-dpi ROG AimPoint sensor, 8000Hz polling rate, tri-mode connectivity, 11 programmable buttons, and an analog/digital joystick on the thumb rest.',
                'specs'             => ['Sensor' => 'ROG AimPoint 36,000 DPI', 'Joystick' => 'Detachable Analog & Digital Joystick', 'Buttons' => '11 Programmable Buttons', 'Connection' => 'Tri-Mode (RF 2.4G / BT / Wired)', 'Push-Fit' => 'Push-Fit Switch Socket II'],
                'image'             => 'images/products/rog-chakram-x-origin.jpg',
            ],

            // ── Gaming Headsets ──────────────────────────────────────────────
            [
                'category_id'       => $categoryMap['gaming-headsets'],
                'name'              => 'ROG Delta S Wireless',
                'slug'              => 'rog-delta-s-wireless',
                'sku'               => 'ROG-DELTA-S-W',
                'price'             => 199.99,
                'sale_price'        => 169.99,
                'stock'             => 40,
                'is_featured'       => true,
                'short_description' => 'Dual-mode wireless gaming headset with AI Beamforming microphones',
                'description'       => 'The ROG Delta S Wireless delivers exceptional audio with AI-powered noise cancellation microphones. 50mm ASUS Essence drivers deliver cinematic sound and ergonomic D-shaped ear cushions ensure fatigue-free comfort. Dual 2.4GHz and Bluetooth connectivity.',
                'specs'             => ['Driver' => '50mm Neodymium ASUS Essence', 'Frequency' => '20Hz - 20,000Hz', 'Microphones' => 'AI Beamforming with AI Noise Cancel', 'Wireless' => 'Low-Latency 2.4GHz + Bluetooth 5.0', 'Battery' => 'Up to 25 hours (Fast Charge 15m=3h)', 'Weight' => '318 grams'],
                'image'             => 'images/products/rog-delta-s-wireless.webp',
            ],
            [
                'category_id'       => $categoryMap['gaming-headsets'],
                'name'              => 'ROG Cetra True Wireless Pro',
                'slug'              => 'rog-cetra-true-wireless-pro',
                'sku'               => 'ROG-CETRA-TWP',
                'price'             => 149.99,
                'sale_price'        => 129.99,
                'stock'             => 55,
                'is_featured'       => false,
                'short_description' => 'True wireless earbuds with Hybrid ANC and 27ms ultra-low latency',
                'description'       => 'ROG Cetra True Wireless Pro earbuds feature Hybrid Active Noise Cancellation, ESS 9280 Quad DAC in wired mode, and a dedicated gaming mode with ultra-low 27ms latency. IPX5 water resistance with up to 28 hours total battery.',
                'specs'             => ['Driver' => '10mm ASUS Essence Neodymium', 'ANC' => 'Hybrid Active Noise Cancellation', 'Latency' => '27ms Ultra-Low Gaming Mode', 'Battery' => '28 hours total with USB-C case', 'Water Resistance' => 'IPX5 Splash-Proof', 'DAC' => 'ESS 9280 Quad DAC'],
                'image'             => 'images/products/rog-cetra-true-wireless-pro.webp',
            ],

            // ── Graphics Cards ───────────────────────────────────────────────
            [
                'category_id'       => $categoryMap['graphics-cards'],
                'name'              => 'ROG STRIX GeForce RTX 4090 OC',
                'slug'              => 'rog-strix-rtx-4090-oc',
                'sku'               => 'ROG-RTX4090-OC',
                'price'             => 1999.99,
                'sale_price'        => null,
                'stock'             => 10,
                'is_featured'       => true,
                'short_description' => '24GB GDDR6X — The Ultimate 8K & 4K Gaming GPU King',
                'description'       => 'The ROG Strix GeForce RTX 4090 OC Edition is the pinnacle of gaming GPU technology. With 24GB of GDDR6X memory, NVIDIA Ada Lovelace architecture, 2640MHz boost clock, and Axial-tech fans with 23% more airflow, it delivers unmatched 4K/8K gaming with full ray tracing and DLSS 3.5.',
                'specs'             => ['GPU' => 'NVIDIA GeForce RTX 4090 (Ada Lovelace)', 'VRAM' => '24GB GDDR6X 384-bit', 'Boost Clock' => '2640 MHz (OC Mode) / 2610 MHz (Default)', 'TDP' => '450W (Recommended 1000W PSU)', 'Cooling' => 'Patented Vapor Chamber + 3.5-Slot Axial-Tech', 'Aura Sync' => 'ARGB Front Ring & Edge Glow'],
                'image'             => 'images/products/rog-strix-rtx-4090-oc.png',
            ],
            [
                'category_id'       => $categoryMap['graphics-cards'],
                'name'              => 'TUF Gaming GeForce RTX 4070 Ti SUPER',
                'slug'              => 'tuf-gaming-rtx-4070-ti-super',
                'sku'               => 'TUF-RTX4070TIS',
                'price'             => 799.99,
                'sale_price'        => 749.99,
                'stock'             => 18,
                'is_featured'       => false,
                'short_description' => '16GB GDDR6X — Military-Grade Reliability & Top 1440p Power',
                'description'       => 'The TUF Gaming RTX 4070 Ti SUPER offers incredible 1440p and 4K performance with 16GB of GDDR6X memory. Military-grade 20K capacitors, vented exoskeleton frame, and dual-ball bearing fans ensure rock-solid stability.',
                'specs'             => ['GPU' => 'NVIDIA GeForce RTX 4070 Ti SUPER', 'VRAM' => '16GB GDDR6X 256-bit', 'Boost Clock' => '2670 MHz (OC Mode)', 'Power Connector' => '1x 16-pin 12VHPWR', 'Cooling' => 'Triple-Fan 2.7-Slot Armor', 'Durability' => 'Military-Grade 20K Capacitors'],
                'image'             => 'images/products/tuf-gaming-rtx-4070-ti-super.png',
            ],
            [
                'category_id'       => $categoryMap['graphics-cards'],
                'name'              => 'ROG Strix GeForce RTX 4080 SUPER OC',
                'slug'              => 'rog-strix-rtx-4080-super-oc',
                'sku'               => 'ROG-RTX4080S-OC',
                'price'             => 1249.99,
                'sale_price'        => 1179.99,
                'stock'             => 14,
                'is_featured'       => true,
                'short_description' => '16GB GDDR6X — Extreme 4K Gaming with 2670 MHz Boost Clock',
                'description'       => 'Unleash blistering frame rates with the ROG Strix GeForce RTX 4080 SUPER. Features custom die-cast shroud, metal backplate, vented frame, and 24-phase power delivery for unmatched overclocking headroom.',
                'specs'             => ['GPU' => 'NVIDIA RTX 4080 SUPER', 'VRAM' => '16GB GDDR6X', 'Boost Clock' => '2670 MHz (OC Mode)', 'CUDA Cores' => '10240', 'Outputs' => '2x HDMI 2.1a, 3x DisplayPort 1.4a', 'Slots' => '3.5-Slot'],
                'image'             => 'images/products/rog-strix-rtx-4080-super-oc.jpg',
            ],

            // ── Motherboards ─────────────────────────────────────────────────
            [
                'category_id'       => $categoryMap['motherboards'],
                'name'              => 'ROG MAXIMUS Z790 APEX ENCORE',
                'slug'              => 'rog-maximus-z790-apex-encore',
                'sku'               => 'ROG-Z790-APEX',
                'price'             => 799.99,
                'sale_price'        => null,
                'stock'             => 12,
                'is_featured'       => true,
                'short_description' => 'LGA1700 Z790 world-record breaking overclocking motherboard',
                'description'       => 'The ROG MAXIMUS Z790 APEX ENCORE is built for extreme overclockers and hardware enthusiasts. Featuring a 24-phase power delivery VRM, DDR5 memory support exceeding 8400+ MT/s, ROG DIMM.2 expander card, Wi-Fi 7, and full PCIe 5.0 support.',
                'specs'             => ['Socket' => 'Intel LGA1700 (14th/13th/12th Gen)', 'Chipset' => 'Intel Z790', 'VRM' => '24+0+2 Power Stages (105A)', 'Memory' => '2x DDR5 up to 8400+ MT/s (OC)', 'Storage' => '5x M.2 NVMe (PCIe 5.0 ready)', 'Wireless' => 'Intel Wi-Fi 7 + 2.5Gb LAN'],
                'image'             => 'images/products/rog-maximus-z790-apex-encore.jpg',
            ],
            [
                'category_id'       => $categoryMap['motherboards'],
                'name'              => 'ROG CROSSHAIR X670E HERO',
                'slug'              => 'rog-crosshair-x670e-hero',
                'sku'               => 'ROG-X670E-HERO',
                'price'             => 499.99,
                'sale_price'        => 449.99,
                'stock'             => 20,
                'is_featured'       => false,
                'short_description' => 'AM5 X670E flagship motherboard for AMD Ryzen 7000/8000/9000',
                'description'       => 'The ROG Crosshair X670E Hero provides the perfect powerhouse foundation for AMD Ryzen processors with PCIe 5.0 x16 slots, dual USB4 Type-C 40Gbps ports, five M.2 slots, and Polymo Lighting on the I/O cover.',
                'specs'             => ['Socket' => 'AMD Socket AM5', 'Chipset' => 'AMD X670E', 'VRM' => '18+2+2 Power Stages (110A)', 'Memory' => '4x DDR5 up to 192GB (AMD EXPO)', 'USB' => 'Dual USB4 40Gbps Type-C Ports', 'Audio' => 'ROG SupremeFX ALC4082 with ESS ES9218 DAC'],
                'image'             => 'images/products/rog-crosshair-x670e-hero.png',
            ],

            // ── Gaming Chairs ────────────────────────────────────────────────
            [
                'category_id'       => $categoryMap['gaming-chairs'],
                'name'              => 'ROG Destrier Ergo Gaming Chair',
                'slug'              => 'rog-destrier-ergo-gaming-chair',
                'sku'               => 'ROG-DESTRIER-ERGO',
                'price'             => 699.99,
                'sale_price'        => 599.99,
                'stock'             => 22,
                'is_featured'       => true,
                'short_description' => 'Cyborg-inspired exoskeleton ergonomic gaming chair with acoustic hood',
                'description'       => 'The ROG Destrier Ergo Gaming Chair features a cyborg-inspired exoskeleton structure with an acoustic elevation hood to block external distractions, 3D armrests with 14cm height elevation mode for mobile gaming, and breathable breathable mesh seating.',
                'specs'             => ['Frame' => 'Heavy-Duty Aluminum Alloy Exoskeleton', 'Acoustics' => 'Detachable Acoustic Elevation Hood', 'Armrests' => '3D Adjustable with 360-Degree Rotation', 'Seat' => 'Breathable High-Tension Mesh + PU Trim', 'Weight Limit' => 'Up to 150 kg (330 lbs)', 'Recline' => '90° - 135° with Multi-Position Lock'],
                'image'             => 'images/products/rog-destrier-ergo-gaming-chair.jpg',
            ],

            // ── Gaming Handhelds & Mobile ────────────────────────────────────
            [
                'category_id'       => $categoryMap['gaming-handhelds'],
                'name'              => 'ROG Ally X (2024)',
                'slug'              => 'rog-ally-x-2024',
                'sku'               => 'ROG-ALLY-X-2024',
                'price'             => 799.99,
                'sale_price'        => 749.99,
                'stock'             => 30,
                'is_featured'       => true,
                'short_description' => 'The ultimate Windows 11 handheld gaming PC with 80Wh battery & 24GB RAM',
                'description'       => 'Play all your PC games anywhere. The ROG Ally X upgrades the handheld experience with a massive 80Wh battery, 24GB high-speed LPDDR5X-7500 memory, 1TB M.2 2280 NVMe SSD, redesigned ergonomic grip handles, dual USB-C ports with USB4 support, and buttery-smooth 120Hz VRR FHD display.',
                'specs'             => ['Processor' => 'AMD Ryzen Z1 Extreme (8C/16T, 5.1GHz)', 'RAM' => '24GB LPDDR5X-7500 (Dual Channel)', 'Storage' => '1TB M.2 2280 PCIe 4.0 SSD', 'Display' => '7" FHD (1080p) 120Hz 100% sRGB FreeSync Premium', 'Battery' => '80Wh (Double the battery life)', 'Weight' => '678 grams with Ergonomic Grip'],
                'image'             => 'images/products/rog-ally-x-2024.jpg',
            ],
            [
                'category_id'       => $categoryMap['gaming-handhelds'],
                'name'              => 'ROG Phone 8 Pro Edition',
                'slug'              => 'rog-phone-8-pro-edition',
                'sku'               => 'ROG-PHONE8-PRO',
                'price'             => 1199.99,
                'sale_price'        => 1099.99,
                'stock'             => 24,
                'is_featured'       => true,
                'short_description' => 'Snapdragon 8 Gen 3 with 24GB RAM, 1TB Storage & AniMe Vision display',
                'description'       => 'Beyond gaming. Powered by Qualcomm Snapdragon 8 Gen 3 Mobile Platform with 24GB LPDDR5X RAM and 1TB UFS 4.0 storage. Features customizable 341 Mini-LED AniMe Vision rear display, 6.78-inch 165Hz LTPO AMOLED display with 2500 nits peak brightness, and gimbal-stabilized 50MP Sony IMX890 camera.',
                'specs'             => ['Processor' => 'Qualcomm Snapdragon 8 Gen 3 (3.3GHz)', 'RAM' => '24GB LPDDR5X', 'Storage' => '1TB UFS 4.0 ROM', 'Display' => '6.78" 165Hz Flexible Samsung AMOLED (2500 nits)', 'Rear Screen' => '341 Mini-LED AniMe Vision Matrix', 'Battery' => '5500mAh Dual-Cell (65W HyperCharge + 15W Qi)'],
                'image'             => 'images/products/rog-phone-8-pro.svg',
            ],

            // ── Expanded Hardware Lineup ──────────────────────────────────────
            [
                'category_id'       => $categoryMap['gaming-monitors'],
                'name'              => 'ROG Swift OLED PG49WCD',
                'slug'              => 'rog-swift-oled-pg49wcd',
                'sku'               => 'ROG-PG49WCD',
                'price'             => 1499.99,
                'sale_price'        => 1299.99,
                'stock'             => 14,
                'is_featured'       => true,
                'short_description' => '49" Super Ultra-Wide 32:9 144Hz 0.03ms QD-OLED Curved Monitor',
                'description'       => 'The ROG Swift OLED PG49WCD is a breathtaking 49-inch curved 1800R gaming monitor with QD-OLED panel, Dual QHD (5120 x 1440) resolution, 144Hz refresh rate, and near-instant 0.03ms GTG response time. Built-in Smart KVM lets you seamlessly switch between two PCs with one keyboard and mouse.',
                'specs'             => ['Panel' => '49" 32:9 Curved 1800R QD-OLED', 'Resolution' => '5120 x 1440 (Dual QHD)', 'Refresh Rate' => '144Hz', 'Response Time' => '0.03ms GTG', 'KVM' => 'ROG Smart KVM with USB-C 90W PD', 'Cooling' => 'Custom Heatsink + Graphene Film'],
                'image'             => 'images/products/rog-swift-oled-pg49wcd.svg',
            ],
            [
                'category_id'       => $categoryMap['graphics-cards'],
                'name'              => 'ROG Matrix Platinum RTX 4090 24GB',
                'slug'              => 'rog-matrix-platinum-rtx-4090',
                'sku'               => 'ROG-MATRIX-4090',
                'price'             => 3199.99,
                'sale_price'        => null,
                'stock'             => 6,
                'is_featured'       => true,
                'short_description' => 'Liquid metal thermal compound with 360mm AIO liquid cooling radiator',
                'description'       => 'The world-record breaking GPU king. The ROG Matrix GeForce RTX 4090 delivers the highest out-of-the-box boost clocks of any RTX 4090 in existence. Equipped with liquid metal thermal compound on the GPU die, a custom-engineered cold plate, magnetic daisy-chainable fans, and an integrated 360mm radiator.',
                'specs'             => ['GPU' => 'NVIDIA RTX 4090 (Ada Lovelace)', 'VRAM' => '24GB GDDR6X 384-bit', 'Boost Clock' => '2700 MHz (Highest Factory OC in World)', 'Cooling' => 'Liquid Metal + Custom 360mm AIO Radiator', 'Power' => '24-Phase Digital VRM + 12VHPWR', 'Chassis' => 'Full Metal Infinity Mirror Frame with Aura Sync'],
                'image'             => 'images/products/rog-matrix-rtx4090-platinum.svg',
            ],
            [
                'category_id'       => $categoryMap['motherboards'],
                'name'              => 'ROG Thor 1600T Titanium PSU',
                'slug'              => 'rog-thor-1600t-titanium-psu',
                'sku'               => 'ROG-THOR-1600T',
                'price'             => 649.99,
                'sale_price'        => 589.99,
                'stock'             => 16,
                'is_featured'       => false,
                'short_description' => '1600W 80 PLUS Titanium Power Supply with Live OLED Power Display',
                'description'       => 'Harness extreme, whisper-quiet power with the ROG Thor 1600W Titanium. Featuring GaN MOSFET power stages, 80 PLUS Titanium certification for 94%+ efficiency, built-in real-time OLED power meter, 135mm PWM Axial-tech fan, and PCIe 5.0 16-pin 600W native GPU power support.',
                'specs'             => ['Wattage' => '1600 Watts Continuous Output', 'Efficiency' => '80 PLUS Titanium Certified (Cybenetics Lambda A++)', 'OLED' => 'Real-Time Wattage Draw Power Display', 'Components' => '100% Japanese 105°C Capacitors + GaN FETs', 'PCIe 5.0' => 'Native PCIe Gen 5 12VHPWR 16-Pin Cable', 'Warranty' => '10-Year Global ROG Warranty'],
                'image'             => 'images/products/rog-thor-1600t-titanium.svg',
            ],
            [
                'category_id'       => $categoryMap['motherboards'],
                'name'              => 'ROG Ryujin III 360 ARGB Liquid Cooler',
                'slug'              => 'rog-ryujin-iii-360-argb-cooler',
                'sku'               => 'ROG-RYUJIN3-360',
                'price'             => 349.99,
                'sale_price'        => 319.99,
                'stock'             => 28,
                'is_featured'       => true,
                'short_description' => '360mm AIO liquid cooler with 3.5" full-color LCD display & 8th Gen Asetek pump',
                'description'       => 'The ultimate thermal weapon for flagship CPUs. The ROG Ryujin III 360 ARGB features a vibrant 3.5-inch LCD screen capable of displaying live system stats, animated GIFs, or custom wallpapers. Powered by 8th Gen Asetek pump with higher flow and lower impedance, plus an embedded VRM fan inside the pump housing.',
                'specs'             => ['Pump' => '8th Gen Asetek Pump (800 - 3600 RPM)', 'Display' => '3.5" Full-Color LCD (60Hz / 32MB Memory)', 'Radiator' => '360mm Aluminum Heavy-Fin Radiator', 'Fans' => '3x ROG Magnetic Daisy-Chainable 120mm ARGB', 'VRM Cooling' => 'Embedded 60mm Pump Housing Fan for Motherboard VRM', 'Compatibility' => 'Intel LGA1700/1851 & AMD AM5/AM4'],
                'image'             => 'images/products/rog-ryujin-iii-360-argb.svg',
            ],
            [
                'category_id'       => $categoryMap['gaming-keyboards'],
                'name'              => 'ROG Raikiri Pro Wireless Controller',
                'slug'              => 'rog-raikiri-pro-wireless-controller',
                'sku'               => 'ROG-RAIKIRI-PRO',
                'price'             => 169.99,
                'sale_price'        => 149.99,
                'stock'             => 35,
                'is_featured'       => false,
                'short_description' => 'Tri-mode wireless controller with built-in OLED display & ESS DAC',
                'description'       => 'Take supreme command of your PC and Xbox games. The ROG Raikiri Pro features a built-in OLED display for custom animations, status indicators, and profile switching. Tri-mode connectivity (2.4GHz RF, Bluetooth, USB-C), 4 rear programmable buttons, selectable step triggers, and built-in ESS DAC audio.',
                'specs'             => ['Display' => 'Built-in 1.3" Monochrome OLED Display', 'Connectivity' => 'Tri-Mode (2.4GHz RF, Bluetooth 5.0, USB-C)', 'Rear Buttons' => '4 Rear Ergonomic Programmable Buttons', 'Triggers' => 'Selectable Short / Full Step Impulse Triggers', 'Audio' => 'Built-in ESS 9281 DAC + 3.5mm Headphone Jack', 'Battery' => 'Up to 48 Hours with OLED On'],
                'image'             => 'images/products/rog-raikiri-pro.svg',
            ],
            [
                'category_id'       => $categoryMap['gaming-headsets'],
                'name'              => 'ROG Delta S Animate Gaming Headset',
                'slug'              => 'rog-delta-s-animate-headset',
                'sku'               => 'ROG-DELTA-S-ANIM',
                'price'             => 249.99,
                'sale_price'        => 219.99,
                'stock'             => 22,
                'is_featured'       => false,
                'short_description' => 'Customizable AniMe Matrix displays with ESS 9281 Quad DAC & MQA support',
                'description'       => 'Express your gaming identity with cutting-edge style. The ROG Delta S Animate features customizable AniMe Matrix displays on each earcup, industry-leading hi-fi ESS 9281 Quad DAC with master quality authenticated (MQA) support, ASUS AI Noise-Canceling Microphone, and ergonomic D-shaped earcups.',
                'specs'             => ['DAC' => 'Hi-Res ESS 9281 Quad DAC + MQA Renderer', 'Earcups' => 'Customizable Dual AniMe Matrix Mini-LED Displays', 'Drivers' => '50mm Neodymium ASUS Essence Drivers', 'Microphone' => 'ASUS AI Noise-Canceling Detachable Mic', 'Connector' => 'USB-C (Includes USB-A adapter)', 'Weight' => '310 grams Lightweight Comfort'],
                'image'             => 'images/products/rog-delta-s-animate.svg',
            ],
            [
                'category_id'       => $categoryMap['gaming-mice'],
                'name'              => 'ROG Moonstone Ace L Glass Pad',
                'slug'              => 'rog-moonstone-ace-l-glass-pad',
                'sku'               => 'ROG-MOONSTONE-L',
                'price'             => 99.99,
                'sale_price'        => 89.99,
                'stock'             => 40,
                'is_featured'       => false,
                'short_description' => 'Premium 9H tempered glass gaming surface with ultra-fast speed glide',
                'description'       => 'The ROG Moonstone Ace L is crafted from first-rate 9H tempered glass with a special low-friction surface treatment for lightning-quick mouse glides and zero noise. Full-coverage silicone base prevents slipping during aggressive esports flicks. Impact and scratch resistant.',
                'specs'             => ['Material' => '9H Impact-Resistant Tempered Glass', 'Surface' => 'Ultra-Low Friction Glass Glide Surface', 'Dimensions' => '500 x 400 x 4 mm (Large Size)', 'Base' => 'Full Silicone Anti-Slip Foundation', 'Maintenance' => 'Waterproof, Dirt-Resistant & Easy Clean', 'Edges' => 'Smooth Beveled Chamfered Edges'],
                'image'             => 'images/products/rog-moonstone-ace-l.svg',
            ],
        ];

        $createdProducts = [];
        foreach ($productsData as $product) {
            $product['gallery']   = null;
            $product['is_active'] = true;
            $createdProducts[] = Product::create($product);
        }

        // ════════════════════════════════════════════════════════════════════
        // 4. ORDERS & ORDER ITEMS (Rich Analytics & Demo Records)
        // ════════════════════════════════════════════════════════════════════
        $now = Carbon::now();
        $sampleOrders = [
            // Today's orders
            [
                'user_id'        => $createdUsers[1]->id,
                'order_number'   => 'ROG-' . $now->format('Ymd') . '-001',
                'status'         => 'completed',
                'payment_method' => 'bakong_khqr',
                'payment_status' => 'paid',
                'first_name'     => 'Kimhong',
                'last_name'      => 'Ngoun',
                'email'          => 'kimhong.ngoun@rogstore.com',
                'phone'          => '+855 12 345 678',
                'address'        => 'No. 128, Preah Norodom Blvd, Sangkat Tonle Bassac',
                'city'           => 'Phnom Penh',
                'state'          => 'Chamkarmon',
                'zip_code'       => '12301',
                'country'        => 'KH',
                'notes'          => 'Please deliver before 5PM. Call upon arrival.',
                'created_at'     => $now->copy()->subHours(2),
                'items'          => [
                    ['product_idx' => 0, 'quantity' => 1], // Zephyrus G16
                    ['product_idx' => 11, 'quantity' => 1], // Harpe Ace
                ]
            ],
            [
                'user_id'        => $createdUsers[2]->id,
                'order_number'   => 'ROG-' . $now->format('Ymd') . '-002',
                'status'         => 'processing',
                'payment_method' => 'bakong_khqr',
                'payment_status' => 'paid',
                'first_name'     => 'Dara',
                'last_name'      => 'Sok',
                'email'          => 'dara.sok@gmail.com',
                'phone'          => '+855 98 765 432',
                'address'        => 'St. 2004, Sen Sok District',
                'city'           => 'Phnom Penh',
                'state'          => 'Sen Sok',
                'zip_code'       => '12080',
                'country'        => 'KH',
                'notes'          => 'Handle with care: OLED monitor.',
                'created_at'     => $now->copy()->subHours(4),
                'items'          => [
                    ['product_idx' => 5, 'quantity' => 1], // PG32UCDM OLED
                ]
            ],
            [
                'user_id'        => $createdUsers[3]->id,
                'order_number'   => 'ROG-' . $now->format('Ymd') . '-003',
                'status'         => 'paid_bakong',
                'payment_method' => 'bakong_khqr',
                'payment_status' => 'paid',
                'first_name'     => 'Sarah',
                'last_name'      => 'Connor',
                'email'          => 'sarah.connor@gaming.io',
                'phone'          => '+1 (415) 890-1234',
                'address'        => '742 Cyberdyne Way, Silicon Valley',
                'city'           => 'San Jose',
                'state'          => 'California',
                'zip_code'       => '95134',
                'country'        => 'US',
                'notes'          => 'Express delivery requested.',
                'created_at'     => $now->copy()->subHours(6),
                'items'          => [
                    ['product_idx' => 22, 'quantity' => 1], // ROG Ally X
                    ['product_idx' => 8, 'quantity' => 1],  // Falchion RX
                ]
            ],

            // Yesterday's orders
            [
                'user_id'        => $createdUsers[4]->id,
                'order_number'   => 'ROG-' . $now->copy()->subDay()->format('Ymd') . '-004',
                'status'         => 'completed',
                'payment_method' => 'credit_card',
                'payment_status' => 'paid',
                'first_name'     => 'Alex',
                'last_name'      => 'Rivera',
                'email'          => 'alex.rivera@esports.net',
                'phone'          => '+1 (310) 555-0199',
                'address'        => '450 Sunset Blvd, Suite 800',
                'city'           => 'Los Angeles',
                'state'          => 'California',
                'zip_code'       => '90028',
                'country'        => 'US',
                'notes'          => 'Leave at the front reception desk.',
                'created_at'     => $now->copy()->subDay()->setHour(14),
                'items'          => [
                    ['product_idx' => 16, 'quantity' => 1], // RTX 4090 OC
                    ['product_idx' => 19, 'quantity' => 1], // Z790 Apex
                ]
            ],
            [
                'user_id'        => $createdUsers[5]->id,
                'order_number'   => 'ROG-' . $now->copy()->subDay()->format('Ymd') . '-005',
                'status'         => 'completed',
                'payment_method' => 'cash_on_delivery',
                'payment_status' => 'paid',
                'first_name'     => 'Sophea',
                'last_name'      => 'Meas',
                'email'          => 'sophea.meas@tech.kh',
                'phone'          => '+855 11 223 344',
                'address'        => 'Wat Bo Village, Sala Kamreuk',
                'city'           => 'Siem Reap',
                'state'          => 'Siem Reap',
                'zip_code'       => '17254',
                'country'        => 'KH',
                'notes'          => 'Cash ready upon delivery.',
                'created_at'     => $now->copy()->subDay()->setHour(16),
                'items'          => [
                    ['product_idx' => 14, 'quantity' => 1], // Delta S Wireless Headset
                    ['product_idx' => 12, 'quantity' => 1], // Keris II Ace Mouse
                ]
            ],

            // 2-6 days ago (for weekly analytics charts)
            [
                'user_id'        => null,
                'order_number'   => 'ROG-' . $now->copy()->subDays(2)->format('Ymd') . '-006',
                'status'         => 'completed',
                'payment_method' => 'bakong_khqr',
                'payment_status' => 'paid',
                'first_name'     => 'Vireak',
                'last_name'      => 'Chhay',
                'email'          => 'vireak.chhay@khmerplay.com',
                'phone'          => '+855 77 889 900',
                'address'        => 'Toul Kork Avenue 315',
                'city'           => 'Phnom Penh',
                'state'          => 'Toul Kork',
                'zip_code'       => '12151',
                'country'        => 'KH',
                'notes'          => null,
                'created_at'     => $now->copy()->subDays(2)->setHour(11),
                'items'          => [
                    ['product_idx' => 1, 'quantity' => 1], // SCAR 18
                ]
            ],
            [
                'user_id'        => null,
                'order_number'   => 'ROG-' . $now->copy()->subDays(3)->format('Ymd') . '-007',
                'status'         => 'completed',
                'payment_method' => 'credit_card',
                'payment_status' => 'paid',
                'first_name'     => 'Kenji',
                'last_name'      => 'Sato',
                'email'          => 'kenji.sato@akihabara.jp',
                'phone'          => '+81 90 1234 5678',
                'address'        => 'Chiyoda-ku, Sotokanda 4-chome',
                'city'           => 'Tokyo',
                'state'          => 'Tokyo',
                'zip_code'       => '101-0021',
                'country'        => 'JP',
                'notes'          => 'Fragile esports gear.',
                'created_at'     => $now->copy()->subDays(3)->setHour(18),
                'items'          => [
                    ['product_idx' => 10, 'quantity' => 1], // Azoth Keyboard
                    ['product_idx' => 11, 'quantity' => 2], // Harpe Ace Mice
                ]
            ],
            [
                'user_id'        => $createdUsers[1]->id,
                'order_number'   => 'ROG-' . $now->copy()->subDays(4)->format('Ymd') . '-008',
                'status'         => 'completed',
                'payment_method' => 'bakong_khqr',
                'payment_status' => 'paid',
                'first_name'     => 'Kimhong',
                'last_name'      => 'Ngoun',
                'email'          => 'kimhong.ngoun@rogstore.com',
                'phone'          => '+855 12 345 678',
                'address'        => 'No. 128, Preah Norodom Blvd',
                'city'           => 'Phnom Penh',
                'state'          => 'Chamkarmon',
                'zip_code'       => '12301',
                'country'        => 'KH',
                'notes'          => 'Destrier Gaming Chair order',
                'created_at'     => $now->copy()->subDays(4)->setHour(9),
                'items'          => [
                    ['product_idx' => 21, 'quantity' => 1], // Destrier Chair
                ]
            ],
            [
                'user_id'        => null,
                'order_number'   => 'ROG-' . $now->copy()->subDays(5)->format('Ymd') . '-009',
                'status'         => 'completed',
                'payment_method' => 'credit_card',
                'payment_status' => 'paid',
                'first_name'     => 'Marcus',
                'last_name'      => 'Brody',
                'email'          => 'marcus.brody@nytech.com',
                'phone'          => '+1 (212) 555-8822',
                'address'        => '5th Avenue & 57th Street',
                'city'           => 'New York',
                'state'          => 'New York',
                'zip_code'       => '10022',
                'country'        => 'US',
                'notes'          => 'Apartment 14B',
                'created_at'     => $now->copy()->subDays(5)->setHour(15),
                'items'          => [
                    ['product_idx' => 18, 'quantity' => 1], // RTX 4080 Super
                ]
            ],
            [
                'user_id'        => $createdUsers[2]->id,
                'order_number'   => 'ROG-' . $now->copy()->subDays(6)->format('Ymd') . '-010',
                'status'         => 'completed',
                'payment_method' => 'bakong_khqr',
                'payment_status' => 'paid',
                'first_name'     => 'Dara',
                'last_name'      => 'Sok',
                'email'          => 'dara.sok@gmail.com',
                'phone'          => '+855 98 765 432',
                'address'        => 'St. 2004, Sen Sok District',
                'city'           => 'Phnom Penh',
                'state'          => 'Sen Sok',
                'zip_code'       => '12080',
                'country'        => 'KH',
                'notes'          => null,
                'created_at'     => $now->copy()->subDays(6)->setHour(10),
                'items'          => [
                    ['product_idx' => 3, 'quantity' => 1], // Zephyrus G14
                ]
            ],
        ];

        foreach ($sampleOrders as $orderData) {
            $items = $orderData['items'];
            unset($orderData['items']);

            $subtotal = 0;
            $itemsToCreate = [];

            foreach ($items as $item) {
                $product = $createdProducts[$item['product_idx']] ?? $createdProducts[0];
                $price = $product->sale_price ?? $product->price;
                $lineTotal = $price * $item['quantity'];
                $subtotal += $lineTotal;

                $itemsToCreate[] = [
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'price'        => $price,
                    'quantity'     => $item['quantity'],
                    'total'        => $lineTotal,
                ];
            }

            $tax = 0.00;
            $shipping = 0.00;
            $total = $subtotal + $tax + $shipping;

            $orderData['subtotal'] = $subtotal;
            $orderData['tax']      = $tax;
            $orderData['shipping'] = $shipping;
            $orderData['total']    = $total;

            $createdAt = $orderData['created_at'];
            $order = Order::create($orderData);
            $order->created_at = $createdAt;
            $order->updated_at = $createdAt;
            $order->save(['timestamps' => false]);

            foreach ($itemsToCreate as $item) {
                $item['order_id']   = $order->id;
                $item['created_at'] = $createdAt;
                $item['updated_at'] = $createdAt;
                OrderItem::create($item);
            }
        }

        // ════════════════════════════════════════════════════════════════════
        // 5. SAMPLE ACTIVE CARTS (For Cart Demonstration)
        // ════════════════════════════════════════════════════════════════════
        Cart::create([
            'session_id' => 'guest_demo_session_123',
            'product_id' => $createdProducts[0]->id, // Zephyrus G16
            'quantity'   => 1,
        ]);
        Cart::create([
            'session_id' => 'guest_demo_session_123',
            'product_id' => $createdProducts[11]->id, // Harpe Ace
            'quantity'   => 1,
        ]);
    }
}
