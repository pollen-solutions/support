<?php

declare(strict_types=1);

namespace Pollen\Support;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

interface MessagesBagInterface extends ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    /**
     * Récupération de la liste complète des enregistrements
     *
     * @return array
     */
    public function all(): array;

    /**
     * Ajout d'un message de notification.
     *
     * @param int $level
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function addRecord(int $level, string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Récupération de la liste complète des messages|associés à un niveau.
     *
     * @param int|null $level
     *
     * @return array
     */
    public function allMessages(?int $level = null): array;

    /**
     * Récupération de la liste complète des codes|associés à un niveau.
     *
     * @param int|null $level
     *
     * @return string[]
     */
    public function allCodes(?int $level = null): array;

    /**
     * Récupération de la liste complète des données de contexte|associées à un niveau.
     *
     * @param int|null $level
     *
     * @return array
     */
    public function allContexts(?int $level = null): array;

    /**
     * Récupère le nombre total d'enregistrements|associées à un niveau.
     *
     * @param int|null $level
     *
     * @return int
     */
    public function count(?int $level = null): int;

    /**
     * Vérification l'existence d'enregistrement|associées à un niveau.
     *
     * @param int|null $level
     *
     * @return bool
     */
    public function exists(?int $level = null): bool;

    /**
     * Vérification d'existence d'enregistrements répondant à des données de contexte, limité à un niveau (en option).
     *
     * @param array $context
     * @param int|null $level
     *
     * @return bool
     */
    public function existsForContext(array $context, ?int $level = null): bool;

    /**
     * Retrouve la liste des enregistrements, pouvant être associé à un niveau et un code.
     *
     * @param int|null $level
     * @param string|null $code
     *
     * @return array
     */
    public function fetch(?int $level = null, $code = null): array;

    /**
     * Retrouve la liste des messages formatés selon une liste de niveau fournies.
     *
     * @param string[]|int[] $levelsMap Cartographie des niveaux de retour.
     *
     * @return string[][]
     */
    public function fetchMessages(array $levelsMap = []): array;

    /**
     * Réinitialisation des enregistrements.
     *
     * @param int|null $level
     *
     * @return static
     */
    public function flush(?int $level = null): MessagesBagInterface;

    /**
     * Liste des enregistrements répondant à des données de contexte, limité à un niveau (en option).
     *
     * @param array $context
     * @param int|null $level
     *
     * @return array
     */
    public function getForContext(array $context, ?int $level = null): array;

    /**
     * Récupération de la liste complète des codes associés à un niveau.
     *
     * @param int $level
     *
     * @return string[]|array
     */
    public function getLevelCodes(int $level): array;

    /**
     * Récupération de la liste complète des données de contexte associées à un niveau et un code (en option).
     *
     * @param int $level
     * @param string|null $code
     *
     * @return array
     */
    public function getLevelContexts(int $level, $code = null): array;

    /**
     * Récupération de la liste complète des messages associés à un niveau et un code (en option).
     *
     * @param int $level
     * @param string|null $code
     *
     * @return array
     */
    public function getLevelMessages(int $level, $code = null): array;

    /**
     * Vérification d'existence d'un niveau.
     *
     * @param int $level
     *
     * @return bool
     */
    public function hasLevel(int $level): bool;

    /**
     * Vérification d'existence d'un nom de qualification de niveau.
     *
     * @param string $levelName
     *
     * @return bool
     */
    public function hasLevelName(string $levelName): bool;

    /**
     * Vérification de prise en charge du niveau de notification.
     *
     * @param int $level
     *
     * @return bool
     */
    public function isHandling(int $level): bool;

    /**
     * Récupération de la liste des enregistrement au format json.
     *
     * @return string
     */
    public function json(): string;

    /**
     * Définition du niveau de notification de récupération des messages.
     *
     * @param int $level
     *
     * @return static
     */
    public function setHandlingLevel(int $level): MessagesBagInterface;

    /**
     * Ajout d'un message d'alerte.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function alert(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout d'un message de condition critique.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function critical(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout d'un message de deboguage.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function debug(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout d'un message d'urgence.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function emergency(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout d'un message d'erreur.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function error(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout d'un message d'information.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function info(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout d'un message de niveau arbitraire.
     *
     * @param string|int $level
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function log($level, string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout d'un message de notification.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function notice(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout d'un message de succès.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function success(string $message = '', ?array $context = null, ?string $code = null): array;

    /**
     * Ajout d'un message d'avertissement.
     *
     * @param string $message
     * @param array|null $context
     * @param string|null $code
     *
     * @return array
     */
    public function warning(string $message = '', ?array $context = null, ?string $code = null): array;
}