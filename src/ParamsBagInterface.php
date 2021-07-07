<?php

declare(strict_types=1);

namespace Pollen\Support;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Pollen\Support\Exception\JsonException;

interface ParamsBagInterface extends ArrayAccess, Countable, IteratorAggregate
{
    /**
     * Récupération d'un élément d'itération.
     *
     * @param string|int $key Clé d'indexe.
     *
     * @return mixed
     */
    public function __get($key);

    /**
     * Définition d'un élément d'itération.
     *
     * @param string|int $key Clé d'indexe.
     * @param mixed $value Valeur.
     *
     * @return void
     */
    public function __set($key, $value): void;

    /**
     * Vérification d'existance d'un élément d'itération.
     *
     * @param string|int $key Clé d'indexe.
     *
     * @return bool
     */
    public function __isset($key): bool;

    /**
     * Suppression d'un élément d'itération.
     *
     * @param string|int $key Clé d'indexe.
     *
     * @return void
     */
    public function __unset($key): void;

    /**
     * Récupération de la liste des attributs.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Suppression de la liste des attributs déclarés.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Compte le nombre d'éléments.
     *
     * @return int
     */
    public function count(): int;

    /**
     * Définition de la liste des attributs par défaut.
     *
     * @return array
     */
    public function defaults(): array;

    /**
     * Suppression d'un ou plusieurs attributs.
     *
     * @param array|string $keys Liste des indices des attributs à supprimer. Syntaxe à point permise.
     *
     * @return void
     */
    public function forget($keys): void;

    /**
     * Récupération d'un attribut.
     *
     * @param string $key Clé d'indexe de l'attribut. Syntaxe à point permise.
     * @param mixed $default Valeur de retour par defaut lorsque l'attribut n'est pas défini.
     *
     * @return mixed
     */
    public function get(string $key, $default = '');

    /**
     * @inheritDoc
     */
    public function getIterator(): iterable;

    /**
     * Vérification d'existence d'un attribut de configuration.
     *
     * @param string $key Clé d'indexe de l'attribut. Syntaxe à point permise.
     *
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Récupération de la liste des paramètres au format json.
     * @see http://php.net/manual/fr/function.json-encode.php
     *
     * @param int $options Options d'encodage.
     *
     * @return string
     *
     * @throws JsonException
     */
    public function json($options = 0): string;

    /**
     * Récupération de la liste des clés d'indexes des attributs de configuration.
     *
     * @return string[]
     */
    public function keys(): array;

    /**
     * Cartographie de donnée.
     *
     * @param mixed $value
     * @param string|int $key
     *
     * @return void
     */
    public function map(&$value, $key): void;

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool;

    /**
     * @inheritDoc
     */
    public function offsetGet($offset);

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void;

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset): void;

    /**
     * Récupération d'un jeu d'attributs associé à une liste de clés d'indices.
     *
     * @param string[] $keys Liste des clés d'indice du jeu d'attributs à récupérer.
     *
     * @return array
     */
    public function only(array $keys): array;

    /**
     * Traitement de la liste des attributs.
     *
     * @return void
     */
    public function parse(): void;

    /**
     * Récupére la valeur d'un attribut avant de le supprimer.
     *
     * @param string $key Clé d'indexe de l'attribut. Syntaxe à point permise.
     * @param mixed $default Valeur de retour par defaut lorsque l'attribut n'est pas défini.
     *
     * @return mixed
     */
    public function pull(string $key, $default = null);

    /**
     * Insertion d'un attribut à la fin d'une liste d'attributs.
     *
     * @param string $key Clé d'indexe de l'attribut. Syntaxe à point permise.
     * @param mixed $value Valeur de l'attribut.
     *
     * @return void
     */
    public function push(string $key, $value): void;

    /**
     * Définition d'un attribut.
     *
     * @param string|array $key Clé d'indexe de l'attribut, Syntaxe à point permise ou tableau associatif des attributs
     *                          à définir.
     * @param mixed $value Valeur de l'attribut si la clé d'index est de type string.
     *
     * @return void
     */
    public function set($key, $value = null): void;

    /**
     * Insertion d'un attribut au début d'une liste d'attributs.
     *
     * @param mixed $value Valeur de l'attribut.
     * @param string $key Clé d'indexe de l'attribut. Syntaxe à point permise.
     *
     * @return void
     */
    public function unshift($value, string $key): void;

    /**
     * Récupération de la liste des valeurs des attributs de configuration.
     *
     * @return mixed[]
     */
    public function values(): array;
}