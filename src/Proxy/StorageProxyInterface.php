<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Filesystem\StorageManagerInterface;
use Pollen\Filesystem\FilesystemInterface;

interface StorageProxyInterface
{
    /**
     * Instance du gestionnaire de stockage|système de gestion de fichiers.
     *
     * @param string|null $diskName
     *
     * @return StorageManagerInterface|FilesystemInterface
     */
    public function storage(?string $diskName = null);

    /**
     * Définition du gestionnaire de stockage.
     *
     * @param StorageManagerInterface $storageManager
     *
     * @return void
     */
    public function setStorageManager(StorageManagerInterface $storageManager): void;
}