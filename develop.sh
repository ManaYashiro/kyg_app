#!/bin/bash
# This is for develop/local script

git fetch origin develop

# Get the name of the current branch
current_branch=$(git rev-parse --abbrev-ref HEAD)

# Check if the current branch is 'develop'
if [ "$current_branch" == "develop" ]; then
  # If on 'develop', pull the latest changes from origin develop
  git pull origin develop
else
  echo "You are not on the 'develop' branch. Current branch: $current_branch"
fi

git fetch --prune
composer install && npm install
docker-compose up -d
php artisan optimize:clear
rm -rf public/build
