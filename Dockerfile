FROM php:8.2-apache

RUN docker-php-ext-install mysqli

# Copy API PHP vào container
COPY ./api /var/www/html/api

EXPOSE 80
