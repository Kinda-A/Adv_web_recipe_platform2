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

# Optionally run migrations when RUN_MIGRATIONS=true
if [ "${RUN_MIGRATIONS}" = "true" ] || [ "${RUN_MIGRATIONS}" = "TRUE" ]; then
  echo "[entrypoint] RUN_MIGRATIONS=true — running migrations"
  php artisan migrate --force || true
fi

# Cache config/routes in non-local environments
if [ "${APP_ENV}" != "local" ]; then
  echo "[entrypoint] Caching config and routes"
  php artisan config:cache || true
  php artisan route:cache || true
else
  echo "[entrypoint] APP_ENV=local — skipping config:cache"
fi

echo "[entrypoint] finished - executing: $@"
exec "$@"
