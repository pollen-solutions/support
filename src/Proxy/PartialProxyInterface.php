<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Partial\PartialDriverInterface;
use Pollen\Partial\PartialManagerInterface;

interface PartialProxyInterface
{
    /**
     * Instance du gestionnaire de portions d'affichage|Instance d'une portion d'affichage.
     *
     * @param string|null $alias Alias de qualification.
     * @param mixed $idOrParams Identifiant de qualification|Liste des attributs de configuration.
     * @param array|null $params Liste des attributs de configuration.
     *
     * @return PartialManagerInterface|PartialDriverInterface
     */
    public function partial(?string $alias = null, $idOrParams = null, ?array $params = null);

    /**
     * Définition du gestionnaire de portions d'affichage.
     *
     * @param PartialManagerInterface $partialManager
     *
     * @return void
     */
    public function setPartialManager(PartialManagerInterface $partialManager): void;
}