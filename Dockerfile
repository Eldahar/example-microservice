FROM php:7.4-fpm
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
 && docker-php-ext-enable zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get install -y git vim

WORKDIR /srv