#!/bin/bash
set -e

cd /var/www

if [ ! -d "vendor/mezzio" ] || [ composer.json -nt composer.lock ]; then
    composer update --no-interaction --optimize-autoloader
else
    composer install --no-interaction --optimize-autoloader
fi

exec "$@"
