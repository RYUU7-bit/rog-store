#!/bin/sh
set -e
cd /var/www/html

# ── Validate required env vars ─────────────────────────────────────────────────
if [ -z "$DATABASE_URL" ]; then
    echo "ERROR: DATABASE_URL is not set."
    echo "Create a free PostgreSQL database on Render and add DATABASE_URL to env vars."
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

# ── Write .env directly from environment variables ────────────────────────────
# The pgsql connection in config/database.php reads DATABASE_URL natively,
# so we just need to set DB_CONNECTION=pgsql and pass DATABASE_URL through.
cat > /var/www/html/.env << ENV
APP_NAME="ROG Store"
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-https://rog-store.onrender.com}
APP_LOCALE=en

LOG_CHANNEL=stderr
LOG_LEVEL=${LOG_LEVEL:-error}

DB_CONNECTION=pgsql
DATABASE_URL=${DATABASE_URL}
DB_SSLMODE=require

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true

CACHE_STORE=database
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
BROADCAST_CONNECTION=log

BAKONG_API_URL=${BAKONG_API_URL:-https://api-bakong.nbc.gov.kh}
BAKONG_ACCOUNT_ID=${BAKONG_ACCOUNT_ID:-}
BAKONG_MERCHANT_NAME=${BAKONG_MERCHANT_NAME:-}
BAKONG_MERCHANT_CITY=${BAKONG_MERCHANT_CITY:-}
BAKONG_TOKEN=${BAKONG_TOKEN:-}

TELEGRAM_BOT_TOKEN=${TELEGRAM_BOT_TOKEN:-}
TELEGRAM_CHAT_ID=${TELEGRAM_CHAT_ID:-}
ENV

echo "ENV written. Using PostgreSQL via DATABASE_URL."

# ── Run migrations and seed ───────────────────────────────────────────────────
php artisan migrate --force --no-interaction || { echo "Migration failed"; exit 1; }
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true
php artisan storage:link --force 2>/dev/null || true
php artisan optimize:clear

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
