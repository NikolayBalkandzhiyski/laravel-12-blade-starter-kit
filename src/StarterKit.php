<?php

namespace NikolayBalkandzhiyski\BladeStarterKit;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;

class StarterKit
{
    /**
     * Install the starter kit into the application.
     */
    public function install(): void
    {
        // Copy stubs
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs', base_path());

        // Update package.json
        $this->updateNodePackages(function ($packages) {
            return [
                'alpinejs' => '^3.4.2',
                'autoprefixer' => '^10.4.2',
                'postcss' => '^8.4.6',
                'tailwindcss' => '^3.1.0',
                ...$packages,
            ];
        });

        // Install NPM dependencies
        $this->runCommands(['npm install', 'npm run build']);

        // Update routes/web.php
        $this->replaceInFile(
            '// Routes go here...',
            $this->getRoutesFileContent(),
            base_path('routes/web.php')
        );
    }

    /**
     * Update the "package.json" file.
     */
    protected function updateNodePackages(callable $callback): void
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages['devDependencies'] = $callback(
            $packages['devDependencies'] ?? []
        );

        ksort($packages['devDependencies']);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Replace a given string within a given file.
     */
    protected function replaceInFile(string $search, string $replace, string $path): void
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
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
}
