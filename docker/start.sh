#!/bin/sh
set -e
cd /var/www/html

# ── Validate required env vars ─────────────────────────────────────────────────
if [ -z "$DATABASE_URL" ]; then
    echo "ERROR: DATABASE_URL is not set."
    exit 1
fi

if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set."
    exit 1
fi

# ── Clear any stale cached config from previous builds ────────────────────────
rm -f bootstrap/cache/config.php bootstrap/cache/routes-v7.php 2>/dev/null || true

# ── Fix permissions on storage/bootstrap ──────────────────────────────────────
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# ── Write .env using PHP to avoid shell quoting issues with special characters ─
php -r "
\$vars = [
    'APP_NAME'             => 'ROG Store',
    'APP_ENV'              => 'production',
    'APP_KEY'              => getenv('APP_KEY'),
    'APP_DEBUG'            => getenv('APP_DEBUG') ?: 'false',
    'APP_URL'              => getenv('APP_URL') ?: 'https://rog-store.onrender.com',
    'APP_LOCALE'           => 'en',
    'LOG_CHANNEL'          => 'stderr',
    'LOG_LEVEL'            => getenv('LOG_LEVEL') ?: 'error',
    'DB_CONNECTION'        => 'pgsql',
    'DATABASE_URL'         => getenv('DATABASE_URL'),
    'DB_SSLMODE'           => 'require',
    'SESSION_DRIVER'       => 'database',
    'SESSION_LIFETIME'     => '120',
    'SESSION_SECURE_COOKIE'=> 'true',
    'CACHE_STORE'          => 'database',
    'QUEUE_CONNECTION'     => 'sync',
    'FILESYSTEM_DISK'      => 'local',
    'BROADCAST_CONNECTION' => 'log',
    'BAKONG_API_URL'       => getenv('BAKONG_API_URL') ?: 'https://api-bakong.nbc.gov.kh',
    'BAKONG_ACCOUNT_ID'    => getenv('BAKONG_ACCOUNT_ID') ?: '',
    'BAKONG_MERCHANT_NAME' => getenv('BAKONG_MERCHANT_NAME') ?: '',
    'BAKONG_MERCHANT_CITY' => getenv('BAKONG_MERCHANT_CITY') ?: '',
    'BAKONG_TOKEN'         => getenv('BAKONG_TOKEN') ?: '',
    'TELEGRAM_BOT_TOKEN'   => getenv('TELEGRAM_BOT_TOKEN') ?: '',
    'TELEGRAM_CHAT_ID'     => getenv('TELEGRAM_CHAT_ID') ?: '',
];

\$lines = [];
foreach (\$vars as \$k => \$v) {
    // Always quote the value so spaces and special chars are safe
    \$escaped = str_replace(['\\\\', '\"'], ['\\\\\\\\', '\\\\\"'], \$v);
    \$lines[] = \$k . '=\"' . \$escaped . '\"';
}

file_put_contents('/var/www/html/.env', implode(\"\n\", \$lines) . \"\n\");
echo 'ENV written. Using PostgreSQL via DATABASE_URL.' . PHP_EOL;
"

# ── Run migrations and seed ───────────────────────────────────────────────────
php artisan migrate --force --no-interaction || { echo "Migration failed"; exit 1; }
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true
php artisan storage:link --force 2>/dev/null || true
php artisan optimize:clear

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
