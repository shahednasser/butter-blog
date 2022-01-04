# Butter Blog Tutorial

Code for Laravel + ButterCMS blog tutorial.

## Installation

After cloning this repository, run the following command to install dependencies:

```bash
composer install
```

## Configurations

Rename `.env.example` to `.env`:

```bash
mv .env.example .env
```

Then, add your ButterCMS API token and Slack Webhook URL:

```bash
BUTTER_API_KEY=
SLACK_WEBHOOK=
```

You also need to add an absolute path to your SQLite database:

```bash
DB_DATABASE=/path/to/butter-blog/database/database.sqlite
```

You can easily create an SQLite database with the following command:

```bash
touch database/database.sqlite
```

You then need to migrate the database tables:

```bash
php artisan migrate
```

And seed to add a fake user:

```bash
php artisan db:seed
```

## Run Server

Finally, you can run the server with the following command:

```bash
php artisan serve
```

This will by default run the server at `localhost:8000`.
