#!/bin/bash

if [ -z ${PHP_FOLDER_PROJECT} ]
then
    PHP_FOLDER_PROJECT=/usr/local/apache2/www/
fi

if [ -z ${PHP_FOLDER_LOG} ]
then
    PHP_FOLDER_LOG=/var/log/docker/php/
fi

if [ -z ${PHP_FOLDER_DATA} ]
then
    PHP_FOLDER_DATA=data
fi

if [ -z ${PHP_FOLDER_INIT_DATA} ]
then
    PHP_FOLDER_INIT_DATA=/docker-entrypoint-initdata.d/
fi

if [ ! -d "${PHP_FOLDER_PROJECT}/${PHP_FOLDER_DATA}" ]; then
    if [ ! -z "$(ls -A ${PHP_FOLDER_INIT_DATA})" ]; then
        mkdir -p "${PHP_FOLDER_PROJECT}/${PHP_FOLDER_DATA}" 2>> ${PHP_FOLDER_LOG}/installdata.log
        cp -r ${PHP_FOLDER_INIT_DATA}/* "${PHP_FOLDER_PROJECT}/${PHP_FOLDER_DATA}/" 2>> ${PHP_FOLDER_LOG}/installdata.log
        chmod 777 -R "${PHP_FOLDER_PROJECT}/${PHP_FOLDER_DATA}"
    fi
fi

exit 0
