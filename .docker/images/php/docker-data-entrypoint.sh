#!/bin/bash

if [ -z ${PHP_FOLDER_LOG} ]
then
    PHP_FOLDER_LOG="/var/log/docker/php/"
fi

if [ -z ${PHP_FOLDER_INIT} ]
then
    PHP_FOLDER_INIT="/var/docker/php/"
fi

if [ -z ${CRON_FOLDER_INIT} ]
then
    CRON_FOLDER_INIT="/var/docker/cron/"
fi

if [ -z ${PHP_FOLDER_PROJECT} ]
then
    PHP_FOLDER_PROJECT=/usr/local/apache2/www/
fi

${PHP_FOLDER_INIT}/importdata.sh 2>> ${PHP_FOLDER_LOG}/installdata.log

cp ${CRON_FOLDER_INIT}/dockercron /etc/cron.d/dockercron

crontab /etc/cron.d/dockercron

#while inotifywait -e close_write /etc/cron.d/dockercron; do crontab /etc/cron.d/dockercron; done &

crontab /etc/cron.d/dockercron

${CRON_FOLDER_INIT}/cronauto.sh 2>> ${PHP_FOLDER_LOG}/initnodejs.log &

touch ${PHP_FOLDER_LOG}/cron.log
cron && tail -f ${PHP_FOLDER_LOG}/cron.log &

cd ${PHP_FOLDER_PROJECT}

touch errors.log
chmod 777 errors.log 

echo "end create project" >> ${PHP_FOLDER_LOG}/endcreate.log

exec "$@"
