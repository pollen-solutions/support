<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Log\LogManagerInterface;

interface LogProxyInterface
{
    /**
     * Instance du gestionnaire de log|Enregistrement d'un message de log.
     *
     * @param string|int|null $level
     * @param string $message
     * @param array $context
     *
     * @return LogManagerInterface|bool
     */
    public function log($level = null, string $message = '', array $context = []);

    /**
     * Définition du gestionnaire de log.
     *
     * @param LogManagerInterface $logManager
     *
     * @return void
     */
    public function setLogManager(LogManagerInterface $logManager): void;
}