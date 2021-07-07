<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\View\ViewInterface;
use Pollen\View\ViewManagerInterface;

interface ViewProxyInterface
{
    /**
     * Resolve viewManager instance.
     *
     * @return ViewManagerInterface
     */
    public function viewManager(): ViewManagerInterface;

    /**
     * Resolve view instance or return a particular template render.
     *
     * @param string|null $name.
     * @param array $data
     *
     * @return ViewInterface|string
     */
    public function view(?string $name = null, array $data = []);

    /**
     * Set viewManager instance.
     *
     * @param ViewManagerInterface $viewManager
     *
     * @return void
     */
    public function setViewManager(ViewManagerInterface $viewManager): void;
}