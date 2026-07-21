#!/bin/sh
set -e

cd /var/www/html

echo "==> Setting up environment..." >&2

# Parse DATABASE_URL with Python — output ONLY key=value lines, nothing else
if [ -n "$DATABASE_URL" ]; then
    echo "==> PostgreSQL mode" >&2
    DB_VARS=$(python3 -c "
import os, urllib.parse
url = os.environ['DATABASE_URL'].replace('postgres://', 'postgresql://', 1)
p = urllib.parse.urlparse(url)
print('DB_CONNECTION=pgsql')
print('DB_HOST=' + (p.hostname or ''))
print('DB_PORT=' + str(p.port or 5432))
print('DB_DATABASE=' + p.path.lstrip('/'))
print('DB_USERNAME=' + (p.username or ''))
print('DB_PASSWORD=' + (p.password or ''))
print('DB_SSLMODE=require')
")
else
    echo "==> SQLite mode" >&2
    DB_VARS="DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite"
    touch /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
fi

# Write .env — only valid KEY=VALUE lines go here
{
printf 'APP_NAME="ROG Store"\n'
printf 'APP_ENV=production\n'
printf 'APP_KEY=%s\n'            "${APP_KEY:-}"
printf 'APP_DEBUG=false\n'
printf 'APP_URL=%s\n'            "${APP_URL:-https://rog-store.onrender.com}"
printf 'APP_LOCALE=en\n'
printf 'LOG_CHANNEL=stderr\n'
printf 'LOG_LEVEL=error\n'
printf '%s\n'                    "$DB_VARS"
printf 'SESSION_DRIVER=file\n'
printf 'SESSION_LIFETIME=120\n'
printf 'CACHE_STORE=file\n'
printf 'QUEUE_CONNECTION=sync\n'
printf 'FILESYSTEM_DISK=local\n'
printf 'BROADCAST_CONNECTION=log\n'
printf 'BAKONG_API_URL=%s\n'         "${BAKONG_API_URL:-https://api-bakong.nbc.gov.kh}"
printf 'BAKONG_ACCOUNT_ID=%s\n'      "${BAKONG_ACCOUNT_ID:-}"
printf 'BAKONG_MERCHANT_NAME="%s"\n' "${BAKONG_MERCHANT_NAME:-}"
printf 'BAKONG_MERCHANT_CITY="%s"\n' "${BAKONG_MERCHANT_CITY:-}"
printf 'BAKONG_TOKEN=%s\n'           "${BAKONG_TOKEN:-}"
} > .env

echo "==> DB: $(grep DB_CONNECTION .env)" >&2

# Generate app key
php artisan key:generate --force --no-interaction

# Migrations
echo "==> Migrating..." >&2
php artisan migrate --force --no-interaction

# Seed
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true

# Storage
php artisan storage:link --force 2>/dev/null || true

# Cache
echo "==> Caching..." >&2
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting services..." >&2
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
