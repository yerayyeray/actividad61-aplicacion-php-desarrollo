FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

COPY conf/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY conf/servername.conf /etc/apache2/conf-available/servername.conf
RUN a2enconf servername || true

WORKDIR /var/www/html
COPY src/ .

RUN chown -R www-data:www-data /var/www/html