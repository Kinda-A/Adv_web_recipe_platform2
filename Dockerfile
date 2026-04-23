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

# Node build stage (use Node 20 slim for Vite >=20 and native bindings)
FROM node:20-bullseye-slim AS node-build
WORKDIR /app
# Install build dependencies required for native modules during npm install
RUN apt-get update && apt-get install -y --no-install-recommends \
    python3 \
    build-essential \
    git \
    && rm -rf /var/lib/apt/lists/*
COPY package*.json vite.config.js ./
# Prefer deterministic install, but fall back to `npm install` when `npm ci` fails
# This helps with optional native deps and package-lock mismatches seen in CI builds.
RUN npm ci --production=false --no-audit --no-fund || \
    npm install --no-audit --no-fund --no-optional --legacy-peer-deps
COPY resources ./resources
RUN npm run build

# Final image
FROM base AS final
WORKDIR /var/www/html
COPY . .
COPY --from=vendor /var/www/html/vendor ./vendor
COPY --from=node-build /app/public ./public

# Install nginx and copy configuration
RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends nginx \
    && ln -sf /usr/sbin/nginx /usr/local/bin/nginx || true \
    && nginx -v || true \
    && rm -rf /var/lib/apt/lists/*

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Copy start script and make executable
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

RUN composer dump-autoload --optimize --no-dev --classmap-authoritative || true

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/local/bin/start.sh"]
