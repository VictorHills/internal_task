# Dockerfile for the "notifications" service using Nginx

# official PHP image
FROM php:8.1-fpm

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Install the PHP extensions you need
RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory in the container
WORKDIR /var/www

# Copy the application source code to the container
COPY . /var/www/

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install dependencies with Composer
RUN composer install --no-dev --optimize-autoloader

# Configure Nginx for Symfony
COPY ./docker/notifications/nginx.conf /etc/nginx/sites-available/default

# Expose port 80
EXPOSE 80

# Start Nginx and PHP-FPM
CMD service php8.1-fpm start && nginx -g 'daemon off;'
