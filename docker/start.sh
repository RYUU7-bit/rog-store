#!/bin/sh
set -e

cd /var/www/html

# ── 1. Write .env from environment variables ──────────────────────────────────
echo "==> Writing .env from environment..."

# Parse DATABASE_URL into individual components
# Format: postgres://user:password@host:port/dbname
if [ -n "$DATABASE_URL" ]; then
    DB_USER=$(echo "$DATABASE_URL" | sed -e 's|postgres://||' -e 's|:.*||')
    DB_PASS=$(echo "$DATABASE_URL" | sed -e 's|postgres://[^:]*:||' -e 's|@.*||')
    DB_HOST=$(echo "$DATABASE_URL" | sed -e 's|.*@||' -e 's|:.*||' -e 's|/.*||')
    DB_PORT=$(echo "$DATABASE_URL" | sed -e 's|.*@[^:]*:||' -e 's|/.*||')
    DB_NAME=$(echo "$DATABASE_URL" | sed -e 's|.*/||' -e 's|?.*||')
else
    DB_USER="${DB_USERNAME:-}"
    DB_PASS="${DB_PASSWORD:-}"
    DB_HOST="${DB_HOST:-127.0.0.1}"
    DB_PORT="${DB_PORT:-5432}"
    DB_NAME="${DB_DATABASE:-laravel}"
fi

echo "==> DB host=$DB_HOST port=$DB_PORT name=$DB_NAME user=$DB_USER"

printf 'APP_NAME="ROG Store"\n'                                  > .env
printf 'APP_ENV=%s\n'          "${APP_ENV:-production}"         >> .env
printf 'APP_KEY=%s\n'          "${APP_KEY:-}"                   >> .env
printf 'APP_DEBUG=%s\n'        "${APP_DEBUG:-false}"            >> .env
printf 'APP_URL=%s\n'          "${APP_URL:-http://localhost}"   >> .env
printf 'APP_LOCALE=en\n'                                        >> .env
printf 'APP_FALLBACK_LOCALE=en\n'                               >> .env
printf 'LOG_CHANNEL=stderr\n'                                   >> .env
printf 'LOG_LEVEL=%s\n'        "${LOG_LEVEL:-error}"            >> .env
printf 'DB_CONNECTION=pgsql\n'                                  >> .env
printf 'DB_HOST=%s\n'          "$DB_HOST"                       >> .env
printf 'DB_PORT=%s\n'          "$DB_PORT"                       >> .env
printf 'DB_DATABASE=%s\n'      "$DB_NAME"                       >> .env
printf 'DB_USERNAME=%s\n'      "$DB_USER"                       >> .env
printf 'DB_PASSWORD=%s\n'      "$DB_PASS"                       >> .env
printf 'DB_SSLMODE=require\n'                                   >> .env
printf 'SESSION_DRIVER=file\n'                                  >> .env
printf 'SESSION_LIFETIME=120\n'                                 >> .env
printf 'CACHE_STORE=file\n'                                     >> .env
printf 'QUEUE_CONNECTION=sync\n'                                >> .env
printf 'FILESYSTEM_DISK=local\n'                                >> .env
printf 'BROADCAST_CONNECTION=log\n'                             >> .env
printf 'BAKONG_API_URL=%s\n'   "${BAKONG_API_URL:-https://api-bakong.nbc.gov.kh}" >> .env
printf 'BAKONG_ACCOUNT_ID=%s\n'    "${BAKONG_ACCOUNT_ID:-}"    >> .env
printf 'BAKONG_MERCHANT_NAME="%s"\n' "${BAKONG_MERCHANT_NAME:-}" >> .env
printf 'BAKONG_MERCHANT_CITY="%s"\n' "${BAKONG_MERCHANT_CITY:-}" >> .env
printf 'BAKONG_TOKEN=%s\n'     "${BAKONG_TOKEN:-}"              >> .env

# ── 2. Generate app key ───────────────────────────────────────────────────────
echo "==> Generating APP_KEY..."
php artisan key:generate --force --no-interaction

# ── 3. Run migrations ─────────────────────────────────────────────────────────
echo "==> Running migrations..."
php artisan migrate --force --no-interaction

# ── 4. Seed if fresh ──────────────────────────────────────────────────────────
echo "==> Seeding database..."
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true

# ── 5. Storage link ───────────────────────────────────────────────────────────
php artisan storage:link --force 2>/dev/null || true

# ── 6. Cache ──────────────────────────────────────────────────────────────────
echo "==> Caching..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting nginx + php-fpm..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
