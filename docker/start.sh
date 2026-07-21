#!/bin/sh
set -e

cd /var/www/html

# ── 1. Generate app key (always ensure it exists) ────────────────────────────
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
    php artisan key:generate --force --no-interaction
fi

# ── 2. Run migrations ────────────────────────────────────────────────────────
echo "==> Running migrations..."
php artisan migrate --force --no-interaction

# ── 3. Seed only if fresh ────────────────────────────────────────────────────
echo "==> Seeding database (if fresh)..."
php artisan db:seed --class=DatabaseSeeder --force --no-interaction || true

# ── 4. Storage link ──────────────────────────────────────────────────────────
echo "==> Creating storage link..."
php artisan storage:link --force 2>/dev/null || true

# ── 5. Clear all caches then rebuild ─────────────────────────────────────────
echo "==> Caching config, routes, views..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting nginx + php-fpm..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
