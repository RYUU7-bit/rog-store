#!/bin/sh
set -e
cd /var/www/html

# ── Fix permissions on storage/bootstrap ──────────────────────────────────────
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache database
chmod -R 775 storage bootstrap/cache database 2>/dev/null || true
chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null || true

# ── Clear any stale cached config from previous builds ────────────────────────
rm -f bootstrap/cache/config.php bootstrap/cache/routes-v7.php bootstrap/cache/services.php bootstrap/cache/packages.php 2>/dev/null || true

# ── Write .env using PHP to avoid shell quoting issues with special characters ─
php -r "
\$appKey = getenv('APP_KEY') ?: '';
if (empty(\$appKey) || (!str_starts_with(\$appKey, 'base64:') && strlen(\$appKey) !== 32)) {
    \$appKey = 'base64:' . base64_encode(random_bytes(32));
}

\$dbUrl = getenv('DATABASE_URL') ?: '';
\$dbConn = !empty(\$dbUrl) ? 'pgsql' : 'sqlite';

if (\$dbConn === 'sqlite') {
    \$sqlitePath = '/var/www/html/database/database.sqlite';
    if (!file_exists(\$sqlitePath)) {
        touch(\$sqlitePath);
        chmod(\$sqlitePath, 0777);
    }
}

\$vars = [
    'APP_NAME'              => 'ROG Store',
    'APP_ENV'               => 'production',
    'APP_KEY'               => \$appKey,
    'APP_DEBUG'             => getenv('APP_DEBUG') ?: 'false',
    'APP_URL'               => getenv('APP_URL') ?: 'https://rog-store.onrender.com',
    'APP_LOCALE'            => 'en',
    'LOG_CHANNEL'           => 'stderr',
    'LOG_LEVEL'             => getenv('LOG_LEVEL') ?: 'error',
    'DB_CONNECTION'         => \$dbConn,
    'DATABASE_URL'          => \$dbUrl,
    'DB_DATABASE'           => \$dbConn === 'sqlite' ? '/var/www/html/database/database.sqlite' : (getenv('DB_DATABASE') ?: 'laravel'),
    'DB_SSLMODE'            => 'require',
    'SESSION_DRIVER'        => \$dbConn === 'sqlite' ? 'file' : 'database',
    'SESSION_LIFETIME'      => '120',
    'SESSION_SECURE_COOKIE' => 'false',
    'CACHE_STORE'           => \$dbConn === 'sqlite' ? 'file' : 'database',
    'QUEUE_CONNECTION'      => 'sync',
    'FILESYSTEM_DISK'       => 'local',
    'BROADCAST_CONNECTION'  => 'log',
    'BAKONG_API_URL'        => getenv('BAKONG_API_URL') ?: 'https://api-bakong.nbc.gov.kh',
    'BAKONG_ACCOUNT_ID'     => getenv('BAKONG_ACCOUNT_ID') ?: '',
    'BAKONG_MERCHANT_NAME'  => getenv('BAKONG_MERCHANT_NAME') ?: '',
    'BAKONG_MERCHANT_CITY'  => getenv('BAKONG_MERCHANT_CITY') ?: '',
    'BAKONG_TOKEN'          => getenv('BAKONG_TOKEN') ?: '',
    'TELEGRAM_BOT_TOKEN'    => getenv('TELEGRAM_BOT_TOKEN') ?: '',
    'TELEGRAM_CHAT_ID'      => getenv('TELEGRAM_CHAT_ID') ?: '',
];

\$lines = [];
foreach (\$vars as \$k => \$v) {
    \$escaped = str_replace(['\\\\', '\"'], ['\\\\\\\\', '\\\\\"'], (string) \$v);
    \$lines[] = \$k . '=\"' . \$escaped . '\"';
}

file_put_contents('/var/www/html/.env', implode(\"\n\", \$lines) . \"\n\");
echo 'ENV written. Database connection: ' . \$dbConn . PHP_EOL;
"

# ── Run migrations and seed ───────────────────────────────────────────────────
php artisan migrate --force --no-interaction || { echo "Migration warning/error. Continuing..."; }
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true
php artisan storage:link --force 2>/dev/null || true
php artisan optimize:clear 2>/dev/null || true
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting Nginx & PHP-FPM via Supervisord..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
