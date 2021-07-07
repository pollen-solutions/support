<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Form\FormInterface;
use Pollen\Form\FormManager;
use Pollen\Form\FormManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;

/**
 * @see \Pollen\Support\Proxy\FormProxyInterface
 */
trait FormProxy
{
    /**
     * Instance du gestionnaire de formulaires.
     */
    private ?FormManagerInterface $formManager = null;

    /**
     * Instance du gestionnaire de formulaires|Instance d'un formulaire.
     *
     * @param string|null $alias
     *
     * @return FormManagerInterface|FormInterface
     */
    public function form(?string $alias = null)
    {
        if ($this->formManager === null) {
            try {
                $this->formManager = FormManager::getInstance();
            } catch (RuntimeException $e) {
                $this->formManager = ProxyResolver::getInstance(
                    FormManagerInterface::class,
                    FormManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($alias === null) {
            return $this->formManager;
        }

        if ($form = $this->formManager->get($alias)) {
            return $form;
        }

        throw new ProxyInvalidArgumentException(sprintf('Form [%s] is unavailable', $alias));
    }

    /**
     * Définition du gestionnaire de formulaires.
     *
     * @param FormManagerInterface $formManager
     *
     * @return void
     */
    public function setFormManager(FormManagerInterface $formManager): void
    {
        $this->formManager = $formManager;
    }
}