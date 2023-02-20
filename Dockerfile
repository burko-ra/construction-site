FROM composer:latest AS composer
FROM php:latest
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt update && apt install -y git
WORKDIR /app