# Set-up

The given stack has been modified to work on a Mac without Docker.

## Requirements

* PHP 7.4.x
* Symfony cli
* Local MySQL server
* Composer

## Install vendors

    composer install

## Run server

    make start

Will launch Symfony server with local PHP. Default endpoint is: [127.0.0.1:8000](http://127.0.0.1:8000).

## Stop server

    make stop
