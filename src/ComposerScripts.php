<?php

namespace NikolayBalkandzhiyski\BladeStarterKit;

class ComposerScripts
{
    /**
     * Handle the post-autoload-dump Composer event.
     */
    public static function postAutoloadDump($event)
    {
        // Log that we're starting the process
        $event->getIO()->write('<info>Blade Starter Kit: Processing Composer events...</info>');

        // Skip attempting to run Laravel stuff entirely - we'll handle it in the install command
        $event->getIO()->write('<info>Blade Starter Kit: To complete installation, run "php artisan blade-kit:install" after setup.</info>');

        // Don't try to do anything with Laravel here - it's causing errors
        return;
    }
}
