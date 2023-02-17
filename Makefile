install:
	composer install

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src
	composer exec --verbose phpstan -- --level=8 --xdebug analyse src

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src