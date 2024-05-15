# variable environnement
ARG VALUE_PHP_VERSION
ARG DEF_PHP_VERSION=${VALUE_PHP_VERSION:-"8.3.7RC1-fpm"}
ARG VALUE_COMPOSER_VERSION
ARG DEF_COMPOSER_VERSION=${VALUE_COMPOSER_VERSION:-"2.7.4"}
# config install composer
FROM composer:${DEF_COMPOSER_VERSION} AS compvers

# config install php
FROM php:${DEF_PHP_VERSION}

# variable version (environnement)
ARG VALUE_PHP_VERSION
ENV DEF_PHPX_VERSION=${VALUE_PHP_VERSION}

ENV DEF_PHPXDEBUG_VERSION=${VALUE_PHP_VERSION:-"3.3.2"}
ENV DEF_PHPXDEBUG_VERSION=${DEF_PHPXDEBUG_VERSION##${DEF_PHPX_VERSION}}
ARG VALUE_XDEBUG_VERSION
ENV DEF_XDEBUG_VERSION=${DEF_PHPXDEBUG_VERSION:-"${VALUE_XDEBUG_VERSION}"}
ENV XDEBUG_VERSION=${DEF_XDEBUG_VERSION:+"xdebug-${DEF_XDEBUG_VERSION}"}
ENV XDEBUG_VERSION=${XDEBUG_VERSION:-'xdebug'}

ARG VALUE_MHSEND_VERSION
ENV DEF_MHSEND_VERSION=${VALUE_MHSEND_VERSION:-"v0.2.0"}

ARG PHP_FOLDER_PROJECT
ENV PHP_FOLDER_PROJECT=${PHP_FOLDER_PROJECT:-"/usr/local/apache2/www/"}
ENV PHP_FOLDER_LOG="/var/log/docker/php/"
ENV PHP_FOLDER_LOG_XDEBUG="/var/log/docker/xdebug/"
ENV PHP_FOLDER_TMP="/var/tmp/docker/php/"
ENV PHP_FOLDER_INIT="/var/docker/php/"
ENV CRON_FOLDER_INIT="/var/docker/cron/"
ENV PHP_FOLDER_INIT_DATA="/docker-entrypoint-initdata.d/"

# install package
RUN set -ex
RUN apt-get update
RUN apt-get install -y curl
RUN apt-get install -y git
RUN apt-get install -y cron
RUN apt-get install -y inotify-tools
RUN apt-get install -y golang-go
RUN apt-get install -y unzip
RUN apt-get install -y libxml2-dev
RUN apt-get install -y libldb-dev
RUN apt-get install -y libldap2-dev
RUN apt-get install -y libssl-dev
RUN apt-get install -y libxslt-dev
RUN apt-get install -y wget
RUN apt-get install -y graphviz
RUN apt-get install -y libzip-dev
RUN apt-get install -y vim
RUN apt-get install -y debconf
RUN apt-get install -y subversion
RUN apt-get install -y build-essential
RUN apt-get install -y locales
RUN apt-get install -y acl
RUN apt-get install -y mailutils
RUN apt-get install -y wget
RUN apt-get install -y libjpeg-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libyaml-dev
RUN apt-get install -y libc-client-dev
RUN apt-get install -y libkrb5-dev
#del list
RUN rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd --with-jpeg
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl
RUN docker-php-ext-install -j7 gd mysqli pdo_mysql xsl zip intl imap
   
#install mhsendmail
RUN go install github.com/mailhog/mhsendmail@${DEF_MHSEND_VERSION}
RUN cp /root/go/bin/mhsendmail /usr/bin/mhsendmail

# Install YAML extension
RUN pecl install yaml && echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini
    
# Goto temporary directory.
WORKDIR /tmp

# Install composer  
COPY --from=compvers /usr/bin/composer /usr/bin/composer  
RUN mkdir /var/composer  
ENV COMPOSER_HOME /var/composer  
ENV COMPOSER_ALLOW_SUPERUSER 1 

RUN mkdir -p ${PHP_FOLDER_PROJECT}
RUN mkdir -p ${PHP_FOLDER_INIT}
RUN mkdir -p ${PHP_FOLDER_LOG}
RUN mkdir -p ${PHP_FOLDER_LOG_XDEBUG}
RUN mkdir -p ${PHP_FOLDER_INIT}
RUN mkdir -p ${CRON_FOLDER_INIT}
RUN mkdir -p ${PHP_FOLDER_INIT_DATA}

COPY dockercron ${CRON_FOLDER_INIT}
COPY dockercron /etc/cron.d/dockercron
RUN crontab /etc/cron.d/dockercron

COPY cronauto.sh ${CRON_FOLDER_INIT}
RUN chmod +x ${CRON_FOLDER_INIT}/cronauto.sh

# xdebug.
RUN pecl install -o -f ${XDEBUG_VERSION} && rm -rf /tmp/pear
COPY xdebug_extends.sh ${PHP_FOLDER_INIT}
RUN chmod +x ${PHP_FOLDER_INIT}/xdebug_extends.sh
RUN ${PHP_FOLDER_INIT}/xdebug_extends.sh

COPY importdata.sh ${PHP_FOLDER_INIT}
RUN chmod +x ${PHP_FOLDER_INIT}/importdata.sh

COPY docker-data-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-data-entrypoint.sh

ENTRYPOINT ["docker-data-entrypoint.sh", "docker-php-entrypoint"]

WORKDIR ${PHP_FOLDER_PROJECT}

CMD ["php-fpm"]
