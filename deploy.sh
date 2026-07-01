#!/bin/bash

# Deployment script for Laravel Application (Direct Host Environment)
# This script ensures the entire environment is correctly initialized and updated

echo "🚀 Starting full deployment and initialization..."

# 1. Update Code from GitHub
echo "📥 Syncing code with GitHub..."
git fetch --all
git reset --hard origin/main
git clean -fd

# 2. Fix Permissions
echo "🔐 Optimizing file permissions..."
chmod -R 775 storage bootstrap/cache
if [ "$(uname)" = "Linux" ]; then
    chown -R :www-data storage bootstrap/cache 2>/dev/null || echo "Webserver group adjustment skipped."
fi

# 3. Critical Dependencies Check
echo "📦 Managing dependencies..."
if [ ! -d "vendor" ]; then
    echo "⚠️ Vendor directory is missing. Installing..."
    composer install --no-interaction --prefer-dist
else
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# 4. Database Initialization
echo "🗄️ Initializing database..."
php artisan migrate --force

# 5. Optimize Application
echo "⚡ Optimizing Laravel..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Storage and Symbolic Links
echo "🔗 Verifying storage links..."
php artisan storage:link --force || echo "Storage link handling completed."

echo "✨ Deployment and Environment initialization successful!"
