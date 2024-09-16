#!/bin/bash

# Start PHP-FPM
php-fpm &

# Start the queue worker
php artisan queue:work &

# Keep the container running
wait