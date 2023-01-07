#--------------------------------------------------------------------------
# PHP 8.2 With Apache
#-------------------------------------------------------------------------- 
FROM php:8.2-apache

#--------------------------------------------------------------------------
# Label - ZN Framework
#-------------------------------------------------------------------------- 
LABEL maintainer="robot@znframework.com"

#--------------------------------------------------------------------------
# MySQLi Installation
#-------------------------------------------------------------------------- 
RUN docker-php-ext-install mysqli

#--------------------------------------------------------------------------
# Posgtres Installation
#-------------------------------------------------------------------------- 
RUN apt-get update && apt-get install -y libpq-dev 
RUN docker-php-ext-install pgsql

#--------------------------------------------------------------------------
# Redis Installation
#-------------------------------------------------------------------------- 
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

#--------------------------------------------------------------------------
# Memcached Installation
#-------------------------------------------------------------------------- 
RUN apt-get update && apt-get install -y libz-dev libmemcached-dev && \
    pecl install memcached && docker-php-ext-enable memcached

#--------------------------------------------------------------------------
# APC/U Installation
#-------------------------------------------------------------------------- 
RUN pecl install apcu && docker-php-ext-enable apcu
RUN printf "\napc.enable_cli=On" >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini

#--------------------------------------------------------------------------
# OPCache Installation
#-------------------------------------------------------------------------- 
RUN docker-php-ext-install opcache && docker-php-ext-enable opcache  

#--------------------------------------------------------------------------
# ZIP Installation
#-------------------------------------------------------------------------- 
RUN apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-install zip

#--------------------------------------------------------------------------
# GD Installation
#-------------------------------------------------------------------------- 
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

#--------------------------------------------------------------------------
# Wget Installation
#-------------------------------------------------------------------------- 
RUN apt-get install -y wget

#--------------------------------------------------------------------------
# Composer Installation
#-------------------------------------------------------------------------- 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#--------------------------------------------------------------------------
# Apache Rewrite Mode On
#-------------------------------------------------------------------------- 
RUN a2enmod rewrite

#--------------------------------------------------------------------------
# Document Root
#--------------------------------------------------------------------------
WORKDIR /var/www/html