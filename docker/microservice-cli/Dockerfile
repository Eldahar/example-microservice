FROM php:8-cli
#RUN apt-get update && apt-get install -y \
#        libfreetype6-dev \
#        libjpeg62-turbo-dev \
#        libpng-dev \
#    && docker-php-ext-configure gd --with-freetype --with-jpeg \
#    && docker-php-ext-install -j$(nproc) gd
RUN apt-get update && \
    apt-get install -y libzip-dev
RUN pecl install xdebug zip \
 && docker-php-ext-configure zip \
 && docker-php-ext-install zip \
 && docker-php-ext-enable xdebug \
 && docker-php-ext-enable zip \
 && docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get install -y git vim
RUN apt-get install -y librabbitmq-dev libssh-dev

ENV EXT_AMQP_VERSION=master

RUN docker-php-source extract \
    && git clone --branch $EXT_AMQP_VERSION --depth 1 https://github.com/php-amqp/php-amqp.git /usr/src/php/ext/amqp \
    && cd /usr/src/php/ext/amqp && git submodule update --init \
    && docker-php-ext-install amqp

RUN docker-php-ext-install sockets
RUN apt-get install -y supervisor

WORKDIR /srv