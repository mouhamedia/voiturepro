FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev libpng-dev zip unzip git curl

RUN docker-php-ext-install pdo pdo_pgsql gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000