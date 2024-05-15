#!/bin/bash

if [ -z ${CRON_FOLDER_INIT} ]
then
    CRON_FOLDER_INIT="/var/docker/cron/"
fi

while : ;
do
    test2=$(diff -u ${CRON_FOLDER_INIT}/dockercron /etc/cron.d/dockercron)
    if [ ! -z "${test2}" ]
    then
        cp ${CRON_FOLDER_INIT}/dockercron /etc/cron.d/dockercron
        crontab /etc/cron.d/dockercron
    fi
done
