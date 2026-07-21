<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $sessionId = $this->getSessionId();
        $cartItems = Cart::with('product.category')
            ->where('session_id', $sessionId)
            ->get();

        $subtotal = $cartItems->sum(fn($item) => ($item->product->sale_price ?? $item->product->price) * $item->quantity);
        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;

        return view('cart.index', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available');
        }

        $sessionId = $this->getSessionId();

        $cartItem = Cart::where('session_id', $sessionId)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Cannot add more than available stock');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'session_id' => $sessionId,
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        if ($request->quantity > $cart->product->stock) {
            return redirect()->back()->with('error', 'Not enough stock');
        }

        $cart->update(['quantity' => $request->quantity]);
        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove(Cart $cart)
    {
        $sessionId = $this->getSessionId();
        if ($cart->session_id === $sessionId) {
            $cart->delete();
        }
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        $sessionId = $this->getSessionId();
        Cart::where('session_id', $sessionId)->delete();
        return redirect()->route('cart')->with('success', 'Cart cleared.');
    }

    private function getSessionId(): string
    {
        if (!Session::has('cart_session_id')) {
            Session::put('cart_session_id', uniqid('cart_', true));
        }
        return Session::get('cart_session_id');
    }
}
