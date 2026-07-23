#!/bin/sh
set -e
cd /var/www/html

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
    touch('/var/www/html/database/database.sqlite');
    $db = "DB_CONNECTION=sqlite\nDB_DATABASE=/var/www/html/database/database.sqlite\n";
}

$key    = getenv('APP_KEY') ?: '';
$appUrl = getenv('APP_URL') ?: 'https://rog-store.onrender.com';
$bName  = getenv('BAKONG_MERCHANT_NAME') ?: '';
$bCity  = getenv('BAKONG_MERCHANT_CITY') ?: '';

$env = "APP_NAME=\"ROG Store\"\n"
     . "APP_ENV=production\n"
     . "APP_KEY=$key\n"
     . "APP_DEBUG=true\n"
     . "APP_URL=$appUrl\n"
     . "APP_LOCALE=en\n"
     . "LOG_CHANNEL=stderr\n"
     . "LOG_LEVEL=error\n"
     . $db
     . "SESSION_DRIVER=file\n"
     . "SESSION_LIFETIME=120\n"
     . "CACHE_STORE=file\n"
     . "QUEUE_CONNECTION=sync\n"
     . "FILESYSTEM_DISK=local\n"
     . "BROADCAST_CONNECTION=log\n"
     . "BAKONG_API_URL=" . (getenv('BAKONG_API_URL') ?: 'https://api-bakong.nbc.gov.kh') . "\n"
     . "BAKONG_ACCOUNT_ID=" . (getenv('BAKONG_ACCOUNT_ID') ?: '') . "\n"
     . "BAKONG_MERCHANT_NAME=\"$bName\"\n"
     . "BAKONG_MERCHANT_CITY=\"$bCity\"\n"
     . "BAKONG_TOKEN=" . (getenv('BAKONG_TOKEN') ?: '') . "\n";

file_put_contents('/var/www/html/.env', $env);
echo "ENV written. DB=" . (getenv('DATABASE_URL') ? 'pgsql' : 'sqlite') . "\n";
PHPEOF

php artisan key:generate --force --no-interaction
php artisan migrate --force --no-interaction
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true
php artisan storage:link --force 2>/dev/null || true
php artisan optimize:clear

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
