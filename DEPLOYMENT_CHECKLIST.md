# Deployment Checklist - After Pulling Changes

## 1. Install/Update Dependencies
```bash
composer install --no-dev --optimize-autoloader
# or if you need dev dependencies:
composer install
```

## 2. Run Database Migrations
```bash
php artisan migrate
# Check migration status first:
php artisan migrate:status
```

## 3. Clear All Caches
```bash
# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Clear compiled files
php artisan clear-compiled
```

## 4. Optimize Application (Production)
```bash
# Cache configuration (faster in production)
php artisan config:cache

# Cache routes (faster in production)
php artisan route:cache

# Cache views (faster in production)
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

## 5. Set Storage Permissions
```bash
# Set ownership to web server user (usually www-data)
sudo chown -R www-data:www-data storage bootstrap/cache

# Set proper permissions
sudo chmod -R 775 storage bootstrap/cache

# Ensure log file is writable
touch storage/logs/laravel.log
chmod 664 storage/logs/laravel.log
```

## 6. Create Storage Link (if not exists)
```bash
php artisan storage:link
```

## 7. Check Environment Configuration
```bash
# Verify .env file exists and has correct values
cat .env | grep -E "APP_ENV|APP_DEBUG|DB_|CACHE_"
```

## 8. Restart Services (if needed)
```bash
# If using queue workers
php artisan queue:restart

# If using supervisor, restart supervisor
sudo supervisorctl restart all

# If using PHP-FPM
sudo service php8.1-fpm restart
# or
sudo systemctl restart php-fpm
```

## 9. Verify Application
- Check if application loads correctly
- Test admin panel access
- Verify file uploads work (berita images, staff photos)
- Check if modals and AJAX requests work

## 10. Check Logs for Errors
```bash
tail -f storage/logs/laravel.log
```

## Quick One-Liner (Development)
```bash
php artisan migrate && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear
```

## Quick One-Liner (Production)
```bash
composer install --no-dev --optimize-autoloader && \
php artisan migrate --force && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan queue:restart
```
