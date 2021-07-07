<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Faker\FakerInterface;

Interface FakerProxyInterface
{
    /**
     * Get Faker instance|Return a modifier call.
     *
     * @param string|null $modifier
     * @param ...$args
     *
     * @return FakerInterface|mixed
     */
    public function faker(?string $modifier = null, ...$args);

    /**
     * Set Faker instance.
     *
     * @param FakerInterface $faker
     *
     * @return void
     */
    public function setFaker(FakerInterface $faker): void;
}