#!/bin/sh
set -e

cd /var/www/html

# ── 1. Create a minimal .env from environment variables ──────────────────────
echo "==> Writing .env from environment..."
cat > .env <<EOF
APP_NAME="${APP_NAME:-ROG Store}"
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY:-}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}
APP_LOCALE=en
APP_FALLBACK_LOCALE=en

LOG_CHANNEL=stderr
LOG_LEVEL=${LOG_LEVEL:-error}

DB_CONNECTION=${DB_CONNECTION:-pgsql}
DATABASE_URL=${DATABASE_URL:-}
DB_URL=${DB_URL:-}

SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
BROADCAST_CONNECTION=log

BAKONG_API_URL=${BAKONG_API_URL:-https://api-bakong.nbc.gov.kh}
BAKONG_ACCOUNT_ID=${BAKONG_ACCOUNT_ID:-}
BAKONG_MERCHANT_NAME=${BAKONG_MERCHANT_NAME:-}
BAKONG_MERCHANT_CITY=${BAKONG_MERCHANT_CITY:-}
BAKONG_TOKEN=${BAKONG_TOKEN:-}
EOF

# ── 2. Generate app key if not set ───────────────────────────────────────────
echo "==> Checking APP_KEY..."
php artisan key:generate --force --no-interaction

# ── 3. Run migrations ────────────────────────────────────────────────────────
echo "==> Running migrations..."
php artisan migrate --force --no-interaction

# ── 4. Seed only if fresh ────────────────────────────────────────────────────
echo "==> Seeding database..."
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true

# ── 5. Storage link ──────────────────────────────────────────────────────────
php artisan storage:link --force 2>/dev/null || true

# ── 6. Cache everything ───────────────────────────────────────────────────────
echo "==> Caching..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting nginx + php-fpm..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
