# Use an official PHP image
FROM php:8.2-apache

# Copy project files
COPY . /var/www/html/

# Enable necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
