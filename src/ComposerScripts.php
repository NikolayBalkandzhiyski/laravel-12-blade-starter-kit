<?php

namespace NikolayBalkandzhiyski\BladeStarterKit;

class ComposerScripts
{
    /**
     * Handle the post-autoload-dump Composer event.
     */
    public static function postAutoloadDump($event)
    {
        // Only run Artisan commands if we're in a Laravel application
        if (file_exists('./artisan')) {
            require_once './vendor/autoload.php';

            $baseDir = dirname(dirname(__FILE__));

            if (file_exists('./bootstrap/app.php')) {
                $app = require_once './bootstrap/app.php';
                $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

                // Run package:discover, but catch failures
                try {
                    $kernel->call('package:discover');
                } catch (\Exception $e) {
                    $event->getIO()->write('<error>Error running package:discover: '.$e->getMessage().'</error>');
                }
            }
        }
    }
}
