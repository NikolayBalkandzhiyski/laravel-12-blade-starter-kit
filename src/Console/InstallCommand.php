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
    protected $signature = 'blade-kit:install
                            {--composer=global : Absolute path to the Composer binary which should be used to install packages}
                            {--dark : Indicate that dark mode support should be installed}
                            {--pest : Indicate that Pest should be installed}
                            {--ssr : Indicate if Vite SSR should be installed}
                            {--typescript : Indicate if TypeScript is preferred}';

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
        // Starter kit banner
        $this->components->info('
    ____  __           __         _____ __             __           __ __ _ __
   / __ )/ /___ _____/ /__      / ___// /_____ ______/ /____  ____/ //_/(_) /_
  / __  / / __ `/ __  / _ \     \__ \/ __/ __ `/ ___/ __/ _ \/ __  / __// / __/
 / /_/ / / /_/ / /_/ /  __/    ___/ / /_/ /_/ / /  / /_/  __/ /_/ / /_ / / /_
/_____/_/\__,_/\__,_/\___/____/____/\__/\__,_/_/   \__/\___/\__,_/\__//_/\__/
                       /_____/
        ');

        // 1. Ensure we have the basic app structure
        $this->components->info('Preparing application scaffolding...');
        $this->ensureApplicationExists();

        // 2. Publish the stubs
        $this->components->info('Publishing starter kit resources...');
        $this->publishStubs();

        // 3. Update package.json
        $this->updateNodePackages();

        // 4. Configure Tailwind
        $this->installTailwindConfiguration();

        // 5. Install NPM dependencies if requested
        if ($this->confirm('Would you like to install and build your frontend dependencies now?', true)) {
            $this->installNpmDependencies();
        }

        // 6. Show final message
        $this->components->info((new StarterKit)->installationSummary());

        return self::SUCCESS;
    }

    /**
     * Install NPM dependencies
     */
    protected function installNpmDependencies(): void
    {
        $this->components->info('Installing NPM dependencies...');

        if (file_exists(base_path('package.json'))) {
            $this->components->task('Installing node dependencies', function () {
                return $this->runCommands(['npm install', 'npm run build']);
            });
        }
    }

    /**
     * Run the given commands.
     */
    protected function runCommands($commands): bool
    {
        $process = proc_open(implode(' && ', $commands), [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ], $pipes);

        $output = stream_get_contents($pipes[1]);
        $error = stream_get_contents($pipes[2]);

        foreach ($pipes as $pipe) {
            fclose($pipe);
        }

        $status = proc_close($process);

        return $status === 0;
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
    protected function updateNodePackages(): void
    {
        if (! $this->files->exists(base_path('package.json'))) {
            return;
        }

        $this->info('Updating package.json...');

        $packages = json_decode($this->files->get(base_path('package.json')), true);
        $packages['devDependencies'] = [
            'alpinejs' => '^3.4.2',
            '@tailwindcss/forms' => '^0.5.2',
            'tailwindcss' => '^3.1.0',
            'autoprefixer' => '^10.4.2',
            'postcss' => '^8.4.6',
        ] + ($packages['devDependencies'] ?? []);

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
