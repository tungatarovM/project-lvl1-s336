install:
	composer install

make lint:
	composer run-script phpcs -- --standard=PSR2 src bin