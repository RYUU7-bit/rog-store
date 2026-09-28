<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today     = Carbon::today();
        $yesterday = Carbon::yesterday();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // ── Today stats ────────────────────────────────────────────────────
        $todayOrders   = Order::whereDate('created_at', $today)->count();
        $todayRevenue  = Order::whereDate('created_at', $today)->sum('total');
        $todayNewCustomers = Order::whereDate('created_at', $today)
                                  ->distinct('email')->count('email');

        // ── Yesterday comparison ────────────────────────────────────────────
        $yesterdayOrders  = Order::whereDate('created_at', $yesterday)->count();
        $yesterdayRevenue = Order::whereDate('created_at', $yesterday)->sum('total');

        // ── This month ──────────────────────────────────────────────────────
        $monthOrders  = Order::where('created_at', '>=', $thisMonth)->count();
        $monthRevenue = Order::where('created_at', '>=', $thisMonth)->sum('total');

        // ── Total all-time ──────────────────────────────────────────────────
        $totalOrders  = Order::count();
        $totalRevenue = Order::sum('total');
        $totalProducts = Product::count();

        // ── Order status breakdown ──────────────────────────────────────────
        $statusBreakdown = Order::select('status', DB::raw('count(*) as count'))
                               ->groupBy('status')
                               ->pluck('count', 'status')
                               ->toArray();

        // ── Payment method breakdown ────────────────────────────────────────
        $paymentBreakdown = Order::select('payment_method', DB::raw('count(*) as count'))
                                ->groupBy('payment_method')
                                ->pluck('count', 'payment_method')
                                ->toArray();

        // ── Last 7 days chart data ──────────────────────────────────────────
        $last7Days = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);
            return [
                'date'    => $date->format('D'),
                'full'    => $date->format('M j'),
                'orders'  => Order::whereDate('created_at', $date)->count(),
                'revenue' => (float) Order::whereDate('created_at', $date)->sum('total'),
            ];
        });

        // ── Today's orders (full list) ──────────────────────────────────────
        $todayOrdersList = Order::with('items.product')
                               ->whereDate('created_at', $today)
                               ->latest()
                               ->get();

        // ── Recent orders (last 15) ─────────────────────────────────────────
        $recentOrders = Order::with('items.product')
                            ->latest()
                            ->take(15)
                            ->get();

        // ── Top selling products ────────────────────────────────────────────
        $topProducts = DB::table('order_items')
            ->select('product_name', DB::raw('SUM(quantity) as units'), DB::raw('SUM(total) as revenue'))
            ->groupBy('product_name')
            ->orderByDesc('units')
            ->take(5)
            ->get();

        // ── Low stock alert ─────────────────────────────────────────────────
        $lowStock = Product::where('stock', '<=', 5)->where('is_active', true)->orderBy('stock')->get();

        // ── % change helpers ────────────────────────────────────────────────
        $ordersChange  = $yesterdayOrders > 0
            ? round((($todayOrders - $yesterdayOrders) / $yesterdayOrders) * 100, 1)
            : ($todayOrders > 0 ? 100 : 0);
        $revenueChange = $yesterdayRevenue > 0
            ? round((($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100, 1)
            : ($todayRevenue > 0 ? 100 : 0);

        // ── Full Hardware Fleet for Instant Dashboard Management ─────────────
        $dashboardProducts = Product::with('category')->orderBy('category_id')->orderBy('name')->get();
        $categories        = Category::orderBy('name')->get();

        return view('admin.dashboard', compact(
            'todayOrders', 'todayRevenue', 'todayNewCustomers',
            'yesterdayOrders', 'yesterdayRevenue',
            'monthOrders', 'monthRevenue',
            'totalOrders', 'totalRevenue', 'totalProducts',
            'statusBreakdown', 'paymentBreakdown',
            'last7Days', 'todayOrdersList', 'recentOrders',
            'topProducts', 'lowStock',
            'ordersChange', 'revenueChange',
            'dashboardProducts', 'categories'
        ));
    }

    public function orders(Request $request)
    {
        $query = Order::with('items.product')->latest();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('order_number', 'like', "%$s%")
                  ->orWhere('first_name',  'like', "%$s%")
                  ->orWhere('last_name',   'like', "%$s%")
                  ->orWhere('email',       'like', "%$s%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $orders = $query->paginate(20)->withQueryString();

        return view('admin.orders', compact('orders'));
    }

    public function orderShow(Order $order)
    {
        $order->load('items.product');
        return view('admin.order-show', compact('order'));
    }

    public function orderStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated to ' . ucfirst($request->status));
    }

    // ── Product Management ──────────────────────────────────────────────────

    public function products(Request $request)
    {
        $query = Product::with('category')->orderBy('category_id')->orderBy('name');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('sku',  'like', "%$s%");
            });
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products   = $query->paginate(20)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products', compact('products', 'categories'));
    }

    public function productJson(Product $product)
    {
        $product->load('category');
        $specsString = '';
        if (is_array($product->specs)) {
            foreach ($product->specs as $k => $v) {
                $specsString .= "{$k}={$v}\n";
            }
        }
        return response()->json([
            'id'                => $product->id,
            'name'              => $product->name,
            'slug'              => $product->slug,
            'sku'               => $product->sku,
            'category_id'       => $product->category_id,
            'category_name'     => $product->category->name ?? '',
            'price'             => (float)$product->price,
            'sale_price'        => $product->sale_price ? (float)$product->sale_price : null,
            'discount_percent'  => $product->discount_percent,
            'stock'             => (int)$product->stock,
            'short_description' => $product->short_description ?? '',
            'description'       => $product->description ?? '',
            'raw_image'         => $product->getRawOriginal('image') ?? '',
            'image'             => $product->image,
            'specs_raw'         => trim($specsString),
            'is_featured'       => (bool)$product->is_featured,
            'is_active'         => (bool)$product->is_active,
            'edit_url'          => route('admin.products.edit', $product),
            'update_url'        => route('admin.products.update', $product),
            'shop_url'          => route('product.show', $product->slug),
        ]);
    }

    public function productCreate()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.product-create', compact('categories'));
    }

    public function productStore(Request $request)
    {
        // Auto-generate SKU if not provided
        if (!$request->filled('sku') && $request->filled('name')) {
            $words = preg_split('/[\s\-_]+/', strtoupper(trim($request->name)));
            $skuPrefix = 'ROG-';
            foreach (array_slice($words, 0, 3) as $w) {
                $clean = preg_replace('/[^A-Z0-9]/', '', $w);
                if (!empty($clean)) $skuPrefix .= substr($clean, 0, 4) . '-';
            }
            $skuPrefix = rtrim($skuPrefix, '-');
            $candidate = $skuPrefix;
            $c = 1;
            while (Product::where('sku', $candidate)->exists()) {
                $candidate = $skuPrefix . '-' . $c++;
            }
            $request->merge(['sku' => $candidate]);
        }

        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'sku'               => 'required|string|max:100|unique:products,sku',
            'category_id'       => 'required|exists:categories,id',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0|lt:price',
            'stock'             => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'image'             => 'nullable|string|max:500',
            'image_file'        => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:5120',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'slug'              => 'nullable|string|max:255|unique:products,slug',
        ]);

        if (empty($data['slug'])) {
            $baseSlug = \Illuminate\Support\Str::slug($data['name']);
            $slug = $baseSlug;
            $counter = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $data['slug'] = $slug;
        }

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('images/products'), $filename);
            $data['image'] = 'images/products/' . $filename;
        } elseif (empty($data['image'])) {
            $data['image'] = 'images/product-fallback.svg';
        }
        unset($data['image_file']);

        $data['is_featured'] = $request->boolean('is_featured', true);
        $data['is_active']   = $request->boolean('is_active', true);
        $data['sale_price']  = $request->filled('sale_price') ? $data['sale_price'] : null;

        if ($request->filled('specs_raw')) {
            $specs = [];
            foreach (explode("\n", trim($request->specs_raw)) as $line) {
                $parts = explode('=', $line, 2);
                if (count($parts) === 2 && trim($parts[0]) !== '') {
                    $specs[trim($parts[0])] = trim($parts[1]);
                }
            }
            $data['specs'] = $specs ?: null;
        }

        $product = Product::create($data);

        if ($request->ajax() || $request->wantsJson()) {
            $product->load('category');
            return response()->json([
                'success' => true,
                'message' => 'New Hardware "' . $product->name . '" successfully deployed to catalog!',
                'product' => [
                    'id'               => $product->id,
                    'name'             => $product->name,
                    'sku'              => $product->sku,
                    'slug'             => $product->slug,
                    'category_id'      => $product->category_id,
                    'category_name'    => $product->category->name ?? 'Hardware',
                    'price'            => (float)$product->price,
                    'sale_price'       => $product->sale_price ? (float)$product->sale_price : null,
                    'discount_percent' => $product->discount_percent,
                    'stock'            => (int)$product->stock,
                    'image'            => $product->image,
                    'is_active'        => (bool)$product->is_active,
                    'is_featured'      => (bool)$product->is_featured,
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Hardware SKU "' . $product->name . '" deployed successfully.');
    }

    public function productEdit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.product-edit', compact('product', 'categories'));
    }

    public function productUpdate(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'sku'               => 'required|string|max:100',
            'category_id'       => 'required|exists:categories,id',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0|lt:price',
            'stock'             => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'image'             => 'nullable|string|max:500',
            'image_file'        => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:5120',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
        ]);

        // Handle uploaded image file if present
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('images/products'), $filename);
            $data['image'] = 'images/products/' . $filename;
        }
        unset($data['image_file']);

        // Checkboxes are absent when unchecked
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');
        $data['sale_price']  = $request->filled('sale_price') ? $data['sale_price'] : null;

        // Handle specs (key=value textarea)
        if ($request->filled('specs_raw')) {
            $specs = [];
            foreach (explode("\n", trim($request->specs_raw)) as $line) {
                $parts = explode('=', $line, 2);
                if (count($parts) === 2 && trim($parts[0]) !== '') {
                    $specs[trim($parts[0])] = trim($parts[1]);
                }
            }
            $data['specs'] = $specs ?: null;
        }

        $product->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            $product->load('category');
            return response()->json([
                'success' => true,
                'message' => 'Hardware SKU "' . $product->name . '" updated successfully!',
                'product' => [
                    'id'               => $product->id,
                    'name'             => $product->name,
                    'sku'              => $product->sku,
                    'slug'             => $product->slug,
                    'category_id'      => $product->category_id,
                    'category_name'    => $product->category->name ?? 'Hardware',
                    'price'            => (float)$product->price,
                    'sale_price'       => $product->sale_price ? (float)$product->sale_price : null,
                    'discount_percent' => $product->discount_percent,
                    'stock'            => (int)$product->stock,
                    'image'            => $product->image,
                    'is_active'        => (bool)$product->is_active,
                    'is_featured'      => (bool)$product->is_featured,
                ]
            ]);
        }

        return redirect()->route('admin.products')
                         ->with('success', '"' . $product->name . '" updated successfully.');
    }

    public function productQuickStock(Request $request, Product $product)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);
        $product->update(['stock' => (int)$request->stock]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Stock updated to ' . $product->stock . ' units for ' . $product->name,
                'stock'   => $product->stock,
                'product' => $product,
            ]);
        }

        return back()->with('success', 'Stock updated to ' . $product->stock . ' units.');
    }

    public function productToggle(Request $request, Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'   => true,
                'is_active' => $product->is_active,
                'message'   => $product->name . ' is now ' . ($product->is_active ? 'Active' : 'Offline'),
            ]);
        }

        return back()->with('success', $product->name . ' is now ' . ($product->is_active ? 'active' : 'inactive') . '.');
    }

    public function productToggleFeatured(Request $request, Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'     => true,
                'is_featured' => $product->is_featured,
                'message'     => $product->name . ' is ' . ($product->is_featured ? 'marked as Featured' : 'removed from Featured'),
            ]);
        }

        return back()->with('success', $product->name . ' featured status toggled.');
    }

    public function productDestroy(Request $request, Product $product)
    {
        $name = $product->name;
        $hasOrders = DB::table('order_items')->where('product_id', $product->id)->exists();
        if ($hasOrders) {
            $product->update(['is_active' => false]);
            $msg = '"' . $name . '" has existing order history, so it was marked Offline in store catalog.';
        } else {
            $product->delete();
            $msg = '"' . $name . '" was permanently deleted from catalog.';
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'          => true,
                'message'          => $msg,
                'deactivated_only' => $hasOrders,
            ]);
        }

        return back()->with('success', $msg);
    }
}
