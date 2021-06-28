.PHONY: start install stop

start:
	brew services run mysql
	symfony server:start --no-tls --daemon

install:
	rm -Rf var/cache/* || true
	rm -Rf var/logs/* || true
	bin/console doctrine:database:drop --if-exists --force
	bin/console doctrine:database:create
	bin/console doctrine:migrations:migrate --no-interaction

stop:
	brew services stop mysql
	symfony server:stop
