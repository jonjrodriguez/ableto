# AbleTo

AbleTo Exercise that allows a user to complete a behavioral survey. It features a Vue.js frontend, Laravel RESTful Api, and basic authentication.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

* Laravel Server [Requirements](https://laravel.com/docs/5.5/installation). Satisified by:
    * [Homestead](https://laravel.com/docs/5.5/homestead)
    * [Valet](https://laravel.com/docs/5.5/valet)
* [Node/NPM](https://nodejs.org/en/) for front-end development

### Installing

A step by step series of examples that tell you have to get a development env running

Clone the repository

```
git clone https://github.com/thoughts1053/ableto.git
cd ableto
```

Setup Laravel environment for dev

```
composer install
cp .env.example .env
php artisan key:generate
```

Update `Database` and `Mail` configs in `.env` and migrate the database

```
php artisan migrate

# Optionally seed database for sample data
php artisan db:seed
```

Optionally, if working on UI

```
npm install
npm run watch
```


## Running the tests

The Api, Models, and Controllers are tested with [PhpUnit](https://phpunit.de/) and the Laravel test helpers. They use an in-memory SQLite database for performance and isolation.

```
# Run all tests
vendor/bin/phpunit

# Alternatively create an alias
alias phpunit=vendor/bin/phpunit

# Run unit tests
phpunit --testsuite Unit

# Run feature tests
phpunit --testsuite Feature
```

## Built With

* [Laravel](https://laravel.com/)
* [Vue.js](https://vuejs.org/)
* [Bootstrap](http://getbootstrap.com/)