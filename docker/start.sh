#!/bin/sh
set -e
cd /var/www/html

# ── Validate required env vars ─────────────────────────────────────────────────
if [ -z "$DATABASE_URL" ]; then
    echo "ERROR: DATABASE_URL is not set. A PostgreSQL database is required on Render."
    echo "Please create a free PostgreSQL database in your Render dashboard and link it."
    exit 1
fi

# ── Clear any stale cached config from previous builds ────────────────────────
rm -f bootstrap/cache/config.php bootstrap/cache/routes-v7.php 2>/dev/null || true

# ── Fix permissions on storage/bootstrap ──────────────────────────────────────
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# ── Generate .env from environment variables ───────────────────────────────────
php << 'PHPEOF'
<?php
$url = getenv('DATABASE_URL');
$u   = parse_url($url);
$db  = "DB_CONNECTION=pgsql\n"
     . "DB_HOST="     . ($u['host'] ?? '') . "\n"
     . "DB_PORT="     . ($u['port'] ?? 5432) . "\n"
     . "DB_DATABASE=" . ltrim($u['path'] ?? 'rog_store', '/') . "\n"
     . "DB_USERNAME=" . ($u['user'] ?? '') . "\n"
     . "DB_PASSWORD=" . ($u['pass'] ?? '') . "\n"
     . "DB_SSLMODE=require\n";

$key    = getenv('APP_KEY') ?: '';
$appUrl = getenv('APP_URL') ?: 'https://rog-store.onrender.com';
$debug  = getenv('APP_DEBUG') ?: 'false';
$bName  = getenv('BAKONG_MERCHANT_NAME') ?: '';
$bCity  = getenv('BAKONG_MERCHANT_CITY') ?: '';

$env = "APP_NAME=\"ROG Store\"\n"
     . "APP_ENV=production\n"
     . "APP_KEY=$key\n"
     . "APP_DEBUG=$debug\n"
     . "APP_URL=$appUrl\n"
     . "APP_LOCALE=en\n"
     . "LOG_CHANNEL=stderr\n"
     . "LOG_LEVEL=error\n"
     . $db
     . "SESSION_DRIVER=database\n"
     . "SESSION_LIFETIME=120\n"
     . "SESSION_SECURE_COOKIE=true\n"
     . "CACHE_STORE=database\n"
     . "QUEUE_CONNECTION=sync\n"
     . "FILESYSTEM_DISK=local\n"
     . "BROADCAST_CONNECTION=log\n"
     . "BAKONG_API_URL="    . (getenv('BAKONG_API_URL') ?: 'https://api-bakong.nbc.gov.kh') . "\n"
     . "BAKONG_ACCOUNT_ID=" . (getenv('BAKONG_ACCOUNT_ID') ?: '') . "\n"
     . "BAKONG_MERCHANT_NAME=\"$bName\"\n"
     . "BAKONG_MERCHANT_CITY=\"$bCity\"\n"
     . "BAKONG_TOKEN="         . (getenv('BAKONG_TOKEN') ?: '') . "\n"
     . "TELEGRAM_BOT_TOKEN="   . (getenv('TELEGRAM_BOT_TOKEN') ?: '') . "\n"
     . "TELEGRAM_CHAT_ID="     . (getenv('TELEGRAM_CHAT_ID') ?: '') . "\n";

file_put_contents('/var/www/html/.env', $env);
echo "ENV written. Using PostgreSQL.\n";
PHPEOF

# ── Only generate APP_KEY if Render did not inject one ────────────────────────
php -r "if (!getenv('APP_KEY')) { passthru('php artisan key:generate --force --no-interaction'); } else { echo 'APP_KEY already set, skipping.' . PHP_EOL; }"

# ── Run migrations and seed ───────────────────────────────────────────────────
php artisan migrate --force --no-interaction || { echo "Migration failed, attempting to continue..."; }
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true
php artisan storage:link --force 2>/dev/null || true
php artisan optimize:clear

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
