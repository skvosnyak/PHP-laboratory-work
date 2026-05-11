#!/bin/sh
set -e

php artisan config:cache
php artisan route:cache
php artisan view:cache

chown -R www-data:www-data storage bootstrap/cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
