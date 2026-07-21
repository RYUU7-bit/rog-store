<?php

namespace App\Http\Controllers;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BakongController extends Controller
{
    /**
     * Generate a BAKONG KHQR QR code using the official bakong-khqr Python library.
     * POST /bakong/generate
     */
    public function generate(Request $request)
    {
        $request->validate([
            'amount'    => 'required|numeric|min:0.01',
            'currency'  => 'in:USD,KHR',
            'order_ref' => 'nullable|string|max:64',
        ]);

        $amount    = round((float) $request->amount, 2);
        $currency  = $request->get('currency', 'USD');
        $orderRef  = $request->get('order_ref', 'ROG-' . strtoupper(Str::random(8)));

        // ── Call Python bakong-khqr library via temp file ───────────────────
        $params = json_encode([
            'token'         => config('services.bakong.token'),
            'account_id'    => config('services.bakong.account_id'),
            'merchant_name' => config('services.bakong.merchant_name'),
            'merchant_city' => config('services.bakong.merchant_city'),
            'amount'        => $amount,
            'currency'      => $currency,
            'bill_number'   => $orderRef,
            'store_label'   => 'ROG Store',
            'terminal_label'=> 'online',
        ]);

        $scriptPath = base_path('scripts/bakong_generate.py');
        $tmpFile    = tempnam(sys_get_temp_dir(), 'bakong_') . '.json';
        file_put_contents($tmpFile, $params);

        $output = shell_exec("python \"" . $scriptPath . "\" --file \"" . $tmpFile . "\" 2>&1");
        @unlink($tmpFile);

        $qrString = null;
        $md5      = null;

        if ($output) {
            $data = json_decode(trim($output), true);
            if (!empty($data['success']) && !empty($data['qr_string'])) {
                $qrString = $data['qr_string'];
                $md5      = $data['md5'] ?? null;
            } else {
                Log::warning('bakong-khqr Python error', ['output' => $output]);
            }
        }

        // ── Fallback: build KHQR locally if Python fails ─────────────────────
        if (!$qrString) {
            $qrString = $this->buildKhqrString(
                config('services.bakong.account_id'),
                config('services.bakong.merchant_name'),
                config('services.bakong.merchant_city'),
                $currency === 'KHR' ? '116' : '840',
                number_format($amount, 2, '.', ''),
                $orderRef
            );
        }

        // ── Render QR as inline SVG data URI (no external HTTP from browser) ─
        $qrDataUri = $this->generateQrDataUri($qrString);

        return response()->json([
            'success'     => true,
            'qr_data_uri' => $qrDataUri,
            'qr_string'   => $qrString,
            'md5'         => $md5,
        ]);
    }

    /**
     * Generate a base64 SVG data URI from a QR string.
     */
    private function generateQrDataUri(string $data): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle(300, 2),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $svg    = $writer->writeString($data);
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /**
     * Fallback: build a valid EMVCo KHQR string locally.
     */
    private function buildKhqrString(
        string $accountId,
        string $merchantName,
        string $merchantCity,
        string $currency,
        string $amount,
        string $billNumber
    ): string {
        $f = fn(string $tag, string $value): string =>
            $tag . str_pad(strlen($value), 2, '0', STR_PAD_LEFT) . $value;

        $bakongInfo     = $f('00', 'bakong.nbc.gov.kh') . $f('01', $accountId);
        $additionalData = $f('01', $billNumber);

        $qr  = $f('00', '01');
        $qr .= $f('01', '12');
        $qr .= $f('29', $bakongInfo);
        $qr .= $f('52', '0000');
        $qr .= $f('53', $currency);
        $qr .= $f('54', $amount);
        $qr .= $f('58', 'KH');
        $qr .= $f('59', strtoupper($merchantName));
        $qr .= $f('60', $merchantCity);
        $qr .= $f('62', $additionalData);
        $qr .= '6304';

        $crc = $this->crc16($qr);
        $qr .= strtoupper(str_pad(dechex($crc), 4, '0', STR_PAD_LEFT));

        return $qr;
    }

    /** CRC16-CCITT (XModem) used by EMVCo QR. */
    private function crc16(string $data): int
    {
        $crc = 0xFFFF;
        for ($i = 0; $i < strlen($data); $i++) {
            $crc ^= ord($data[$i]) << 8;
            for ($j = 0; $j < 8; $j++) {
                $crc = ($crc & 0x8000) ? (($crc << 1) ^ 0x1021) : ($crc << 1);
                $crc &= 0xFFFF;
            }
        }
        return $crc;
    }

    /**
     * Poll transaction status by md5.
     * POST /bakong/check
     */
    public function check(Request $request)
    {
        $request->validate(['md5' => 'required|string']);

        try {
            $response = Http::withToken(config('services.bakong.token'))
                ->timeout(10)
                ->post(config('services.bakong.api_url') . '/v1/individual/check-transaction', [
                    'md5' => $request->md5,
                ]);

            if ($response->successful()) {
                $body = $response->json();
                return response()->json([
                    'success' => true,
                    'paid'    => ($body['responseCode'] ?? -1) === 0,
                    'data'    => $body['data'] ?? null,
                ]);
            }
        } catch (\Exception $e) {
            Log::info('Bakong check error: ' . $e->getMessage());
        }

        return response()->json(['success' => false, 'paid' => false]);
    }
}
