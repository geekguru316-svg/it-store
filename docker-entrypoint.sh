#!/bin/bash
set -e

# Run database migrations
php artisan migrate --force

# Automatically seed the database if it is empty
php artisan tinker --execute="if(\App\Models\Product::count() == 0) { Artisan::call('db:seed', ['--class' => 'ProductSeeder', '--force' => true]); echo 'Database seeded.'; }"

# Create storage link if not exists
php artisan storage:link --force || true

# Cache configurations for speed
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute the main container command (CMD)
exec "$@"
