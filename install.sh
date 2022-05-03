# creation des dossiers pour le site
mkdir -p project/cron
mkdir -p project/install
mkdir -p project/error
mkdir -p project/docs
mkdir -p project/unit
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

# copier les configurations
# cp docker/config/config_path.php project/cron/
# cp docker/config/config_path.php project/error/
# cp docker/config/config_path.php project/install/
# cp docker/config/.htaccess project/www/
# cp docker/config/sgbd_config.php project/www/config/
# cp docker/config/config.php project/www/config/

# modifi les droits sur les dossiers
chmod 777 -R project
chmod 777 -R projecttmp

# creation du docker du projet
docker-compose up -d
