FROM composer:1.9.3 as build
WORKDIR /app
COPY . /app
RUN composer install

FROM php:7.4-apache
EXPOSE 80

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

COPY --from=build /app /app
COPY . /app
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data /app 
RUN a2enmod rewrite
