<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount(['activeProducts'])
            ->get();

        $newArrivals = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        $saleProducts = Product::with('category')
            ->where('is_active', true)
            ->whereNotNull('sale_price')
            ->take(4)
            ->get();

        return view('home', compact('featuredProducts', 'categories', 'newArrivals', 'saleProducts'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
