<?php

namespace NikolayBalkandzhiyski\BladeStarterKit;

class ComposerScripts
{
    /**
     * Handle the post-autoload-dump Composer event.
     */
    public static function postAutoloadDump($event)
    {
        // We're only handling the package in development mode
        // Skip any Laravel-specific operations when running composer update

        $event->getIO()->write('<info>Blade Starter Kit: Processing composer updates...</info>');

        // Don't try to run Laravel commands during regular composer operations
        if (getenv('COMPOSER_DEV_MODE') !== '0' && ! file_exists('./vendor/laravel/framework')) {
            $event->getIO()->write('<info>Blade Starter Kit: Skipping Laravel operations.</info>');

            return;
        }

        // Only try to run artisan commands in a Laravel context
        if (! file_exists('./artisan')) {
            return;
        }

        try {
            if (file_exists('./bootstrap/app.php') && file_exists('./vendor/autoload.php')) {
                require_once './vendor/autoload.php';

                $app = require './bootstrap/app.php';

                if ($app->bound('Illuminate\Contracts\Console\Kernel')) {
                    $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
                    $kernel->call('package:discover');
                    $event->getIO()->write('<info>Blade Starter Kit: Package discovery completed.</info>');
                }
            }
        } catch (\Throwable $e) {
            // Just log the error, don't fail
            $event->getIO()->write("<warning>Blade Starter Kit: {$e->getMessage()}</warning>");
        }
    }
}
