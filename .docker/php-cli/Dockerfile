FROM phpdockerio/php7-cli:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install git php7.0-mysql php7.0-sqlite php-geoip php-imagick \
    php7.0-soap php-xdebug php7.0-phpdbg awscli jpegoptim optipng pngquant gifsicle webp dnsutils

RUN curl -sL https://deb.nodesource.com/setup_15.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g svgo

# Install mailhog client
ENV PATH /usr/local/go/bin:$PATH

RUN curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' | tar -C '/usr/local' -xvzf - \
    && go get github.com/mailhog/mhsendmail \
    && cp /root/go/bin/mhsendmail /usr/bin/mhsendmail

# Install mysqldump which is used in `up.sh`
RUN apt-get update \
    && apt-get install -y --no-install-recommends mysql-client

# Image Cleanup
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Override ini file
COPY .docker/php-cli/php-ini-overrides.ini /etc/php/7.0/cli/conf.d/99-overrides.ini
COPY .docker/php-cli/php-ini-overrides-phpdbg.ini /etc/php/7.0/phpdbg/conf.d/99-overrides.ini
