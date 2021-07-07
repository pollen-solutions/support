<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Mail\MailableInterface;
use Pollen\Mail\MailManager;
use Pollen\Mail\MailManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\MailProxyInterface
 */
trait MailProxy
{
    /**
     * Instance du gestionnaire de mail.
     */
    private ?MailManagerInterface $mailManager = null;

    /**
     * Instance du gestionnaire de mail|Instance de mail.
     *
     * @param MailableInterface|string|array|null $mailable
     *
     * @return MailManagerInterface|MailableInterface
     */
    public function mail($mailable = null)
    {
        if ($this->mailManager === null) {
            try {
                $this->mailManager = MailManager::getInstance();
            } catch (RuntimeException $e) {
                $this->mailManager = ProxyResolver::getInstance(
                    MailManagerInterface::class,
                    MailManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($mailable === null) {
            return $this->mailManager;
        }

        if ($this->mailManager->setMailable($mailable)) {
            return $this->mailManager->getMailable();
        }

        throw new ProxyInvalidArgumentException('Mailable is unavailable');
    }

    /**
     * Définition du gestionnaire de mail.
     *
     * @param MailManagerInterface $mailManager
     *
     * @return void
     */
    public function setMailManager(MailManagerInterface $mailManager): void
    {
        $this->mailManager = $mailManager;
    }
}