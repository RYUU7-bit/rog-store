<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $sessionId = $this->getSessionId();
        $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(fn($item) => ($item->product->sale_price ?? $item->product->price) * $item->quantity);
        $tax = $subtotal * 0.08;
        $shipping = 0;
        $total = $subtotal + $tax;

        return view('checkout.index', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:10',
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer,bakong_khqr',
        ]);

        $sessionId = $this->getSessionId();
        $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Cart is empty.');
        }

        $subtotal = $cartItems->sum(fn($item) => ($item->product->sale_price ?? $item->product->price) * $item->quantity);
        $tax = $subtotal * 0.08;
        $shipping = 0;
        $total = $subtotal + $tax;

        // Create order FIRST — order number becomes QR ref for BAKONG
        $order = Order::create([
            'order_number'   => Order::generateOrderNumber(),
            'status'         => 'pending',
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            'shipping'       => $shipping,
            'total'          => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'city'           => $request->city,
            'state'          => $request->state,
            'zip_code'       => $request->zip_code,
            'country'        => $request->get('country', 'KH'),
            'notes'          => $request->notes,
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            $price = $item->product->sale_price ?? $item->product->price;
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item->product_id,
                'product_name' => $item->product->name,
                'price'        => $price,
                'quantity'     => $item->quantity,
                'total'        => $price * $item->quantity,
            ]);
        }

        // ══ If BAKONG KHQR, return JSON with order data → client opens modal ══════
        if ($request->payment_method === 'bakong_khqr') {
            return response()->json([
                'success'      => true,
                'show_bakong'  => true,
                'order_number' => $order->order_number,
                'amount'       => (float) number_format($total, 2, '.', ''),
            ]);
        }

        // ══ For other methods, mark paid immediately (demo mode) ═════════════════
        $order->update(['payment_status' => 'paid', 'status' => 'confirmed']);
        Cart::where('session_id', $sessionId)->delete();

        // Send Telegram notification
        try {
            (new TelegramService())->notifyNewOrder($order->load('items'));
        } catch (\Exception $e) {
            // Never fail order due to notification issues
        }

        return redirect()->route('checkout.success', $order->order_number);
    }

    /**
     * Confirm Bakong payment (called by modal after user confirms).
     */
    public function confirmBakong(Request $request)
    {
        $request->validate(['order_number' => 'required|string']);

        $order = Order::where('order_number', $request->order_number)->firstOrFail();

        if ($order->payment_status === 'paid') {
            return response()->json(['success' => true, 'already_paid' => true]);
        }

        // Mark paid
        $order->update(['payment_status' => 'paid', 'status' => 'confirmed']);

        // Clear cart
        $sessionId = $this->getSessionId();
        Cart::where('session_id', $sessionId)->delete();

        // Telegram
        try {
            (new TelegramService())->notifyNewOrder($order->load('items'));
        } catch (\Exception $e) {
            // Silent fail
        }

        return response()->json(['success' => true]);
    }

    public function success(string $orderNumber)
    {
        $order = Order::with('items.product')->where('order_number', $orderNumber)->firstOrFail();
        return view('checkout.success', compact('order'));
    }

    private function getSessionId(): string
    {
        if (!Session::has('cart_session_id')) {
            Session::put('cart_session_id', uniqid('cart_', true));
        }
        return Session::get('cart_session_id');
    }
}
