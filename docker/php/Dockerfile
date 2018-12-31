FROM php:7.3-fpm-alpine3.8

ARG USER_UID

RUN apk update && apk upgrade && \
    apk --no-cache add \
        acl

RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN addgroup -S -g $USER_UID 360-dev && \
    adduser -S -u $USER_UID -G 360-dev 360-dev

RUN chown -R 360-dev:360-dev /var/www/html

USER 360-dev

EXPOSE 9000
CMD ["php-fpm"]