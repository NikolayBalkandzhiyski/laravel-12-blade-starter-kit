<?php

namespace NikolayBalkandzhiyski\BladeStarterKit;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use NikolayBalkandzhiyski\BladeStarterKit\Console\InstallCommand;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
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
