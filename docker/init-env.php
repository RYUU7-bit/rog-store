<?php
/**
 * Dynamic Environment Initializer for Render & Docker
 *
 * Automatically tests PostgreSQL connectivity (with DNS healing for Render internal hostnames).
 * If PostgreSQL is unreachable or invalid, safely falls back to SQLite so the application
 * is ALWAYS 100% operational with zero downtime and no 500 error crashes.
 */

$appRoot = realpath(__DIR__ . '/..') ?: '/var/www/html';
$envFile = $appRoot . '/.env';

// ── 1. App Key Check ──────────────────────────────────────────────────────────
$appKey = getenv('APP_KEY') ?: '';
if (empty($appKey) || (!str_starts_with($appKey, 'base64:') && strlen($appKey) !== 32)) {
    $appKey = 'base64:' . base64_encode(random_bytes(32));
    echo "[ENV] Generated new 256-bit APP_KEY." . PHP_EOL;
}

// ── 2. Database Connectivity & Auto-Healing ───────────────────────────────────
$rawDbUrl    = getenv('DATABASE_URL') ?: '';
$dbConn      = 'sqlite';
$finalDbUrl  = '';
$workingHost = '127.0.0.1';
$port        = 5432;
$user        = '';
$pass        = '';
$dbname      = '';

if (!empty($rawDbUrl)) {
    echo "[DB] Checking DATABASE_URL provided by environment..." . PHP_EOL;
    $parsed = parse_url($rawDbUrl);
    $host   = $parsed['host'] ?? '';
    $port   = $parsed['port'] ?? 5432;
    $user   = isset($parsed['user']) ? urldecode($parsed['user']) : '';
    $pass   = isset($parsed['pass']) ? urldecode($parsed['pass']) : '';
    $dbname = isset($parsed['path']) ? ltrim($parsed['path'], '/') : '';

    $workingHost = $host;

    // Render Internal Hostname Resolution Fix:
    // If the host is in the format "dpg-xxxx-a" without dots, it is Render internal DNS.
    // If the Web Service and Database are in different regions, or internal DNS fails,
    // gethostbyname() will fail to resolve. We try known Render regional domains.
    if (!empty($host)) {
        $ip = @gethostbyname($host);
        if ($ip === $host) {
            echo "[DB] Internal host [{$host}] did not resolve directly. Probing Render regional domains..." . PHP_EOL;
            $regions = ['singapore', 'oregon', 'frankfurt', 'ohio', 'virginia'];
            foreach ($regions as $region) {
                $candidate = "{$host}.{$region}-postgres.render.com";
                $candIp = @gethostbyname($candidate);
                if ($candIp !== $candidate) {
                    echo "[DB] Found resolvable hostname: {$candidate} ({$candIp})" . PHP_EOL;
                    $workingHost = $candidate;
                    break;
                }
            }
        }
    }

    // Now test connection to PostgreSQL with a strict 4-second timeout
    if (!empty($workingHost) && extension_loaded('pdo_pgsql')) {
        try {
            $dsn = "pgsql:host={$workingHost};port={$port};dbname={$dbname};sslmode=require;connect_timeout=4";
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_TIMEOUT => 4,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $pdo->query("SELECT 1");

            // Connection succeeded!
            $dbConn = 'pgsql';
            $auth = (!empty($user) || !empty($pass)) ? rawurlencode($user) . ($pass ? ':' . rawurlencode($pass) : '') . '@' : '';
            $finalDbUrl = "postgres://{$auth}{$workingHost}:{$port}/{$dbname}";
            echo "[DB] SUCCESS: Connected to PostgreSQL on {$workingHost}:{$port}/{$dbname}." . PHP_EOL;
        } catch (Throwable $e) {
            echo "[DB] WARNING: PostgreSQL connection failed (" . $e->getMessage() . ")." . PHP_EOL;
            echo "[DB] FALLBACK: Automatically switching to SQLite to ensure zero downtime." . PHP_EOL;
            $dbConn = 'sqlite';
            $finalDbUrl = '';
        }
    } else {
        echo "[DB] FALLBACK: Using SQLite." . PHP_EOL;
        $dbConn = 'sqlite';
        $finalDbUrl = '';
    }
} else {
    echo "[DB] No DATABASE_URL specified. Defaulting to SQLite database." . PHP_EOL;
    $dbConn = 'sqlite';
}

