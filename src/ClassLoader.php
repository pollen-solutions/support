<?php

declare(strict_types=1);

namespace Pollen\Support;

use Composer\Autoload\ClassLoader as BaseClassLoader;
use Pollen\Support\Filesystem as fs;
use RuntimeException;

class ClassLoader extends BaseClassLoader
{
    /**
     * @var string
     */
    protected static $baseDir = '';

    /**
     * Déclaration d'un jeu de répertoire PSR-0|PSR-4 pour un espace de nom ou auto-inclusion de fichier.
     *
     * @param string $prefix Espace de nom de qualification.
     * @param array|string $paths Chemin(s) vers le(s) repertoire(s) de l'espace de nom.
     * @param string $type psr-4|psr-0|files
     *
     * @return $this
     */
    public function load(string $prefix, $paths, string $type = 'psr-4'): self
    {
        switch ($type) {
            default :
            case 'psr-4' :
                $this->addPsr4($prefix, $paths);
                break;
            case 'psr-0' :
                $this->add($prefix, $paths);
                break;
            case 'files' :
                if (is_string($paths)) {
                    $paths = Arr::wrap($paths);
                }

                foreach ($paths as $path) {
                    $file = fs::normalizePath(self::$baseDir . fs::DS . $path);

                    if (file_exists($file)) {
                        include_once $file;
                    } else {
                        throw new RuntimeException(
                            sprintf('ClassLoader could not require file [%s]', $file)
                        );
                    }
                }
                break;
            case 'classmap' :
                /** @todo */
                break;
        }

        $this->register();

        return $this;
    }

    /**
     * Définition du chemin absolue de base pour les fichiers.
     * @param $baseDir
     */
    public static function setBaseDir($baseDir): void
    {
        self::$baseDir = $baseDir;
    }
}