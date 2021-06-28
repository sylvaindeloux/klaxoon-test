.PHONY: start stop

start:
	brew services run mysql
	symfony server:start --no-tls --daemon

stop:
	brew services stop mysql
	symfony server:stop
