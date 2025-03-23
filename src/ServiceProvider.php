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

        // Only register commands if we're in a Laravel application
        if (file_exists(base_path('artisan'))) {
            try {
                $this->commands([
                    InstallCommand::class,
                ]);
            } catch (\Exception $e) {
                // Gracefully handle any errors during command registration
            }
        }
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
