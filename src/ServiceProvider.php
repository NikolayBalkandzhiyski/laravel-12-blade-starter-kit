<?php

namespace NikolayBalkandzhiyski\BladeStarterKit;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use NikolayBalkandzhiyski\BladeStarterKit\Console\InstallCommand;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the filesystem binding if it doesn't exist
        if (! $this->app->bound('files')) {
            $this->app->singleton('files', function () {
                return new Filesystem;
            });
        }

        // Register commands
        $this->commands([
            InstallCommand::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            // Publish stubs
            $this->publishes([
                __DIR__.'/../stubs' => base_path(),
            ], 'blade-starter-kit-stubs');
        }
    }
}
