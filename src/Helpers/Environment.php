<?php

namespace NikolayBalkandzhiyski\BladeStarterKit\Helpers;

class Environment
{
    /**
     * Determine if the current execution context is a Laravel application.
     */
    public static function isLaravelApplication(): bool
    {
        return file_exists(base_path('artisan'));
    }

    /**
     * Determine if the current execution context is the package itself.
     */
    public static function isPackage(): bool
    {
        return ! static::isLaravelApplication();
    }
}
