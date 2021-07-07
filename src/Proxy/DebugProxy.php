<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Debug\DebugManager;
use Pollen\Debug\DebugManagerInterface;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\DebugProxyInterface
 */
trait DebugProxy
{
    /**
     * Instance du gestionnaire de débogage.
     */
    private ?DebugManagerInterface $debugManager = null;

    /**
     * Instance du gestionnaire de débogage.
     *
     * @return DebugManagerInterface
     */
    public function debug(): DebugManagerInterface
    {
        if ($this->debugManager === null) {
            try {
                $this->debugManager = DebugManager::getInstance();
            } catch (RuntimeException $e) {
                $this->debugManager = ProxyResolver::getInstance(
                    DebugManagerInterface::class,
                    DebugManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->debugManager;
    }

    /**
     * Définition du gestionnaire de débogage.
     *
     * @param DebugManagerInterface $debugManager
     *
     * @return void
     */
    public function setDebugManager(DebugManagerInterface $debugManager): void
    {
        $this->debugManager = $debugManager;
    }
}