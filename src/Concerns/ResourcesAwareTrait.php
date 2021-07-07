<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\Exception\ResourcesUnavailableException;
use Pollen\Support\Filesystem;
use ReflectionClass;
use ReflectionException;

/**
 * @see \Pollen\Support\Concerns\ResourcesAwareTraitInterface
 */
trait ResourcesAwareTrait
{
    /**
     * Chemin relatif vers le répertoire des ressources.
     * @var string|null
     */
    protected $resourcesBasePath = '../resources';

    /**
     * Chemin absolu vers le répertoire des ressources.
     * @var string|null
     */
    protected $resourcesBaseDir;

    /**
     * Chemin absolu vers une ressource (fichier|répertoire).
     *
     * @param string|null $path
     *
     * @return string
     */
    public function resources(?string $path = null): string
    {
        if ($this->resourcesBaseDir === null) {
            try {
                $reflector = new ReflectionClass(get_class($this));
                $this->resourcesBaseDir = realpath(
                    dirname($reflector->getFileName()) . Filesystem::DS . $this->resourcesBasePath
                );
            } catch (ReflectionException $e) {
                throw new ResourcesUnavailableException(
                    sprintf('[%s] ressources directory unreachable', static::class),
                    0,
                    $e
                );
            }

            if (!file_exists($this->resourcesBaseDir)) {
                throw new ResourcesUnavailableException(
                    sprintf('[%s] ressources directory unreachable', static::class)
                );
            }
        }

        return $this->resourcesNormalizePath(
            $path === null
                ? $this->resourcesBaseDir
                : $this->resourcesBaseDir . Filesystem::DS . $path
        );
    }

    /**
     * Définition du chemin absolu vers le répertoire des ressources.
     *
     * @param string $resourceBaseDir
     *
     * @return void
     */
    public function setResourcesBaseDir(string $resourceBaseDir): void
    {
        $this->resourcesBaseDir = $resourceBaseDir;
    }

    /**
     * Normalisation d'un chemin vers un répertoire.
     *
     * @param string $path
     *
     * @return string
     */
    protected function resourcesNormalizePath(string $path): string
    {
        return Filesystem::normalizePath($path);
    }
}