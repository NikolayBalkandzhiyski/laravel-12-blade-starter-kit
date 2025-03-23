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
        try {
            // Register the filesystem binding if it doesn't exist
            if (! $this->app->bound('files')) {
                $this->app->singleton('files', function () {
                    return new Filesystem;
                });
            }
        } catch (\Exception $e) {
            // Gracefully handle any errors
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Only proceed if we're in console mode
        if (! $this->app->runningInConsole()) {
            return;
        }

        try {
            $this->commands([
                InstallCommand::class,
            ]);

            // Publish stubs using the new group parameter
            $this->publishes([
                __DIR__.'/../stubs' => base_path(),
            ], ['blade-starter-kit-stubs', 'laravel-assets']);
        } catch (\Exception $e) {
            // Gracefully handle any errors
        }
    }
}
