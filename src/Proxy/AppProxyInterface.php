<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Kernel\ApplicationInterface;

Interface AppProxyInterface
{
    /**
     * Resolve App Instance or service served by container.
     *
     * @param string|null $serviceName
     *
     * @return ApplicationInterface|mixed
     */
    public function app(?string $serviceName = null);

    /**
     * Set App instance.
     *
     * @param ApplicationInterface $app
     *
     * @return void
     */
    public function setApp(ApplicationInterface $app): void;
}