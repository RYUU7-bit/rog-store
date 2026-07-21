FROM php:8.3-fpm-alpine

# ── System deps ───────────────────────────────────────────────────────────────
RUN apk add --no-cache \
    nginx \
    python3 \
    py3-pip \
    nodejs \
    npm \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    postgresql16-dev \
    oniguruma-dev \
    supervisor \
    shadow

# ── PHP extensions ────────────────────────────────────────────────────────────
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    gd \
    zip \
    mbstring \
    exif \
    pcntl \
    bcmath \
    opcache

# ── PHP opcache config ────────────────────────────────────────────────────────
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
 && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
 && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini \
 && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini

# ── Composer ──────────────────────────────────────────────────────────────────
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ── Python bakong-khqr ────────────────────────────────────────────────────────
COPY requirements.txt ./
RUN pip3 install --no-cache-dir --break-system-packages -r requirements.txt

# ── PHP deps ──────────────────────────────────────────────────────────────────
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts

# ── Node deps + build assets ──────────────────────────────────────────────────
COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts

COPY . .

RUN npm run build

# ── Post-install scripts ──────────────────────────────────────────────────────
RUN composer run-script post-autoload-dump 2>/dev/null || true

# ── Permissions ───────────────────────────────────────────────────────────────
RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache/data \
    storage/logs \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache \
 && chown -R www-data:www-data /var/www/html

# ── Configs ───────────────────────────────────────────────────────────────────
COPY docker/nginx.conf      /etc/nginx/http.d/default.conf
COPY docker/php-fpm.conf    /usr/local/etc/php-fpm.d/www.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/start.sh        /start.sh
RUN chmod +x /start.sh

EXPOSE 10000

CMD ["/start.sh"]
