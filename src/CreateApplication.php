<?php

namespace NikolayBalkandzhiyski\BladeStarterKit;

class CreateApplication
{
    /**
     * Create a basic application structure.
     */
    public static function ensure(): void
    {
        // Create app directory and basic structure if it doesn't exist
        if (! is_dir(base_path('app'))) {
            mkdir(base_path('app'), 0755, true);
            mkdir(base_path('app/Http'), 0755, true);
            mkdir(base_path('app/Http/Controllers'), 0755, true);
        }

        // Ensure an App namespace file exists
        if (! file_exists(base_path('app/Providers'))) {
            mkdir(base_path('app/Providers'), 0755, true);
        }

        // Create AppServiceProvider if it doesn't exist
        if (! file_exists(base_path('app/Providers/AppServiceProvider.php'))) {
            file_put_contents(
                base_path('app/Providers/AppServiceProvider.php'),
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
}
