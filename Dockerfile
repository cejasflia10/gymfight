FROM php:8.2-apache

# Instalar extensiones necesarias para MySQLi
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copiar archivos del proyecto
COPY . /var/www/html/

EXPOSE 80
