FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/api/

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    locales \
    zip \
    vim \
    libonig-dev \
    curl \
    wget \
    libssl-dev \
    librabbitmq-dev   

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql bcmath mbstring pcntl

# Copy application files
COPY . /var/www/api

# Set permissions
RUN chown -R www-data:www-data /var/www/api/storage /var/www/api/bootstrap/cache
RUN touch /var/www/api/storage/logs/laravel.log && chown www-data:www-data /var/www/api/storage/logs/laravel.log

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose port
EXPOSE 9000

# Set the entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
