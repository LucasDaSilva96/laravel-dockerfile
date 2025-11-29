# Laravel Dockerfile Package

A Composer-installable Laravel package that provides a production-ready Dockerfile with Supervisor configuration for running Laravel's scheduler.

## Features

- 🐳 Production-optimized Dockerfile for Laravel applications
- ⏰ Supervisor configuration to run `php artisan schedule:work`
- 🚀 Simple Artisan command to scaffold Docker files
- 📦 Easy installation via Composer

## Requirements

- PHP >= 8.0
- Laravel 8.x, 9.x, 10.x, 11.x or 12.x

## Installation

Install the package via Composer:

```bash
composer require lucasdasilvajunior/laravel-dockerfile
```

The package will be auto-discovered by Laravel.

## Usage

Run the initialization command to copy the Dockerfile and Supervisor configuration to your Laravel project root:

```bash
php artisan docker:init
```

This command will:

- Copy a production-ready `Dockerfile` to your project root
- Copy a `supervisor.conf` file configured to run Laravel's scheduler

If the files already exist, you'll be prompted to confirm overwriting them.

## What's Included

### Dockerfile

The generated Dockerfile includes:

- PHP 8.3-FPM base image
- Common PHP extensions (PDO, MySQL, Zip, etc.)
- Supervisor for process management
- Composer for dependency management
- Optimized for production with `--no-dev` and `--optimize-autoloader`
- Proper permissions for Laravel storage and cache directories

### Supervisor Configuration

The supervisor configuration:

- Runs `php artisan schedule:work` continuously
- Auto-restarts on failure
- Logs output to `/var/log/supervisor/laravel-schedule.log`
- Runs as `www-data` user

## Building and Running

After running `php artisan docker:init`, build and run your Docker container:

```bash
# Build the Docker image
docker build -t my-laravel-app .

# Run the container
docker run -d -p 9000:9000 my-laravel-app
```

## Customization

Feel free to modify the generated `Dockerfile` and `supervisor.conf` files to suit your specific needs:

- Add additional PHP extensions
- Configure additional Supervisor programs (queue workers, etc.)
- Adjust environment variables
- Add nginx or other services

## Alternative: Using vendor:publish

You can also use Laravel's standard publishing mechanism:

```bash
php artisan vendor:publish --tag=docker-stubs
```

## License

This package is open-source software licensed under the MIT license.

## Author

Lucas Da Silva Junior - lucas.ds.developer@gmail.com
