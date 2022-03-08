FROM php:7.4

WORKDIR /var/www/html/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .


RUN apt-get update && apt-get install -y libzip-dev zip unzip git libpq-dev && docker-php-ext-install pdo pdo_pgsql zip
RUN composer install --ignore-platform-req=ext-http --prefer-dist


