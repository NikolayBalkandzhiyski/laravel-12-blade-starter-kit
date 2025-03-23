<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use NikolayBalkandzhiyski\BladeStarterKit\StarterKit;

class BladeKitInstall extends Command
{
    protected $signature = 'blade-kit:install';

    protected $description = 'Install the Blade Starter Kit';

    public function handle()
    {
        $this->info('Installing Blade Starter Kit via local command...');

        try {
            $starterKit = new StarterKit;
            $starterKit->install();

            $this->info($starterKit->installationSummary());

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Error installing Blade Starter Kit: '.$e->getMessage());
            $this->newLine();
            $this->error($e->getTraceAsString());

            return self::FAILURE;
        }
    }
}
