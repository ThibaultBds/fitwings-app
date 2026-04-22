FROM php:8.2-apache

# Activer rewrite
RUN a2enmod rewrite

# Installer PDO + MySQL driver
RUN docker-php-ext-install pdo pdo_mysql

# Installer l'extension MongoDB + utilitaires necessaires a Composer
RUN apt-get update \
    && apt-get install -y libssl-dev pkg-config unzip git msmtp \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm /tmp/composer-setup.php

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/zzz-mailhog.ini
COPY docker/msmtprc /etc/msmtprc

RUN chown www-data:www-data /etc/msmtprc \
    && chmod 600 /etc/msmtprc \
    && touch /var/log/msmtp.log \
    && chown www-data:www-data /var/log/msmtp.log

WORKDIR /var/www/html






















