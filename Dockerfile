FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable rewrite (important for routing later)
RUN a2enmod rewrite

WORKDIR /var/www/html