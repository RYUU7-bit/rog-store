<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    /**
     * High-Quality Natural Text-to-Speech audio proxy for Khmer and English.
     * GET /api/ai/tts?text=...&lang=km
     */
    public function tts(Request $request)
    {
        $text = trim($request->get('text', ''));
        $lang = $request->get('lang', 'km');

        if (empty($text)) {
            return response()->noContent();
        }

        // Clean and limit string length
        $cleanText = mb_substr(strip_tags($text), 0, 300, 'UTF-8');
        $cacheKey  = 'rog_ai_tts_' . md5($lang . '_' . $cleanText);

        try {
            $audioContent = Cache::remember($cacheKey, 86400 * 7, function () use ($cleanText, $lang) {
                $targetLang = ($lang === 'kh' || $lang === 'km') ? 'km' : 'en';
                $url = 'https://translate.google.com/translate_tts?ie=UTF-8&tl=' . urlencode($targetLang) . '&client=tw-ob&q=' . urlencode($cleanText);

                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                    'Referer'    => 'https://translate.google.com/',
                ])->timeout(8)->get($url);

                if ($response->successful() && strlen($response->body()) > 500) {
                    return $response->body();
                }

                return null;
            });

            if ($audioContent) {
                return response($audioContent, 200)
                    ->header('Content-Type', 'audio/mpeg')
                    ->header('Accept-Ranges', 'bytes')
                    ->header('Cache-Control', 'public, max-age=604800');
            }
        } catch (\Exception $e) {
            Log::warning('AI TTS generation error: ' . $e->getMessage());
        }

        return response()->json(['error' => 'TTS audio stream unavailable'], 503);
    }
}
