<?php

namespace Arekaev\TbankPayment\Enums;

use ReflectionClass;
use ReflectionClassConstant;

abstract class Enum
{
    public static function isValid($value): bool
    {
        return in_array($value, self::getPublicConstantValues());
    }

    private static function getPublicConstantValues(): array
    {
        $reflectionClass = new ReflectionClass(static::class);
        $constants = $reflectionClass->getConstants();

        $reflectionConstants = array_filter(
            array_keys($constants), // Берем имена констант
            function ($constantName) use ($reflectionClass) {
                // Создаем объект ReflectionClassConstant на основе имени константы
                return (new ReflectionClassConstant($reflectionClass->getName(), $constantName))->isPublic();
            }
        );

        // Возвращаем значения тех констант, которые прошли фильтр
        return array_map(function ($constantName) use ($constants) {
            return $constants[$constantName];
        }, $reflectionConstants);
    }
}