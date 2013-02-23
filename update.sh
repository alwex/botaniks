#!/bin/sh
git pull origin
cd php-db-migrate
php migrate --up