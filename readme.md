# Insight.pic

Put the power of Insights to work in your organization quickly by using Insights profile pictures.

### Tech

Insight.pic uses a number of open source projects to work properly:

* [Vuejs](https://vuejs.org/) - front-end!
* [Laravel](https://laravel.com) - Back-end Api

### Installation

Insight.pic requires [node](https://nodejs.org/) v6.9.4, [php](http://php.net) v7.0.

Install the dependencies and devDependencies and start the server.

```sh
$ composer install
$ npm install
$ php artisan serve
$ php artisan migrate
```

Seed The database:

```sh
$ php artisan db:seed --class=ColorTableSeeder
$ php artisan db:seed --class=DesignTableSeeder
```
