<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

interface ResourcesAwareTraitInterface
{
    /**
     * Chemin absolu vers une ressource (fichier|répertoire).
     *
     * @param string|null $path
     *
     * @return string
     */
    public function resources(?string $path = null): string;

    /**
     * Définition du chemin absolu vers le répertoire racine des ressources.
     *
     * @param string $resourceBaseDir
     *
     * @return void
     */
    public function setResourcesBaseDir(string $resourceBaseDir): void;
}