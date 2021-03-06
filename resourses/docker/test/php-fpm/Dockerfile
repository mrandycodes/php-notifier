FROM php:8.0-fpm

RUN apt-get update \
    && apt-get install -y git zip libzip-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV APP_ENV=TEST
