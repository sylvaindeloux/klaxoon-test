# Set-up

The given stack has been modified to work on a Mac without Docker.

## Requirements

* PHP 7.4.x
* Symfony cli
* Local MySQL server
* Composer

MySQL (8.0) commands to initialize database with user:

    CREATE DATABASE klaxoon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    CREATE USER 'klaxoon'@'%' IDENTIFIED BY 'klaxoon';
    GRANT ALL PRIVILEGES ON klaxoon.* TO 'klaxoon'@'%' WITH GRANT OPTION;
    FLUSH PRIVILEGES;

## Install vendors

    composer install

## Run server

    make start

Will launch Symfony server with local PHP. Default endpoint is: [127.0.0.1:8000](http://127.0.0.1:8000).

## Initialize database

    make start
    make install

Will (re)create database and create required tables.

## Stop server

    make stop

# Documentation

## Delete a bookmark

    DELETE /bookmarks/{id}

**Responses**

* `404` Bookmark not found
* `204` Bookmark deleted
