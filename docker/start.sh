#!/bin/sh
set -e
cd /var/www/html

echo "=========================================="
echo " Starting ROG Store Container on Render..."
echo "=========================================="

# ── Fix permissions on storage/bootstrap/database ────────────────────────────
mkdir -p storage/framework/sessions \
         storage/framework/views \
         storage/framework/cache/data \
         storage/logs \
         bootstrap/cache \
         database
chmod -R 777 storage bootstrap/cache database 2>/dev/null || true
chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null || true

# ── Clear any stale cached config from previous builds ────────────────────────
rm -f bootstrap/cache/config.php bootstrap/cache/routes-v7.php bootstrap/cache/services.php bootstrap/cache/packages.php 2>/dev/null || true
# Clear stale compiled Blade views so @yield/@section inheritance works correctly
rm -rf storage/framework/views/*.php 2>/dev/null || true

# ── Run dynamic environment & database initialization ─────────────────────────
php /var/www/html/docker/init-env.php

# ── If SQLite database exists, ensure proper permissions ──────────────────────
if [ -f /var/www/html/database/database.sqlite ]; then
    chmod 0777 /var/www/html/database/database.sqlite 2>/dev/null || true
    chown www-data:www-data /var/www/html/database/database.sqlite 2>/dev/null || true
fi

# ── Run migrations ────────────────────────────────────────────────────────────
echo "Running migrations..."
php artisan migrate --force --no-interaction || echo "Notice: Migration warning, continuing..."

# ── Check and seed database if empty ──────────────────────────────────────────
echo "Checking seed state..."
php /var/www/html/docker/seed-check.php || true

# ── Storage link & caching ────────────────────────────────────────────────────
php artisan storage:link --force 2>/dev/null || true
php artisan optimize:clear 2>/dev/null || true
php artisan config:cache || true
php artisan route:cache || true
# NOTE: view:cache is intentionally NOT run — pre-compiling Blade views with
# @extends/@section inheritance causes @yield('content') to render blank.
# Views compile on first request and are cached naturally by PHP's opcache.

echo "Starting Nginx & PHP-FPM via Supervisord..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
