############################################################
# Dockerfile to build Nginx installed drupal
############################################################

#### Set the base image to PHP-FPM
FROM php:7.3-fpm-stretch

### File Author / Maintainer
MAINTAINER Vollcom Digital GmbH

ARG GIT_TOKEN
ARG BRANCH
ARG GIT_REPO
ARG WITH_XDEBUG=false
ARG APCU_VERSION=5.1.19

### /

### Copy nginx config and entrypoint
COPY config/nginx/nginx.conf /bin/
COPY init_container.sh /bin/
### /

###  Configure root user credentials
RUN chmod 755 /bin/init_container.sh \
    && echo "root:Docker!" | chpasswd \
    && echo "cd /home" >> /etc/bash.bashrc
### /

#### Install the PHP extensions we need
#### With a few edits
RUN apt-get update; \
	apt-get install -y --no-install-recommends \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		libpq-dev \
		libzip-dev;

#### Additional libraries not in base recommendations
RUN apt-get update; \
	    apt-get install -y --no-install-recommends \
        openssh-server \
        curl \
        git \
        mysql-client \
        nano \
        sudo \
        tcptraceroute \
        vim \
        wget \
        nginx \
        redis-server \
        libssl-dev;
### /

###
RUN	docker-php-ext-configure gd \
		--with-freetype-dir=/usr \
		--with-jpeg-dir=/usr \
		--with-png-dir=/usr \
	; \
	\
	docker-php-ext-install -j "$(nproc)" \
		gd \
		opcache \
		mysqli \
		zip;
### /

### set recommended PHP.ini settings
### see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=60'; \
		echo 'opcache.fast_shutdown=1'; \
       } > /usr/local/etc/php/conf.d/opcache-recommended.ini
### /

#### Install xDebugger and enable it
RUN if [ $WITH_XDEBUG = "true" ] ; then \
	    pecl install xdebug-2.9.5; \
	    docker-php-ext-enable xdebug; \
	fi ;
### /

### INSTALL APCU
RUN pecl install apcu-${APCU_VERSION} && docker-php-ext-enable apcu
RUN { \
        echo 'extension=apcu.so'; \
        echo 'apc.enable_cli=1'; \
        echo "apc.enable=1"; \
     } > /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini
### /

### Change nginx logs directory
RUN   \
   rm -f /var/log/nginx/* \
   && rmdir /var/log/nginx \
   && chmod 777 /var/log \
   && chmod 777 /bin/init_container.sh \
   && cp /bin/nginx.conf /etc/nginx/nginx.conf \
   && rm -rf /var/www/html \
   && rm -rf /var/log/nginx \
   && mkdir -p /home/LogFiles \
   && ln -s /home/LogFiles  /var/log/nginx
### /

### Change maximum server requests
COPY /config/php/www.conf /usr/local/etc/php-fpm.d/
### /

### Append "daemon off;" to the beginning of the configuration
RUN echo "daemon off;" >> /etc/nginx/nginx.conf

### Include PHP recommendations from https://www.drupal.org/docs/7/system-requirements/php
RUN { \
    echo 'log_errors=On'; \
    echo 'display_startup_errors=Off'; \
    echo 'date.timezone=UTC'; \
    echo 'session.cache_limiter = nocache'; \
    echo 'session.auto_start = 0'; \
    echo 'expose_php = off'; \
    echo 'allow_url_fopen = on'; \
    echo 'display_errors=Off'; \
    echo 'upload_max_filesize = 32M'; \
    echo 'post_max_size = 32M'; \
    echo 'realpath_cache_size = 256k'; \
    echo 'realpath_cache_ttl = 3600'; \
    } > /usr/local/etc/php/conf.d/php.ini
### /

### Installs memcached support for php
RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev \
    && pecl install memcached-3.1.5 \
    && docker-php-ext-enable memcached
RUN apt-get update && apt-get install -y memcached
RUN { \
    echo 'extension=memcached.so'; \
    echo '-l 127.0.0.1'; \
    echo 'memcache.hash_strategy=consistent'; \
    } > /usr/local/etc/php/conf.d/docker-php-ext-memcached.ini
### /

### Install Redis Cache
RUN pecl install redis && docker-php-ext-enable redis
RUN { \
        echo 'extension=redis.so'; \
     } > /usr/local/etc/php/conf.d/docker-php-ext-redis.ini
### /

COPY sshd_config /etc/ssh/

EXPOSE 2222 8080

ENV NGINX_RUN_USER www-data
ENV PHP_VERSION 7.3

ENV PORT 8080
ENV WEBSITE_ROLE_INSTANCE_ID localRoleInstance
ENV WEBSITE_INSTANCE_ID localInstance
ENV PATH ${PATH}:/var/www/html/web
ENV DEVPORTAL_ENV=${DEVPORTAL_ENV}
ENV NEWRELIC_VERSION=${NEWRELIC_VERSION}
ENV EXT_APCU_VERSION=${APCU_VERSION}
### /

#### Install wp-cli
RUN curl -o /bin/wp-cli.phar https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x /bin/wp-cli.phar
RUN cd /bin && mv wp-cli.phar wp
RUN mkdir -p /var/www/.wp-cli/cache && chown www-data:www-data /var/www/.wp-cli/cache
### /

WORKDIR /var/www/html/

### Install composer
RUN curl -sS https://getcomposer.org/installer | php -d allow_url_fopen=on -- --install-dir=/usr/local/bin --filename=composer
### /

### Install dependencies
COPY /src/composer.json ./
RUN php -d allow_url_fopen=on -d memory_limit=-1 /usr/local/bin/composer update --no-dev --no-interaction --verbose
### /

### Copy custom modules and themes from local wordpress code base to final destination
COPY /src/web/app/themes web/app/themes
COPY /src/web/app/mu-plugins web/app/mu-plugins
### /

### Finish composer
RUN composer dump-autoload --no-scripts --no-dev --optimize
### /

### Add directories for public and private files
RUN mkdir -p /home/site/wwwroot/web/app/uploads
RUN ln -s /home/site/wwwroot/web/app/uploads /var/www/html/web/app/uploads
### /

### Begin of set permissions to wordpress file system
WORKDIR /var/www/html/web
RUN chown -R www-data:www-data .
RUN chgrp www-data /var/www/html/web/app/uploads -R
RUN chmod g+w /var/www/html/web/app/uploads -R
### /

ENTRYPOINT ["/bin/init_container.sh"]