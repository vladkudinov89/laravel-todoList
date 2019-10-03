# CRUD test work #
1. Clone this repository [https://github.com/vladkudinov89/laravel-todoList](https://github.com/vladkudinov89/laravel-todoList)
2. Install & run project locally or in container with [docker-compose](https://dotsandbrackets.com/quick-intro-to-docker-compose-ru/)
A few examples how to execute common commands in docker-compose:
    - Install composer-package `docker-compose exec app composer require package/name`
    - Execute _php artisan_ commands `docker-compose exec app php artisan ...`
2. Run `cp .env.example .env` .
3. Run command `docker-compose exec app composer install`.
3. Run command `docker-compose up -d` to up project.
4. Run command `docker-compose exec app php artisan migrate:fresh --seed`

Run command `docker-compose exec app php ./vendor/bin/phpunit` to run tests.

Run command `docker-compose down` to stop project.
