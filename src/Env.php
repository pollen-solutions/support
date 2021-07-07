<?php

declare(strict_types=1);

namespace Pollen\Support;

use Dotenv\Dotenv;
use Illuminate\Support\Env as BaseEnv;

class Env extends BaseEnv
{
    protected static ?Dotenv $loader = null;

    /**
     * @param string $dir
     *
     * @return Dotenv
     */
    public static function load(string $dir): Dotenv
    {
        if (static::$loader === null) {
            static::$loader = Dotenv::createImmutable($dir);
            static::$loader->safeLoad();
        }

        return static::$loader;
    }

    /**
     * Vérifie si l'environnement d'éxecution est en développement.
     *
     * @return bool
     */
    public static function inDev(): bool
    {
        return static::get('APP_ENV') === 'dev' || static::get('APP_ENV') === 'developpement';
    }

    /**
     * Vérifie si l'environnement d'éxecution est en production.
     *
     * @return bool
     */
    public static function inProd(): bool
    {
        return static::get('APP_ENV') === 'prod' || static::get('APP_ENV') === 'production';
    }

    /**
     * Vérifie si l'environnement d'éxecution est en recette.
     *
     * @return bool
     */
    public static function inStaging(): bool
    {
        return static::get('APP_ENV') === 'staging';
    }
}