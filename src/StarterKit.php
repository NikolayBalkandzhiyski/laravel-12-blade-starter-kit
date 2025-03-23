<?php

namespace NikolayBalkandzhiyski\BladeStarterKit;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;

class StarterKit
{
    /**
     * The filesystem instance.
     */
    protected Filesystem $files;

    /**
     * Create a new StarterKit instance.
     */
    public function __construct()
    {
        $this->files = new Filesystem;
    }

    /**
     * Install the starter kit into the application.
     */
    public function install(): void
    {
        // Ensure application structure exists
        StubInstaller::install($this->files);

        // Copy stubs
        $this->files->copyDirectory(__DIR__.'/../stubs', base_path());

        // Update package.json
        $this->updateNodePackages(function ($packages) {
            return [
                'alpinejs' => '^3.12.3',
                'autoprefixer' => '^10.4.16',
                'postcss' => '^8.4.31',
                'tailwindcss' => '^3.3.5',
                '@tailwindcss/forms' => '^0.5.7',
                ...$packages,
            ];
        });

        // Update routes/web.php - use custom method that's safer
        $this->updateRoutesFile();
    }

    /**
     * Update the routes file.
     */
    protected function updateRoutesFile(): void
    {
        $routesPath = base_path('routes/web.php');

        if (! $this->files->exists($routesPath)) {
            $this->files->put($routesPath, "<?php\n\nuse Illuminate\Support\Facades\Route;\n\n");
        }

        // Always append routes to the end of the file
        $this->files->append($routesPath, "\n".$this->getRoutesFileContent());
    }

    /**
     * Update the "package.json" file.
     */
    protected function updateNodePackages(callable $callback): void
    {
        if (! $this->files->exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode($this->files->get(base_path('package.json')), true);

        $packages['devDependencies'] = $callback(
            $packages['devDependencies'] ?? []
        );

        ksort($packages['devDependencies']);

        $this->files->put(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Replace a given string within a given file.
     */
    protected function replaceInFile(string $search, string $replace, string $path): void
    {
        $this->files->put($path, str_replace($search, $replace, $this->files->get($path)));
    }

    /**
     * Run the given commands.
     */
    protected function runCommands($commands): void
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

        proc_close($process);

        if ($error) {
            throw new RuntimeException($error);
        }
    }

    /**
     * Get the routes file content.
     */
    protected function getRoutesFileContent(): string
    {
        return <<<'EOF'
Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])
                ->name('login');

    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);

    Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'create'])
                ->name('register');

    Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])
                ->name('dashboard');

    Route::post('logout', [\App\Http\Controllers\Auth\LogoutController::class, 'store'])
                ->name('logout');
});
EOF;
    }

    /**
     * Get the name of the starter kit.
     */
    public function name(): string
    {
        return 'Laravel 12 Blade Starter Kit';
    }

    /**
     * Get the description of the starter kit.
     */
    public function description(): string
    {
        return 'A simple, clean starter kit with Blade templates and traditional form-based authentication.';
    }

    /**
     * Get the starter kit installation summary.
     */
    public function installationSummary(): string
    {
        return 'Blade starter kit installed successfully! Make sure to run `npm install && npm run dev` to compile your assets.';
    }

    /**
     * Return the available features for this starter kit.
     */
    public function features(): array
    {
        return [
            'blade' => true,
            'alpinejs' => true,
            'tailwind' => true,
            'auth' => true,
            'dark-mode' => true,
        ];
    }
}
