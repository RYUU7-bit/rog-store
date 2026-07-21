#!/bin/sh
set -e

cd /var/www/html

echo "==> Generating app key if missing..."
php artisan key:generate --no-interaction --force 2>/dev/null || true

echo "==> Running migrations..."
php artisan migrate --force --no-interaction

echo "==> Seeding database (if fresh)..."
php artisan db:seed --class=DatabaseSeeder --force --no-interaction 2>/dev/null || true

echo "==> Creating storage link..."
php artisan storage:link --force 2>/dev/null || true

echo "==> Clearing and caching config..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
