#!/bin/bash
set -e

# Run database migrations
php artisan migrate --force

# Create storage link if not exists
php artisan storage:link --force || true

# Cache configurations for speed
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute the main container command (CMD)
exec "$@"
