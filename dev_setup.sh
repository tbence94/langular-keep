#!/bin/bash

sudo ln -s /workspace/langular-keep/nginx.conf /etc/nginx/conf.d/langular-keep.conf
sudo service nginx reload

./composer.phar install

#npm install -g gulp
npm install
gulp

sudo touch database/database.sqlite

sudo chmod 777 database/database.sqlite
sudo chmod 777 storage -R
sudo chmod 777 bootstrap -R
