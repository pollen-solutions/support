<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\ParamsBag;
use InvalidArgumentException;

interface ParamsBagAwareTraitInterface
{
    /**
     * Liste des paramètres par défaut.
     *
     * @return array
     */
    public function defaultParams(): array;

    /**
     * Définition|Récupération|Instance des paramètres de configuration.
     *
     * @param array|string|null $key
     * @param mixed $default
     *
     * @return string|int|array|mixed|ParamsBag
     *
     * @throws InvalidArgumentException
     */
    public function params($key = null, $default = null);

    /**
     * Traitement de la liste des paramètres.
     *
     * @return void
     */
    public function parseParams(): void;

    /**
     * Définition de la liste des paramètres.
     *
     * @param array $params
     *
     * @return void
     */
    public function setParams(array $params): void;
}