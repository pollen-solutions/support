<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Config\ConfiguratorInterface;

interface ConfigProxyInterface
{
    /**
     * Instance du gestionnaire de configuration.
     *
     * @param array|string|null $key
     * @param mixed $default
     *
     * @return ConfiguratorInterface|mixed
     */
    public function config(?string $key = null, $default = null);

    /**
     * Définition du gestionnaire de configuration.
     *
     * @param ConfiguratorInterface $configurator
     *
     * @return void
     */
    public function setConfigurator(ConfiguratorInterface $configurator): void;
}