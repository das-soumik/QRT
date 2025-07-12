# Use official PHP 8.1 image with Apache
FROM php:8.1-apache

# Enable Apache rewrite module (optional)
RUN a2enmod rewrite

# Install mysqli extension for MySQL
RUN docker-php-ext-install mysqli

# Set working directory
WORKDIR /var/www/html

# Copy everything from repo root into Apache public folder
COPY . /var/www/html/

# Fix permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
