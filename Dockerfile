# Use a base PHP image for Laravel
FROM php:8.1-fpm

# Install system dependencies and Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    git \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && apt-get install -y curl gnupg2 lsb-release ca-certificates

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy the application files
COPY . .

# Install PHP and npm dependencies
RUN composer install
RUN npm install  # This is where npm install is failing, ensure npm is available now

# Expose port (optional)
EXPOSE 80

# Start Laravel with PHP-FPM
CMD ["php-fpm"]
