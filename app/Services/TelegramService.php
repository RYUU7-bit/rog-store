<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    private string $token;
    private string $chatId;

    public function __construct()
    {
        $this->token  = config('services.telegram.bot_token', '');
        $this->chatId = config('services.telegram.chat_id', '');
    }

    /**
     * Send a message to the configured Telegram chat.
     */
    public function send(string $message): bool
    {
        if (empty($this->token) || empty($this->chatId)) {
            return false;
        }

        try {
            $response = Http::timeout(8)->post(
                "https://api.telegram.org/bot{$this->token}/sendMessage",
                [
                    'chat_id'    => $this->chatId,
                    'text'       => $message,
                    'parse_mode' => 'HTML',
                ]
            );

            return $response->successful();
        } catch (\Exception $e) {
            Log::warning('Telegram notification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send a new order notification.
     */
    public function notifyNewOrder(\App\Models\Order $order): void
    {
        $items = $order->items->map(fn($i) =>
            "  • {$i->product_name} × {$i->quantity}  <b>\${$i->total}</b>"
        )->implode("\n");

        $paymentMethod = match($order->payment_method) {
            'bakong_khqr'  => '🏦 BAKONG KHQR',
            'credit_card'  => '💳 Credit Card',
            'paypal'       => '🔵 PayPal',
            'bank_transfer'=> '🏛 Bank Transfer',
            default        => $order->payment_method,
        };

        $message = "🛒 <b>NEW ORDER — ROG Store</b>\n"
            . "━━━━━━━━━━━━━━━━━━━━\n"
            . "📦 Order: <code>{$order->order_number}</code>\n"
            . "👤 Customer: <b>{$order->first_name} {$order->last_name}</b>\n"
            . "📧 Email: {$order->email}\n"
            . "📱 Phone: {$order->phone}\n"
            . "📍 City: {$order->city}, {$order->country}\n"
            . "━━━━━━━━━━━━━━━━━━━━\n"
            . "🛍 Items:\n{$items}\n"
            . "━━━━━━━━━━━━━━━━━━━━\n"
            . "💰 Subtotal: \${$order->subtotal}\n"
            . "🧾 Tax: \${$order->tax}\n"
            . "✅ <b>Total: \${$order->total}</b>\n"
            . "━━━━━━━━━━━━━━━━━━━━\n"
            . "💳 Payment: {$paymentMethod}\n"
            . "📊 Status: <b>" . strtoupper($order->status) . "</b>\n"
            . "🕐 Time: " . $order->created_at->format('d M Y H:i') . " UTC";

        $this->send($message);
    }
}
