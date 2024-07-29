FROM php:7.4-apache

# Install PDO and mysqli extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy Apache configuration (create this file as mentioned before)
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copy PHP files
COPY *.php /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80