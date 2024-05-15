#!/bin/bash

if [ -z ${MH_MAILDIR_PATH} ]
then
    MH_MAILDIR_PATH="/mailhog/"
fi

if [ -z ${MH_FOLDER_LOG} ]
then
    MH_FOLDER_LOG="/var/log/docker/mailhog/"
fi

if [ -z ${MH_FOLDER_INIT_DATA} ]
then
    MH_FOLDER_INIT_DATA="/docker-entrypoint-initdata.d/"
fi

if [ ! -z "$(ls -A ${MH_FOLDER_INIT_DATA}/*@mailhog.example)" ]; then
    cp -r ${MH_FOLDER_INIT_DATA}/*@mailhog.example "${MH_MAILDIR_PATH}/" 2>> ${MH_FOLDER_LOG}/installdata.log
fi

exit 0
