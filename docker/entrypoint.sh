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

# If a PORT is provided (Render sets $PORT), patch nginx to listen on it
if [ -n "${PORT}" ] && [ -f /etc/nginx/conf.d/default.conf ]; then
  sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/conf.d/default.conf || true
fi

# If the start command is nginx, ensure php-fpm runs in the background first
if [ "$#" -gt 0 ]; then
  if echo "$1" | grep -q "nginx"; then
    echo "[entrypoint] starting php-fpm in background for nginx"
    php-fpm -D || true
  fi
fi

echo "[entrypoint] finished - executing: $@"

# If the command was supplied as a single string (some platforms pass the whole startCommand
# as one argument), run it through the shell so quoted args are parsed correctly.
if [ "$#" -eq 1 ]; then
  echo "[entrypoint] single-arg start command detected; executing via sh -c"
  exec sh -c "$1"
else
  # Sanitize args: remove surrounding single/double quotes that may be embedded
  args=("$@")
  for i in "${!args[@]}"; do
    # strip leading/trailing double quotes
    args[$i]="${args[$i]#\"}"
    args[$i]="${args[$i]%\"}"
    # strip leading/trailing single quotes
    args[$i]="${args[$i]#\'}"
    args[$i]="${args[$i]%\'}"
  done

  # Special-case nginx -g "daemon off;": combine subsequent tokens into a single argument after -g
  for idx in "${!args[@]}"; do
    if [ "${args[$idx]}" = "-g" ]; then
      # combine remaining tokens into one argument
      combined=""
      for ((j=idx+1; j<${#args[@]}; j++)); do
        if [ -z "$combined" ]; then
          combined="${args[$j]}"
        else
          combined="$combined ${args[$j]}"
        fi
      done
      newargs=("${args[@]:0:$((idx+1))}")
      newargs+=("$combined")
      echo "[entrypoint] executing reconstructed command: ${newargs[*]}"
      exec "${newargs[@]}"
    fi
  done

  echo "[entrypoint] executing sanitized args: ${args[*]}"
  exec "${args[@]}"
fi
