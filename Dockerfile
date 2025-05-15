FROM php:8.1-apache

# Installa estensioni PHP necessarie per Yii
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev libssl-dev \
    && docker-php-ext-install pdo_mysql mbstring zip gd mysqli


# Abilita mod_rewrite di Apache
RUN a2enmod rewrite

# Copia configurazione php.ini personalizzata
COPY php.ini /usr/local/etc/php/

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Imposta DocumentRoot su /var/www/html/web
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/web|g' /etc/apache2/sites-available/000-default.conf
