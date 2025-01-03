# Stage 1: Build dependencies and install composer
FROM composer:2.6 as builder

# Set working directory
WORKDIR /app

# Copy composer files and install dependencies
COPY src/composer.json src/composer.lock ./
RUN composer install --no-dev --optimize-autoloader -v --no-interaction

# Copy application files
COPY src ./

# Stage 2: Production environment
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql intl opcache zip bcmath ctype xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy files from the builder stage
COPY --from=builder /app /var/www/html

# Create necessary directories and set permissions
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer globally
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Clear Composer cache
RUN composer clear-cache

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
