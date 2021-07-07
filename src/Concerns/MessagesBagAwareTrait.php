<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\MessagesBag;

/**
 * @see \Pollen\Support\Concerns\MessagesBagAwareTraitInterface
 */
trait MessagesBagAwareTrait
{
    /**
     * Instance du gestionnaire des messages.
     * @var MessagesBag|null
     */
    private ?MessagesBag $messagesBag = null;

    /**
     * Définition d'un message|Instance du gestionnaire de message.
     *
     * @param string|null $message
     * @param string|int $level
     * @param mixed $datas
     *
     * @return array|MessagesBag
     */
    public function messages(?string $message = null, $level = MessagesBag::ERROR, array $datas = [])
    {
        if (!$this->messagesBag instanceof MessagesBag) {
            $this->messagesBag = new MessagesBag();
        }

        if ($message === null) {
            return $this->messagesBag;
        }

        $level = MessagesBag::toMessageBagLevel($level);

        return $this->messagesBag->log($level, $message, $datas);
    }

    /**
     * Définition de l'instance du gestionnaire de messages.
     *
     * @param MessagesBag $messagesBag
     *
     * @return void
     */
    public function setMessagesBag(MessagesBag $messagesBag): void
    {
        $this->messagesBag = $messagesBag;
    }
}