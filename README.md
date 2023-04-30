# Installation Requirement

## Using Docker
[Docker](https://docs.docker.com/engine/install/ubuntu/)
[Docker Compose](https://docs.docker.com/compose/install/linux/)
[Sail](https://laravel.com/docs/10.x/sail)

## Linux

PHP >= 8.1
MYSQL >= 8
Composer

# Run Application

## Using Docker

1. Edit configuration on docker-compose.yaml (Optional)
2. Run application using docker-compose `docker-compose up`
3. Access application on browser at 'localhost:8000'
4. To stop the application run `docker-compose down`

## Using Docker + Sail
1. Run './vendor/bin/sail up'
2. Edit configuration on docker-compose.yaml (Optional)
3. Run application using sail `./vendor/bin/sail up`
4. Access application on browser at 'localhost'
5. Access phpmyadmin on browser at 'localhost:8080'
5. Run migration using `sail php artisan migrate:fresh`
6. To stop the application run `./vendor/bin/sail down`
7. Instead of repeatedly typing `.vendor/bin/sail` to execute Sail commands, you can use alias like `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'` (Optional)

## Manually

1. Run 'composer install'
2. Set database configuration on .env file, copy it from .env.example
3. Run 'php artisan migrate'
4. Run 'php artisan key:generate'
5. Run 'php artisan storage:link'
6. Run 'php artisan serve --host=0.0.0.0'


# About Application
1. Accessing Login Admin at `localhost\admin`
2. Accessing Register Admin at `localhost\admin\register`