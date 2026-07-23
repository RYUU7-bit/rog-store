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

        $order = Order::create([
            'order_number'   => Order::generateOrderNumber(),
            'status'         => 'confirmed',
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            'shipping'       => $shipping,
            'total'          => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid',
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

        Cart::where('session_id', $sessionId)->delete();

        // Send Telegram notification
        try {
            (new TelegramService())->notifyNewOrder($order->load('items'));
        } catch (\Exception $e) {
            // Never fail the order because of notification issues
        }

        return redirect()->route('checkout.success', $order->order_number);
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
