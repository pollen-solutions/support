<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Filesystem\FilesystemInterface;
use Pollen\Filesystem\StorageManager;
use Pollen\Filesystem\StorageManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\StorageProxyInterface
 */
trait StorageProxy
{
    /**
     * Instance du gestionnaire de stockage.
     */
    private ?StorageManagerInterface $storageManager = null;

    /**
     * Instance du gestionnaire de stockage|système de gestion de fichiers.
     *
     * @param string|null $diskName
     *
     * @return StorageManagerInterface|FilesystemInterface
     */
    public function storage(?string $diskName = null)
    {
        if ($this->storageManager === null) {
            try {
                $this->storageManager = StorageManager::getInstance();
            } catch (RuntimeException $e) {
                $this->storageManager = ProxyResolver::getInstance(
                    StorageManagerInterface::class,
                    StorageManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($diskName === null) {
            return $this->storageManager;
        }

        if ($disk = $this->storageManager->disk($diskName)) {
            return $disk;
        }

        throw new ProxyInvalidArgumentException(sprintf('Filesystem [%s] is unavailable', $diskName));
    }

    /**
     * Définition du gestionnaire de stockage.
     *
     * @param StorageManagerInterface $storageManager
     *
     * @return void
     */
    public function setStorageManager(StorageManagerInterface $storageManager): void
    {
        $this->storageManager = $storageManager;
    }
}