#!/bin/sh
set -e

cd /var/www/html

echo "==> DATABASE_URL present: $([ -n "$DATABASE_URL" ] && echo YES || echo NO)"

# ── Parse DATABASE_URL using Python (already installed) ──────────────────────
if [ -n "$DATABASE_URL" ]; then
    eval $(python3 - <<'PYEOF'
import os, urllib.parse, sys

url = os.environ.get("DATABASE_URL", "")
if not url:
    sys.exit(0)

# Handle both postgres:// and postgresql://
url = url.replace("postgres://", "postgresql://", 1)

p = urllib.parse.urlparse(url)
print(f"export _DB_HOST={urllib.parse.quote(p.hostname or '')}")
print(f"export _DB_PORT={p.port or 5432}")
print(f"export _DB_NAME={urllib.parse.quote(p.path.lstrip('/') or 'laravel')}")
print(f"export _DB_USER={urllib.parse.quote(p.username or '')}")
print(f"export _DB_PASS={urllib.parse.quote(p.password or '', safe='')}")
PYEOF
)
    echo "==> Parsed DB: host=$_DB_HOST port=$_DB_PORT name=$_DB_NAME user=$_DB_USER"
else
    _DB_HOST="${DB_HOST:-127.0.0.1}"
    _DB_PORT="${DB_PORT:-5432}"
    _DB_NAME="${DB_DATABASE:-laravel}"
    _DB_USER="${DB_USERNAME:-}"
    _DB_PASS="${DB_PASSWORD:-}"
fi

# ── Write .env ────────────────────────────────────────────────────────────────
echo "==> Writing .env..."
{
printf 'APP_NAME="ROG Store"\n'
printf 'APP_ENV=production\n'
printf 'APP_KEY=%s\n'    "${APP_KEY:-}"
printf 'APP_DEBUG=false\n'
printf 'APP_URL=%s\n'    "${APP_URL:-http://localhost}"
printf 'APP_LOCALE=en\n'
printf 'LOG_CHANNEL=stderr\n'
printf 'LOG_LEVEL=error\n'
printf 'DB_CONNECTION=pgsql\n'
printf 'DB_HOST=%s\n'     "$_DB_HOST"
printf 'DB_PORT=%s\n'     "$_DB_PORT"
printf 'DB_DATABASE=%s\n' "$_DB_NAME"
printf 'DB_USERNAME=%s\n' "$_DB_USER"
printf 'DB_PASSWORD=%s\n' "$_DB_PASS"
printf 'DB_SSLMODE=require\n'
printf 'SESSION_DRIVER=file\n'
printf 'SESSION_LIFETIME=120\n'
printf 'CACHE_STORE=file\n'
printf 'QUEUE_CONNECTION=sync\n'
printf 'FILESYSTEM_DISK=local\n'
printf 'BROADCAST_CONNECTION=log\n'
printf 'BAKONG_API_URL=%s\n'       "${BAKONG_API_URL:-https://api-bakong.nbc.gov.kh}"
printf 'BAKONG_ACCOUNT_ID=%s\n'    "${BAKONG_ACCOUNT_ID:-}"
printf 'BAKONG_MERCHANT_NAME="%s"\n' "${BAKONG_MERCHANT_NAME:-}"
printf 'BAKONG_MERCHANT_CITY="%s"\n' "${BAKONG_MERCHANT_CITY:-}"
printf 'BAKONG_TOKEN=%s\n'         "${BAKONG_TOKEN:-}"
} > .env

echo "==> .env written. DB_HOST line: $(grep DB_HOST .env)"

# ── Generate APP_KEY ──────────────────────────────────────────────────────────
echo "==> Generating APP_KEY..."
php artisan key:generate --force --no-interaction

# ── Migrations ────────────────────────────────────────────────────────────────
echo "==> Running migrations..."
php artisan migrate --force --no-interaction

# ── Seed ──────────────────────────────────────────────────────────────────────
echo "==> Seeding..."
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true

# ── Storage link ──────────────────────────────────────────────────────────────
php artisan storage:link --force 2>/dev/null || true

# ── Cache ─────────────────────────────────────────────────────────────────────
echo "==> Caching..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting nginx + php-fpm..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
