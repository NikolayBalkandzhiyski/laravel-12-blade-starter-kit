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
        $event->getIO()->write('<info>Blade Starter Kit: Processing composer updates...</info>');

        // Skip discovery completely when running as a package
        if (! self::isInLaravelApplication()) {
            $event->getIO()->write('<info>Blade Starter Kit: Skipping package discovery (not in a Laravel application context).</info>');

            return;
        }

        // Create basic Laravel structure to ensure we can detect the namespace
        try {
            self::ensureBasicLaravelStructure();

            if (file_exists('./vendor/autoload.php') && file_exists('./bootstrap/app.php')) {
                // Prevent errors from bubbling up that would break composer
                self::safelyRunPackageDiscovery($event);
            }
        } catch (\Throwable $e) {
            // Just log the error, don't fail the composer process
            $event->getIO()->write("<warning>Blade Starter Kit: {$e->getMessage()}</warning>");
        }
    }

    /**
     * Check if we're in a Laravel application context.
     */
    private static function isInLaravelApplication(): bool
    {
        // Check for key Laravel files
        $laravelFiles = [
            'artisan',
            'composer.json',
        ];

        foreach ($laravelFiles as $file) {
            if (! file_exists("./{$file}")) {
                return false;
            }
        }

        // Check composer.json for Laravel dependencies
        if (file_exists('./composer.json')) {
            $composerJson = json_decode(file_get_contents('./composer.json'), true);
            if (isset($composerJson['require']['laravel/framework'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Ensure we have a minimal Laravel structure to detect the namespace.
     */
    private static function ensureBasicLaravelStructure(): void
    {
        // Create app directory if it doesn't exist
        if (! is_dir('./app')) {
            mkdir('./app', 0755, true);
        }

        // Create app/Providers directory if it doesn't exist
        if (! is_dir('./app/Providers')) {
            mkdir('./app/Providers', 0755, true);
        }

        // Create a minimal AppServiceProvider if it doesn't exist
        if (! file_exists('./app/Providers/AppServiceProvider.php')) {
            file_put_contents(
                './app/Providers/AppServiceProvider.php',
                <<<'EOT'
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
EOT
            );
        }
    }

    /**
     * Run package discovery in a way that won't break composer if it fails.
     */
    private static function safelyRunPackageDiscovery($event): void
    {
        try {
            // Only load the autoloader if we're confident it exists
            require_once './vendor/autoload.php';

            // Only try to boot the app if we're confident bootstrap/app.php exists
            $app = require './bootstrap/app.php';

            // Only proceed if we can resolve the kernel
            if ($app->bound('Illuminate\Contracts\Console\Kernel')) {
                $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
                $kernel->call('package:discover');
                $event->getIO()->write('<info>Blade Starter Kit: Package discovery completed.</info>');
            } else {
                $event->getIO()->write('<warning>Blade Starter Kit: Could not resolve console kernel.</warning>');
            }
        } catch (\Throwable $e) {
            // Specifically catch namespace detection errors and provide a message
            if (strpos($e->getMessage(), 'Unable to detect application namespace') !== false) {
                $event->getIO()->write('<warning>Blade Starter Kit: Application namespace not yet available. Package discovery will be handled by Laravel later.</warning>');
            } else {
                $event->getIO()->write("<warning>Blade Starter Kit error during package discovery: {$e->getMessage()}</warning>");
            }
        }
    }
}
