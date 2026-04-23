#!/usr/bin/env bash
set -e

echo "[entrypoint] starting - $(date)"

# Ensure storage and cache directories exist and have correct permissions
mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache || true

# Install composer dependencies if missing
if [ ! -f /var/www/html/vendor/autoload.php ]; then
  echo "[entrypoint] composer dependencies not found, installing..."
  composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader || true
fi

# Generate app key if not provided
if [ -z "${APP_KEY}" ]; then
  echo "[entrypoint] APP_KEY is empty — generating"
  php artisan key:generate --ansi || true
fi

# Run migrations if enabled
if [ "${RUN_MIGRATIONS}" = "true" ] || [ "${RUN_MIGRATIONS}" = "TRUE" ]; then
  echo "[entrypoint] running migrations"
  php artisan migrate --force || true
fi

# Clear Laravel caches safely (fixes stale config issues)
echo "[entrypoint] clearing Laravel caches"
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# If Render provides PORT, update nginx config
if [ -n "${PORT}" ] && [ -f /etc/nginx/conf.d/default.conf ]; then
  sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/conf.d/default.conf || true
fi

# Start php-fpm if nginx is used
if [ "$#" -gt 0 ]; then
  if echo "$1" | grep -q "nginx"; then
    echo "[entrypoint] starting php-fpm in background"
    php-fpm -D || true
  fi
fi

echo "[entrypoint] finished - executing command: $@"

# Handle single argument case (Render behavior)
if [ "$#" -eq 1 ]; then
  exec sh -c "$1"
else
  # Clean quotes from args
  args=("$@")
  for i in "${!args[@]}"; do
    args[$i]="${args[$i]#\"}"
    args[$i]="${args[$i]%\"}"
    args[$i]="${args[$i]#\'}"
    args[$i]="${args[$i]%\'}"
  done

  exec "${args[@]}"
fi