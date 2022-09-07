# Laravel 8 SIM SURAT

## Installation

Install the dependencies and devDependencies.

```sh
composer install
npm i && npm run dev
```

Dont forget to edit .env file
```sh
cp .env.example .env
```
and then run migration with seed and start server

```sh
php artisan migrate:fresh --seed
php artisan serve
```
