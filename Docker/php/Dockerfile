FROM php:8.2-fpm-alpine

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS  \
    && apk add --update linux-headers  \
    && pecl install xdebug  \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

RUN /bin/sh -c "docker-php-ext-install pdo_mysql  \
    && docker-php-ext-enable pdo_mysql  \
    && docker-php-ext-install opcache  \
    && docker-php-ext-enable opcache  \
    && apk add --no-cache icu-dev  \
    && docker-php-ext-install intl"

RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer