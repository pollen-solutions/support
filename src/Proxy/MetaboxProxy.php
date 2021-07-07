<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Metabox\MetaboxManager;
use Pollen\Metabox\MetaboxManagerInterface;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\MetaboxProxyInterface
 */
trait MetaboxProxy
{
    /**
     * Instance du gestionnaire de metaboxes.
     */
    private ?MetaboxManagerInterface $metaboxManager = null;

    /**
     * Instance du gestionnaire de metaboxes.
     *
     * @return MetaboxManagerInterface
     */
    public function metabox(): MetaboxManagerInterface
    {
        if ($this->metaboxManager === null) {
            try {
                $this->metaboxManager = MetaboxManager::getInstance();
            } catch (RuntimeException $e) {
                $this->metaboxManager = ProxyResolver::getInstance(
                    MetaboxManagerInterface::class,
                    MetaboxManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->metaboxManager;
    }

    /**
     * Définition de l'instance du gestionnaire de metaboxes.
     *
     * @param MetaboxManagerInterface $metaboxManager
     *
     * @return void
     */
    public function setMetaboxManager(MetaboxManagerInterface $metaboxManager): void
    {
        $this->metaboxManager = $metaboxManager;
    }
}