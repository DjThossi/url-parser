FROM php:7.3-cli

ARG PHP_ENV_NAME
ENV PHP_ENV_NAME ${PHP_ENV_NAME:-production}
RUN mv "$PHP_INI_DIR/php.ini-$PHP_ENV_NAME" "$PHP_INI_DIR/php.ini" && \
    echo 'date.timezone = Europe/Berlin' >> "$PHP_INI_DIR/php.ini"

RUN ln -snf /usr/share/zoneinfo/Europe/Berlin /etc/localtime

RUN apt-get update && apt-get install -my \
  wget \
  git \
  zip \
  && rm -rf /var/lib/apt/lists/*

COPY composer-installer.sh /tmp/
RUN /tmp/composer-installer.sh && rm /tmp/composer-installer.sh

RUN pecl install xdebug-2.7.1 \
  && docker-php-ext-enable xdebug

WORKDIR /var/www/html
