# Use the official Laravel Sail PHP image with Composer
FROM laravelsail/php82-composer:latest

# Set working directory
WORKDIR /var/www/html

# Install system dependencies needed for SQLite
RUN apt-get update && apt-get install -y \
    sqlite3 libsqlite3-dev unzip curl git

# Copy your Laravel app into the image
COPY . .

# Set appropriate permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Install composer dependencies (optimized, no dev)
RUN composer install --no-dev --optimize-autoloader

# Ensure the SQLite database file exists
RUN touch storage/database.sqlite && chmod -R 775 storage

# Set environment to production
ENV APP_ENV=production
ENV APP_DEBUG=false

# Expose port 8080 for Fly.io
EXPOSE 8080

# Start Laravel's built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
