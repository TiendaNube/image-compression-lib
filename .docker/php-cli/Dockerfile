FROM phpdockerio/php74-cli:latest
WORKDIR "/application"

ARG DEBIAN_FRONTEND=noninteractive

RUN export LANG=C.UTF-8 \
    && apt-get update \
    && apt-get -y --no-install-recommends install  \
      git \
      software-properties-common \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        php7.4-imagick \
        php7.4-geoip \
        php7.4-mysql \
        php7.4-phpdbg \
        php7.4-sqlite \
        php7.4-soap \
        php7.4-xdebug \
        jpegoptim \
        optipng \
        pngquant \
        gifsicle \
        webp \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Override ini file
COPY .docker/php-cli/php-ini-overrides.ini /etc/php/7.0/cli/conf.d/99-overrides.ini
COPY .docker/php-cli/php-ini-overrides-phpdbg.ini /etc/php/7.0/phpdbg/conf.d/99-overrides.ini
