# LawLine-dev-test

## Setup

Please review the [Lumen 5 documentation](https://lumen.laravel.com/docs/5.5/installation) to view the server requirements.

After cloning this repository to your local environment you are goning to want to `cd` into the project directory, configure the `.env` file for your environment, and run the following commands:

- `composer install`: Install php dependencies
- `php artisan migrate`: Run database migrations
- `php artisan db:seed`: Run database seeders

## Authentication

I settled for a Basic Auth scheme in this project. So, in order to make a valid request you must pass the credentials of a valid user. If you check the `database/seeders/UsersTableSeeder.php` file you will find that there are five users whose credentials you could use. If you use a tool like postman, simply select "Basic Auth" as you authorization type then type in the selected user's email and password. This should allow you to make valid api requests to the application.

## Tests

Run tests: `./vendor/bin/phpunit`
