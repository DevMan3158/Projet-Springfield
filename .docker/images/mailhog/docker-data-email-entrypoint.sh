#!/bin/bash

if [ -z ${MH_FOLDER_LOG} ]
then
    MH_FOLDER_LOG="/var/log/docker/mailhog/"
fi

if [ -z ${MH_FOLDER_INIT} ]
then
    MH_FOLDER_INIT="/var/docker/mailhog/"
fi

${MH_FOLDER_INIT}/importdata.sh 2>> ${MH_FOLDER_LOG}/installdata.log

exec "$@"
