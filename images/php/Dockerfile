FROM php:7.1-fpm

MAINTAINER Martin Malovanets <cybersoul13@gmail.com>

RUN apt-get update && apt-get install -y \
  curl \
  wget \
  git \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libcurl4-openssl-dev \
  pkg-config \
  libssl-dev \
  && docker-php-ext-install -j$(nproc) iconv mcrypt mbstring zip json \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN pecl install mongodb

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www

CMD ["php-fpm"]