FROM php:8.1-apache

WORKDIR /var/www/html/

RUN rm -rf * && apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pgsql pdo pdo_pgsql
RUN a2enmod rewrite
# We need to run lines independently to avoid build errors

COPY . .

EXPOSE 80