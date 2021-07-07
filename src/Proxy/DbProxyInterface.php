<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Illuminate\Database\Schema\Builder as SchemaBuilder;
use Pollen\Database\DatabaseManagerInterface;
use Illuminate\Database\Query\Builder;

interface DbProxyInterface
{
    /**
     * Instance du gestionnaire de base de données|Gestionnaire de requête d'une table de la base de données.
     *
     * @param string|null $dbTable
     *
     * @return DatabaseManagerInterface|Builder
     */
    public function db(?string $dbTable = null);

    /**
     * Instance du constructeur de base de données.
     *
     * @param string $name
     *
     * @return SchemaBuilder
     */
    public function schema(string $name = 'default'): SchemaBuilder;

    /**
     * Définition du gestionnaire de base de données.
     *
     * @param DatabaseManagerInterface $dbManager
     *
     * @return void
     */
    public function setDbManager(DatabaseManagerInterface $dbManager): void;
}