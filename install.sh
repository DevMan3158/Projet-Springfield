# creation des dossiers pour le site
mkdir -p project/cron
mkdir -p project/install
mkdir -p project/error
mkdir -p project/docs
mkdir -p project/unit
mkdir -p project/www/data
# creation des tmp du docker
mkdir -p projecttmp/data
mkdir -p projecttmp/mysql_data
mkdir -p projecttmp/tmp
mkdir -p projecttmp/tmp/php
mkdir -p projecttmp/tmp/mysql
mkdir -p projecttmp/tmp/httpd
mkdir -p projecttmp/log
mkdir -p projecttmp/log/php
mkdir -p projecttmp/log/httpd
mkdir -p projecttmp/log/xdebug
mkdir -p projecttmp/log/mysql

# copier les configurations et fichiers
cp -R config/img/ project/www/data/

# modifi les droits sur les dossiers
# chmod 777 -R project
chmod 777 -R project/www/data
chmod 777 project/www/
chmod 777 -R projecttmp

# creation du docker du projet
docker-compose up -d
