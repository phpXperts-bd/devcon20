FROM php:7.2-fpm

# RUN printf "deb http://archive.debian.org/debian/ jessie main\ndeb-src http://archive.debian.org/debian/ jessie main\ndeb http://security.debian.org jessie/updates main\ndeb-src http://security.debian.org jessie/updates main" > /etc/apt/sources.list

RUN apt-get update && apt-get install -y \
    git \
    zip \
    nginx \
        libfreetype6-dev \
        libmcrypt-dev \
        zlib1g \
        zlib1g-dev \
        libicu-dev \
        libxpm-dev \
        libssl-dev \
        libjpeg-dev \
        libpng-dev \
        libicu-dev \
        libwebp-dev \
        libxpm-dev \
        libxml2-dev \
        g++ \
        supervisor \
    && docker-php-ext-install iconv \
        pdo_mysql \
        zip \
        mbstring \
        dom

RUN docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/freetype2 \
        --with-png-dir=/usr/include \
        --with-jpeg-dir=/usr/include \
        --with-webp-dir=/usr/include \
    && docker-php-ext-install gd \
    && docker-php-ext-enable gd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN pecl install redis \
&&  docker-php-ext-enable redis

RUN apt-get update && apt-get install -y \
        libmagickwand-dev --no-install-recommends

RUN pecl install imagick && docker-php-ext-enable imagick

RUN rm /etc/nginx/sites-available/default

ADD supervisor-worker.conf /etc/supervisor/conf.d/worker.conf

WORKDIR /var/www/app

COPY init.sh /usr/local/bin

RUN curl -sS https://getcomposer.org/installer | \
php -- --install-dir=/usr/bin/ --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER=1

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/app

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/app

# Change current user to www
USER www

ENTRYPOINT ["/usr/local/bin/init.sh"]
