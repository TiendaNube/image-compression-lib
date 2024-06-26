FROM ubuntu:20.04
COPY --from=composer:1.10.7 /usr/bin/composer /usr/bin/composer

WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive
ARG PHP_VERSION=7.1

RUN export LANG=C.UTF-8 \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
      git \
      software-properties-common \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        jpegoptim \
        gifsicle \
        optipng \
        pngquant \
        webp \
        php${PHP_VERSION} \
        php${PHP_VERSION}-geoip \
        php${PHP_VERSION}-imagick \
        php${PHP_VERSION}-mbstring \
        php${PHP_VERSION}-mysql \
        php${PHP_VERSION}-phpdbg \
        php${PHP_VERSION}-sqlite \
        php${PHP_VERSION}-soap \
        php${PHP_VERSION}-xdebug \
        php${PHP_VERSION}-xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Override ini file
COPY .docker/php-cli/php-ini-overrides.ini /etc/php/7.0/cli/conf.d/99-overrides.ini
