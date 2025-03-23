<?php

namespace NikolayBalkandzhiyski\BladeStarterKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use NikolayBalkandzhiyski\BladeStarterKit\StarterKit;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blade-kit:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Blade Starter Kit resources';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Publish stubs
        $this->publishStubs();
        
        // Install NPM dependencies
        $this->updateNodePackages(function ($packages) {
            return [
                'alpinejs' => '^3.4.2',
                '@tailwindcss/forms' => '^0.5.2',
                // Add any other dependencies
            ] + $packages;
        });

        // Configure Tailwind
        $this->installTailwindConfiguration();
        
        // Update Routes
        $this->replaceInFile(
            '// Add your routes here...',
            file_get_contents(__DIR__.'/../../stubs/routes/web.php'),
            base_path('routes/web.php')
        );
        
        // Success message
        $this->info((new StarterKit)->installationSummary());
        
        return self::SUCCESS;
    }

    /**
     * Publish stubs to the application.
     */
    protected function publishStubs(): void
    {
        $this->callSilent('vendor:publish', [
            '--tag' => 'blade-starter-kit-stubs',
            '--force' => true,
        ]);
    }

    /**
     * Update NPM dependencies in the package.json file.
     */
    protected function updateNodePackages(callable $callback): void
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('package.json')), true);
        $packages['devDependencies'] = $callback($packages['devDependencies'] ?? []);
        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Configure Tailwind CSS.
     */
    protected function installTailwindConfiguration(): void
    {
        copy(__DIR__.'/../../stubs/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.'/../../stubs/postcss.config.js', base_path('postcss.config.js'));
    }

    /**
     * Replace a string in a file.
     */
    protected function replaceInFile($search, $replace, $path): void
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
