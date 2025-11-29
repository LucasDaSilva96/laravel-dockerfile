<?php

namespace Lucasdasilvajunior\LaravelDockerfile;

use Illuminate\Support\ServiceProvider;
use Lucasdasilvajunior\LaravelDockerfile\Commands\InitDockerCommand;

class DockerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Register the artisan command
        if ($this->app->runningInConsole()) {
            $this->commands([
                InitDockerCommand::class,
            ]);

            // Register publishable stubs (optional if you want php artisan vendor:publish)
            $this->publishes([
                __DIR__ . '/../resources/stubs/Dockerfile' => base_path('Dockerfile'),
                __DIR__ . '/../resources/stubs/supervisor.conf' => base_path('supervisor.conf'),
            ], 'docker-stubs');
        }
    }

    public function register(): void
    {
        // If you need to bind anything to the container, do it here (not needed for now)
    }
}
