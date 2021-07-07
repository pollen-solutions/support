<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Asset\AssetInterface;
use Pollen\Asset\AssetManagerInterface;

Interface AssetProxyInterface
{
    /**
     * Instance du gestionnaire des assets.
     *
     * @param string|null $name
     *
     * @return AssetManagerInterface|AssetInterface
     */
    public function asset(?string $name = null);

    /**
     * Définition du gestionnaire des assets.
     *
     * @param AssetManagerInterface $assetManager
     *
     * @return void
     */
    public function setAssetManager(AssetManagerInterface $assetManager): void;
}