<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Event\EventDispatcherInterface;

interface EventProxyInterface
{
    /**
     * Instance du répartiteur d'événements.
     *
     * @return EventDispatcherInterface
     */
    public function event(): EventDispatcherInterface;

    /**
     * Définition du gestionnaire de events.
     *
     * @param EventDispatcherInterface $eventDispatcher
     *
     * @return void
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): void;
}