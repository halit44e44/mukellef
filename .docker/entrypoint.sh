#!/bin/bash

#On error no such file entrypoint.sh, execute in terminal - dos2unix .docker\entrypoint.sh
composer install
chmod +x .docker/entrypoint.sh
#Just for Laravel Apps
#php artisan migrate:fresh --seed

php-fpm
