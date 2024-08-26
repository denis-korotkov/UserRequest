#!/bin/bash

cp .env.example .env

echo "Start composer install"
composer install

vendor/bin/sail up -d

echo "Start migrate for [laravel.test]..."
docker-compose exec laravel.test php artisan migrate

echo "Start seed for [laravel.test]..."
docker-compose exec laravel.test php artisan db:seed
