FROM php:8.2-apache

# Activer rewrite
RUN a2enmod rewrite

# Installer PDO + MySQL driver
RUN docker-php-ext-install pdo pdo_mysql

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html