#!/bin/sh
set -e
cd /var/www/html

# Write .env using PHP — reliable, no shell quoting issues
php -r "
\$url = getenv('DATABASE_URL');
if (\$url) {
    \$u = parse_url(\$url);
    \$db = 'DB_CONNECTION=pgsql' . PHP_EOL
        . 'DB_HOST=' . (\$u['host'] ?? '') . PHP_EOL
        . 'DB_PORT=' . (\$u['port'] ?? 5432) . PHP_EOL
        . 'DB_DATABASE=' . ltrim(\$u['path'] ?? 'laravel', '/') . PHP_EOL
        . 'DB_USERNAME=' . (\$u['user'] ?? '') . PHP_EOL
        . 'DB_PASSWORD=' . (\$u['pass'] ?? '') . PHP_EOL
        . 'DB_SSLMODE=require' . PHP_EOL;
} else {
    touch('/var/www/html/database/database.sqlite');
    \$db = 'DB_CONNECTION=sqlite' . PHP_EOL
        . 'DB_DATABASE=/var/www/html/database/database.sqlite' . PHP_EOL;
}
\$env = 'APP_NAME=\"ROG Store\"' . PHP_EOL
    . 'APP_ENV=production' . PHP_EOL
    . 'APP_KEY=' . getenv('APP_KEY') . PHP_EOL
    . 'APP_DEBUG=true' . PHP_EOL
    . 'APP_URL=' . (getenv('APP_URL') ?: 'https://rog-store.onrender.com') . PHP_EOL
    . 'APP_LOCALE=en' . PHP_EOL
    . 'LOG_CHANNEL=stderr' . PHP_EOL
    . 'LOG_LEVEL=error' . PHP_EOL
    . \$db
    . 'SESSION_DRIVER=file' . PHP_EOL
    . 'SESSION_LIFETIME=120' . PHP_EOL
    . 'CACHE_STORE=file' . PHP_EOL
    . 'QUEUE_CONNECTION=sync' . PHP_EOL
    . 'FILESYSTEM_DISK=local' . PHP_EOL
    . 'BROADCAST_CONNECTION=log' . PHP_EOL
    . 'BAKONG_API_URL=' . (getenv('BAKONG_API_URL') ?: 'https://api-bakong.nbc.gov.kh') . PHP_EOL
    . 'BAKONG_ACCOUNT_ID=' . getenv('BAKONG_ACCOUNT_ID') . PHP_EOL
    . 'BAKONG_MERCHANT_NAME=\"' . getenv('BAKONG_MERCHANT_NAME') . '\"' . PHP_EOL
    . 'BAKONG_MERCHANT_CITY=\"' . getenv('BAKONG_MERCHANT_CITY') . '\"' . PHP_EOL
    . 'BAKONG_TOKEN=' . getenv('BAKONG_TOKEN') . PHP_EOL;
file_put_contents('/var/www/html/.env', \$env);
echo 'DB mode: ' . (getenv('DATABASE_URL') ? 'PostgreSQL' : 'SQLite') . PHP_EOL;
"

php artisan key:generate --force --no-interaction
php artisan migrate --force --no-interaction
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true
php artisan storage:link --force 2>/dev/null || true

# Clear any stale cache — do NOT re-cache in production on free tier
php artisan optimize:clear

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
