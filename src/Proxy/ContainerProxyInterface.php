<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use League\Container\Definition\DefinitionInterface;
use Psr\Container\ContainerInterface as Container;

interface ContainerProxyInterface
{
    /**
     * Ajout d'un service fourni par le conteneur d'injection de dépendances.
     *
     * @param string $alias Alias de qualification du service.
     * @param mixed|null $concrete
     * @param bool $share
     *
     * @return DefinitionInterface
     */
    public function containerAdd(string $alias, $concrete = null, bool $share = false): ?DefinitionInterface;

    /**
     * Vérification de disponibilité d'un service fourni par le conteneur d'injection de dépendances.
     *
     * @param string $alias Alias de qualification du service.
     *
     * @return bool
     */
    public function containerHas(string $alias): bool;

    /**
     * Récupération d'un service fourni par le conteneur d'injection de dépendances.
     *
     * @param string $alias Alias de qualification du service.
     *
     * @return mixed|null
     */
    public function containerGet(string $alias);

    /**
     * Récupération de l'instance du conteneur d'injection de dépendances.
     *
     * @return Container|null
     */
    public function getContainer(): ?Container;

    /**
     * Définition du conteneur d'injection de dépendances.
     *
     * @param Container $container
     *
     * @return void
     */
    public function setContainer(Container $container): void;
}