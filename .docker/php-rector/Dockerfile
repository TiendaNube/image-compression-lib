FROM php:7.4.33-cli-bullseye
COPY --from=composer:1.10.7 /usr/bin/composer /usr/bin/composer

RUN apt-get -y update \
    && apt-get -y install git zip unzip \
    && apt-get -y autoremove --purge \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && mkdir /rector \
    && cd /rector \
    && composer require rector/rector --dev

WORKDIR /application
