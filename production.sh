#!/bin/bash
# This is for develop/local script

composer install --no-dev --optimize-autoloader && npm install --omit-dev
npm run build
php artisan optimize
composer dump-autoload
