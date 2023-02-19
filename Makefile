install:
	composer install

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src
	vendor/bin/phpstan analyse -c phpstan.neon --xdebug

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src

test:
	composer exec --verbose phpunit tests

run:
	docker run -d --rm --name construction-site 40b4066a9292