<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Http\RequestInterface;
use Psr\Http\Message\ServerRequestInterface as PsrRequestInterface;
use Symfony\Component\HttpFoundation\Request as BaseRequest;

interface HttpRequestProxyInterface
{
    /**
     * Instance de la requête HTTP.
     *
     * @return RequestInterface|BaseRequest
     */
    public function httpRequest(): RequestInterface;

    /**
     * Instance de la requête HTTP au format PSR-7.
     *
     * @return PsrRequestInterface
     */
    public function httpPsrRequest(): PsrRequestInterface;

    /**
     * Définition de la requête HTTP.
     *
     * @param RequestInterface $httpRequest
     *
     * @return void
     */
    public function setHttpRequest(RequestInterface $httpRequest): void;
}