<?php

namespace Lucasdasilvajunior\LaravelDockerfile\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InitDockerCommand extends Command
{
    protected $signature = 'docker:init';
    protected $description = 'Publish Dockerfile and Supervisor config for Laravel with schedule:work';

    public function handle(Filesystem $files): int
    {
        $this->info('Initializing Docker setup...');

        $stubsPath = __DIR__ . '/../../resources/stubs';

        $targets = [
            'Dockerfile'      => base_path('Dockerfile'),
            'supervisor.conf' => base_path('supervisor.conf'),
        ];

        foreach ($targets as $stub => $destination) {
            $source = $stubsPath . '/' . $stub;

            if (! $files->exists($source)) {
                $this->error("Stub file missing: {$source}");
                return self::FAILURE;
            }

            if ($files->exists($destination)) {
                if (! $this->confirm("{$stub} already exists at {$destination}. Overwrite?", false)) {
                    $this->line("Skipping {$stub}...");
                    continue;
                }
            }

            $files->copy($source, $destination);
            $this->info("Published {$stub} -> {$destination}");
        }

        $this->info('Docker initialization complete.');
        return self::SUCCESS;
    }
}
