#!/bin/bash

cp .env.example .env

echo "Start composer install for [laravel.test]..."
docker-compose exec laravel.test composer install

echo "Start migrate for [laravel.test]..."
docker-compose exec laravel.test php artisan migrate

echo "Start seed for [laravel.test]..."
docker-compose exec laravel.test db:seed
