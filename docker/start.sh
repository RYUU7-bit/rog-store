#!/bin/sh
set -e

cd /var/www/html

echo "==> Setting up environment..."

# ── Build .env ────────────────────────────────────────────────────────────────
{
printf 'APP_NAME="ROG Store"\n'
printf 'APP_ENV=production\n'
printf 'APP_KEY=%s\n'    "${APP_KEY:-}"
printf 'APP_DEBUG=false\n'
printf 'APP_URL=%s\n'    "${APP_URL:-https://rog-store.onrender.com}"
printf 'APP_LOCALE=en\n'
printf 'LOG_CHANNEL=stderr\n'
printf 'LOG_LEVEL=error\n'

# ── Database: use PostgreSQL if DATABASE_URL given, else SQLite ───────────────
if [ -n "$DATABASE_URL" ]; then
    echo "==> Using PostgreSQL (DATABASE_URL found)"
    # Parse with Python
    DB_VALS=$(python3 -c "
import os, urllib.parse
url = os.environ['DATABASE_URL'].replace('postgres://', 'postgresql://', 1)
p = urllib.parse.urlparse(url)
print(f'DB_CONNECTION=pgsql')
print(f'DB_HOST={p.hostname}')
print(f'DB_PORT={p.port or 5432}')
print(f'DB_DATABASE={p.path.lstrip(\"/\")}')
print(f'DB_USERNAME={p.username}')
print(f'DB_PASSWORD={p.password}')
print(f'DB_SSLMODE=require')
")
    printf '%s\n' "$DB_VALS"
else
    echo "==> No DATABASE_URL — using SQLite"
    printf 'DB_CONNECTION=sqlite\n'
    printf 'DB_DATABASE=/var/www/html/database/database.sqlite\n'
fi

printf 'SESSION_DRIVER=file\n'
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

echo "==> DB_CONNECTION: $(grep DB_CONNECTION .env)"

# ── SQLite: ensure file exists ────────────────────────────────────────────────
if grep -q 'DB_CONNECTION=sqlite' .env; then
    touch /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
fi

# ── APP_KEY ───────────────────────────────────────────────────────────────────
php artisan key:generate --force --no-interaction

# ── Migrate ───────────────────────────────────────────────────────────────────
echo "==> Running migrations..."
php artisan migrate --force --no-interaction

# ── Seed ──────────────────────────────────────────────────────────────────────
echo "==> Seeding..."
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true

# ── Storage ───────────────────────────────────────────────────────────────────
php artisan storage:link --force 2>/dev/null || true

# ── Cache ─────────────────────────────────────────────────────────────────────
echo "==> Caching..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
