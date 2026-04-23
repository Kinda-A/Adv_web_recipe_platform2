#!/usr/bin/env bash
set -e

echo "[start.sh] starting php-fpm in background"
php-fpm -D || true

echo "[start.sh] attempting to start nginx"

# Prefer nginx found in PATH
if command -v nginx >/dev/null 2>&1; then
	echo "[start.sh] found nginx in PATH: $(command -v nginx)"
	exec nginx -g 'daemon off;'
fi

# Try common absolute locations
if [ -x /usr/sbin/nginx ]; then
	echo "[start.sh] found nginx at /usr/sbin/nginx"
	exec /usr/sbin/nginx -g 'daemon off;'
fi

if [ -x /sbin/nginx ]; then
	echo "[start.sh] found nginx at /sbin/nginx"
	exec /sbin/nginx -g 'daemon off;'
fi

echo "[start.sh] ERROR: nginx binary not found. PATH=$PATH"
echo "[start.sh] listing /usr/sbin:"; ls -la /usr/sbin || true
echo "[start.sh] listing /sbin:"; ls -la /sbin || true

# Keep the container running for debugging so logs can be inspected
tail -f /dev/null