<?php

declare(strict_types=1);

namespace Pollen\Support;

use BadMethodCallException;
use RuntimeException;
use ReflectionClass;
use ReflectionException;
use Throwable;

/**
 * @mixin ReflectionClass
 */
class ClassInfo
{
    /**
     * Listes des classes.
     * @var ReflectionClass[]|array
     */
    protected static $reflectionClasses = [];

    /**
     * @var string
     */
    protected $currentClassName = '';

    /**
     * @param string|object $class
     */
    public function __construct($class)
    {
        $this->currentClassName = is_object($class) ? get_class($class) : $class;

        if (self::$reflectionClasses[$this->currentClassName] ?? null) {
            try {
                self::$reflectionClasses[$this->currentClassName] = new ReflectionClass($this->currentClassName);
            } catch (ReflectionException $e) {
                throw new RuntimeException(
                    sprintf(
                        'ClassInfo unable instanciate ReflectionClass for [%s]',
                        $this->currentClassName
                    ),
                    0,
                    $e
                );
            }
        }
    }

    /**
     * Délégation d'appel d'une méthode de la classe de réflexion de la classe courante.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        try {
            return self::$reflectionClasses[$this->currentClassName]->$method(...$arguments);
        } catch (Throwable $e) {
            throw new BadMethodCallException(
                sprintf(
                    'Default Logger method call [%s] throws an exception: %s',
                    $method,
                    $e->getMessage()
                ), 0, $e
            );
        }
    }

    /**
     * Récupération du chemin absolu vers le repertoire de stockage d'une application déclarée.
     *
     * @return string
     */
    public function getDirname(): string
    {
        return dirname($this->getFilename());
    }

    /**
     * Récupération du nom court de la classe au format kebab (Minuscules séparées par des tirets).
     *
     * @return string
     */
    public function getKebabName(): string
    {
        return Str::kebab($this->getShortName());
    }
}