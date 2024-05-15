# config install nodejs
FROM debian:bookworm-slim

ARG VALUE_MHOG_VERSION
ENV DEF_MHOG_VERSION=${VALUE_MHOG_VERSION:-"v1.0.1"}

ENV MH_FOLDER_LOG="/var/log/docker/mailhog/"
ENV MH_FOLDER_INIT="/var/docker/mailhog/"
ENV MH_FOLDER_INIT_DATA="/docker-entrypoint-initdata.d/"
ENV MH_MAILDIR_PATH="/mailhog/"

# install package
RUN set -ex
RUN apt-get update 
RUN apt-get install -y curl
RUN apt-get install -y git
RUN apt-get install -y golang-go
#del list
RUN rm -rf /var/lib/apt/lists/*

RUN mkdir -p ${MH_FOLDER_LOG}
RUN mkdir -p ${MH_FOLDER_INIT}
RUN mkdir -p ${MH_FOLDER_INIT_DATA}
RUN mkdir -p ${MH_MAILDIR_PATH}

RUN go install github.com/mailhog/MailHog@${DEF_MHOG_VERSION}
RUN cp /root/go/bin/MailHog /usr/bin/MailHog

COPY importdata.sh ${MH_FOLDER_INIT}
RUN chmod +x ${MH_FOLDER_INIT}/importdata.sh

COPY docker-data-email-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-data-email-entrypoint.sh

EXPOSE 1025 8025

ENTRYPOINT ["docker-data-email-entrypoint.sh", "MailHog"]
