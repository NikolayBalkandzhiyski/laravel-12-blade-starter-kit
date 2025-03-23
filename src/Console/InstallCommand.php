<?php

namespace NikolayBalkandzhiyski\BladeStarterKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use NikolayBalkandzhiyski\BladeStarterKit\StarterKit;
use NikolayBalkandzhiyski\BladeStarterKit\StubInstaller;

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
     * The filesystem instance.
     */
    protected Filesystem $files;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->files = new Filesystem;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Installing Blade Starter Kit...');

        try {
            // Ensure basic structure exists
            $this->ensureApplicationExists();

            // Publish stubs
            $this->publishStubs();

            // Install NPM dependencies
            $this->updateNodePackages(function ($packages) {
                return [
                    'alpinejs' => '^3.4.2',
                    '@tailwindcss/forms' => '^0.5.2',
                    'tailwindcss' => '^3.1.0',
                    'autoprefixer' => '^10.4.2',
                    'postcss' => '^8.4.6',
                ] + $packages;
            });

            // Configure Tailwind
            $this->installTailwindConfiguration();

            // Success message
            $this->info((new StarterKit)->installationSummary());

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Error installing Blade Starter Kit: '.$e->getMessage());

            if ($this->getOutput()->isVerbose()) {
                $this->error($e->getTraceAsString());
            }

            return self::FAILURE;
        }
    }

    /**
     * Ensure a minimal Laravel application structure exists.
     */
    protected function ensureApplicationExists(): void
    {
        $this->info('Ensuring application structure...');
        StubInstaller::install($this->files);
    }

    /**
     * Publish stubs to the application.
     */
    protected function publishStubs(): void
    {
        $this->info('Publishing stubs...');

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
        if (! $this->files->exists(base_path('package.json'))) {
            return;
        }

        $this->info('Updating package.json...');

        $packages = json_decode($this->files->get(base_path('package.json')), true);
        $packages['devDependencies'] = $callback($packages['devDependencies'] ?? []);

        $this->files->put(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Configure Tailwind CSS.
     */
    protected function installTailwindConfiguration(): void
    {
        $this->info('Installing Tailwind configuration...');

        if ($this->files->exists(__DIR__.'/../../stubs/tailwind.config.js')) {
            $this->files->copy(
                __DIR__.'/../../stubs/tailwind.config.js',
                base_path('tailwind.config.js')
            );
        }

        if ($this->files->exists(__DIR__.'/../../stubs/postcss.config.js')) {
            $this->files->copy(
                __DIR__.'/../../stubs/postcss.config.js',
                base_path('postcss.config.js')
            );
        }
    }

    /**
     * Replace a string in a file.
     */
    protected function replaceInFile($search, $replace, $path): void
    {
        $this->files->put(
            $path,
            str_replace($search, $replace, $this->files->get($path))
        );
    }
}
