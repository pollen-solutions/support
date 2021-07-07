<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\ParamsBag;
use InvalidArgumentException;

trait ParamsBagAwareTrait
{
    /**
     * Instance du gestionnaire de paramètres
     * @var ParamsBag|null
     */
    private $paramsBag;

    /**
     * Liste des paramètres par défaut.
     *
     * @return array
     */
    public function defaultParams(): array
    {
        return [];
    }

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
    public function params($key = null, $default = null)
    {
        if (!$this->paramsBag instanceof ParamsBag) {
            $this->paramsBag = ParamsBag::createFromAttrs($this->defaultParams());
        }

        if (is_null($key)) {
            return $this->paramsBag;
        }

        if (is_string($key)) {
            return $this->paramsBag->get($key, $default);
        }

        if (is_array($key)) {
            $this->paramsBag->set($key);
            return $this->paramsBag;
        }

        throw new InvalidArgumentException('Invalid ParamsBag passed method arguments');
    }

    /**
     * Traitement de la liste des paramètres.
     *
     * @return void
     */
    public function parseParams(): void
    {
    }

    /**
     * Définition de la liste des paramètres.
     *
     * @param array $params
     *
     * @return void
     */
    public function setParams(array $params): void
    {
        $this->params($params);
    }
}