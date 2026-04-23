#!/usr/bin/env bash
set -e

echo "[start.sh] starting php-fpm in background"
php-fpm -D || true

echo "[start.sh] starting nginx"
exec nginx -g 'daemon off;'