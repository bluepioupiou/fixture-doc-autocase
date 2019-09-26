init:
	composer install
	php bin/console doctrine:database:drop --force
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create

load: 
	php bin/console doctrine:fixtures:load  --no-interaction

start:
	php bin/console server:start

stop:
	php bin/console server:stop