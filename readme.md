[ ![Codeship Status](https://img.shields.io/codeship/48af53a0-bc7f-0134-aecb-5e9a8948951f.svg)](https://codeship.com/projects/195866)

# Notejam: Laravel

Notejam application implemented using [Laravel](http://laravel.com/)  framework.

[![](https://laravel.com/assets/img/components/logo-laravel.svg)](http://laravel.com/)

Laravel version: 5.3

# Installation and launching

## Clone


Clone the repo:

```bash
$ git clone git@github.com:komarserjio/notejam.git YOUR_PROJECT_DIR/
```

## Install

Install [composer](https://getcomposer.org/):

```bash
$ cd YOUR_PROJECT_DIR/laravel/notejam/
$ curl -s https://getcomposer.org/installer | php
```

## Install dependencies

```bash
$ cd YOUR_PROJECT_DIR/laravel/notejam/
$ php composer.phar install
```

## Create database schema

```bash
$ cd YOUR_PROJECT_DIR/laravel/notejam/
$ touch app/database/notejam.db
$ php artisan migrate
```

## Launch

Start laravel web server:

```bash
$ cd YOUR_PROJECT_DIR/laravel/notejam/
$ php artisan serve
```

Go to http://localhost:8000/ in your browser.

## Run tests

Run functional and unit tests:

```bash
$ cd YOUR_PROJECT_DIR/laravel/notejam/
$ php vendor/bin/phpunit
```

## Contribution

Do you have php/laravel experience? Help the app to follow php and laravel best practices.

Please send your pull requests in the ``master`` branch.
Always prepend your commits with framework name:

> Laravel: Implemented sign in functionality

Read [contribution guide]( https://github.com/komarserjio/notejam/blob/master/contribute.rst) for details.
