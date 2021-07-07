<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Routing\RouterInterface;

interface RouterProxyInterface
{
    /**
     * Instance du gestionnaire de routage.
     *
     * @return RouterInterface
     */
    public function router(): RouterInterface;

    /**
     * Définition du gestionnaire de routage.
     *
     * @param RouterInterface $router
     *
     * @return void
     */
    public function setRouter(RouterInterface $router): void;
}