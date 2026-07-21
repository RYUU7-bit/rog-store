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
        $todayOrdersList = Order::with('items')
                               ->whereDate('created_at', $today)
                               ->latest()
                               ->get();

        // ── Recent orders (last 15) ─────────────────────────────────────────
        $recentOrders = Order::with('items')
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

        return view('admin.dashboard', compact(
            'todayOrders', 'todayRevenue', 'todayNewCustomers',
            'yesterdayOrders', 'yesterdayRevenue',
            'monthOrders', 'monthRevenue',
            'totalOrders', 'totalRevenue', 'totalProducts',
            'statusBreakdown', 'paymentBreakdown',
            'last7Days', 'todayOrdersList', 'recentOrders',
            'topProducts', 'lowStock',
            'ordersChange', 'revenueChange'
        ));
    }

    public function orders(Request $request)
    {
        $query = Order::with('items')->latest();

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
            'image'             => 'nullable|url|max:500',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
        ]);

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

        return redirect()->route('admin.products')
                         ->with('success', '"' . $product->name . '" updated successfully.');
    }

    public function productToggle(Request $request, Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', $product->name . ' is now ' . ($product->is_active ? 'active' : 'inactive') . '.');
    }
}
