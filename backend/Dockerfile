# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html/

# Copy the current directory contents into the container at /var/www/html
COPY ../backend/. /var/www/html/



# Install any needed packages
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip

# Install PHP extensions
RUN docker-php-ext-install intl zip
RUN docker-php-ext-install mysqli pdo_mysql

# Enable Apache module rewrite
RUN a2enmod rewrite

# Change uid and gid of Apache to Docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Change the web_root to CakePHP /var/www/html/webroot folder
RUN sed -i -e "s|/var/www/html|/var/www/html/backend/webroot|g" /etc/apache2/sites-enabled/000-default.conf

# Set up Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Install Composer dependencies
# RUN composer install --no-interaction

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for Apache
EXPOSE 80

# Command to run on container start
CMD ["apache2-foreground"]
