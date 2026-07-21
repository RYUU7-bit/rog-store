#!/bin/sh
set -e

cd /var/www/html

# ── 1. Write .env from environment variables (quote all values) ───────────────
echo "==> Writing .env from environment..."
cat > .env << 'ENVEOF'
APP_NAME="ROG Store"
ENVEOF

# Append dynamic values safely with printf
printf 'APP_ENV=%s\n'          "${APP_ENV:-production}"          >> .env
printf 'APP_KEY=%s\n'          "${APP_KEY:-}"                    >> .env
printf 'APP_DEBUG=%s\n'        "${APP_DEBUG:-false}"             >> .env
printf 'APP_URL=%s\n'          "${APP_URL:-http://localhost}"    >> .env
printf 'APP_LOCALE=en\n'                                         >> .env
printf 'APP_FALLBACK_LOCALE=en\n'                                >> .env
printf 'LOG_CHANNEL=stderr\n'                                    >> .env
printf 'LOG_LEVEL=%s\n'        "${LOG_LEVEL:-error}"             >> .env
printf 'DB_CONNECTION=%s\n'    "${DB_CONNECTION:-pgsql}"         >> .env
printf 'DATABASE_URL=%s\n'     "${DATABASE_URL:-}"               >> .env
printf 'SESSION_DRIVER=file\n'                                   >> .env
printf 'SESSION_LIFETIME=120\n'                                  >> .env
printf 'CACHE_STORE=file\n'                                      >> .env
printf 'QUEUE_CONNECTION=sync\n'                                 >> .env
printf 'FILESYSTEM_DISK=local\n'                                 >> .env
printf 'BROADCAST_CONNECTION=log\n'                              >> .env
printf 'BAKONG_API_URL=%s\n'   "${BAKONG_API_URL:-https://api-bakong.nbc.gov.kh}" >> .env
printf 'BAKONG_ACCOUNT_ID=%s\n'   "${BAKONG_ACCOUNT_ID:-}"      >> .env
printf 'BAKONG_MERCHANT_NAME="%s"\n' "${BAKONG_MERCHANT_NAME:-}" >> .env
printf 'BAKONG_MERCHANT_CITY="%s"\n' "${BAKONG_MERCHANT_CITY:-}" >> .env
printf 'BAKONG_TOKEN=%s\n'     "${BAKONG_TOKEN:-}"               >> .env

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
