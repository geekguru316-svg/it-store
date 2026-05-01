#!/bin/bash
set -e

# Install PHP extensions and Composer
apt-get update && apt-get install -y php-cli php-zip php-mbstring php-xml php-curl php-pgsql php-gd php-dom

# Download and install Composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies (production)
composer install --optimize-autoloader --no-dev --no-interaction

# Install Node.js dependencies and build assets (Vite + Tailwind)
npm install
npm run build

# Generate app key if not set
php artisan key:generate --force --no-interaction || true

# Create storage symlink
php artisan storage:link --force || true

# Cache configuration for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
php artisan migrate --force --no-interaction