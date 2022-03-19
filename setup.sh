#!/bin/bash

echo -n 'APP_KEY=' >> .env
docker-compose run web php artisan key:generate --show --no-ansi >> .env

echo ".env file written"

