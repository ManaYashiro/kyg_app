#!/bin/bash
# This is for develop/local script

composer install --no-dev --optimize-autoloader && npm install --omit-dev
php artisan optimize
npm run build
