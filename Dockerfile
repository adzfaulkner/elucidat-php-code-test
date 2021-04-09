FROM php:7.4-cli-alpine

RUN apk add --no-cache zip libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app