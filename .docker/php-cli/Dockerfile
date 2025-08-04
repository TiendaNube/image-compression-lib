FROM ubuntu:22.04
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

ARG PHP_VERSION=7.3

RUN apt-get update \
    && apt-get -y install  \
      awscli  \
      curl \
      git  \
      software-properties-common \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
      dnsutils \
      gifsicle  \
      jpegoptim  \
      optipng  \
      mysql-client-8.0 \
      php${PHP_VERSION}-cli \
      php${PHP_VERSION}-common \
      php${PHP_VERSION}-curl \
      php${PHP_VERSION}-geoip \
      php${PHP_VERSION}-gd \
      php${PHP_VERSION}-imagick \
      php${PHP_VERSION}-json \
      php${PHP_VERSION}-mysql \
      php${PHP_VERSION}-phpdbg \
      php${PHP_VERSION}-sqlite3 \
      php${PHP_VERSION}-soap \
      php${PHP_VERSION}-xdebug \
      php${PHP_VERSION}-xml \
      php${PHP_VERSION}-zip \
      pngquant  \
      webp

# Install mailhog client
ENV PATH=/usr/local/go/bin:$PATH

RUN curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' | tar -C '/usr/local' -xvzf - \
    && go get github.com/mailhog/mhsendmail \
    && cp /root/go/bin/mhsendmail /usr/bin/mhsendmail

# Image Cleanup
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Override ini file
COPY .docker/php-cli/php-ini-overrides.ini /etc/php/${PHP_VERSION}/cli/conf.d/99-overrides.ini
COPY .docker/php-cli/php-ini-overrides-phpdbg.ini /etc/php/${PHP_VERSION}/cli/conf.d/99-overrides.ini
