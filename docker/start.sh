#!/bin/sh
set -e
cd /var/www/html

# ── Clear all cached config before regenerating .env ──────────────────────────
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
rm -f bootstrap/cache/config.php 2>/dev/null || true

# ── SQLite: use /tmp which is always writable on Render's ephemeral filesystem
# Copy the seeded sqlite from the image to /tmp on first boot, then keep using /tmp
if [ -z "$DATABASE_URL" ]; then
    if [ ! -f /tmp/database.sqlite ]; then
        if [ -f /var/www/html/database/database.sqlite ]; then
            cp /var/www/html/database/database.sqlite /tmp/database.sqlite
        else
            touch /tmp/database.sqlite
        fi
    fi
    chmod 666 /tmp/database.sqlite 2>/dev/null || true
    chown www-data:www-data /tmp/database.sqlite 2>/dev/null || true
    
    # Also fix the baked-in sqlite if it exists (belt and suspenders)
    chmod 666 /var/www/html/database/database.sqlite 2>/dev/null || true
    chown www-data:www-data /var/www/html/database/database.sqlite 2>/dev/null || true
fi

# ── Fix permissions on storage/bootstrap (Render may reset these) ─────────────
chmod -R 775 storage bootstrap/cache 2>/dev/null || true
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# Generate .env from environment variables using PHP
php << 'PHPEOF'
<?php
$url = getenv('DATABASE_URL');
if ($url) {
    $u  = parse_url($url);
    $db = "DB_CONNECTION=pgsql\n"
        . "DB_HOST=" . ($u['host'] ?? '') . "\n"
        . "DB_PORT=" . ($u['port'] ?? 5432) . "\n"
        . "DB_DATABASE=" . ltrim($u['path'] ?? 'laravel', '/') . "\n"
        . "DB_USERNAME=" . ($u['user'] ?? '') . "\n"
        . "DB_PASSWORD=" . ($u['pass'] ?? '') . "\n"
        . "DB_SSLMODE=require\n";
} else {
    // SQLite lives in /tmp so it is always writable on Render
    $db = "DB_CONNECTION=sqlite\nDB_DATABASE=/tmp/database.sqlite\n";
}

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
     . "BAKONG_API_URL=" . (getenv('BAKONG_API_URL') ?: 'https://api-bakong.nbc.gov.kh') . "\n"
     . "BAKONG_ACCOUNT_ID=" . (getenv('BAKONG_ACCOUNT_ID') ?: '') . "\n"
     . "BAKONG_MERCHANT_NAME=\"$bName\"\n"
     . "BAKONG_MERCHANT_CITY=\"$bCity\"\n"
     . "BAKONG_TOKEN=" . (getenv('BAKONG_TOKEN') ?: '') . "\n"
     . "TELEGRAM_BOT_TOKEN=" . (getenv('TELEGRAM_BOT_TOKEN') ?: '') . "\n"
     . "TELEGRAM_CHAT_ID=" . (getenv('TELEGRAM_CHAT_ID') ?: '') . "\n";

file_put_contents('/var/www/html/.env', $env);
echo "ENV written. DB=" . (getenv('DATABASE_URL') ? 'pgsql' : 'sqlite') . "\n";
PHPEOF

# Only generate an APP_KEY if one was not injected via environment (Render provides it via generateValue)
php -r "if (!getenv('APP_KEY')) { passthru('php artisan key:generate --force --no-interaction'); } else { echo 'APP_KEY already provided, skipping key:generate' . PHP_EOL; }"
php artisan migrate --force --no-interaction
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true
php artisan storage:link --force 2>/dev/null || true
php artisan optimize:clear

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
