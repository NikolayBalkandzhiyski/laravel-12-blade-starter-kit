<?php

namespace NikolayBalkandzhiyski\BladeStarterKit\Console;

use Illuminate\Console\Command;
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
    protected $description = 'Install the Blade Starter Kit';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Installing Blade Starter Kit...');

        // Remove default resources
        $this->removeDefaultResources();

        // Install starter kit
        (new StarterKit)->install();

        $this->info('Blade Starter Kit installed successfully.');
        $this->newLine();
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');

        return Command::SUCCESS;
    }

    /**
     * Remove Laravel's default resources.
     */
    protected function removeDefaultResources(): void
    {
        $this->info('Removing default resources...');

        $filesystem = new \Illuminate\Filesystem\Filesystem;

        // Remove welcome view
        if ($filesystem->exists(resource_path('views/welcome.blade.php'))) {
            $filesystem->delete(resource_path('views/welcome.blade.php'));
        }
    }
}
