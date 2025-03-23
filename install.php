#!/usr/bin/env php
<?php

/**
 * Laravel Blade Starter Kit Manual Installer
 *
 * This script can be used if the automatic installation fails.
 * Run it from the root of your Laravel project with:
 * php install.php
 */
$basePath = getcwd();

// Check if we're in a Laravel project
if (! file_exists($basePath.'/artisan')) {
    echo "⚠️  This doesn't seem to be a Laravel project. Make sure you run this script from your Laravel project root.\n";
    exit(1);
}

// Welcome message
echo "🚀 Laravel Blade Starter Kit Manual Installer\n";
echo "============================================\n\n";

try {
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
    $stubsPath = __DIR__.'/stubs';

    function recursiveCopy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst, 0755, true);

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
