<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Support\ProxyResolver;
use Pollen\View\ViewInterface;
use Pollen\View\ViewManager;
use Pollen\View\ViewManagerInterface;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\ViewProxyInterface
 */
trait ViewProxy
{
    /**
     * ViewManager instance.
     */
    private ?ViewManagerInterface $viewManager = null;

    /**
     * Resolve viewManager instance.
     *
     * @return ViewManagerInterface
     */
    public function viewManager(): ViewManagerInterface
    {
        if ($this->viewManager === null) {
            try {
                $this->viewManager = ViewManager::getInstance();
            } catch (RuntimeException $e) {
                $this->viewManager = ProxyResolver::getInstance(
                    ViewManagerInterface::class,
                    ViewManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        return $this->viewManager;
    }

    /**
     * Resolve view instance or return a particular template render.
     *
     * @param string|null $name.
     * @param array $data
     *
     * @return ViewInterface|string
     */
    public function view(?string $name = null, array $data = [])
    {
        $view = $this->viewManager()->getDefaultView();

        if ($name === null) {
            return $view;
        }

        return $view ->render($name, $data);
    }

    /**
     * Set viewManager instance.
     *
     * @param ViewManagerInterface $viewManager
     *
     * @return void
     */
    public function setViewManager(ViewManagerInterface $viewManager): void
    {
        $this->viewManager = $viewManager;
    }
}