#!/bin/bash
sudo service openvpn stop
sudo docker network prune -f
sudo service openvpn stop

sudo docker stop $(docker ps -aq) && sudo docker rm $(docker ps -aq) && sudo docker rmi -f $(docker images -q)

docker image prune -f
docker container prune -f
docker image prune -a -f
sudo docker image prune -f
sudo docker container prune -f
sudo docker image prune -a -f

sudo service docker stop
sudo rm -r /var/lib/docker/overlay2
sudo service docker start
sudo docker system prune --volumes -a -f
