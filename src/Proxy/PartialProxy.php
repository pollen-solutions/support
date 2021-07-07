<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Partial\PartialDriverInterface;
use Pollen\Partial\PartialManager;
use Pollen\Partial\PartialManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\PartialProxyInterface
 */
trait PartialProxy
{
    /**
     * Instance du gestionnaire de portions d'affichage.
     */
    private ?PartialManagerInterface $partialManager = null;

    /**
     * Instance du gestionnaire de portions d'affichage|Instance d'une portion d'affichage.
     *
     * @param string|null $alias Alias de qualification.
     * @param mixed $idOrParams Identifiant de qualification|Liste des attributs de configuration.
     * @param array|null $params Liste des attributs de configuration.
     *
     * @return PartialManagerInterface|PartialDriverInterface
     */
    public function partial(?string $alias = null, $idOrParams = null, ?array $params = null)
    {
        if ($this->partialManager === null) {
            try {
                $this->partialManager = PartialManager::getInstance();
            } catch (RuntimeException $e) {
                $this->partialManager = ProxyResolver::getInstance(
                    PartialManagerInterface::class,
                    PartialManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($alias === null) {
            return $this->partialManager;
        }

        if ($partial = $this->partialManager->get($alias, $idOrParams, $params)) {
            return $partial;
        }

        throw new ProxyInvalidArgumentException(sprintf('Partial [%s] is unavailable', $alias));
    }

    /**
     * Définition du gestionnaire de portions d'affichage.
     *
     * @param PartialManagerInterface $partialManager
     *
     * @return void
     */
    public function setPartialManager(PartialManagerInterface $partialManager): void
    {
        $this->partialManager = $partialManager;
    }
}