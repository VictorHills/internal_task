# Use the official PHP 8.1 FPM image as a base
FROM php:8.1-fpm

# Install the DOM extension
RUN apt-get update && \
    apt-get install -y libxml2-dev && \
    docker-php-ext-install dom

# Update package repository and install required packages
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip \
    && pecl install redis \
    && docker-php-ext-enable redis

# Copy your application code to the container (make sure you're in the right directory)
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# If you're using Composer, you can also include the composer install command:

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# RUN composer install --no-interaction

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
