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
        $starterKit = new StarterKit;
        $starterKit->install();

        $this->info($starterKit->installationSummary());

        return self::SUCCESS;
    }
}
