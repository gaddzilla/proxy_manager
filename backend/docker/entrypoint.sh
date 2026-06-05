#!/usr/bin/env sh
set -e

if [ "${DB_CONNECTION}" = "mysql" ]; then
  echo "Waiting for MySQL at ${DB_HOST}:${DB_PORT:-3306}..."

  until php -r "new PDO('mysql:host=${DB_HOST};port=${DB_PORT:-3306}', '${DB_USERNAME}', '${DB_PASSWORD}');" >/dev/null 2>&1; do
    sleep 1
  done
fi

if [ "${RUN_MIGRATIONS}" = "true" ]; then
  php artisan migrate --force
fi

exec "$@"
