<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\ParamsBag;
use InvalidArgumentException;

interface ConfigBagAwareTraitInterface
{
    /**
     * Liste des paramètres de configuration par défaut.
     *
     * @return array
     */
    public function defaultConfig(): array;

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
    public function config($key = null, $default = null);

    /**
     * Traitement de la liste des paramètres de configuration.
     *
     * @return void
     */
    public function parseConfig(): void;

    /**
     * Définition de la liste des paramètres de configuration.
     *
     * @param array $params
     *
     * @return void
     */
    public function setConfig(array $params): void;
}