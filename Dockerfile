FROM php:8.2-apache

RUN docker-php-ext-install mysqli

COPY ./api /var/www/html/api
COPY ./sql /docker-entrypoint-initdb.d

EXPOSE 80
