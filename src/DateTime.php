<?php

declare(strict_types=1);

namespace Pollen\Support;

use Carbon\Carbon;
use Exception;

class DateTime extends Carbon
{
    /**
     * Format de date par défaut
     * @var string
     */
    protected static $defaultFormat = 'Y-m-d H:i:s';

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->format(static::$defaultFormat);
    }

    /**
     * Définition du format d'affichage par défault de la date.
     *
     * @param string $format
     *
     * @return string
     */
    public static function setDefaultFormat(string $format): string
    {
        return static::$defaultFormat = $format;
    }

    /**
     * Récupération de la date locale pour un format donné.
     *
     * @param string|null $format Format d'affichage de la date.
     * @param string|null $locale ex. en|en_GB|fr ...
     *
     * @return string
     */
    public function formatLocale(?string $format = null, ?string $locale = null): string
    {
        if ($locale !== null) {
            $baseLocale = $this->locale ?? null;
            $this->locale($locale);
        }
        $date = $this->settings(['formatFunction' => 'translatedFormat'])->format($format ?: static::$defaultFormat);

        if (isset($baseLocale)) {
            $this->locale($baseLocale);
        }
        return $date;
    }

    /**
     * Récupération de la date basée sur le temps universel pour un format donné.
     *
     * @param string|null $format Format d'affichage de la date. MySQL par défaut.
     *
     * @return string|null
     */
    public function utc(?string $format = null): ?string
    {
        try {
            return (new static(null, 'UTC'))
                ->setTimestamp($this->getTimestamp())->format($format ?: static::$defaultFormat);
        } catch (Exception $e) {
            return null;
        }
    }
}