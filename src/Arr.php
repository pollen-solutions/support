<?php

declare(strict_types=1);

namespace Pollen\Support;

use Illuminate\Support\Arr as BaseArr;
use Pollen\Validation\Validator as v;

class Arr extends BaseArr
{
    /**
     * Insertion d'un tableau après une clé d'indice
     * @see https://gist.github.com/wpscholar/0deadce1bbfa4adb4e4c
     *
     * @param array $array
     * @param mixed $new
     * @param string|int $key
     *
     * @return array
     */
    public static function insertAfter(array $array, $new, $key): array
    {
        $keys = array_keys($array);
        $index = array_search($key, $keys, true);
        $pos = false === $index ? count($array) : $index;

        return array_merge(
            array_slice($array, 0, $pos, true),
            [$pos => $new],
            array_slice($array, $pos, null, true)
        );
    }

    /**
     * Serialisation de données si nécessaire.
     *
     * @param string|array|object $data
     *
     * @return mixed
     */
    public static function serialize($data)
    {
        if (is_array($data) || is_object($data)) {
            return serialize($data);
        }

        if (v::serialized(false)->validate($data)) {
            return serialize($data);
        }

        return $data;
    }

    /**
     * Suppression des slashes.
     *
     * @param string|array|object $data
     *
     * @return string|array|object
     */
    public static function stripslashes($data)
    {
        if (is_array($data)) {
            foreach ($data as $index => $item) {
                $data[$index] = static::stripslashes($item);
            }
        } elseif (is_object($data)) {
            $object_vars = get_object_vars($data);

            foreach ($object_vars as $property_name => $property_value) {
                $data->$property_name = static::stripslashes($property_value);
            }
        } elseif (is_string($data)) {
            $data = stripslashes($data);
        }

        return $data;
    }
}