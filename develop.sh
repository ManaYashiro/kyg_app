#!/bin/bash
# This is for develop/local script

git fetch origin develop
composer install && npm install
docker-compose up -d
php artisan optimize:clear
rm -rf public/build
