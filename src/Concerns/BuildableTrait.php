<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

/**
 * @see \Pollen\Support\Concerns\BuildableTraitInterface
 */
trait BuildableTrait
{
    /**
     * État d'initialisation.
     * @var bool
     */
    private $built = false;

    /**
     * Vérification de l'état d'initialisation.
     * @return bool
     */
    public function isBuilt(): bool
    {
        return $this->built;
    }

    /**
     * Définition de l'état d'initialisation.
     *
     * @param bool $built
     *
     * @return void
     */
    public function setBuilt(bool $built = true): void
    {
        $this->built = $built;
    }
}