// ── 3. Prepare SQLite file if needed ──────────────────────────────────────────
$sqlitePath = $appRoot . '/database/database.sqlite';
if ($dbConn === 'sqlite') {
    $dbDir = dirname($sqlitePath);
    if (!is_dir($dbDir)) {
        @mkdir($dbDir, 0777, true);
    }
    if (!file_exists($sqlitePath)) {
        @touch($sqlitePath);
    }
    @chmod($sqlitePath, 0777);
    @chmod($dbDir, 0777);
    echo "[DB] SQLite database prepared at: {$sqlitePath}" . PHP_EOL;
}

// ── 4. Build Environment Variables Array ──────────────────────────────────────
$vars = [
    'APP_NAME'              => getenv('APP_NAME') ?: 'ROG Store',
    'APP_ENV'               => getenv('APP_ENV') ?: 'production',
    'APP_KEY'               => $appKey,
    'APP_DEBUG'             => getenv('APP_DEBUG') ?: 'false',
    'APP_URL'               => getenv('APP_URL') ?: 'https://rog-store.onrender.com',
    'APP_LOCALE'            => 'en',
    'LOG_CHANNEL'           => 'stderr',
    'LOG_LEVEL'             => getenv('LOG_LEVEL') ?: 'debug',

    'DB_CONNECTION'         => $dbConn,
    'DATABASE_URL'          => $finalDbUrl,
    'DB_DATABASE'           => $dbConn === 'sqlite' ? $sqlitePath : ($dbname ?: 'rog_store_db'),
    'DB_HOST'               => $dbConn === 'pgsql' ? $workingHost : '127.0.0.1',
    'DB_PORT'               => $dbConn === 'pgsql' ? (string)$port : '5432',
    'DB_USERNAME'           => $dbConn === 'pgsql' ? $user : '',
    'DB_PASSWORD'           => $dbConn === 'pgsql' ? $pass : '',
    'DB_SSLMODE'            => 'require',

    'SESSION_DRIVER'        => 'file',
    'SESSION_LIFETIME'      => '120',
    'SESSION_SECURE_COOKIE' => 'false',
    'CACHE_STORE'           => 'file',
    'QUEUE_CONNECTION'      => 'sync',
    'FILESYSTEM_DISK'       => 'local',
    'BROADCAST_CONNECTION'  => 'log',

    'BAKONG_API_URL'        => getenv('BAKONG_API_URL') ?: 'https://api-bakong.nbc.gov.kh',
    'BAKONG_ACCOUNT_ID'     => getenv('BAKONG_ACCOUNT_ID') ?: 'ngoun_kimhong@bkrt',
    'BAKONG_MERCHANT_NAME'  => getenv('BAKONG_MERCHANT_NAME') ?: 'KIMHONG NGOUN',
    'BAKONG_MERCHANT_CITY'  => getenv('BAKONG_MERCHANT_CITY') ?: 'Phnom Penh',
    'BAKONG_TOKEN'          => getenv('BAKONG_TOKEN') ?: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImlkIjoiYTE2YmNkMTM1ZDYzNDdkOCJ9LCJpYXQiOjE3ODQ2MjMzNzEsImV4cCI6MTc5MjM5OTM3MX0.ummOgG26OxKLybhUkp5yvb4JUhzIajXEEWg2FQxwfnE',
    'TELEGRAM_BOT_TOKEN'    => getenv('TELEGRAM_BOT_TOKEN') ?: '8513335087:AAHeyXzf_wXpaBZLclnv6fUD0tN0nvHr2N0',
    'TELEGRAM_CHAT_ID'      => getenv('TELEGRAM_CHAT_ID') ?: '6285316662',
];

// ── 5. Write to .env ──────────────────────────────────────────────────────────
$lines = [];
foreach ($vars as $k => $v) {
    $escaped = str_replace(['\\', '"'], ['\\\\', '\\"'], (string)$v);
    $lines[] = "{$k}=\"{$escaped}\"";
}

file_put_contents($envFile, implode("\n", $lines) . "\n");
echo "[ENV] Successfully wrote configuration to .env with DB_CONNECTION={$dbConn}" . PHP_EOL;
