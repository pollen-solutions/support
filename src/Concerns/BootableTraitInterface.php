<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

interface BootableTraitInterface
{
    /**
     * Vérification de l'état de chargement.
     *
     * @return bool
     */
    public function isBooted(): bool;

    /**
     * Définition de l'état de chargement.
     *
     * @param bool $booted
     *
     * @return void
     */
    public function setBooted(bool $booted = true): void;
}