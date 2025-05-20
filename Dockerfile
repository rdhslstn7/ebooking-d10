FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip bcmath intl gd

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . .

# Install dependencies
RUN composer install --optimize-autoloader --no-dev \
    && php artisan config:clear \
    && php artisan route:clear

# Set file permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port
EXPOSE 10000

# Start Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
