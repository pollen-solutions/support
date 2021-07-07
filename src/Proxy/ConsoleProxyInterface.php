<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Console\ConsoleInterface;

interface ConsoleProxyInterface
{
    /**
     * Get Console manager instance.
     *
     * @return ConsoleInterface
     */
    public function console();

    /**
     * Set Console manager instance
     *
     * @param ConsoleInterface $console
     *
     * @return void
     */
    public function setConsole(ConsoleInterface $console): void;
}