# Tasks

This is a simple project created with Laravel 10 and MYSQL

## Installation

Clone this repository, then run the following commands:

```bash
composer install
```

Generate the app key:

```bash
php artisan key:generate
```

Create a new database and add the database credentials to the .env file. Then run the migrations:

```bash
php artisan migrate
```

## Run Queue

Because the tasks status is updated using a queue, you need to run the queue worker:

```bash
php artisan queue:work
```

## Seeding

You can seed the database with some tasks using the following command:

```bash
php artisan db:seed
```

## Usage

Run the app using `php artisan serve` and navigate to `http://localhost:8000/` in your browser.

## Authentication

Use the following credentials to login:

```bash
// Admin
email: admin@demo.com
password: password

// User
email: user@demo.com
password: password
```

## Authorization

A `User` must be logged in to access any task, whereas only `Admin` can create a new task.


## Used Technologies & References

- VS Code
- Laravel 10
- MYSQL
- PHP 8.2
- Composer 2
- Github Copilot
- Github Actions
- Chat GPT
- Laravel Docs

## Testing

You can run the tests using the following command:

```bash
php artisan test
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
```