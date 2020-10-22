FROM debian:stretch
LABEL Maintainer="M A Hossain Tonu <mahtonu@vantage.com>" \
Description="phpXperts container with Nginx 1.13 & PHP-FPM 7.3 based on Debian."

#
ENV DEBIAN_FRONTEND noninteractive
ENV NGINX_VERSION 1.13.4-1~stretch
ENV php_conf /etc/php/7.3/fpm/php.ini
ENV fpm_conf /etc/php/7.3/fpm/pool.d/www.conf
ENV COMPOSER_ALLOW_SUPERUSER=1

#set to EST time
RUN echo "America/New_York" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata

# Install Basic Requirements
RUN apt-get update \
    && apt-get install --no-install-recommends --no-install-suggests -q -y \
    apt-transport-https \
    lsb-release \
    wget \
    vim \
    apt-utils \
    gnupg \
    curl \
    cron \
    procps \
    nano \
    zip \
    unzip \
    python-pip \
    python-setuptools \
    dirmngr \
    ca-certificates

# Supervisor config
RUN pip install wheel
RUN pip install supervisor supervisor-stdout
ADD ./supervisord.conf /etc/supervisord.conf

# Avoid ERROR: invoke-rc.d: policy-rc.d denied execution of start.
RUN echo "#!/bin/sh\nexit 0" > /usr/sbin/policy-rc.d

# Add sources for latest nginx and php
RUN apt-key adv --no-tty --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys 573BFD6B3D8FBC641079A6ABABF5BD827BD9BF62 \
    && echo "deb http://nginx.org/packages/mainline/debian/ stretch nginx" >> /etc/apt/sources.list \
    && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list \
    && apt-get update

# add nginx user:group
RUN groupadd -g 1002 nginx
RUN useradd -u 1001 -g 1002 nginx

# Install nginx
RUN apt-get install --no-install-recommends --no-install-suggests -q -y \
                        nginx=${NGINX_VERSION}

# Override nginx's default config
RUN rm -rf /etc/nginx/conf.d/default.conf
ADD ./nginx-default.conf /etc/nginx/conf.d/default.conf
ADD ./phpxperts.conf /etc/nginx/conf.d/phpxperts.conf

# Install PHP and Libraries
RUN apt-get install --no-install-recommends --no-install-suggests -q -y \
    php7.3-fpm php7.3-cli php7.3-dev php7.3-common \
    php7.3-json php7.3-opcache php7.3-readline php7.3-mbstring php7.3-curl php7.3-memcached \
    php7.3-imagick php7.3-mysql php7.3-zip php7.3-pgsql php7.3-intl php7.3-xml \
    php7.3-enchant php7.3-gd php7.3-pspell php7.3-pgsql \
    php7.3-soap php7.3-tidy php-xdebug php7.3-recode php7.3-apcu php7.3-apcu-bc php7.3-xml \
    php7.3-phpdbg php-http-request2 php7.3-imap

# Override php's default ini
RUN rm -rf ${php_conf}
ADD ./config/php.ini ${php_conf}

# Override php-fpm config
RUN sed -i -e "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g" ${php_conf} && \
sed -i -e "s/upload_max_filesize\s*=\s*2M/upload_max_filesize = 100M/g" ${php_conf} && \
sed -i -e "s/post_max_size\s*=\s*8M/post_max_size = 100M/g" ${php_conf} && \
sed -i -e "s/variables_order = \"GPCS\"/variables_order = \"EGPCS\"/g" ${php_conf} && \
sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.3/fpm/php-fpm.conf && \
sed -i -e "s/;catch_workers_output\s*=\s*yes/catch_workers_output = yes/g" ${fpm_conf} && \
sed -i -e "s/pm.max_children = 5/pm.max_children = 50/g" ${fpm_conf} && \
sed -i -e "s/pm.start_servers = 2/pm.start_servers = 5/g" ${fpm_conf} && \
sed -i -e "s/pm.min_spare_servers = 1/pm.min_spare_servers = 5/g" ${fpm_conf} && \
sed -i -e "s/pm.max_spare_servers = 3/pm.max_spare_servers = 35/g" ${fpm_conf} && \
sed -i -e "s/pm.max_requests = 500/pm.max_requests = 500/g" ${fpm_conf} && \
sed -i -e "s/www-data/nginx/g" ${fpm_conf} && \
sed -i -e "s/^;clear_env = no$/clear_env = no/" ${fpm_conf}

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/app

# Add Scripts
ADD ./init.sh /init.sh
RUN chmod 755 /init.sh

# We are not exposing 443 or TCP port port SSL as our loadbalancer will deal this
EXPOSE 80

# Point /bin/sh to /bin/bash and manually source:
RUN rm /bin/sh && ln -sf /bin/bash /bin/sh
RUN source ~/.profile

# Add Crontab
COPY ./crontab /etc/cron.d/cron

RUN curl -sS https://getcomposer.org/installer | \
/usr/bin/php7.3 -- --install-dir=/usr/bin/ --filename=composer

RUN /usr/bin/php7.3 /usr/bin/composer install
RUN /usr/bin/php7.3 artisan key:generate
RUN /usr/bin/php7.3 artisan config:cache

CMD ["/init.sh"]
