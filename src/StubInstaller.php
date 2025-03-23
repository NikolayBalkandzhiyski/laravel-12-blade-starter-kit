<?php

namespace NikolayBalkandzhiyski\BladeStarterKit;

use Illuminate\Filesystem\Filesystem;

class StubInstaller
{
    /**
     * Install skeleton files into the Laravel application.
     */
    public static function install(Filesystem $files): void
    {
        // Ensure basic application structure
        self::ensureDirectoriesExist($files);

        // Install base application files
        self::installAppFiles($files);
    }

    /**
     * Create necessary directories for Laravel.
     */
    protected static function ensureDirectoriesExist(Filesystem $files): void
    {
        $directories = [
            'app/Http/Controllers/Auth',
            'app/Models',
            'app/Providers',
            'config',
            'database/migrations',
            'resources/views/auth',
            'resources/views/components',
            'resources/views/layouts',
            'routes',
        ];

        foreach ($directories as $directory) {
            if (! $files->isDirectory(base_path($directory))) {
                $files->makeDirectory(base_path($directory), 0755, true);
            }
        }
    }

    /**
     * Install base application files.
     */
    protected static function installAppFiles(Filesystem $files): void
    {
        // Create routes file
        if (! $files->exists(base_path('routes/web.php'))) {
            $files->put(
                base_path('routes/web.php'),
                "<?php\n\nuse Illuminate\Support\Facades\Route;\n\n// Add your routes here...\n"
            );
        }

        // Create User model
        if (! $files->exists(base_path('app/Models/User.php'))) {
            $files->put(
                base_path('app/Models/User.php'),
                <<<'EOT'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
EOT
            );
        }

        // Create AppServiceProvider
        if (! $files->exists(base_path('app/Providers/AppServiceProvider.php'))) {
            $files->put(
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
