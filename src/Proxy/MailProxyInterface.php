<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Mail\MailableInterface;
use Pollen\Mail\MailManagerInterface;

interface MailProxyInterface
{
    /**
     * Instance du gestionnaire de mail|Instance de mail.
     *
     * @param MailableInterface|string|array|null $mailable
     *
     * @return MailManagerInterface|MailableInterface
     */
    public function mail($mailable = null);

    /**
     * Définition du gestionnaire de mail.
     *
     * @param MailManagerInterface $mailManager
     *
     * @return void
     */
    public function setMailManager(MailManagerInterface $mailManager): void;
}