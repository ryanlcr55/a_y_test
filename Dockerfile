FROM composer:2 as build
WORKDIR /app
COPY . /app
RUN composer install

FROM php:8-fpm-buster
RUN  sed -i 's/deb.debian.org/opensource.nchc.org.tw/g'  /etc/apt/sources.list

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libmemcached-dev \
        libz-dev \
        libpq-dev \
        libssl-dev \
        libmcrypt-dev \
        openssh-server \
        libxml2-dev \
        libzip-dev \
        unzip \
        && rm -r /var/lib/apt/lists/*

RUN docker-php-ext-install soap exif pcntl zip pdo_mysql bcmath

COPY --from=build /app /var/www

# Source the bash
RUN . ~/.bashrc

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
WORKDIR /var/www

COPY .docker/php/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh && \
    chmod 777 -R storage bootstrap/cache
RUN ln -s /usr/local/bin/docker-entrypoint.sh /

ENTRYPOINT ["docker-entrypoint.sh"]

EXPOSE 9000
CMD ["php-fpm"]
