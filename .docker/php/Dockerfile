FROM php:7.4.16-fpm

#RUN pear install PhpDocumentor-1.4.4 \
#                 XML_Beautifier \
# && pear clear-cache \
# && rm -rf /tmp/*

RUN apt update
RUN apt upgrade -y  
RUN apt install -y libxml2-dev 
RUN apt install -y libldb-dev
RUN apt install -y libldap2-dev
RUN apt install -y libssl-dev
RUN apt install -y libxslt-dev
RUN apt install -y wget
RUN apt install -y graphviz
RUN apt install -y libzip-dev
#RUN apt install -y zlib-dev

RUN set -ex; \
	\
	apt-get update; \
	apt-get install -y vim curl debconf subversion apt-transport-https apt-utils build-essential locales acl mailutils wget; \
	apt-get install -y \
		libjpeg-dev \
		libpng-dev \
                libmcrypt-dev \
                git \
	; \
	rm -rf /var/lib/apt/lists/*; \
	\
	docker-php-ext-configure gd --with-jpeg; \
	docker-php-ext-install -j5 gd mysqli pdo_mysql json xsl zip; \
	pecl install -o -f xdebug-3.0.4 \
        && rm -rf /tmp/pear 
   
#install mailhog     
RUN apt-get update &&\
    apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl git &&\
    rm -rf /var/lib/apt/lists/*
RUN curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' | tar -C '/usr/local' -xvzf -
ENV PATH /usr/local/go/bin:$PATH
RUN go get github.com/mailhog/mhsendmail
RUN cp /root/go/bin/mhsendmail /usr/bin/mhsendmail

#install some base extensions
#RUN apt-get install -y \
#        libzip-dev \
#        zip \
#  && docker-php-ext-configure zip --with-libzip \
#  && docker-php-ext-install zip

#install some base extensions >=7.3
#RUN apt-get install -y \
#        libzip-dev \
#        zip \
#  && docker-php-ext-install zip

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN apt-get update && apt-get install -y libc-client-dev libkrb5-dev && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap

# Install YAML extension
RUN apt-get update -y
RUN apt-get install libyaml-dev -y
RUN pecl install yaml && echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini
#RUN pecl install ${yaml_version} && echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini
#RUN pecl install yaml && echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini
    
# Goto temporary directory.
WORKDIR /tmp

# Install composer  
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer  
RUN mkdir /var/composer  
ENV COMPOSER_HOME /var/composer  
ENV COMPOSER_ALLOW_SUPERUSER 1 

#install phpdoc
RUN mkdir /opt/phpDocumentor/
#RUN mkdir /opt/phpDocumentor/phar/

WORKDIR /opt/phpDocumentor/

RUN composer require "phpdocumentor/phpdocumentor:^3"
#RUN wget https://www.phpdoc.org/phpDocumentor.phar
#RUN cp phpDocumentor.phar /usr/local/bin/phpdoc && chmod +x /usr/local/bin/phpdoc
#RUN pear channel-discover pear.phpdoc.org
#RUN pear install phpdoc/phpDocumentor

WORKDIR /tmp

# Run composer and phpunit installation.
RUN composer selfupdate && \
    composer require "phpunit/phpunit:8.*.*" --prefer-source --no-interaction && \
    ln -s /tmp/vendor/bin/phpunit /usr/local/bin/phpunit

ADD https://phar.phpunit.de/phpunit-skelgen.phar /tmp
RUN chmod +x /tmp/phpunit-skelgen.phar
RUN mv /tmp/phpunit-skelgen.phar /usr/local/bin/phpunit-skelgen

WORKDIR /usr/local/apache2/www

CMD ["php-fpm"]
