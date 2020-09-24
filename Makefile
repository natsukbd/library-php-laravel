install:
	cp -a .env.example .env
	cp -a ./laravel/.env.example ./laravel/.env
	docker-compose run --rm --workdir=/var/www/html/laravel composer install
	docker-compose run --rm --workdir=/var/www/html/laravel php php artisan key:generate
.PHONY: install

test:
	docker-compose run --rm --workdir=/var/www/html/laravel php ./vendor/bin/phpunit
.PHONY: test

phpcs:
	docker-compose run --rm --workdir=/var/www/html/laravel php ./vendor/bin/phpcs --standard=/var/www/html/ruleset.xml
.PHONY: phpcs

phpcbf:
	docker-compose run --rm --workdir=/var/www/html/laravel php ./vendor/bin/phpcbf --standard=/var/www/html/ruleset.xml
.PHONY: phpcbf

phpstan:
	docker-compose run --rm --workdir=/var/www/html/laravel php ./vendor/bin/phpstan analyze -c phpstan.neon
.PHONY: phpstan
