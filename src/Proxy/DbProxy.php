<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Schema\Builder as SchemaBuilder;
use Pollen\Database\DatabaseManager;
use Pollen\Database\DatabaseManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;
use Exception;

/**
 * @see \Pollen\Support\Proxy\DbProxyInterface
 */
trait DbProxy
{
    /**
     * Instance du gestionnaire de base de données.
     */
    private ?DatabaseManagerInterface $dbManager = null;

    /**
     * Instance du gestionnaire de base de données|Gestionnaire de requête d'une table de la base de données.
     *
     * @param string|null $dbTable
     *
     * @return DatabaseManagerInterface|Builder
     */
    public function db(?string $dbTable = null)
    {
        if ($this->dbManager === null) {
            try {
                $this->dbManager = DatabaseManager::getInstance();
            } catch (RuntimeException $e) {
                $this->dbManager = ProxyResolver::getInstance(
                    DatabaseManagerInterface::class,
                    DatabaseManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($dbTable === null) {
            return $this->dbManager;
        }

        try {
            return $this->dbManager->getConnection()->table($dbTable);
        } catch(Exception $e) {
            throw new ProxyInvalidArgumentException(sprintf('Db Table [%s] is unavailable', $dbTable));
        }
    }

    /**
     * Instance du constructeur de base de données.
     *
     * @param string $name
     *
     * @return SchemaBuilder
     */
    public function schema(string $name = 'default'): SchemaBuilder
    {
        return $this->db()->getConnection($name)->getSchemaBuilder();
    }

    /**
     * Définition du gestionnaire de base de données.
     *
     * @param DatabaseManagerInterface $dbManager
     *
     * @return void
     */
    public function setDbManager(DatabaseManagerInterface $dbManager): void
    {
        $this->dbManager = $dbManager;
    }
}