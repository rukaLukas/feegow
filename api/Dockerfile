FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/api/

# Install dependencies for the operating system software
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

# install amqp extension
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install bcmath
# RUN apt-get update && apt-get install -y pecl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install default extensions for laravel
RUN docker-php-ext-install mbstring pcntl

# Copy existing application directory contents to the working directory
COPY . /var/www/api

# Assign permissions of the working directory to the www-data user
RUN chown -R www-data:www-data \
     /var/www/api/storage \
     /var/www/api/bootstrap/cache

# Create the log file and set the ownership to www-data
RUN touch /var/www/api/storage/logs/laravel.log && \
    chown www-data:www-data /var/www/api/storage/logs/laravel.log

# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose port 9000 and start php-fpm server (for FastCGI Process Manager)
EXPOSE 9000
CMD [ "php-fpm" ]
