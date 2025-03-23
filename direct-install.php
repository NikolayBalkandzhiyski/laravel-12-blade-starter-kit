#!/usr/bin/env php
<?php

/**
 * Laravel Blade Starter Kit Direct Installer
 *
 * This script can be used if the Artisan command fails.
 * Run it from the root of your Laravel project with:
 * php vendor/nikolaybalkandzhiyski/laravel-12-blade-starter-kit/direct-install.php
 */

// Check if we're running from a terminal
if (PHP_SAPI !== 'cli') {
    echo "This script must be run from the command line.\n";
    exit(1);
}

$basePath = getcwd();

// Check if we're in a Laravel project
if (! file_exists($basePath.'/artisan')) {
    echo "⚠️  This doesn't seem to be a Laravel project. Make sure you run this script from your Laravel project root.\n";
    exit(1);
}

// Welcome message
echo "🚀 Laravel Blade Starter Kit Direct Installer\n";
echo "=============================================\n\n";

echo "This installer will directly copy starter kit files to your project.\n";
echo "This bypasses Laravel's dependency system which may be causing errors.\n\n";

// Confirm before proceeding
echo 'Do you want to continue? (y/n): ';
$handle = fopen('php://stdin', 'r');
$line = trim(fgets($handle));
if (strtolower($line) !== 'y') {
    echo "Installation aborted.\n";
    exit;
}

try {
    // Find the package path
    $packagePath = __DIR__;

    // If this script is being run from vendor directory
    if (strpos($packagePath, 'vendor/nikolaybalkandzhiyski/laravel-12-blade-starter-kit') === false) {
        $packagePath = $basePath.'/vendor/nikolaybalkandzhiyski/laravel-12-blade-starter-kit';
    }

    if (! is_dir($packagePath)) {
        echo "❌ Error: Cannot find the starter kit package directory.\n";
        exit(1);
    }

    // 1. Create basic directory structure
    echo "📁 Creating directory structure...\n";
    $directories = [
        'app/Http/Controllers/Auth',
        'app/Models',
        'app/Providers',
        'config',
        'resources/views/auth',
        'resources/views/components',
        'resources/views/layouts',
        'routes',
    ];

    foreach ($directories as $dir) {
        $path = $basePath.'/'.$dir;
        if (! is_dir($path)) {
            echo "  Creating $dir\n";
            mkdir($path, 0755, true);
        }
    }

    // 2. Copy stubs
    echo "📋 Copying starter kit files...\n";
    $stubsPath = $packagePath.'/stubs';

    function recursiveCopy($src, $dst)
    {
        if (! is_dir($src)) {
            echo "  Warning: Source directory $src does not exist.\n";

            return;
        }

        $dir = opendir($src);
        if (! is_dir($dst)) {
            mkdir($dst, 0755, true);
        }

        while (($file = readdir($dir)) !== false) {
            if ($file != '.' && $file != '..') {
                if (is_dir($src.'/'.$file)) {
                    recursiveCopy($src.'/'.$file, $dst.'/'.$file);
                } else {
                    copy($src.'/'.$file, $dst.'/'.$file);
                    echo '  Copied '.$dst.'/'.$file."\n";
                }
            }
        }

        closedir($dir);
    }

    recursiveCopy($stubsPath, $basePath);

    // 3. Update package.json
    echo "📦 Updating package.json...\n";
    if (file_exists($basePath.'/package.json')) {
        $packageJson = json_decode(file_get_contents($basePath.'/package.json'), true);

        $packageJson['devDependencies'] = array_merge($packageJson['devDependencies'] ?? [], [
            'alpinejs' => '^3.12.3',
            'autoprefixer' => '^10.4.16',
            'postcss' => '^8.4.31',
            'tailwindcss' => '^3.3.5',
            '@tailwindcss/forms' => '^0.5.7',
        ]);

        file_put_contents(
            $basePath.'/package.json',
            json_encode($packageJson, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    // 4. Success message
    echo "\n✅ Blade Starter Kit installed successfully!\n";
    echo "   Run these commands to complete setup:\n";
    echo "   - npm install\n";
    echo "   - npm run dev\n";
    echo "   - php artisan migrate\n\n";

} catch (Exception $e) {
    echo '❌ Error: '.$e->getMessage()."\n";
    exit(1);
}
