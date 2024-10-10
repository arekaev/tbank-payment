<?php

namespace Arekaev\TbankPayment\Helpers;

class Arr
{
    public static function get($array, string $key, $default = null)
    {
        if (is_array($array)) {
            return $array[$key] ?? $default;
        }

        return $default;
    }

    public static function has($array, string $key): bool
    {
        if (is_array($array)) {
            return array_key_exists($key, $array);
        }

        return false;
    }

    public static function merge(array  ...$arrays): array
    {
        return array_merge(...$arrays);
    }

    public static function except(array $array, array $keys): array
    {
        foreach ($keys as $key) {
            if (self::has($array, $key)) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}