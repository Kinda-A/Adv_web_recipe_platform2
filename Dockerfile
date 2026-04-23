# Dockerfile - Multi-stage build for Laravel 11 (PHP 8.2)
FROM php:8.2-fpm AS base

ARG user=www-data
ARG uid=1000

# Install system deps and PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring exif pcntl bcmath gd intl zip \
    && rm -rf /var/lib/apt/lists/*

# Install composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Composer stage (cached)
FROM base AS vendor
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader --no-scripts

# Node build stage
FROM node:18-alpine AS node-build
WORKDIR /app
COPY package*.json vite.config.js ./
RUN npm ci --production=false
COPY resources ./resources
RUN npm run build

# Final image
FROM base AS final
WORKDIR /var/www/html
COPY . .
COPY --from=vendor /var/www/html/vendor ./vendor
COPY --from=node-build /app/public ./public

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN composer dump-autoload --optimize --no-dev --classmap-authoritative || true

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
