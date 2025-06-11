FROM php:8.2-apache

# Instalación de la extensión MySQLi
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

COPY . /var/www/html/

EXPOSE 80
