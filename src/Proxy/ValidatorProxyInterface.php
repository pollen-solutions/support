<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Validation\ValidatorInterface;

Interface ValidatorProxyInterface
{
    /**
     * Instance du gestionnaire de validation|Validation.
     *
     * @param string|null $ruleName.
     * @param array|null $args
     *
     * @return ValidatorInterface
     */
    public function validator(?string $ruleName = null, ...$args): ValidatorInterface;

    /**
     * Définition du gestionnaire de validation.
     *
     * @param ValidatorInterface $validator
     *
     * @return void
     */
    public function setValidator(ValidatorInterface $validator): void;
}