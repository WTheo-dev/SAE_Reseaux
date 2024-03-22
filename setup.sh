#!/bin/bash

set -xe

git clone https://github.com/WTheo-dev/SAE_Reseaux.git

cd SAE_Reseaux && git checkout integration-de-fou-zinzin && cd ..

cp ./SAE_Reseaux/docker-compose.yml . && docker-compose up -d

docker exec sae chmod +x /opt/lampp/htdocs/init-bdd.sh

sleep 10

docker exec sae /opt/lampp/htdocs/init-bdd.sh
