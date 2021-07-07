<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Cookie\CookieInterface;
use Pollen\Cookie\CookieJarInterface;

interface CookieProxyInterface
{
    /**
     * Instance du gestionnaire de cookies|Instance d'un cookie.
     *
     * @param string|null $alias
     *
     * @return CookieJarInterface|CookieInterface
     */
    public function cookie(?string $alias = null);

    /**
     * Définition du gestionnaire de cookies.
     *
     * @param CookieJarInterface $cookieJar
     *
     * @return void
     */
    public function setCookieJar(CookieJarInterface $cookieJar): void;
}