<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Form\FormInterface;
use Pollen\Form\FormManagerInterface;

interface FormProxyInterface
{
    /**
     * Instance du gestionnaire de formulaires|Instance d'un formulaire.
     *
     * @param string|null $alias
     *
     * @return FormManagerInterface|FormInterface
     */
    public function form(?string $alias = null);

    /**
     * Définition du gestionnaire de formulaires.
     *
     * @param FormManagerInterface $formManager
     *
     * @return void
     */
    public function setFormManager(FormManagerInterface $formManager): void;
}