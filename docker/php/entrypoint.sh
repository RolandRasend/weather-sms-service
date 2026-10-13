#!/bin/bash

# Install dependencies if composer.json exists
if [ -f "composer.json" ]; then
    echo "Checking for composer dependencies..."
    composer install --no-interaction --optimize-autoloader
fi

# Start supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
