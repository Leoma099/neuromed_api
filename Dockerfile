# Use an official PHP image as a base
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy the existing application directory contents
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --no-scripts

# **Run migrations**
RUN php artisan migrate --force

# Expose port
EXPOSE 9000

# Run the Laravel server (make sure this matches your start command)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]