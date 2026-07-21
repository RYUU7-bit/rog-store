<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $sessionId = Session::get('cart_session_id', '');
            $cartCount = $sessionId
                ? Cart::where('session_id', $sessionId)->sum('quantity')
                : 0;

            $navCategories = Category::where('is_active', true)->get();

            $view->with('cartCount', $cartCount)
                 ->with('navCategories', $navCategories);
        });
    }
}
