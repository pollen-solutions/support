<?php

declare(strict_types=1);

namespace Pollen\Support;

use Dotenv\Dotenv;
use Dotenv\Repository\Adapter\PutenvAdapter;
use Dotenv\Repository\RepositoryInterface;
use Dotenv\Repository\RepositoryBuilder;
use Pollen\Support\Filesystem as fs;
use PhpOption\Option;
use RuntimeException;

class Env
{
    /**
     * Environment loader instance.
     * @var Dotenv|null
     */
    protected static ?Dotenv $loader = null;

    /**
     * Environment repository instance.
     * @var RepositoryInterface|null
     */
    protected static ?RepositoryInterface $repository = null;

    /**
     * Allow uses global env var.
     * @var bool
     */
    protected static bool $globalEnabled = false;

    /**
     * Merge Vars Bag instance.
     * @var ParamsBag|null
     */
    protected static ?ParamsBag $mergeVarsBag = null;

    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param null $default
     *
     * @return string|bool|null
     */
    public static function get(string $key, $default = null)
    {
        return Option::fromValue(static::getRepository()->get($key))
            ->map(function ($value) {
                switch (strtolower($value)) {
                    case 'true':
                    case '(true)':
                        return true;
                    case 'false':
                    case '(false)':
                        return false;
                    case 'empty':
                    case '(empty)':
                        return '';
                    case 'null':
                    case '(null)':
                        return null;
                }

                if (preg_match('/\A([\'"])(.*)\1\z/', $value, $matches)) {
                    $value = $matches[2];
                }

                if (static::mergeVarsBag()->count()) {
                    $value = static::getMergedVarsValue($value);
                }

                return $value;
            })
            ->getOrCall(function () use ($default) {
                return value($default);
            });
    }

    /**
     * Enabling global environment variables usage.
     *
     * @param bool $enabled
     *
     * @return void
     */
    public static function enableGlobal(bool $enabled): void
    {
        static::$globalEnabled = true;
    }

    /**
     * Gets the environment repository instance.
     *
     * @return RepositoryInterface
     */
    public static function getRepository(): RepositoryInterface
    {
        if (static::$repository === null) {
            throw new RuntimeException('Env file must loaded before.');
        }
        return static::$repository;
    }

    /**
     * Loads the environment variables from a path.
     *
     * @param string $path
     *
     * @return Dotenv
     */
    public static function load(string $path): Dotenv
    {
        if (static::$loader === null) {
            $builder = RepositoryBuilder::createWithDefaultAdapters();

            if (static::$globalEnabled) {
                $builder->addAdapter(PutenvAdapter::class);
            }
            $builder->immutable();

            static::$repository = $builder->make();

            $names = ['.env', '.env.local'];
            foreach ($names as $k => $name) {
                $filename = fs::normalizePath($path . fs::DS . $name);
                if (!file_exists($filename)) {
                    unset($names[$k]);
                }
            }

            static::$loader = Dotenv::create(static::$repository, $path, array_values($names), false);
            static::$loader->safeLoad();
        }

        return static::$loader;
    }

    /**
     * Checks if the execution environment is the development one.
     *
     * @return bool
     */
    public static function inDev(): bool
    {
        return static::get('APP_ENV') === 'dev' || static::get('APP_ENV') === 'developpement';
    }

    /**
     * Checks if the execution environment is the production one.
     *
     * @return bool
     */
    public static function inProd(): bool
    {
        return static::get('APP_ENV') === 'prod' || static::get('APP_ENV') === 'production';
    }

    /**
     * Checks if the execution environment is the staging one.
     *
     * @return bool
     */
    public static function inStaging(): bool
    {
        return static::get('APP_ENV') === 'staging';
    }

    /**
     * Gets the merged vars bag instance.
     *
     * @return ParamsBag
     *
     * @throws \InvalidArgumentException
     */
    public static function mergeVarsBag(): ParamsBag
    {
        if (static::$mergeVarsBag === null) {
            static::$mergeVarsBag = new ParamsBag();
        }

        return static::$mergeVarsBag;
    }

    /**
     * Gets a value with merged vars replacement.
     *
     * @param string $value
     *
     * @return string
     */
    private static function getMergedVarsValue(string $value): string
    {
        if (preg_match_all('/([^%%]*)%%(.*?)%%([^%%]*)?/', $value, $matches)) {
            $value = '';
            foreach ($matches[2] as $i => $tag) {
                $value .= $matches[1][$i] . static::mergeVarsBag()->get($tag, $matches[2][$i]) . $matches[3][$i];
            }
        }

        return $value;
    }

    /**
     * Set merge vars.
     *
     * @param array $mergeVars
     *
     * @return void
     */
    public static function setMergeVars(array $mergeVars): void
    {
        static::mergeVarsBag()->set($mergeVars);
    }
}